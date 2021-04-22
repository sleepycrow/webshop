<?php
// Rejestracja
if(isset($_POST['intent-signup'])){
  if(!isset($_POST['password']) || empty(trim($_POST['password']))){
    $s_page->add_notice('error', 'Nie podano hasła!');
  }elseif(!isset($_POST['password2']) || empty(trim($_POST['password2']))){
    $s_page->add_notice('error', 'Nie podano drugiego hasła!');
  }elseif(!isset($_POST['username']) || empty(trim($_POST['username']))){
    $s_page->add_notice('error', 'Nie podano nazwy użytkownika!');
  }elseif(!isset($_POST['email']) || empty(trim($_POST['email']))){
    $s_page->add_notice('error', 'Nie podano adresu e-mail!');
  }elseif($_POST['password'] != $_POST['password2']){
    $s_page->add_notice('error', 'Hasła się nie zgadzają!');

  }elseif(preg_match("/^([A-Za-z0-9.-_]+)$/i", $_POST["username"]) == false || strpos($_POST["username"], "<") != false || strpos($_POST["username"], ">") != false){
    $s_page->add_notice('error', 'Nazwa użytkownika może składać się tylko ze znaków alfanumerycznych!');
  }elseif(preg_match("/^([^@ \t\r\n]+@[^@ \t\r\n]+\.[A-Za-z]+)$/i", $_POST["email"]) == false || strpos($_POST["email"], "<") != false || strpos($_POST["email"], ">") != false){
    $s_page->add_notice('error', 'Podano niepoprawny adres e-mail!');

  }else{
    $username = mysqli_escape_string($s_db, $_POST['username']);
    $email = mysqli_escape_string($s_db, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT) or die('Wystąpił błąd');

    $quer = $s_db->query("SELECT * FROM `".TABLE_USERS."` WHERE `username`='{$username}' LIMIT 1");
    if($quer == false) die('Wystąpił błąd[1].');
    if($quer->num_rows > 0){
      $s_page->add_notice('error', 'Pożądana nazwa użytkownika jest już zajęta!');
    }else{
      $s_db->query("INSERT INTO `".TABLE_USERS."` (`username`, `password`, `email`) VALUES ('{$username}', '{$password}', '{$email}')") or die(mysqli_error($s_db));
      $_POST['intent-login'] = 'yes please :>';
    }
  }
}

// Logowanie
if(isset($_POST['intent-login'])){
  if(!isset($_POST['password']) || empty(trim($_POST['password']))){
    $s_page->add_notice('error', 'Nie podano hasła!');
  }elseif(!isset($_POST['username']) || empty(trim($_POST['username']))){
    $s_page->add_notice('error', 'Nie podano nazwy użytkownika!');
  }else{
    $username = mysqli_escape_string($s_db, $_POST['username']);
    $password = $_POST['password'];

    $quer = $s_db->query("SELECT * FROM `".TABLE_USERS."` WHERE `username`='{$username}' LIMIT 1");
    if($quer == false) die('Wystąpił błąd.');
    if($quer->num_rows > 0){
      $user = $quer->fetch_assoc();
      if(password_verify($password, $user['password'])){
        unset($user['password']);
        $_SESSION['user'] = $user;
        header('Location:'.s_page('/user/'));
        die('Zalogowano poprawnie!');
      }else{
        $s_page->add_notice('error', 'Niepoprawne hasło lub nazwa użytkownika.');
      }
    }else{
      $s_page->add_notice('error', 'Niepoprawne hasło lub nazwa użytkownika.');
    }
  }
}

// Wylogowywanie
if($s_req->get_arg(0) == 'logout'){
  unset($_SESSION['user']);
  $s_page->add_notice('info', 'Zostałeś wylogowany.');
}
