<?php
/**
 * Modele Livre.
 * * Permet de gérer les données concernant les livres.
 * @author Alexandre Bédard - alexandre.bedard123@gmail.com
 * @author Jonathan Collard - Jonathan Collard
 * @author Yoann Bélanger - yoann.belanger@hotmail.com
 */
declare(strict_types=1);

namespace App\Modeles;


use App\App;
use \PDO;

class Livre
{
    private int $id;
    private ?string $isbn_papier;
    private ?string $isbn_pdf;
    private ?string $isbn_epub;
    private ?string $url_audio;
    private ?string $titre;
    private ?string $le_livre;
    private ?string $arguments_commerciaux;
    private ?int $statut;
    private ?string $pagination;
    private ?int $age_min;
    private ?string $format;
    private ?int $tirage;
    private ?string $prix_can;
    private ?string $prix_euro;
    private ?string $date_parution_quebec;
    private ?string $date_parution_france;
    private ?int $categorie_id;
    private ?int $type_impression_id;
    private ?int $type_couverture_id;


    public function __construct()
    {
        //vide
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

    public static function compter() : int
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT COUNT(id) as total 
                FROM livres";
        $requete = $pdo->prepare($sql);
        $requete->execute();
        $nbLivre = $requete->fetch();
        return (int) $nbLivre['total'];
    }

    public static function compterLivreCategorie($uneCategorie) : int
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT COUNT(id) as total 
                FROM livres
                WHERE categorie_id = :categorie";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':categorie',$uneCategorie, PDO::PARAM_INT);
        $requete->execute();
        $nbLivre = $requete->fetch();
        return (int) $nbLivre['total'];
    }


    public static function paginer($unNoPage, $uneQteParPage) : array
    {
        $unIndex = $unNoPage * $uneQteParPage;

        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT livres.*
                FROM livres
                LIMIT :index, :quantite";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':index',$unIndex, PDO::PARAM_INT);
        $requete->bindParam(':quantite',$uneQteParPage, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS, Livre::class);
        $requete->execute();
        $livres = $requete->fetchAll();
        return $livres;
    }


    public static function trouverTout() : array
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT livres.*
                FROM livres";
        $requete = $pdo->prepare($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS, Livre::class);
        $requete->execute();
        $livres = $requete->fetchAll();
        return $livres;
    }
    public static function trouverParAuteur($unIdAuteur): array
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT livres.* 
                    FROM livres INNER JOIN livres_auteurs ON livres.id = livres_auteurs.livre_id
                    WHERE livres_auteurs.auteur_id = :unIdAuteur";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':unIdAuteur', $unIdAuteur, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS, Livre::class);
        $requete->execute();
        $listeLivres = $requete->fetchAll();
        return $listeLivres;
    }
    // Trier par recence
    public static function trierRecence($unNoPage, $uneQteParPage) : array{
        $unIndex = $unNoPage * $uneQteParPage;
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT livres.*
                FROM livres
                ORDER BY date_parution_quebec DESC
                LIMIT :index, :quantite";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':index',$unIndex, PDO::PARAM_INT);
        $requete->bindParam(':quantite',$uneQteParPage, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS, Livre::class);
        $requete->execute();
        $livres = $requete->fetchAll();
        return $livres;

    }
    // Info Fiche
    public static function trouver($unIdLivre): Livre{
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT livres.*
                FROM livres
                WHERE id = :unIdLivre";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':unIdLivre',$unIdLivre, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS,Livre::class);
        $requete->execute();
        $livre = $requete->fetch();
        return $livre;
    }
// Info Fiche
    public static function trouverAutreLivre($unIdLivre): Livre{
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT livres.*,livres_auteurs.auteur_id
                FROM livres_auteurs
                INNER JOIN livres ON livres_auteurs.livre_id = livres.id
                WHERE livre_id = :unIdLivre";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':unIdLivre',$unIdLivre, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS,Livre::class);
        $requete->execute();
        $autreLivre = $requete->fetch();
        return $autreLivre;
    }


    // Trier les Titres
    public static function trierAZ($unNoPage, $uneQteParPage):array{
        $unIndex = $unNoPage * $uneQteParPage;
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT livres.*
                FROM livres
                ORDER BY titre ASC LIMIT :index, :quantite";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':index',$unIndex, PDO::PARAM_INT);
        $requete->bindParam(':quantite',$uneQteParPage, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS,Livre::class);
        $requete->execute();
        $livresAz = $requete->fetchAll();
        return $livresAz;
    }

    public static function trierZA($unNoPage, $uneQteParPage):array{
        $unIndex = $unNoPage * $uneQteParPage;
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT livres.*
                FROM livres
                ORDER BY titre DESC LIMIT :index, :quantite";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':index',$unIndex, PDO::PARAM_INT);
        $requete->bindParam(':quantite',$uneQteParPage, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS,Livre::class);
        $requete->execute();
        $livresInverse = $requete->fetchAll();
        return $livresInverse;
    }
    public static function trierIsbn($unNoPage, $uneQteParPage):array{
        $unIndex = $unNoPage * $uneQteParPage;
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT livres.*
                FROM livres
                ORDER BY isbn_papier DESC LIMIT :index, :quantite";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':index',$unIndex, PDO::PARAM_INT);
        $requete->bindParam(':quantite',$uneQteParPage, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS,Livre::class);
        $requete->execute();
        $livresIsbn = $requete->fetchAll();
        return $livresIsbn;
    }
    public static function trierCategorie($unNoPage, $uneQteParPage):array{
        $unIndex = $unNoPage * $uneQteParPage;
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT livres.*
                FROM livres
                ORDER BY categorie_id ASC LIMIT :index, :quantite";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':index',$unIndex, PDO::PARAM_INT);
        $requete->bindParam(':quantite',$uneQteParPage, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS,Livre::class);
        $requete->execute();
        $livresCategorie = $requete->fetchAll();
        return $livresCategorie;
    }
    // Trier les Auteur AZ-ZA

    public static function trierAuteurAZ():array{
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT livres.*
        FROM livres INNER JOIN livres_auteurs ON livres.id = livres_auteurs.livre_id
        INNER JOIN auteurs ON livres_auteurs.auteur_id = auteurs.id
        ORDER BY auteurs.prenom ASC";
        $requete = $pdo->prepare($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS,Livre::class);
        $requete->execute();
        $auteursAz = $requete->fetchAll();
        return $auteursAz;
    }
    public static function trouverAuteurAz($unNoPage, $uneQteParPage):array{
        $unIndex = $unNoPage * $uneQteParPage;
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT livres.*
        FROM livres INNER JOIN livres_auteurs ON livres.id = livres_auteurs.livre_id
        INNER JOIN auteurs ON livres_auteurs.auteur_id = auteurs.id
        ORDER BY auteurs.prenom ASC LIMIT :index, :quantite";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':index',$unIndex, PDO::PARAM_INT);
        $requete->bindParam(':quantite',$uneQteParPage, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS,Livre::class);
        $requete->execute();
        $auteursAz = $requete->fetchAll();
        return $auteursAz;
    }
    public static function trierAuteurZA():array{
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT livres.*
        FROM livres INNER JOIN livres_auteurs ON livres.id = livres_auteurs.livre_id
        INNER JOIN auteurs ON livres_auteurs.auteur_id = auteurs.id
        ORDER BY auteurs.prenom DESC";
        $requete = $pdo->prepare($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS,Livre::class);
        $requete->execute();
        $auteursZa = $requete->fetchAll();
        return $auteursZa;
    }
    public static function trouverAuteurZa($unNoPage, $uneQteParPage):array{
        $unIndex = $unNoPage * $uneQteParPage;
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT livres.*
        FROM livres INNER JOIN livres_auteurs ON livres.id = livres_auteurs.livre_id
        INNER JOIN auteurs ON livres_auteurs.auteur_id = auteurs.id
        ORDER BY auteurs.prenom DESC LIMIT :index, :quantite";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':index',$unIndex, PDO::PARAM_INT);
        $requete->bindParam(':quantite',$uneQteParPage, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS,Livre::class);
        $requete->execute();
        $auteursZa = $requete->fetchAll();
        return $auteursZa;
    }

    public static function trouverParCategorie($unNoPage, $uneQteParPage, $uneCategorie):array{
        $unIndex = $unNoPage * $uneQteParPage;
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT livres.*
        FROM livres INNER JOIN livres_auteurs ON livres.id = livres_auteurs.livre_id
        INNER JOIN auteurs ON livres_auteurs.auteur_id = auteurs.id
        WHERE categorie_id = :categorie
        ORDER BY auteurs.prenom DESC LIMIT :index, :quantite";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':index',$unIndex, PDO::PARAM_INT);
        $requete->bindParam(':quantite',$uneQteParPage, PDO::PARAM_INT);
        $requete->bindParam(':categorie',$uneCategorie, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS,Livre::class);
        $requete->execute();
        $BD = $requete->fetchAll();
        return $BD;
    }

    public static function trouverNouveaute(): array
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT * 
                FROM livres
                WHERE statut = 2
                LIMIT 4";
        $requete = $pdo->prepare($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS, Livre::class);
        $requete->execute();
        $listeNouveaute = $requete->fetchAll();
        return $listeNouveaute;
    }

    public static function trouverNouveautePlus(): array
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT * 
                FROM livres
                WHERE statut = 2
                LIMIT 4 OFFSET 4";
        $requete = $pdo->prepare($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS, Livre::class);
        $requete->execute();
        $listeNouveautePlus = $requete->fetchAll();
        return $listeNouveautePlus;
    }

    public static function trierTouteNouveaute(): array
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT * 
                FROM livres
                WHERE statut = 1";
        $requete = $pdo->prepare($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS, Livre::class);
        $requete->execute();
        $listeNouveaute = $requete->fetchAll();
        return $listeNouveaute;
    }

    public static function trouverAParaitre(): array
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT * 
                    FROM livres
                    WHERE date_parution_quebec > '2020-01-01'
                    ORDER BY date_parution_quebec DESC
                    LIMIT 4";
        $requete = $pdo->prepare($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS, Livre::class);
        $requete->execute();
        $listeAParaitre = $requete->fetchAll();
        return $listeAParaitre;
    }

    public static function trouverAParaitrePlus(): array
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT * 
                FROM livres
                WHERE date_parution_quebec > '2020-01-01'
                LIMIT 4 OFFSET 4";
        $requete = $pdo->prepare($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS, Livre::class);
        $requete->execute();
        $listeAParaitrePlus = $requete->fetchAll();
        return $listeAParaitrePlus;
    }
    public static function trouverLesLivre($unIdLivre,$unIdAuteur): array
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT livres.* 
                FROM livres INNER JOIN livres_auteurs ON livres.id = livres_auteurs.livre_id
                WHERE livres_auteurs.auteur_id = :unIdAuteur
                AND livres_auteurs.livre_id != :unIdLivre";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':unIdLivre', $unIdLivre, PDO::PARAM_INT);
        $requete->bindParam(':unIdAuteur', $unIdAuteur, PDO::PARAM_INT);
        $requete->setFetchMode(PDO::FETCH_CLASS, Livre::class);
        $requete->execute();
        $livres = $requete->fetchAll();
        return $livres;
    }
    public static function rechercher($unFiltre, $uneRecherche): array
    {
        $pdo = App::getInstance()->getPDO();
                $sql = 'SELECT livres.*
                    FROM livres
                    INNER JOIN livres_auteurs ON livres.id = livres_auteurs.livre_id
                    INNER JOIN auteurs ON livres_auteurs.auteur_id = auteurs.id
                    WHERE ' . $unFiltre . ' = ' . '"'. $uneRecherche. '"';
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':unFiltre', $unFiltre, PDO::PARAM_STR);
        $requete->bindParam(':uneRecherche', $uneRecherche, PDO::PARAM_STR);
        $requete->setFetchMode(PDO::FETCH_CLASS, Livre::class);
        $requete->execute();
        $rechercheResultat = $requete->fetchAll();
        return $rechercheResultat;
    }


    public static function rechercherAuteurEtTitre($unFiltre, $uneRecherche): array
    {

        if($unFiltre == "nom"){
            $unFiltre = "CONCAT(nom,prenom)";
        }elseif($unFiltre == "titre"){
            $unFiltre = "titre";
        }
        $laRecherche = $uneRecherche;
        $resultat = explode(" ", $laRecherche);
        $where = " WHERE " . $unFiltre . " LIKE "  . "'%". $resultat[0] . "%' ";
        for($i=1; $i < count($resultat); $i ++){
            $where = $where . " AND " . $unFiltre . " LIKE "  . "'%". $resultat[$i] . "%' ";
            echo $i;

        }

        $pdo = App::getInstance()->getPDO();
        $sql = 'SELECT livres.*
                    FROM livres
                    INNER JOIN livres_auteurs ON livres.id = livres_auteurs.livre_id
                    INNER JOIN auteurs ON livres_auteurs.auteur_id = auteurs.id'
            . $where;
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':unFiltre', $unFiltre, PDO::PARAM_STR);
        $requete->bindParam(':uneRecherche', $uneRecherche, PDO::PARAM_STR);
        $requete->setFetchMode(PDO::FETCH_CLASS, Livre::class);
        $requete->execute();
        $rechercheResultat = $requete->fetchAll();
        return $rechercheResultat;
    }

    public function getCategories(): Categorie{
        return Categorie::trouver($this->categorie_id) ;
    }
    public function getImpressions(): Impression{
        return Impression::trouver($this->type_impression_id) ;
    }
    public function getCouvertures(): Couverture{
        return Couverture::trouver($this->type_couverture_id) ;
    }
    public function getAuteurs() : array
    {
        // Retourne un tableau d’objets des auteurs associés à un livre.
        return Auteur::trouverParLivre($this->id) ;
    }
    public function getDescriptionCourte()
    {
        return substr($this->arguments_commerciaux,0, 75)."...";
    }
}