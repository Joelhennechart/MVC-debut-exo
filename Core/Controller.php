<?php
//chef d'orchestre de l'application MVC
namespace App\Core;

abstract class Controller
{
    protected function render(string $view, array $data = []): void
    {
        extract($data);

        //on demarre le buffer de sortie
        ob_start();
        
        include_once ROOT . '/Views/' . $view . '.php';

        // On déchargera le buffer de sortie dans la variable $contenu
        
        $contenu = ob_get_clean();

        include_once ROOT . '/Views/base.php';
        
    }
}