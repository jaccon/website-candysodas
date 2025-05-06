<?php
global $CONFIG;
session_start();

$language = $_SESSION['language'] ?? $CONFIG['CONF']['defaultLanguage'];
include "{$CONFIG['CONF']['coreDir']}/translates/{$language}/translate.inc.php";

?>
