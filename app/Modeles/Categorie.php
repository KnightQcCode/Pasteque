<?php
/**
 * Modele Catégorie.
 * * Permet de gérer les données concernant les catégories.
 * @author Alexandre Bédard - alexandre.bedard123@gmail.com
 * @author Jonathan Collard - Jonathan Collard
 * @author Yoann Bélanger - yoann.belanger@hotmail.com
 */

declare(strict_types=1);

namespace App\Modeles;

use App\App;
use \PDO;

class Categorie
{
    private int $id;
    private $nom;

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

    public static function trouverTout(): array
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT categories.*
                FROM categories";
        $requete = $pdo->prepare($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS, Categorie::class);
        $requete->execute();
        $categories = $requete->fetchAll();
        return $categories;

    }
    public static function trouver(int $unIdCategorie) : Categorie
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT categories.* 
                    FROM categories 
                    WHERE categories.id = :idCategorie";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':idCategorie', $unIdCategorie, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS, Categorie::class);
        $requete->execute();
        $categorie = $requete->fetch();
        return $categorie;
    }


}