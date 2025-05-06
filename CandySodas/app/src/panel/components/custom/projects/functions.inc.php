<?php 

  function getDeliveryMessage($deadline) {
    $currentDate = time();
    
    if (!is_numeric($deadline)) {
        $deadline = strtotime($deadline);
    }

    $daysLeft = ($deadline - $currentDate) / (60 * 60 * 24);
    
    if (floor($daysLeft) === 0 && date('Y-m-d', $currentDate) === date('Y-m-d', $deadline)) {
        return 'Entrega hoje';
    }
    return floor($daysLeft) . ' dias';
  }

  function convertTimestampToDate($timestamp) {
    return date('d/m/Y', $timestamp);
  }

?>