<?php 
include(__DIR__ . '/../../config.inc.php'); 
global $CONFIG;
session_start();
Auth::loginSession();
Configurations::checkFeatureStatus('fmStatus');

$baseDirectory = realpath($CONFIG['CONF']['uploadDir']);
$currentDirectory = isset($_GET['dir']) ? realpath($baseDirectory . '/' . $_GET['dir']) : $baseDirectory;

if (!$currentDirectory || strpos($currentDirectory, $baseDirectory) !== 0) {
    $currentDirectory = $baseDirectory;
}

// Função para formatar o tamanho do arquivo
function formatSize($size) {
    $units = ['B', 'KB', 'MB', 'GB'];
    $i = 0;
    while ($size >= 1024 && $i < count($units) - 1) {
        $size /= 1024;
        $i++;
    }
    return round($size, 2) . ' ' . $units[$i];
}

// Função para formatar a data
function formatDate($timestamp) {
    return date('d M Y, H:i a', $timestamp);
}

// Função para excluir arquivo ou diretório
function deleteFileOrDirectory($path) {
    echo "Tentando excluir: " . $path . "<br>"; // Depuração
    if (is_dir($path)) {
        // Se for diretório, apagar recursivamente
        echo "É um diretório. Deletando...<br>"; // Depuração
        $files = array_diff(scandir($path), ['.', '..']);
        foreach ($files as $file) {
            deleteFileOrDirectory($path . DIRECTORY_SEPARATOR . $file);
        }
        rmdir($path);
    } elseif (is_file($path)) {
        echo "É um arquivo. Deletando...<br>"; // Depuração
        unlink($path);
    } else {
        echo "Caminho não encontrado ou não é um arquivo/diretório válido: " . $path . "<br>"; // Depuração
    }
}

// Verificar se há o parâmetro 'delete' na URL e excluir o arquivo ou diretório
if (isset($_GET['delete']) && isset($_GET['type']) && isset($_GET['dir'])) {
    $fileToDelete = realpath($currentDirectory . '/' . $_GET['delete']);
    
    echo "Caminho absoluto do arquivo a ser excluído: " . $fileToDelete . "<br>"; // Depuração

    if ($fileToDelete && strpos($fileToDelete, $currentDirectory) === 0) {
        if ($_GET['type'] == 'file' && is_file($fileToDelete)) {
            deleteFileOrDirectory($fileToDelete);
            header("Location: ?dir=" . urlencode($_GET['dir']));
            exit;
        } elseif ($_GET['type'] == 'directory' && is_dir($fileToDelete)) {
            deleteFileOrDirectory($fileToDelete);
            header("Location: ?dir=" . urlencode($_GET['dir']));
            exit;
        }
    } else {
        echo "Erro: O arquivo ou diretório não foi encontrado ou o caminho não é válido: " . $fileToDelete . "<br>"; // Depuração
    }
}

$files = scandir($currentDirectory);
$fileData = [];

foreach ($files as $file) {
    if ($file == '.' || $file == '..') {
        continue;
    }

    $filePath = $currentDirectory . '/' . $file;
    $relativePath = trim(str_replace($baseDirectory, '', $filePath), '/'); // Corrigido o caminho relativo

    $fileInfo = ['name' => $file, 'path' => $relativePath];

    if (is_dir($filePath)) {
        $fileInfo['type'] = 'directory';
    } elseif (is_file($filePath)) {
        $fileInfo['type'] = 'file';
        $fileInfo['size'] = formatSize(filesize($filePath));
        $fileInfo['date'] = formatDate(filemtime($filePath));
    }

    $fileData[] = $fileInfo;
}

$breadcrumbParts = explode('/', $relativePath);
$breadcrumbPath = '';
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?dir=">Home</a></li>
        <?php foreach ($breadcrumbParts as $index => $part): ?>
            <?php if (!empty($part)): ?>
                <?php 
                $breadcrumbPath .= ($breadcrumbPath ? '/' : '') . $part; 
                ?>
                <li class="breadcrumb-item">
                    <a href="?dir=<?= urlencode($breadcrumbPath) ?>"><?= htmlspecialchars($part) ?></a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ol>
</nav>

<table id="kt_file_manager_list" data-kt-filemanager-table="folders" class="table align-middle table-row-dashed fs-6 gy-5">
  <thead>
      <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
        <th class="min-w-250px">Filename</th>
        <th class="min-w-10px">Size</th>
        <th class="min-w-125px">Last Modified</th>
        <th class="w-125px"></th>
      </tr>
  </thead>

  <tbody class="fw-semibold text-gray-600">
      <?php foreach ($fileData as $fileInfo): ?>
            <tr>
                <td data-order="<?= htmlspecialchars($fileInfo['name']) ?>">
                    <div class="d-flex align-items-center">
                        <?php if ($fileInfo['type'] == 'directory'): ?>
                            <a href="?dir=<?= urlencode($fileInfo['path']) ?>" class="text-gray-800 text-hover-primary"><?= htmlspecialchars($fileInfo['name']) ?></a>
                        <?php else: ?>

                            <span class="icon-wrapper">
                                <i class="ki-duotone ki-files fs-2x text-primary me-4"></i>
                            </span>

                            <?php  $id = pathinfo($fileInfo['name'], PATHINFO_FILENAME); ?>

                            <a  href="<?= $CONFIG['CONF']['uploadUrl']."/".$fileInfo['path']; ?>"
                                target="_blank"
                                class="text-gray-800 text-hover-primary">
                                <img src="<?= $CONFIG['CONF']['uploadUrl']."/".$fileInfo['path']; ?>" width="40" />
                                <?= htmlspecialchars($fileInfo['name']) ?>
                                <br/>
                                <small class="text-muted"> <?= $CONFIG['CONF']['uploadUrl']."/".$fileInfo['path']; ?> </small>
                            </a>


                        <?php endif; ?>
                    </div>
                </td>
                <td>
                    <?= $fileInfo['type'] == 'file' ? $fileInfo['size'] : '-' ?>
                </td>
                <td>
                    <?= $fileInfo['type'] == 'file' ? $fileInfo['date'] : '-' ?>
                </td>
                <td class="text-end" data-kt-filemanager-table="action_dropdown">
                <button 
                    type="button" 
                    id="deleteF"
                    class="btn btn-danger btn-sm delete-file" 
                    data-name="<?= htmlspecialchars($fileInfo['name']) ?>" 
                    data-type="<?= htmlspecialchars($fileInfo['type']) ?>" 
                    data-dir="<?= htmlspecialchars($_GET['dir']) ?>"
                    onClick="deleteFileOrDir(this)"
                >
                    Delete
                </button>
                </td>
            </tr>
        <?php endforeach; ?>
  </tbody>
</table>

<script>
function deleteFileOrDir(button) {
    var fileName = button.getAttribute('data-name');
    var fileType = button.getAttribute('data-type');
    var fileDir = button.getAttribute('data-dir');
    var fileId = fileName.substring(0, fileName.lastIndexOf('.'));

    if (confirm("Tem certeza que deseja deletar " + fileName + "?")) {
        var fileData = {
            id: fileId,
            name: fileName,
            type: fileType,
            dir: fileDir
        };

        fetch('/api/file-remove', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(fileData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                button.closest('tr').remove();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            alert('Erro na requisição: ' + error);
        });
    }
}
</script>