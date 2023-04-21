<?php

//echo "Hello world !";


use App\Core\Main;
use App\Autoloader;

//On definit la constante avec le dossier racine du projet

define('ROOT', dirname(__DIR__)); //constante ROOT qui definit le dossier app  

include_once ROOT . '/Autoloader.php'; //on importe le fichier Autoloader qui lui charge dynamiquement automatiquement tous les autres fichiers 
Autoloader::register();

//Onjh instancie la classe Main qui va démarrer notre application (et le routeur)
$app =new Main();

// On execute la methode start qui demarre notre app
$app->start();