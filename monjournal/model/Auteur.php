<?php

namespace model;

class Auteur
{

    private string $identifiant;

    private string $motDePasse;

    private string $nom;

    private string $prenom;

    public function getIdentifiant() : string {
        return $this->identifiant;
    }

    public function getMotDePasse() : string {
        return $this->motDePasse;
    }

    public function getNom() : string {
        return $this->nom;
    }

    public function getPrenom() : string {
        return $this->prenom;
    }

    public function setIdentifiant(string $identifiant) : void {
        $this->identifiant = $identifiant;
    }

    public function setMotDePasse(string $motDePasse) : void {
        $this->motDePasse = $motDePasse;
    }

    public function setNom(string $nom) : void {
        $this->nom = $nom;
    }

    public function setPrenom(string $prenom) : void {
        $this->prenom = $prenom;
    }
}

