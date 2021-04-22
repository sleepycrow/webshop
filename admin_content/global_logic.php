<?php
/**
 * Logika globalna - logika która uruchamia się przy każdej podstronie.
 **/

session_start();

// Upewnij się, że użytkownik ma prawa, aby tutaj być
if(!s_logged_in() || $_SESSION['user']['is_admin'] == false){
  http_response_code(403);
  die('Nie masz wystarczających uprawnień, aby być tutaj.');
}
