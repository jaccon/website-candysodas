<?php
  include('../../config.inc.php');
  global $CONFIG;

  $directory = '../../pages/'; 
  $siteUrl = $CONFIG['CONF']['siteUrl'];
  header('Content-Type: text/xml');

  echo '<?xml version="1.0" encoding="UTF-8"?>';
  echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    if (is_dir($directory)) {
        if ($handle = opendir($directory)) {
            while (($file = readdir($handle)) !== false) {

                if ($file != '.' && $file != '..') {
                        $newFileName = str_replace('.template.php', '.html', $file);
                        $url = $siteUrl."/".$newFileName;
                        
                        $blacklistUrl = Seo::seoBlackList($newFileName);

                        // Check if url not have in blacklist SEO
                        if($blacklistUrl != 1) {
                            echo "<url>
                                <loc>$url</loc>
                            </url>";
                        }
                }
            }
            closedir($handle);
        }
    } else {
        echo "Erro to parser, directory/files not found";
    }

  echo "</urlset>";

?>