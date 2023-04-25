<?php
namespace App\Core;
// definit si une url qu'on rentre est valable ou non, et envoi dans la bonne url
class Router
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

            if (preg_match('#^' . $route['url'] . '$#', $url, $matches) && in_array($method, $route['methods'])) {
                /**
                 * 'url' => '/',
                 * 'method' => ['GET],
                 * 'controller' => 'App\Controller\MinController',
                 */
                $contoller = $route['controller'];
                $action = $route['action'];
                // new APP|Controller|HomeController();
                $contoller = new $contoller();
                $params = array_slice($matches, 1);
                $contoller->$action(...$params);

                //showposte(1)

                return;
            }
        }
        echo "Page not Found";
    }
}