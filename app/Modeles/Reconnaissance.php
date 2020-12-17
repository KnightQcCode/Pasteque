<?php
/**
 * Modele Reconnaissance.
 * Permet d'associer un item avec un le panier.
 * @author Alexandre Bédard - alexandre.bedard123@gmail.com
 * @author Jonathan Collard - Jonathan Collard
 * @author Yoann Bélanger - yoann.belanger@hotmail.com
 */
declare(strict_types=1);

namespace App\Modeles;


use App\App;
use \PDO;


class Reconnaissance
{
    private int $id;
    private ?string $la_reconnaissance;
    private ?int $livre_id;

    public function __construct()
    {
        //vide
    }

    public static function trouver(int $unIdLivre) : array
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT reconnaissances.* 
                FROM reconnaissances 
                WHERE livre_id = :unIdLivre";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':unIdLivre', $unIdLivre, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS, Reconnaissance::class);
        $requete->execute();
        $reconnaissance = $requete->fetchAll();
        return $reconnaissance;
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
}