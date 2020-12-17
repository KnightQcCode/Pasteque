<?php
/**
 * Modele actualité.
 * Permet de gérer les données concernant les actualités.
 * @author Alexandre Bédard - alexandre.bedard123@gmail.com
 * @author Jonathan Collard - Jonathan Collard
 * @author Yoann Bélanger - yoann.belanger@hotmail.com
 */
declare(strict_types=1);

namespace App\Modeles;

use App\App;
use \PDO;

class Actualite
{
    private int $id;
    private ?string $titre;
    private ?string $texte;
    private ?string $date;
    private ?string $url;
    private ?int $statut;

    public function __construct()
    {

    }

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
                FROM actualites";
        $requete = $pdo->prepare($sql);
        $requete->execute();
        $nbActualite = $requete->fetch();
        return (int) $nbActualite['total'];
    }
    public static function paginer($uneQte) : array
    {
        $unIndex = $uneQte;

        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT actualites.*
                FROM actualites
                LIMIT :index, :quantite";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':index',$unIndex, PDO::PARAM_INT);
        $requete->bindParam(':quantite',$uneQte, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS, Actualite::class);
        $requete->execute();
        $actualites = $requete->fetchAll();
        return $actualites;
    }
    public static function trouverTout(): array
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT actualites.*
                FROM actualites";
        $requete = $pdo->prepare($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS, Actualite::class);
        $requete->execute();
        $actualites= $requete->fetchAll();
        return $actualites;

    }
    public function getDescriptionCourte()
    {
        return substr($this->texte,0, 75)."...";
    }
}
