<?php
require ROOT_PATH.'/includes/lib/stringify.php';

// Zapisz ustawienia
if(isset($_POST['intent-edit-config'])){
  foreach($s_conf as $conf_key => $conf_val){
    if(isset($_POST[$conf_key]))
      $s_conf[$conf_key] = $_POST[$conf_key];
  }

  $config_contents = '<?php $s_conf = '.stringify($s_conf, true).';';
  file_put_contents(ROOT_PATH.'/includes/config.php', $config_contents); //chyba tak nie powininem robić, iks-kurwa-de

  // Umrzyj i odśwież aby zastosować ustawienia
  header('Location:'.s_page('/config/'));
  die();
}

// Zdobądź tematy graficzne
$themes = [];
foreach(scandir($s_site->child_site_content_path.'/themes') as $dir)
  if($dir != '.' && $dir != '..') array_push($themes, $dir);

$s_page->set_model('themes', $themes);
