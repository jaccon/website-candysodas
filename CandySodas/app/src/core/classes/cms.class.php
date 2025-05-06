<?php

class CMS {
  static public function apiConnect($contractId, $userId, $apiUrl){
    return "Hello World";
  }

  static public function defaultPageTitle(){
    global $CONFIG;
    return $CONFIG['CONF']['defaultPageTitle'];
  }

  static public function siteUrl() {
    global $CONFIG;
    return $CONFIG['CONF']['siteUrl'];
  }
  
  static public function isPage($id, $field){
    global $CONFIG;
    $file = $CONFIG['CONF']['cacheDir']."/pages.json";

    if(file_exists($file)){
      $data =  file_get_contents($file);
    }

    $objitems = json_decode($data);
      foreach ($objitems as $content) {
          if ($content->id === $id) return $content->$field;
       }
      return false;
  }

  static public function isComponent($id, $field){
    global $CONFIG;
    $file = $CONFIG['CONF']['cacheDir']."/metadata.json";

    if(file_exists($file)){
      $data =  file_get_contents($file);
    }

    $objitems = json_decode($data);
      foreach ($objitems as $content) {
          if ($content->id === $id) return $content->$field;
       }
      return false;
  }

  static public function isMenu($id, $field){
    global $CONFIG;
    $file = $CONFIG['CONF']['cacheDir']."/metadata.json";

    if(file_exists($file)){
      $data =  file_get_contents($file);
    }

    $objitems = json_decode($data);
    foreach ($objitems as $content) {
        if ($content->id === $id) return $content->$field;
      }
    return false;
  }

  static public function getComponentsByMetaType($type) {
    global $CONFIG;
    $file = $CONFIG['CONF']['cacheDir'] . "/metadata.json";

    if (file_exists($file)) {
        $data = file_get_contents($file);
    }

    $objitems = json_decode($data);

    $filteredComponents = array();

    foreach ($objitems as $content) {
        if ($content->metadataType === $type) {
            $filteredComponents[] = $content;
        }
    }

    return $filteredComponents;
  }


  static public function getContractId(){
    global $CONFIG;

    return base64_encode($CONFIG['CONF']['contractId']);
  }

  static public function getImage($img){
    global $CONFIG;

    $remoteCND = $CONFIG['CONF']['remoteCDN'];
    $remoteCNDStatus = $CONFIG['CONF']['remoteCDNStatus'];

    if(!$img) {
      return $remoteCND."/no-image.jpg";
    }

    if($remoteCNDStatus === "disable") {
      return $CONFIG['CONF']['siteUrl'].$CONFIG['CONF']['localImagesRepositoryUrl']."/".$img;
    } else {
      return $remoteCND."/".$img;
    }

  }

  static public function getCurrentUrl(){
    $currentUrl = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
    $currentUrl .= $_SERVER['HTTP_HOST'];
    $currentUrl .= $_SERVER['REQUEST_URI'];
    return $currentUrl;
  }

  static public function includeComponent() {
    global $CONFIG;
    return $CONFIG['CONF']['siteDir']."components/";
  }

  static function sliderEasyBuild($componentSliderType,$componentSliderQtd) {
    global $CONFIG;
    $csvFile = $CONFIG['CONF']['cacheDir']."/metadata.json";
    $file = fopen($csvFile, 'r');
    $foundData = [];

    $header = fgetcsv($file);

    $metadataTypeIndex = array_search('metadataType', $header);

    while (($row = fgetcsv($file)) !== false) {
        if ($row[$metadataTypeIndex] === $componentSliderType) {
            $foundData[] = [
                'id' => $row[array_search('id', $header)],
                'title' => $row[array_search('title', $header)],
                'description' => $row[array_search('description', $header)],
                'featuredImage' => $row[array_search('featuredImage', $header)],
                'permLink' => $row[array_search('permLink', $header)],
                'permLinkButtonText' => $row[array_search('permLinkButtonText', $header)],
                'posiction' => $row[array_search('posiction', $header)]
            ];
        }
    }
    fclose($file);
    return $foundData;
  }

  static public function isSelected($value, $selectedValue) {
    return $value === $selectedValue ? 'selected' : '';
  }

  static public function isChecked($value, $selectedValue) {
    return $value === $selectedValue ? 'checked="checked"' : '';
  }

  public static function isSelectedCategories($categoryId, $selectedCategories) {
    $selectedArray = explode('|', $selectedCategories);
    return in_array($categoryId, $selectedArray) ? 'selected' : '';
  }

  static public function saveCategory($data) {
    global $CONFIG;
    
    $filePath = $CONFIG['CONF']['cacheDir'].'/categories.json';
  
    try {
        if (file_exists($filePath)) {
            $jsonData = file_get_contents($filePath);
            $projects = json_decode($jsonData, true);
        } else {
            $projects = [];
        }
  
        $projects[] = $data;
  
        file_put_contents($filePath, json_encode($projects, JSON_PRETTY_PRINT));
        return true;
    } catch (Exception $e) {
        echo "Erro ao salvar dados: " . $e->getMessage();
        return false;
    }
  }

  static public function saveComponent($data) {
    global $CONFIG;
    
    $filePath = $CONFIG['CONF']['cacheDir'].'/components.json';
  
    try {
        if (file_exists($filePath)) {
            $jsonData = file_get_contents($filePath);
            $projects = json_decode($jsonData, true);
        } else {
            $projects = [];
        }
  
        $projects[] = $data;
  
        file_put_contents($filePath, json_encode($projects, JSON_PRETTY_PRINT));
        return true;
    } catch (Exception $e) {
        echo "Erro ao salvar dados: " . $e->getMessage();
        return false;
    }
  }

  static public function saveCmsRegister($data,$cacheFile) {
    global $CONFIG;
    
    $filePath = $CONFIG['CONF']['cacheDir']."/".$cacheFile;
  
    try {
        if (file_exists($filePath)) {
            $jsonData = file_get_contents($filePath);
            $projects = json_decode($jsonData, true);
        } else {
            $projects = [];
        }
  
        $projects[] = $data;
  
        file_put_contents($filePath, json_encode($projects, JSON_PRETTY_PRINT));
        return true;
    } catch (Exception $e) {
        echo "Erro ao salvar dados: " . $e->getMessage();
        return false;
    }
  }

  static public function updateCmsRegisterById($projectId, $updatedData, $cacheFile) {
    global $CONFIG;

    $filePath = $CONFIG['CONF']['cacheDir'] . '/'.$cacheFile;

    if (!file_exists($filePath)) {
        return ['success' => false, 'message' => 'Arquivo categories.json não encontrado.'];
    }

    $jsonData = file_get_contents($filePath);

    $projects = json_decode($jsonData, true);

    if (!is_array($projects)) {
        return ['success' => false, 'message' => 'Erro ao ler o arquivo categories.json.'];
    }

    $projectIndex = array_search($projectId, array_column($projects, 'id'));

    if ($projectIndex === false) {
        return ['success' => false, 'message' => 'Register note found.'];
    }

    $projects[$projectIndex] = array_merge($projects[$projectIndex], $updatedData);

    if (file_put_contents($filePath, json_encode($projects, JSON_PRETTY_PRINT)) === false) {
        return ['success' => false, 'message' => 'Erro ao salvar o arquivo categories.json.'];
    }

    Auth::logUserAction($projectId, 'update users');
    return ['success' => true, 'message' => 'Register atualizado com sucesso.'];

  }

  static public function getRegisterById($registerId, $cacheFile) {
    global $CONFIG;

    $filePath = $CONFIG['CONF']['cacheDir'] . "/".$cacheFile;

    if (!file_exists($filePath)) {
        return null; 
    }

    $jsonData = file_get_contents($filePath);

    $registers = json_decode($jsonData, true);

    if (!is_array($registers)) {
        return null; 
    }

    foreach ($registers as $register) {
        if ($register['id'] === $registerId) {
            return $register;
        }
    }

    return null; 
  }
  
  static public function saveSlideshow($data) {
    global $CONFIG;
    
    $filePath = $CONFIG['CONF']['cacheDir'].'/metadata.json';
  
    try {
        if (file_exists($filePath)) {
            $jsonData = file_get_contents($filePath);
            $projects = json_decode($jsonData, true);
        } else {
            $projects = [];
        }
  
        $projects[] = $data;
  
        file_put_contents($filePath, json_encode($projects, JSON_PRETTY_PRINT));
        return true;
    } catch (Exception $e) {
        echo "Erro ao salvar dados: " . $e->getMessage();
        return false;
    }
  }

  static public function updateSlideshow($data) {
    global $CONFIG;
    $filePath = $CONFIG['CONF']['cacheDir'].'/metadata.json';

    try {
        if (file_exists($filePath)) {
            $jsonData = file_get_contents($filePath);
            $projects = json_decode($jsonData, true);
        } else {
            $projects = [];
        }

        $idToUpdate = $data['id'];
        $updated = false;

        foreach ($projects as $key => $project) {
            if ($project['id'] == $idToUpdate) {
                $projects[$key]['title'] = $data['title'];
                $projects[$key]['content'] = $data['content'];
                $projects[$key]['status'] = $data['status'];
                $projects[$key]['userId'] = $data['userId'];
                $projects[$key]['createdAt'] = $data['createdAt'];

                $updated = true;
                break;
            }
        }

        if (!$updated) {
            error_log("Erro: Slideshow com ID $idToUpdate não encontrado para atualização.");
            return false;
        }

        file_put_contents($filePath, json_encode($projects, JSON_PRETTY_PRINT));
        return true;

    } catch (Exception $e) {
        error_log("Erro ao atualizar dados: " . $e->getMessage());
        return false;
    }
}

  static public function savePost($data) {
    global $CONFIG;
    
    $filePath = $CONFIG['CONF']['cacheDir'].'/posts.json';
  
    try {
        if (file_exists($filePath)) {
            $jsonData = file_get_contents($filePath);
            $projects = json_decode($jsonData, true);
        } else {
            $projects = [];
        }
  
        $projects[] = $data;
  
        file_put_contents($filePath, json_encode($projects, JSON_PRETTY_PRINT));
        return true;
    } catch (Exception $e) {
        echo "Erro ao salvar dados: " . $e->getMessage();
        return false;
    }
  }

  static public function savePage($data) {
    global $CONFIG;
    
    $filePath = $CONFIG['CONF']['cacheDir'].'/pages.json';
  
    try {
        if (file_exists($filePath)) {
            $jsonData = file_get_contents($filePath);
            $projects = json_decode($jsonData, true);
        } else {
            $projects = [];
        }
  
        $projects[] = $data;
  
        file_put_contents($filePath, json_encode($projects, JSON_PRETTY_PRINT));
        return true;
    } catch (Exception $e) {
        echo "Erro ao salvar dados: " . $e->getMessage();
        return false;
    }
  }

  static public function updatePost($projectId, $updatedData) {
    global $CONFIG;

    $filePath = $CONFIG['CONF']['cacheDir'] . '/posts.json';

    if (!file_exists($filePath)) {
        return ['success' => false, 'message' => 'Arquivo posts.json não encontrado.'];
    }

    $jsonData = file_get_contents($filePath);

    $projects = json_decode($jsonData, true);

    if (!is_array($projects)) {
        return ['success' => false, 'message' => 'Erro ao ler o arquivo posts.json.'];
    }

    $projectIndex = array_search($projectId, array_column($projects, 'id'));

    if ($projectIndex === false) {
        return ['success' => false, 'message' => 'User não encontrado.'];
    }

    $projects[$projectIndex] = array_merge($projects[$projectIndex], $updatedData);

    if (file_put_contents($filePath, json_encode($projects, JSON_PRETTY_PRINT)) === false) {
        return ['success' => false, 'message' => 'Erro ao salvar o arquivo poss.json.'];
    }

    Auth::logUserAction($projectId, 'update post');
    return ['success' => true, 'message' => 'Registro atualizado com sucesso.'];

  }

  static public function updatePage($projectId, $updatedData) {
    global $CONFIG;

    $filePath = $CONFIG['CONF']['cacheDir'] . '/pages.json';

    if (!file_exists($filePath)) {
        return ['success' => false, 'message' => 'Arquivo posts.json não encontrado.'];
    }

    $jsonData = file_get_contents($filePath);

    $projects = json_decode($jsonData, true);

    if (!is_array($projects)) {
        return ['success' => false, 'message' => 'Erro ao ler o arquivo posts.json.'];
    }

    $projectIndex = array_search($projectId, array_column($projects, 'id'));

    if ($projectIndex === false) {
        return ['success' => false, 'message' => 'User não encontrado.'];
    }

    $projects[$projectIndex] = array_merge($projects[$projectIndex], $updatedData);

    if (file_put_contents($filePath, json_encode($projects, JSON_PRETTY_PRINT)) === false) {
        return ['success' => false, 'message' => 'Erro ao salvar o arquivo poss.json.'];
    }

    Auth::logUserAction($projectId, 'update page');
    return ['success' => true, 'message' => 'Registro atualizado com sucesso.'];

  }

  static public function getCategories($categoryType = null) {
    global $CONFIG;
    $filePath = $CONFIG['CONF']['cacheDir'].'/categories.json';

    if (file_exists($filePath)) {
        $jsonData = file_get_contents($filePath);
        $categories = json_decode($jsonData, true);
        
        if (is_array($categories)) {
            return array_filter($categories, function($category) use ($categoryType) {
                $isEnabled = isset($category['status']) && $category['status'] === 'enabled';
                $matchesType = $categoryType ? (isset($category['categoryType']) && $category['categoryType'] === $categoryType) : true;
                return $isEnabled && $matchesType;
            });
        }
    }

    return [];
  }

  static public function getPostsById($postId) {
    global $CONFIG;

    $filePath = $CONFIG['CONF']['cacheDir'] . '/posts.json';

    if (!file_exists($filePath)) {
        return null; 
    }

    $jsonData = file_get_contents($filePath);
    $posts = json_decode($jsonData, true);

    if (!is_array($posts)) {
        return null; 
    }

    foreach ($posts as $post) {
        if ($post['id'] === $postId) {
            return $post;
        }
    }

    return null; 

  }

  static public function getPagesById($postId) {
    global $CONFIG;

    $filePath = $CONFIG['CONF']['cacheDir'] . '/pages.json';

    if (!file_exists($filePath)) {
        return null; 
    }

    $jsonData = file_get_contents($filePath);
    $posts = json_decode($jsonData, true);

    if (!is_array($posts)) {
        return null; 
    }

    foreach ($posts as $post) {
        if ($post['id'] === $postId) {
            return $post;
        }
    }

    return null; 

  }

  static public function getCategoryById($registerId) {
    global $CONFIG;

    $filePath = $CONFIG['CONF']['cacheDir'] . '/categories.json';

    if (!file_exists($filePath)) {
        return null; 
    }

    $jsonData = file_get_contents($filePath);

    $registers = json_decode($jsonData, true);

    if (!is_array($registers)) {
        return null; 
    }

    foreach ($registers as $register) {
        if ($register['id'] === $registerId) {
            return $register;
        }
    }

    return null; 
  }

    static public function getComponentsById($registerId) {
        global $CONFIG;

        $filePath = $CONFIG['CONF']['cacheDir'] . '/components.json';

        if (!file_exists($filePath)) {
            return null; 
        }

        $jsonData = file_get_contents($filePath);

        $registers = json_decode($jsonData, true);

        if (!is_array($registers)) {
            return null; 
        }

        foreach ($registers as $register) {
            if ($register['id'] === $registerId) {
                return $register;
            }
        }

        return null; 
    }

  static public function loadMetadaById($registerId) {
    global $CONFIG;

    $filePath = $CONFIG['CONF']['cacheDir'] . '/metadata.json';

    if (!file_exists($filePath)) {
        return null; 
    }

    $jsonData = file_get_contents($filePath);

    $registers = json_decode($jsonData, true);

    if (!is_array($registers)) {
        return null; 
    }

    foreach ($registers as $register) {
        if ($register['id'] === $registerId) {
            return $register;
        }
    }

    return null; 
  }

  static public function updateCategoryById($projectId, $updatedData) {
    global $CONFIG;

    $filePath = $CONFIG['CONF']['cacheDir'] . '/categories.json';

    if (!file_exists($filePath)) {
        return ['success' => false, 'message' => 'Arquivo categories.json não encontrado.'];
    }

    $jsonData = file_get_contents($filePath);

    $projects = json_decode($jsonData, true);

    if (!is_array($projects)) {
        return ['success' => false, 'message' => 'Erro ao ler o arquivo categories.json.'];
    }

    $projectIndex = array_search($projectId, array_column($projects, 'id'));

    if ($projectIndex === false) {
        return ['success' => false, 'message' => 'Register note found.'];
    }

    $projects[$projectIndex] = array_merge($projects[$projectIndex], $updatedData);

    if (file_put_contents($filePath, json_encode($projects, JSON_PRETTY_PRINT)) === false) {
        return ['success' => false, 'message' => 'Erro ao salvar o arquivo categories.json.'];
    }

    Auth::logUserAction($projectId, 'update users');
    return ['success' => true, 'message' => 'Register atualizado com sucesso.'];

   }

  static public function updateComponentsById($projectId, $updatedData) {
    global $CONFIG;

    $filePath = $CONFIG['CONF']['cacheDir'] . '/components.json';

    if (!file_exists($filePath)) {
        return ['success' => false, 'message' => 'Arquivo components.json não encontrado.'];
    }

    $jsonData = file_get_contents($filePath);

    $projects = json_decode($jsonData, true);

    if (!is_array($projects)) {
        return ['success' => false, 'message' => 'Erro ao ler o arquivo components.json.'];
    }

    $projectIndex = array_search($projectId, array_column($projects, 'id'));

    if ($projectIndex === false) {
        return ['success' => false, 'message' => 'Register note found.'];
    }

    $projects[$projectIndex] = array_merge($projects[$projectIndex], $updatedData);

    if (file_put_contents($filePath, json_encode($projects, JSON_PRETTY_PRINT)) === false) {
        return ['success' => false, 'message' => 'Erro ao salvar o arquivo components.json.'];
    }

    Auth::logUserAction($projectId, 'update users');
    return ['success' => true, 'message' => 'Register atualizado com sucesso.'];

   }

   

   static public function getDirectorySize($directory) {
    $size = 0;

    if (!is_dir($directory)) {
        return "O caminho especificado não é um diretório.";
    }

    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS));

    foreach ($files as $file) {
        $size += $file->getSize();
    }

    return Cms::formatSize($size);

  }

  static public function formatSize($size) {
      $units = ['B', 'KB', 'MB', 'GB', 'TB'];
      $i = 0;

      while ($size >= 1024 && $i < count($units) - 1) {
          $size /= 1024;
          $i++;
      }
      
      return round($size, 2) . " " . $units[$i];
  }

  static public function renderMediaById($filename) {
    global $CONFIG;

    $jsonFilePath = $CONFIG['CONF']['cacheDir'] . "/metadata.json";
    if (!file_exists($jsonFilePath)) return "Arquivo metadata.json não encontrado.";

    $jsonData = file_get_contents($jsonFilePath);
    $files = json_decode($jsonData, true);
    if (!is_array($files)) return "Erro ao processar o JSON.";

    foreach ($files as $file) {
        // Caso onde a mídia está dentro de 'uploadFiles' (exemplo de imagens)
        if (!empty($file['uploadFiles']) && is_array($file['uploadFiles'])) {
            foreach ($file['uploadFiles'] as $uploadFile) {
                if ($uploadFile['uploadPath'] === $filename) {
                    $filePath = $CONFIG['CONF']['uploadUrl'] . "/" . $uploadFile['originalDirectory'] . '/' . $uploadFile['uploadPath'];
                    return Cms::renderMediaHtml($filePath, $filename);
                }
            }
        }
        
        // Caso onde a mídia está diretamente nos campos (exemplo de vídeos)
        if (isset($file['filename']) && $file['filename'] === $filename) {
            $filePath = $CONFIG['CONF']['uploadUrl'] . "/" . $file['directoryName'] . '/' . $file['filename'];
            return Cms::renderMediaHtml($filePath, $filename);
        }
    }

    return "Arquivo não encontrado.";
}

// Função auxiliar para gerar o HTML
    static private function renderMediaHtml($filePath, $filename) {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            return "<img src='$filePath' alt='Imagem' class='img-fluid'>";
        } elseif (in_array($extension, ['mp4', 'webm', 'ogg'])) {
            return "<video controls autoplay muted class='w-100' controlslist='nodownload' oncontextmenu='return false;'>
                        <source src='$filePath' type='video/$extension'>
                    </video>";
        } elseif (in_array($extension, ['mp3', 'wav', 'ogg'])) {
            return "<audio controls class='w-100'>
                        <source src='$filePath' type='audio/$extension'>
                    </audio>";
        }
        
        return "Formato de arquivo não suportado.";
    }

  static public function getMetadataById($id, $field) {
    global $CONFIG;

    $jsonFilePath = $CONFIG['CONF']['cacheDir']."/metadata.json";

    if (!file_exists($jsonFilePath)) {
        return "Arquivo metadata.json não encontrado.";
    }

    $jsonData = file_get_contents($jsonFilePath);
    $files = json_decode($jsonData, true);

    if (!is_array($files)) {
        return "Erro ao processar o JSON.";
    }

    foreach ($files as $file) {
        if ($file['id'] === $id) {
            return $file[$field];
        }
    }

    return "Arquivo não encontrado.";
    
  }

  static public function getMetadataByName($name, $field) {
    global $CONFIG;

    $jsonFilePath = $CONFIG['CONF']['cacheDir']."/metadata.json";

    if (!file_exists($jsonFilePath)) {
        return "Arquivo metadata.json não encontrado.";
    }

    $jsonData = file_get_contents($jsonFilePath);
    $files = json_decode($jsonData, true);

    if (!is_array($files)) {
        return "Erro ao processar o JSON.";
    }

    foreach ($files as $file) {
        if ($file['title'] === $name) {
            return $file[$field];
        }
    }

    return "Arquivo não encontrado.";
    
  }

  static public function getMetadataByComponentId($id) {
    global $CONFIG;

    $jsonFilePath = $CONFIG['CONF']['cacheDir']."/metadata.json";

    if (!file_exists($jsonFilePath)) {
        return []; 
    }

    $jsonData = file_get_contents($jsonFilePath);
    $metas = json_decode($jsonData, true);

    if (!is_array($metas)) {
        return []; 
    }

    $result = []; 

    foreach ($metas as $meta) {
        if ($meta['component'] === $id) {
            $result[] = $meta; 
        }
    }

    return $result; 
 }


  static public function metadataUpdateById($mId, $updatedData) {
    global $CONFIG;

    $filePath = $CONFIG['CONF']['cacheDir'] . '/metadata.json';

    if (!file_exists($filePath)) {
        return ['success' => false, 'message' => 'Arquivo metadata.json não encontrado.'];
    }

    $jsonData = file_get_contents($filePath);

    $projects = json_decode($jsonData, true);

    if (!is_array($projects)) {
        return ['success' => false, 'message' => 'Erro ao ler o arquivo metadata.json.'];
    }

    $projectIndex = array_search($mId, array_column($projects, 'id'));

    if ($projectIndex === false) {
        return ['success' => false, 'message' => 'Projeto não encontrado.'];
    }

    $projects[$projectIndex] = array_merge($projects[$projectIndex], $updatedData);

    if (file_put_contents($filePath, json_encode($projects, JSON_PRETTY_PRINT)) === false) {
        return ['success' => false, 'message' => 'Erro ao salvar o arquivo metadata.json.'];
    }

    Auth::logUserAction($mId, 'update metadata');

    return ['success' => true, 'message' => 'Projeto atualizado com sucesso.'];
  }

  static public function getLastFeaturedImageByPubId($pubId) {

    global $CONFIG;
    $filePath = $CONFIG['CONF']['cacheDir'] . '/metadata.json';

    if (!file_exists($filePath)) {
        echo "Arquivo não encontrado: $filePath";
        return null;
    }

    $jsonData = file_get_contents($filePath);
    $data = json_decode($jsonData, true);

    if ($data === null) {
        echo "Erro ao decodificar o JSON.";
        return null;
    }

    $featuredImages = [];

    foreach ($data as $item) {
        if ($item['metadataType'] === 'featuredImage' && $item['pubId'] === $pubId && isset($item['uploadFiles'][0])) {
            $featuredImages[] = $item;
        }
    }

    if (!empty($featuredImages)) {
        usort($featuredImages, function($a, $b) {
            return strtotime($b['createdAt']) - strtotime($a['createdAt']);
        });

        return $featuredImages[0]['uploadFiles'][0];
    }

    return null;
  }

  static public function getSlideshowById($registerId) {
    global $CONFIG;

    $filePath = $CONFIG['CONF']['cacheDir'] . '/metadata.json';

    if (!file_exists($filePath)) {
        return null; 
    }

    $jsonData = file_get_contents($filePath);

    $registers = json_decode($jsonData, true);

    if (!is_array($registers)) {
        return null; 
    }

    foreach ($registers as $register) {
        if ($register['id'] === $registerId) {
            return $register;
        }
    }

    return null; 
  }

  static public function generateUUID() {
    $time = microtime(true) * 10000000 + 0x01B21DD213814000;
    
    $timeHex = str_pad(dechex($time), 16, "0", STR_PAD_LEFT);
    $node = bin2hex(random_bytes(6));
    
    $uuid = sprintf(
        "%08s-%04s-%04x-%04x-%012s",
        substr($timeHex, 0, 8),
        substr($timeHex, 8, 4),
        (hexdec(substr($timeHex, 12, 4)) & 0x0FFF) | 0x1000,
        (hexdec(substr($node, 0, 4)) & 0x3FFF) | 0x8000,
        substr($node, 4, 12)
    );
    
    return $uuid;
    
  }

  static public function updateSliderById($projectId, $updatedData) {
    global $CONFIG;

    $filePath = $CONFIG['CONF']['cacheDir'] . '/metadata.json';

    if (!file_exists($filePath)) {
        return ['success' => false, 'message' => 'Arquivo metatada.json não encontrado.'];
    }

    $jsonData = file_get_contents($filePath);

    $projects = json_decode($jsonData, true);

    if (!is_array($projects)) {
        return ['success' => false, 'message' => 'Erro ao ler o arquivo metatada.json.'];
    }

    $projectIndex = array_search($projectId, array_column($projects, 'id'));

    if ($projectIndex === false) {
        return ['success' => false, 'message' => 'Register note found.'];
    }

    $projects[$projectIndex] = array_merge($projects[$projectIndex], $updatedData);

    if (file_put_contents($filePath, json_encode($projects, JSON_PRETTY_PRINT)) === false) {
        return ['success' => false, 'message' => 'Erro ao salvar o arquivo metatada.json.'];
    }

    Auth::logUserAction($projectId, 'update slideshow');
    return ['success' => true, 'message' => 'Register atualizado com sucesso.'];

   }


   // Site Configurations
    static public function loadSiteConfiguration($registerId) {
        global $CONFIG;

        $filePath = $CONFIG['CONF']['cacheDir'] . '/siteconfigurations.cms.json';

        if (!file_exists($filePath)) {
            return null; 
        }

        $jsonData = file_get_contents($filePath);

        $registers = json_decode($jsonData, true);

        if (!is_array($registers)) {
            return null; 
        }

        foreach ($registers as $register) {
            if ($register['id'] === $registerId) {
                return $register;
            }
        }

        return null; 

    }

    // Site Configurations
    static public function siteConfigurationUpdates($updatedData) {

        global $CONFIG;
    
        $filePath = $CONFIG['CONF']['cacheDir'] . '/siteconfigurations.cms.json';
    
        if (!file_exists($filePath)) {
            return ['success' => false, 'message' => 'Arquivo siteconfigurations.cms.json não encontrado.'];
        }
    
        $jsonData = file_get_contents($filePath);
    
        $projects = json_decode($jsonData, true);
    
        if (!is_array($projects)) {
            return ['success' => false, 'message' => 'Erro ao ler o arquivo metadata.json.'];
        }
    
        $projectIndex = array_search('siteConfigurations', array_column($projects, 'name'));
    
        if ($projectIndex === false) {
            return ['success' => false, 'message' => 'Registro não encontrado.'];
        }
    
        $projects[$projectIndex] = array_merge($projects[$projectIndex], $updatedData);
    
        if (file_put_contents($filePath, json_encode($projects, JSON_PRETTY_PRINT)) === false) {
            return ['success' => false, 'message' => 'Erro ao salvar o arquivo siteconfigurations.cms.json.'];
        }
    
        Auth::logUserAction('siteConfigurations', 'update metadata');
    
        return ['success' => true, 'message' => 'Registro atualizado com sucesso.'];
        
    }

    // Get Site Configuration Data
    static public function getSiteConfigurationData($field) {

        global $CONFIG;
    
        $jsonFilePath = $CONFIG['CONF']['cacheDir']."/siteconfigurations.cms.json";
    
        if (!file_exists($jsonFilePath)) {
            return "Arquivo siteconfigurations.cms.json não encontrado.";
        }
    
        $jsonData = file_get_contents($jsonFilePath);
        $files = json_decode($jsonData, true);
    
        if (!is_array($files)) {
            return "Erro ao processar o JSON.";
        }
    
        foreach ($files as $file) {
            if ($file['name'] === 'siteConfigurations') {
                return $file[$field];
            }
        }
    
        return "Arquivo não encontrado.";
    
    }

    static public function getComponents() {

        global $CONFIG;

        $jsonFilePath = $CONFIG['CONF']['cacheDir']."/components.json";

        if (!file_exists($jsonFilePath)) {
            die('Arquivo components.json não encontrado.');
        }
        
        $jsonData = file_get_contents($jsonFilePath);
        $components = json_decode($jsonData, true);
        
        if (!is_array($components)) {
            die('Erro ao decodificar o JSON.');
        }
        
        return $components;
     }

  }

  

?>