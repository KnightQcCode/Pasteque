<?php
/**
 * Modele Parution.
 * Permet d'associer un item avec un le panier.
 * @author Alexandre Bédard - alexandre.bedard123@gmail.com
 * @author Jonathan Collard - Jonathan Collard
 * @author Yoann Bélanger - yoann.belanger@hotmail.com
 */
declare(strict_types=1);

namespace App\Modeles;


use App\App;
use \PDO;


class Parution
{
    private int $id;
    private string $etat;

    public function __construct()
    {
        //vide
    }

    public static function trouver(int $unIdParution) : Parution
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT parutions.* 
                FROM parutions 
                WHERE parutions.id = :idParution";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':idParution', $unIdParution, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS, Parution::class);
        $requete->execute();
        $parution = $requete->fetch();
        return $parution;
    }


    public function __set($property, $value)
    {
        if (property_exists($this,$property))
        {
            $this->$property = $value;
        }
    }

    public function __get($property)
    {
        if (property_exists($this,$property))
        {
            return $this->$property;
        }
    }

    public static function trouverTout() : array
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT parutions.*
                FROM parutions";
        $requete = $pdo->prepare($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS, Parution::class);
        $requete->execute();
        $parutions = $requete->fetchAll();
        return $parutions;
    }
}