<?php
  class Admin {
    
    static public function statusBaghets($status) {

      global $CONFIG;

      if($status === "enabled") {
        echo "
          <span class='badge py-3 px-4 fs-7 badge-light-success'>
            ".STATUS_ENABLED."
          </span>
        ";
      } elseif ($status === "disabled") {
        echo "
          <span class='badge py-3 px-4 fs-7 badge-light-danger'>
            ".STATUS_DISABLED."
          </span>
        ";
      } elseif ($status === "working") {
        echo "
          <span class='badge py-3 px-4 fs-7 badge-dark'>
            ".STATUS_WORKING."
          </span>
        ";
      } elseif ($status) {
        echo "
          <span class='badge py-3 px-4 fs-7 badge-dark'>
            ".$status."
          </span>
        ";
      }
    }

    static public function statusIcons($status) {

      global $CONFIG;
      $path = $CONFIG['CONF']['adminCMS'];

      if($status === "enabled") {
        echo "
          <img src='$path/assets/media/misc/ico-enabled.png' width='20' />
        ";
      } elseif ($status === "disabled") {
        echo "
          <span class='badge py-3 px-4 fs-7 badge-light-danger'>
            Disabled
          </span>
        ";
      } elseif ($status) {
        echo "
          <span class='badge py-3 px-4 fs-7 badge-dark'>
            ".$status."
          </span>
        ";
      }
    }

    static public function formatDateTime($dataHora) {
      $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dataHora);
      if ($dateTime) {
          return $dateTime->format('d/m/Y H:i:s');
      }
      return false; 
    }

    static public function formatDate($data) {
      $date = DateTime::createFromFormat('Y-m-d', $data);
      if ($date) {
          return $date->format('d/m/Y');
      }
      return false; 
    }

    static public function convertTimestampToDate($timestamp) {
      return date('d/m/Y', $timestamp);
    }

    static public function convertIsoDate($isoDate, $format = 'd/m/Y H:i:s') {
      try {
          $date = new DateTime($isoDate);
          $date->setTimezone(new DateTimeZone('America/Sao_Paulo')); // Fuso horário GMT-3
          return $date->format($format);
      } catch (Exception $e) {
          return 'Invalid date';
      }
  }



}