<?php
  foreach($notices as $notice){
    echo "<div class='notice notice-{$notice['severity']}'>{$notice['message']}</div>";
  }
?>
