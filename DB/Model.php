<?php

namespace App\Db;

use PDOStatement;


class Model extends Db //Model est enfant de Db qui lui même est enfant de PDO
{
    protected ?string $table = null;
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
    /**
     * Fonction qui envoie une requéte en base de données
     *
     * @param string $query
     * @param array $attributs
     * @return void
     */
    public function runQuery(string $query, array $attributs = []): PDOStatement |bool
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