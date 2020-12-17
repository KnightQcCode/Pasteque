<?php
/**
 * Modele Impression.
 * Permet de gérer les données concernant les impressions.
 * @author Alexandre Bédard - alexandre.bedard123@gmail.com
 * @author Jonathan Collard - Jonathan Collard
 * @author Yoann Bélanger - yoann.belanger@hotmail.com
 */

declare(strict_types=1);

namespace App\Modeles;

use App\App;
use \PDO;

class Impression
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
        $sql = "SELECT type_impression.*
                FROM type_impression";
        $requete = $pdo->prepare($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS, Impression::class);
        $requete->execute();
        $impressions = $requete->fetchAll();
        return $impressions;

    }
    public static function trouver(int $unIdImpression) : Impression
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT type_impression.* 
                    FROM type_impression 
                    WHERE type_impression.id = :idImpression";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':idImpression', $unIdImpression, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS, Impression::class);
        $requete->execute();
        $impression = $requete->fetch();
        return $impression;
    }


}