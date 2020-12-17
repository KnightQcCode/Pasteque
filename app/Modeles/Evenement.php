<?php
/**
 * Modele Evenement.
 *  Permet de gérer les données concernant les Evenements.
 * @author Alexandre Bédard - alexandre.bedard123@gmail.com
 * @author Jonathan Collard - Jonathan Collard
 * @author Yoann Bélanger - yoann.belanger@hotmail.com
 */

declare(strict_types=1);

namespace App\Modeles;

use App\App;
use \PDO;

class Evenement
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
                FROM evenements";
        $requete = $pdo->prepare($sql);
        $requete->execute();
        $nbEvenement = $requete->fetch();
        return (int) $nbEvenement['total'];
    }
    public static function paginer($uneQte) : array
    {
        $unIndex = $uneQte;

        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT evenements.*
                FROM evenements
                LIMIT :index, :quantite";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':index',$unIndex, PDO::PARAM_INT);
        $requete->bindParam(':quantite',$uneQte, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS, Evenement::class);
        $requete->execute();
        $evenements = $requete->fetchAll();
        return $evenements;
    }
    public static function trouverTout(): array
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT evenements.*
                FROM evenements";
        $requete = $pdo->prepare($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS, Evenement::class);
        $requete->execute();
        $evenements = $requete->fetchAll();
        return $evenements;

    }
    public function getDescriptionCourte()
    {
        return substr($this->texte,0, 75)."...";
    }
}