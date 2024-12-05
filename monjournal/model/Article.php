<?php

namespace model;

class Article
{
    
    private int $id;
    private string $titre;
    private string $intro;
    private string $texte;
    private \DateTime $datePublication;
    private string $auteur;
    
    public function getId() : int {
        return $this->id;
    }

    public function getTitre() : string {
        return $this->titre;
    }

    public function getIntro() : string {
        return $this->intro;
    }

    public function getTexte() : string {
        return $this->texte;
    }

    public function getDatePublication() : \DateTime {
        return $this->datePublication;
    }

    public function getAuteur() : string {
        return $this->auteur;
    }

    public function setId(int $id) : void {
        $this->id = $id;
    }

    public function setTitre(string $titre) : void {
        $this->titre = $titre;
    }

    public function setIntro(string $intro) : void {
        $this->intro = $intro;
    }

    public function setTexte($texte) : void {
        $this->texte = $texte;
    }

    public function setDatePublication(\DateTime $datePublication) : void {
        $this->datePublication = $datePublication;
    }


    public function setAuteur(string $auteur) : void {
        $this->auteur = $auteur;
    }
    
}
