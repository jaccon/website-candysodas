<?php
include(__DIR__ . '/../../config.inc.php'); 
global $CONFIG;
$searchTerm = isset($_GET['query']) ? trim($_GET['query']) : '';
$category = isset($_GET['category']) ? trim($_GET['category']) : '';

$files = [
    'post' => 'posts.json',
    'page' => 'pages.json',
    'component' => 'components.json'
];

$editPages = [
    'post' => 'post-update.html',
    'page' => 'page-update.html',
    'component' => 'components-update.html'
];

$results = [];
$debug = [];
$debugMode = false;

if ($searchTerm !== '' && isset($files[$category])) {
    $filePath = $CONFIG['CONF']['cacheDir'].'/'.$files[$category];
    $debug['file'] = $filePath; 
    if (file_exists($filePath)) {
        $data = json_decode(file_get_contents($filePath), true);
        $debug['data'] = $data;
        if (is_array($data)) {
            foreach ($data as $item) {
                if (stripos($item['title'], $searchTerm) !== false) {
                    $results[] = $item;
                }
            }
        }
    } else {
        $debug['error'] = "Arquivo não encontrado!";
    }
}
?>

<?php if ($debugMode && !empty($debug)): ?>
    <pre><?php print_r($debug); ?></pre>
<?php endif; ?>

<?php if ($searchTerm !== ''): ?>
    <p><strong>Termo pesquisado:</strong> <?= htmlspecialchars($searchTerm); ?> em <strong> <?= htmlspecialchars($_GET['category']); ?> </strong> </p>
<?php endif; ?>

<div class="card-body pt-0">
    <div class="table-responsive">
        <table class="table align-middle table-row-dashed fs-6 gy-5">
            <thead>
                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-200px">Title</th>
                    <th class="text-end min-w-100px">ID</th>
                    <th class="text-end min-w-70px">CreatedAt</th>
                    <th class="text-end min-w-100px">Status</th>
                </tr>
            </thead>
            <tbody class="fw-semibold text-gray-600">
                <?php if (!empty($results)): ?>
                    <?php foreach ($results as $item): ?>
                        <tr>
                            <td>
                                <a href="<?= isset($editPages[$category]) ? $editPages[$category] . '?id=' . $item['id'] : '#' ?>" class="text-gray-800 text-hover-primary fs-5 fw-bold">
                                    <?= htmlspecialchars($item['title']); ?>
                                </a>
                            </td>
                            <td class="text-end pe-0">
                                <span class="fw-bold"><?= htmlspecialchars($item['id']); ?></span>
                            </td>
                            <td class="text-end pe-0">
                                <span class="fw-bold ms-3">
                                  <?= Admin::formatDateTime($item['createdAt']); ?>
                                </span>
                            </td>
                            <td class="text-end pe-0">
                                <?= Admin::statusBaghets($item['status']); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No results found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>