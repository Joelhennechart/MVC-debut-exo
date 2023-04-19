<?php

namespace App\Core;

use PDOStatement;

class Model extends Db
{
    protected ?string $table = null;
    private ?Db $db = null;

    /**
     * Fonction qui récupère toutes les entrées d'une table
     *
     * @return array
     */
    public function findAll(): array
    {
        $query = $this->runQuery("SELECT * FROM $this->table");

        return $query->fetchAll();
    }

    public function find(int $id): array|bool
    {
        return $this->runQuery("SELECT * FROM $this->table WHERE id = ?", [$id])->fetch();
    }

    /**
     * Fonction de recherche par critères dynamique
     *
     * @param array $criteres
     * @return array
     */
    public function findBy(array $criteres): array
    {
        // SELECT * FROM poste WHERE titre = ? AND id = ?
        $champs = [];
        $valeurs = [];

        foreach ($criteres as $key => $value) {
            $champs[] = "$key = ?";
            $valeurs[] = $value;
        }

        $listeChamp = implode(' AND ', $champs);

        // On execute la requete
        return $this->runQuery("SELECT * FROM $this->table WHERE $listeChamp", $valeurs)->fetchAll();
    }

    /**
     * Création d'une entrée en base de données
     *
     * @param self $model
     * @return void
     */
    public function create(self $model)
    {
        // INSERT INTO poste (titre, description, actif) VALUES (?, ?, ?)
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
        $listeMarqeurSql =  implode(', ', $marqueurSql);

        // On execute la requête SQL
        return $this->runQuery("INSERT INTO $this->table ($listeChamp) VALUES ($listeMarqeurSql)", $valeurs);
    }

    /**
     * Fonction qui envoie une requête en base de données
     *
     * @param string $query
     * @param array $attributs
     * @return PDOStatement|boolean
     */
    public function runQuery(string $query, array $attributs = []): PDOStatement|bool
    {
        // On récupère l'instance de Db
        $this->db = Db::getInstance();

        // On vérifie si on a des attributs
        if ($attributs != null) {
            // Requête préparée
            $query = $this->db->prepare($query);
            $query->execute($attributs);

            return $query;
        } else {
            // Requete simple
            return $this->db->query($query);
        }
    }
    /**
     * Fonction qui hydrate un poste à partir d'un tableau associatif
     *
     * @param array $donnees
     *
     */
    public function hydrate(array $donnees){
        foreach($donnees as $key => $value){
            // On récupère le nom du setter qui correspond à la clé (key)
            $setter = 'set' . ucwords($key);

            // On vérifie l'existance du setter créé
            if(method_exists($this, $setter)){
                // Si OK, on appelle (exécute) le setter
                $this->$setter($value);
            }
        }
        return $this;
    }

    /**
     * Fonction qui met a jour les valeurs des attributs d'un poste selon son id
     *
     * @param integer $id
     * @param Model $model
     */
    public function update(int $id, Model $model ){
        $champs =[];
        $valeurs =[];
        foreach($model as $champ => $valeur){
            if($valeur !== null && $champ != 'db' && $champ != 'table'){    // !== different en valeur et aussi en type
                $champs[] = "$champ = ?";
                $valeurs[] = $valeur;
            }
        }
        $valeurs[] = $id;
        // On trabsforme le tableau $champs en string
        $listeChamps = implode(',', $champs);

        //on execute notre requete
        return $this->runQuery("UPDATE $this->table SET $listeChamps WHERE id = ?;", $valeurs);
    }

    public function delete(int $id){
        return $this->runQuery("DELETE FROM $this->table WHERE id = ?", [$id]);
    }
}
