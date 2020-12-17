<?php
/**
 * Modele Couverture.
 * @author Alexandre Bédard - alexandre.bedard123@gmail.com
 * @author Jonathan Collard - Jonathan Collard
 * @author Yoann Bélanger - yoann.belanger@hotmail.com
 */

declare(strict_types=1);

namespace App\Modeles;

use App\App;
use \PDO;

class Couverture
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
        $sql = "SELECT type_couverture.*
                FROM type_couverture";
        $requete = $pdo->prepare($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS, Couverture::class);
        $requete->execute();
        $couvertures = $requete->fetchAll();
        return $couvertures;

    }
    public static function trouver(int $unIdCouverture) : Couverture
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT type_couverture.* 
                    FROM type_couverture 
                    WHERE type_couverture.id = :idCouverture";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':idCouverture', $unIdCouverture, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS, Couverture::class);
        $requete->execute();
        $couverture = $requete->fetch();
        return $couverture;
    }
}