<?php
$baseUrl = '';

function getSearchProducts($page = 1, $perPage = 9, $query = '') {
    $catalogPath = '../../../cached/catalog.json';
    $products = [];

    if (!file_exists($catalogPath)) {
        return [
            'products' => [],
            'totalPages' => 1,
            'currentPage' => 1,
            'totalResults' => 0
        ];
    }

    $jsonData = file_get_contents($catalogPath);
    $products = json_decode($jsonData, true);
    if (!is_array($products)) $products = [];

    if (!empty(trim($query))) {
        $query = strtolower(trim($query));
        $products = array_filter($products, function ($product) use ($query) {
            $title = strtolower($product['title'] ?? '');
            $sku = strtolower($product['sku'] ?? '');
            $tags = strtolower($product['tags'] ?? '');

            return strpos($title, $query) !== false ||
                   strpos($sku, $query) !== false ||
                   strpos($tags, $query) !== false;
        });
    }

    $totalProducts = count($products);
    if ($totalProducts === 0) {
        return [
            'products' => [],
            'totalPages' => 1,
            'currentPage' => 1,
            'totalResults' => 0,
            'message' => 'Nenhum resultado encontrado.'
        ];
    }

    $totalPages = max(1, ceil($totalProducts / $perPage));
    $currentPage = max(1, min($page, $totalPages));
    $offset = ($currentPage - 1) * $perPage;

    $paginatedProducts = array_slice(array_values($products), $offset, $perPage);

    return [
        'products' => $paginatedProducts,
        'totalPages' => $totalPages,
        'currentPage' => $currentPage,
        'totalResults' => $totalProducts
    ];
}

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';
$productsData = getSearchProducts($page, 9, $searchQuery);
?>

<section class="service-block bg-gradient6 pad-tb light-dark">
    <div class="container">

        <?php if ($searchQuery): ?>
            <div class="row mb-4">
                <div class="col-12">
                    <div class="search-results-info">
                        Encontrados <?= $productsData['totalResults'] ?> produtos para "<?= htmlspecialchars($searchQuery) ?>"
                        <a href="?" class="btn btn-sm btn-outline-secondary ml-3">Limpar busca</a>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row upset link-hover">
            <?php if (empty($productsData['products'])): ?>
                <div class="col-12 text-center">
                    <div class="alert alert-info mt-4" role="alert">
                        <h4>Nenhum produto encontrado</h4>
                        <p>Desculpe, não há produtos disponíveis no momento.</p>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($productsData['products'] as $index => $product): ?>
                    <div class="col-lg-4 col-sm-6 mt30 wow fadeInUp" data-wow-delay="<?= ($index * 0.2) ?>s">
                        <div class="s-block">
                            <div class="">
                                <a href="product-<?= htmlspecialchars($product['permLink']) ?>.html">
                                    <img src="<?= $baseUrl; ?>/assets/images/products/<?= htmlspecialchars($product['featuredImage']) ?>"
                                        alt="<?= htmlspecialchars($product['title']) ?>"
                                        onerror="this.onerror=null;this.src='<?= $baseUrl; ?>/assets/images/no-image.jpg';"
                                        class="img-fluid">
                                </a>
                            </div>
                            <h4>
                                <a href="product-<?= htmlspecialchars($product['permLink']) ?>.html">
                                    <?= htmlspecialchars($product['title']) ?>
                                </a>
                            </h4>
                            <?php if (!empty($product['description'])): ?>
                                <p><?= htmlspecialchars($product['description']) ?></p>
                            <?php endif; ?>
                            <?php if (!empty($product['weight'])): ?>
                                <p class="weight"><strong>Peso:</strong> <?= htmlspecialchars($product['weight']) ?></p>
                            <?php endif; ?>
                            <?php if (!empty($product['category'])): ?>
                                <strong>Categoria:</strong> <?= htmlspecialchars($product['category']) ?>
                            <?php endif; ?>
                            <?php if (!empty($product['sku'])): ?>
                                <br/><br/><strong>SKU:</strong> <?= htmlspecialchars($product['sku']) ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <?php if ($productsData['totalPages'] > 1): ?>
            <div class="row">
                <div class="col-12">
                    <nav aria-label="Product pagination" class="mt-4">
                        <ul class="pagination justify-content-center">
                            <li class="page-item <?= ($productsData['currentPage'] <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $productsData['currentPage'] - 1 ?><?= $searchQuery ? '&q=' . urlencode($searchQuery) : '' ?>">« Anterior</a>
                            </li>
                            <li class="page-item <?= ($productsData['currentPage'] >= $productsData['totalPages']) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $productsData['currentPage'] + 1 ?><?= $searchQuery ? '&q=' . urlencode($searchQuery) : '' ?>">Próximo »</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
.pagination {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    list-style: none;
    padding-left: 0;
}
.page-item {
    margin: 0 3px;
}
</style>
