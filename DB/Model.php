<?php

namespace App\Db;

use PDOStatement;


class Model extends Db //Model est enfant de Db qui lui même est enfant de PDO
{
    protected ?string $table = null; // 3 possibilité public, private (private juste pour cette table), protected (class private aussi pour les enfants)
    private ?Db $db = null;

    /**
     * findAll : Fonction qui récupére toutes les entrées d'une table
     *
     * @return array
     */
    public function findAll(): array //findAll trouve toutes les entrées dans une table
    {
        $query = $this->runQuery("SELECT * FROM $this->table");
        return $query->fetchAll();
    }

    public function find(int $id): array|bool
    {
        return $this->runQuery("SELECT * FROM $this->table WHERE id = ?", [$id])->fetch(); // ? =marqueur SQL
    }

    

    /**
     *function de recherche par critères dynamique findBy
     *
     * @param array $criteres
     * @return array
     */
    public function findBy(array $criteres): array 
    {
        //SELECT * FROM poste WHERE titre = ? AND id = ?
        $champs = [];
        $valeurs = [];

        foreach ($criteres as $key => $value) { // Foreach ($données as $data) $key a chaque tour de boucle je récupère que la clé , et la valeur séparément 
            $champs[] = "$key = ?";
            $valeurs[] = $value;
        }
        
        $listeChamp = implode(' AND ', $champs);

        //On execute la requéte
        return $this->runQuery("SELECT * FROM $this->table WHERE $listeChamp", $valeurs)->fetchAll();
    }    
    
    /**
     * Création d'une entrée de base de données
     *
     * @param self $model
     * @return void
     */
    public function create(self $model)
    {
       //Insert INTO poste (titre, description, actif) VALUES (?, ?, ?) (? marqueurs)
       $champs = [];
       $marqueurSql = [];
       $valeurs = [];

        foreach ($model as $key => $value) {
            if ($key != 'table' && $key != 'db' && $value !== null) {
            $champs[] = $key;
            $marqueurSql[] = "?";
            $valeurs[] = $value;
            }
        }
        $listeChamp = implode(', ', $champs);
        $listeMarqueurSql = implode(', ', $marqueurSql);

        // On execute la requete SQL
        return $this->runQuery(" INSERT INTO $this->table ($listeChamp) VALUES ($listeMarqueurSql)", $valeurs);
    }

    /**
     * Fonction qui envoie une requéte en base de données
     *
     * @param string $query
     * @param array $attributs
     * @return PDOStatement|bool
     */
    public function runQuery(string $query, array $attributs = []): PDOStatement|bool
    {
        // On récupére l'instance (connexion) de Db
        $this->db = Db::getInstance(); //db = Data Base

        // On vérifie si on a des attributs
        if ($attributs != null) {
            // Requéte préparée
            $query = $this->db->prepare($query);
            $query->execute($attributs);

            return $query;
        } else{
            // requéte simple
            return $this->db->query($query);
        }
    }
}