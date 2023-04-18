<?php

namespace App\Db;

use PDO;
use PDOException;

class Db extends PDO //Db est enfant de PDO
{
    //On stock l'instance de la connexion en PDO
    private static ?Db $instance = null;
    //On stock l'instance de la connexion en PDO
    private const DBHOST = 'mvcdebutexo-db-1';
    private const DBUSER = 'root';
    private const DBPASS = 'root';
    private const DBNAME = 'demo_mvc_2023';

    public function __construct()
    {
        // DSN de connexion en BDD = Data Source Name
        $dsn = 'mysql:dbname=' . self::DBNAME . ';host=' . self::DBHOST;  // = . DB::DBNAME . ';host=' . Db::DBHOST;
        // On appelle le constructeur de la classe PDO
        try {
            parent::__construct($dsn, self::DBUSER, self::DBPASS, []);
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);  // PDO::FETCH_ASSOC= tableau associatif
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ERRMODE va être plus precis pour indiquer une erreur
          

           // PDO= 1pont entre mon code php et ma base de donné mysql
            
        } catch (PDOException $e) { //try on essaie si tous va bien ok. Ca passe a Catch si il y'a une erreur
            die($e->getMessage()); // die affiche une page blanche et indique 1 message d'erreur 
        }
    }
    /**
     * Récupère ou créée une instance de Db (INSTANCE UNIQUE) 
     *
     * @return self
     */
    public static function getInstance() : self
        {
            //On verifie que la propiété instance est null
            if (self::$instance === null) {
                self::$instance = new self();
                }
                return self::$instance;
    }
}