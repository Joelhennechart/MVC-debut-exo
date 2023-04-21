<?php
namespace App\Core;
class Routeur
{
    private array $routes = [];
    public function addRoute(array $route): self
    {
        $this->routes[] = $route;
        return $this;
    }
    public function handleRequest($url, $method)
    {
        //on boucle sur le tableau des routes de mon application
        foreach ($this->routes as $route) {
            // On vérifie que l'url envoie du navigateur et la method correspondent à un route existante

            if($url == $route['url'] && in_array($method, $route['methods'])) {
                /**
                 * 'url' => '/',
                 * 'method' => ['GET],
                 * 'controller' => 'App\Controller\MinController',
                 */
                $contoller = $route['controller'];
                $action = $route['action'];
                // new APP|Controller|HomeController();
                $contoller = new $contoller();
                $contoller->$action();

                return;
            }
        }
        echo "Page not Found";
    }
}