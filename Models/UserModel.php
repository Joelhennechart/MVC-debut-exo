<?php

namespace App\Models;

class UserModel extends Model{
    protected ?int $id = null;
    protected ?string $nom = null;
    protected ?string $prenom = null;
    protected ?string $email = null;
    protected ?string $password = null;

    public function __construct()
    {
        $this->table = 'user';
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function setSession(): void
    {
        $_SESSION ['user'] = [
            'id' =>$this->id,
            'nom' =>$this->nom,
            'prenom' =>$this->prenom,
            'email' =>$this->email,
        ];
    }
    
    public function findUserByEmail(string $email): mixed
    {
        return $this->runQuery("SELECT * FROM $this->table WHERE email = ?", [$email])->fetch();
    }

    /**
     * Get the value of id
     *
     * @return ?int
     */
    public function getId(): ?int  // getId retourne un element en int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param ?int $id
     *
     * @return self
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nom
     *
     * @return ?string
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @param ?string $nom
     *
     * @return self
     */
    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     *
     * @return ?string
     */
    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @param ?string $prenom
     *
     * @return self
     */
    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return ?string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param ?string $email
     *
     * @return self
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return ?string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param ?string $password
     *
     * @return self
     */
    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }
}