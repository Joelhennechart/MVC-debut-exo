<?php

use App\Autoloader;
use App\Db\PosteModel;

// On importe l'autoloader
require_once  './Autoloader.php';

Autoloader::register();

// $posteModel = new PosteModel();
// $posteModel->setTitre('Développeur React')
//     ->setDescription('Recherche dev React')
//     ->setActif(true);

// $posteModel->create($posteModel);

/*****************************
*    !!! SUITE ICI !!!
****************************/
$donnees = [
    'titre' => 'Titre du poste',
    'description' => 'Poste super !!',
    'actif' => 1
];

$model =new PosteModel();
$poste = $model->hydrate($donnees);

$model->create($poste);
var_dump($poste);
