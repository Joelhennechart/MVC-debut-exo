<?php

use App\Autoloader;
use App\Db\PosteModel;

// On importe l'autoloader
require_once  './Autoloader.php';

Autoloader::register();

$posteModel = new PosteModel();
$posteModel->setTitre('Développeur React')
    ->setDescription('Recherche dev React')
    ->setActif(true);
    
$posteModel->create($posteModel);

var_dump($posteModel);
