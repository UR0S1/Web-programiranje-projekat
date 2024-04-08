<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'projekat2');


$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

mysqli_set_charset($link, 'utf8');

if($link === false){
    die("Greška pri povezivanju na bazu podataka: " . mysqli_connect_error());
}