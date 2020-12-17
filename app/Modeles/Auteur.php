<?php
/**
 * Modele Auteur.
 * * Permet de gérer les données concernant les auteurs.
 * @author Alexandre Bédard - alexandre.bedard123@gmail.com
 * @author Jonathan Collard - Jonathan Collard
 * @author Yoann Bélanger - yoann.belanger@hotmail.com
 */
declare(strict_types=1);

namespace App\Modeles;


use App\App;
use \PDO;

class Auteur
{
//    Je modifie
    private int $id;
    private ?string $nom;
    private ?string $prenom;
    private ?string $notice;
    private ?string $site_web;
    private ?string $titre;
    private ?string $isbn_papier;

    //Méthodes non statique
    public function __construct()
    {
        //vide
    }

    //Getter / Setter (magiques)
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public static function compter() : int
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT COUNT(id) as total 
                FROM auteurs";
        $requete = $pdo->prepare($sql);
        $requete->execute();
        $nbAuteur = $requete->fetch();
        return (int) $nbAuteur['total'];
    }
    public static function paginer($unNoPage, $uneQteParPage) : array
    {
        $unIndex = $unNoPage * $uneQteParPage;

        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT auteurs.*
                FROM auteurs
                ORDER BY prenom ASC
                LIMIT :index, :quantite";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':index',$unIndex, PDO::PARAM_INT);
        $requete->bindParam(':quantite',$uneQteParPage, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS, Auteur::class);
        $requete->execute();
        $auteurs = $requete->fetchAll();
        return $auteurs;
    }

    //Méthodes de sélection statiques

    public static function trouverTout(): array
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT auteurs.*
                FROM auteurs ORDER BY prenom ASC";
        $requete = $pdo->prepare($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS, Auteur::class);
        $requete->execute();
        $auteurs = $requete->fetchAll();
        return $auteurs;
    }
    public static function trouver($unIdAuteur) : Auteur
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT auteurs.* 
                FROM auteurs 
                WHERE id = :unIdAuteur ORDER BY nom ASC";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':unIdAuteur', $unIdAuteur, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS, Auteur::class);
        $requete->execute();
        $auteur = $requete->fetch();
        return $auteur;
    }
    public static function trouverParLivre($unIdLivre): array
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT auteurs.* 
                FROM auteurs INNER JOIN livres_auteurs ON auteurs.id = livres_auteurs.auteur_id
                WHERE livres_auteurs.livre_id = :unIdLivre";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':unIdLivre', $unIdLivre, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS, Auteur::class);
        $requete->execute();
        $auteurs = $requete->fetchAll();
        return $auteurs;
    }
    public static function trouverLesLivre($unIdAuteur): array
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT livres.*, categories.nom
                FROM livres 
                INNER JOIN livres_auteurs ON livres.id = livres_auteurs.livre_id
                INNER JOIN categories ON livres.categorie_id = categories.id
                WHERE livres_auteurs.auteur_id = :unIdAuteur";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':unIdAuteur', $unIdAuteur, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS, Auteur::class);
        $requete->execute();
        $livres = $requete->fetchAll();
        return $livres;
    }
    // Trier les Titres
    public static function trierAuteurAZ($unNoPage, $uneQteParPage):array{
        $unIndex = $unNoPage * $uneQteParPage;
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT auteurs.*
                FROM auteurs
                ORDER BY prenom ASC LIMIT :index, :quantite";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':index',$unIndex, PDO::PARAM_INT);
        $requete->bindParam(':quantite',$uneQteParPage, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS,Auteur::class);
        $requete->execute();
        $auteursAZ = $requete->fetchAll();
        return $auteursAZ;
    }
    public static function trierAuteurZA($unNoPage, $uneQteParPage):array{
        $unIndex = $unNoPage * $uneQteParPage;
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT auteurs.*
                FROM auteurs
                ORDER BY prenom DESC LIMIT :index, :quantite";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':index',$unIndex, PDO::PARAM_INT);
        $requete->bindParam(':quantite',$uneQteParPage, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS,Auteur::class);
        $requete->execute();
        $auteursZA = $requete->fetchAll();
        return $auteursZA;
    }
    public function getLivres(): array
    {
        // Retourne un tableau d’objets des auteurs associés à un livre.
        return Livre::trouverParAuteur($this->id);

    }
    public function getNomPrenom(): string
    {
        return $this->nom . " " . $this->prenom;
    }
}