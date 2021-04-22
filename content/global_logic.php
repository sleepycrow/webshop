<?php
/**
 * Logika globalna - logika która uruchamia się przy każdej podstronie.
 **/

session_start();

// Pobierz z bazy danych kategorie produktów
$g_categories = [];

// TODO: Przenieś to do szablonu??
$quer = $s_db->query('SELECT `cat_id`, `cat_name` FROM `'.TABLE_CATEGORIES.'`');
if($quer == false) die("Nie udało się wydobyć kategorii produktów");
while($row = $quer->fetch_assoc()) array_push($g_categories, $row);

// Upewnij się, że w sesji jest koszyk.
if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
