<?php
include('../../config.inc.php');
global $CONFIG;

function sanitizeString($string) {
    $string = mb_strtolower($string, 'UTF-8');
    $string = preg_replace('/[^a-z0-9\-áàâãéêíóôõúüç]/iu', '-', $string);
    $string = preg_replace('/-+/', '-', $string);
    $string = trim($string, '-');
    return $string;
}

function convertToUtf8($string) {
    $encoding = mb_detect_encoding($string, ['UTF-8', 'ISO-8859-1', 'Windows-1252'], true);
    if ($encoding && $encoding !== 'UTF-8') {
        $string = iconv($encoding, 'UTF-8//IGNORE', $string);
    }
    return $string;
}

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

$baseDir = $CONFIG['CONF']['cacheDir'];
$tempDir = $baseDir . '/temp';
$catalogJsonPath = $baseDir . '/catalog.json';
$categoriesJsonPath = $baseDir . '/catalog-categories.json';

if (!file_exists($baseDir)) {
    if (!mkdir($baseDir, 0777, true)) {
        echo json_encode(['success' => false, 'message' => 'Failed to create base directory']);
        exit;
    }
}

if (!file_exists($tempDir)) {
    if (!mkdir($tempDir, 0777, true)) {
        echo json_encode(['success' => false, 'message' => 'Failed to create temp directory']);
        exit;
    }
}

if (!isset($_FILES['csv_file'])) {
    echo json_encode(['success' => false, 'message' => 'No file uploaded']);
    exit;
}

if ($_FILES['csv_file']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['success' => false, 'message' => 'Upload error: ' . $_FILES['csv_file']['error']]);
    exit;
}

$csvFileName = uniqid('import_') . '.csv';
$csvFilePath = $tempDir . '/' . $csvFileName;

if (!move_uploaded_file($_FILES['csv_file']['tmp_name'], $csvFilePath)) {
    echo json_encode(['success' => false, 'message' => 'Failed to move uploaded file']);
    exit;
}

$handle = fopen($csvFilePath, 'r');
if (!$handle) {
    echo json_encode(['success' => false, 'message' => 'Error opening uploaded CSV file']);
    exit;
}

stream_filter_append($handle, 'convert.iconv.ISO-8859-1/UTF-8');

$headers = fgetcsv($handle);
if (!$headers) {
    echo json_encode(['success' => false, 'message' => 'Invalid CSV headers']);
    exit;
}
$headers = array_map('trim', array_map('strtolower', $headers));

$catalog = [];
if (file_exists($catalogJsonPath)) {
    $existingData = file_get_contents($catalogJsonPath);
    if ($existingData !== false) {
        $catalog = json_decode($existingData, true) ?? [];
    }
}

$categories = [];
if (file_exists($categoriesJsonPath)) {
    $existingCategories = file_get_contents($categoriesJsonPath);
    if ($existingCategories !== false) {
        $categories = json_decode($existingCategories, true) ?? [];
    }
}

$stats = ['imported' => 0, 'updated' => 0, 'skipped' => 0, 'errors' => []];
$existingSkus = array_column($catalog, 'sku');
$usedPermLinks = array_column($catalog, 'permLink');

while (($row = fgetcsv($handle)) !== false) {
    if (count($row) !== count($headers)) {
        $stats['errors'][] = "Invalid column count in row";
        continue;
    }

    $data = array_combine($headers, array_map('trim', $row));
    if (empty($data['sku'])) {
        $stats['errors'][] = "Empty SKU found";
        $stats['skipped']++;
        continue;
    }

    $data = array_map('convertToUtf8', $data);

    $existingIndex = array_search($data['sku'], $existingSkus);

    if ($existingIndex !== false) {
        $updated = false;
        foreach ($data as $key => $value) {
            if ($catalog[$existingIndex][$key] !== $value) {
                $catalog[$existingIndex][$key] = $value;
                $updated = true;
            }
        }
        if ($updated) {
            $catalog[$existingIndex]['updatedAt'] = date('Y-m-d H:i:s');
            $stats['updated']++;
        }
    } else {
        $basePermLink = $data['sku'] . '-' . sanitizeString($data['title'] ?? '');
        $permLink = $basePermLink;
        $counter = 1;
        while (in_array($permLink, $usedPermLinks)) {
            $permLink = $basePermLink . '-' . $counter;
            $counter++;
        }
        $usedPermLinks[] = $permLink;

        $newProduct = [
            'id' => CMS::generateUUID(),
            'title' => $data['title'] ?? '',
            'description' => $data['description'] ?? '',
            'featuredImage' => $data['image name 1'] ?? '',
            'sku' => $data['sku'],
            'priceList' => $data['pricelist'] ?? '0',
            'priceSale' => $data['pricesale'] ?? '0',
            'categories' => $data['category'] ?? '',
            'tags' => $data['tags'] ?? '',
            'inventory' => $data['inventory'] ?? '0',
            'weight' => $data['gramagem'] ?? '',
            'content' => $data['content'] ?? '',
            'status' => strtolower($data['status']) === 'ativo' ? 'enabled' : 'disabled',
            'addToSitemap' => '1',
            'highlightInCategory' => '0',
            'productType' => 'single',
            'createdAt' => date('Y-m-d H:i:s'),
            'userId' => Auth::getUserData($_SESSION['user'], "id") ?? null,
            'permLink' => $permLink
        ];

        $catalog[] = $newProduct;
        $existingSkus[] = $data['sku'];
        $stats['imported']++;

        // Add category to catalog-categories.json if not already present
        $categoriesArray = explode(',', $data['category']);
        foreach ($categoriesArray as $category) {
            $category = trim($category);
            if ($category === '') continue;
            $existingCategoryIndex = array_search($category, array_column($categories, 'title'));
            if ($existingCategoryIndex === false) {
                $newCategory = [
                    'id' => CMS::generateUUID(),
                    'title' => $category,
                    'createdAt' => date('Y-m-d H:i:s'),
                    'userId' => Auth::getUserData($_SESSION['user'], "id") ?? null,
                    'status' => 'enabled'
                ];
                $categories[] = $newCategory;
            }
        }
    }
}

$jsonData = json_encode($catalog, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
if ($jsonData === false) {
    echo json_encode(['success' => false, 'message' => 'JSON encoding failed: ' . json_last_error_msg()]);
    exit;
}

if (file_put_contents($catalogJsonPath, $jsonData) === false) {
    echo json_encode(['success' => false, 'message' => 'Failed to write catalog.json']);
    exit;
}

$categoriesJsonData = json_encode($categories, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
if ($categoriesJsonData === false) {
    echo json_encode(['success' => false, 'message' => 'JSON encoding failed for categories: ' . json_last_error_msg()]);
    exit;
}

if (file_put_contents($categoriesJsonPath, $categoriesJsonData) === false) {
    echo json_encode(['success' => false, 'message' => 'Failed to write catalog-categories.json']);
    exit;
}

fclose($handle);
unlink($csvFilePath);

echo json_encode([
    'success' => true,
    'message' => 'Import completed successfully',
    'stats' => [
        'totalImported' => $stats['imported'],
        'totalUpdated' => $stats['updated'],
        'totalSkipped' => $stats['skipped'],
        'totalErrors' => count($stats['errors']),
        'errors' => $stats['errors']
    ]
]);
?>
