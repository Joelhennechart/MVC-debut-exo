<?php

namespace App\Core;

class PosteModel extends Model
{
    protected ?int $id = null;
    protected ?string $titre =null;
    protected ?string $description = null;
    protected ?\DateTime $createdAt = null;
    protected ?int $actif = null;

    public function __construct()
    {
        $this->table = 'poste';
    }

    /**             Clique Alt et sur toutes les fonctions en restant appuyer sur Alt puis clique droit "insert php8 getter et setter"
     * Get the value of id
     *
     * @return ?int
     */
    public function getId(): ?int
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
     * Get the value of titre
     *
     * @return ?string
     */
    public function getTitre(): ?string
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @param ?string $titre
     *
     * @return self
     */
    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get the value of description
     *
     * @return ?string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param ?string $description
     *
     * @return self
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of actif
     *
     * @return ?bool
     */
    public function getActif(): ?bool
    {
        return $this->actif;
    }

    /**
     * Set the value of actif
     *
     * @param ?bool $actif
     *
     * @return self
     */
    public function setActif(?bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }
}