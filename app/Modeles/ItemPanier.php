<?php
/**
 * Modele ItemPanier.
 * Permet d'associer un item avec un le panier.
 * @author Alexandre Bédard - alexandre.bedard123@gmail.com
 * @author Jonathan Collard - Jonathan Collard
 * @author Yoann Bélanger - yoann.belanger@hotmail.com
 */

declare(strict_types=1);
namespace App\modeles;
use App\App;
use \PDO;

class ItemPanier
{
    private int $id;
    private int $quantite;
    private int $livre_id;
    private int $panier_id;
    public function __construct()
    {}

    public function __set($property, $value) {
        if (property_exists($this, $property)){
            $this->$property = $value;
        }
    }

    public function __get($property) {
        if (property_exists($this, $property)){
            return $this->$property;
        }
    }

    public function ajouterlivrepanier($unQuantite, $unIdLivre) : void
    {
        $client = $_SESSION["client2"];
        $pdo = App::getInstance()->getPDO() ;
        $chaineSQL = "INSERT INTO trx_items_paniers(quantite, livre_id, panier_id) VALUES (:unQuantite, :unIdLivre, '$client')";
        $requetePreparee = $pdo->prepare($chaineSQL);
        $requetePreparee->bindParam(':unQuantite',$unQuantite, PDO::PARAM_INT);
        $requetePreparee->bindParam(':unIdLivre',$unIdLivre, PDO::PARAM_INT);
        $requetePreparee->execute();
    }

    public static function compteur() : int
    {
        $client = $_SESSION["client2"];
        $pdo = App::getInstance()->getPDO() ;
        $chaineSQL = "SELECT SUM(quantite) as total 
                FROM trx_paniers
                INNER JOIN trx_items_paniers ON trx_paniers.id = trx_items_paniers.panier_id 
                WHERE client_id = '$client'";
        $requetePreparee = $pdo->prepare($chaineSQL);
        $requetePreparee->execute();
        $nbItemsPanier = $requetePreparee->fetch();
        return (int)$nbItemsPanier['total'];
    }

    public static function trouverParPanier($unIdPanier){
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT *
                FROM trx_paniers INNER JOIN trx_items_paniers ON trx_paniers.id = trx_items_paniers.panier_id
                WHERE trx_items_paniers.panier_id = :unIdPanier";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':unIdPanier',$unIdPanier, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS,ItemPanier::class);
        $requete->execute();
        $itemsPaniers = $requete->fetchAll();
        return $itemsPaniers;
    }

    public static function trouverParIdPanierEtIdLivre($unIdLivre,$unIdPanier){
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT *
                FROM trx_items_paniers
                WHERE trx_items_paniers.livre_id = :unIdLivre && trx_items_paniers.panier_id = :unIdPanier";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':unIdLivre',$unIdLivre, PDO::PARAM_INT);
        $requete->bindParam(':unIdPanier',$unIdPanier, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS,ItemPanier::class);
        $requete->execute();
        $test = $requete->fetch();
        if($test == false){
            $test=null;
        }
        return $test;
    }
}
