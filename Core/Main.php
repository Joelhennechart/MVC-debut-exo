<?php
namespace App\Core;

class Main
{
    public function __construct(
        private Router $router = new Router()
    )
    {
        
    }
    
    public function start(): void
    {
       session_start();
        
        // On enleve le trailing /
        $uri = $_SERVER['REQUEST_URI'];
        if($uri != '/' && !empty($uri) && $uri[-1] === '/'){
            $uri = substr($uri, 0, -1); // prend du 1ier caractére jusqu' a l'avant dernier
            //var_dump($uri);
            // On envoie le code http 301
            http_response_code(301);

            // On redirige le navigateur
            header("Location: $uri");
            exit();                    //pour arrèter l'execution une fois qu"elle est finis auissi non elle se repete. Il faut enlever le var_dump le /de fin est automatiquement enlevé
        }
        $this->initRouter();
        $this->router->handleRequest($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
    }

    private function initRouter(): void
    {
        $files = glob(\dirname(__DIR__) . '/Controllers/*.php');

        $files = array_merge_recursive($files, glob(\dirname(__DIR__) . '/Controllers/**/*.php'));

        foreach ($files as $file) {
            $file = substr($file, 1);
            $file = str_replace('/', '\\', $file);
            $file = substr($file,0, -4);
            $file = ucfirst($file);
            $classes[] = $file;
        
        }

       
        foreach ($classes as $class) {
            $methods = get_class_methods($class);

            
            foreach ($methods as $method) {
                $attributes = (new \ReflectionMethod($class, $method))->getAttributes(Route::class);
                

                foreach ($attributes as $attribute) {
                    $route = $attribute->newInstance();
                    $route->setController($class)
                        ->setAction($method);
                    $this->router->addRoute([
                        'name' => $route->getName(),
                        'url' => $route->getUrl(),
                        'methods' => $route->getMethod(),
                        'controller' => $route->getController(), 
                        'action' => $route->getAction(),
                    ]);
                }
            }
        }   
    }
}