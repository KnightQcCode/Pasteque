<?php
/**
 * Modele Compte.
 * * Permet de gérer les données concernant les comptes.
 * @author Alexandre Bédard - alexandre.bedard123@gmail.com
 * @author Jonathan Collard - Jonathan Collard
 * @author Yoann Bélanger - yoann.belanger@hotmail.com
 */
declare(strict_types=1);

namespace App\Modeles;


use App\App;
use \PDO;

class Compte
{
    private int $id;
    private ?string $nom;
    private ?string $prenom;
    private ?string $courriel;
    private ?string $mot_de_passe;

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

    //Méthodes de sélection statiques

    public static function trouverTout(): array
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT trx_clients.*
                FROM trx_clients 
                WHERE id = 1";
        $requete = $pdo->prepare($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS, Compte::class);
        $requete->execute();
        $connexion = $requete->fetchAll();
        return $connexion;
    }
    public function insererCompte(): void
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "INSERT INTO trx_clients (nom,prenom,courriel,mot_de_passe)
                VALUES (:nom,:prenom,:courriel,:mot_de_passe)";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':nom',$this->nom, PDO::PARAM_STR);
        $requete->bindParam(':prenom',$this->prenom, PDO::PARAM_STR);
        $requete->bindParam(':courriel',$this->courriel, PDO::PARAM_STR);
        $requete->bindParam(':mot_de_passe',$this->mot_de_passe, PDO::PARAM_STR);
        $requete->execute();
    }
}