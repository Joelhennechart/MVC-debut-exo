<?php
//chef d'orchestre de l'application MVC
namespace App\Core;

abstract class Controller
{
    protected function render(string $view, array $data = []): void
    {
        extract($data);
        
        include_once ROOT . '/Views/' . $view . '.php';
        
    }
}