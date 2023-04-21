<?php
namespace App\Core;

class Main
{
    public function __construct(
        private Routeur $router = new Routeur()
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
        $this->router->handleRequest($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
    }
}