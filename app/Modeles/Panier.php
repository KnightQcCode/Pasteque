<?php
/**
 * Modele Panier.
 * Permet de gérer les données concernant les paniers.
 * @author Alexandre Bédard - alexandre.bedard123@gmail.com
 * @author Jonathan Collard - Jonathan Collard
 * @author Yoann Bélanger - yoann.belanger@hotmail.com
 */
declare(strict_types=1);

namespace App\Modeles;


use App\App;
use \PDO;

class Panier
{
    private int $id;
    private ?string $prenom;
    private ?string $nom;
    private ?string $mot_de_passe;
    private ?string $titre;
    private ?string $no_civique;
    private ?string $voie;
    private ?string $ville;
    private ?string $code_postal;
    private ?string $province;
    private ?string $pays;
    private ?string $type;
    private ?string $numero;
    private ?string $code_securite;
    private ?string $isbn_papier;
    private ?int $expiration_mois;
    private ?int $expiration_annnee;
    private int $client_id;
    private int $quantite;
    private int $livre_id;
    private int $panier_id;
    private float $prix_can;


    public function __construct()
    {
        //vide
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

    public static function trouverIdSession($idSession): ?Panier{
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT trx_paniers.*
                FROM trx_paniers
                WHERE trx_paniers.session_id = :idSession";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':idSession',$idSession, PDO::PARAM_STR);
        $requete->setFetchMode(PDO::FETCH_CLASS,Panier::class);
        $requete->execute();
        $panier = $requete->fetch();
        if($panier == false){
            $panier=null;
        }
        return $panier;

    }

    public function insererPanier(): void{
        $idSession = session_id();
        $pdo = App::getInstance()->getPDO();
        $sql = "INSERT INTO trx_paniers(client_id, session_id)
                VALUES ( 0,'$idSession') ";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':client_id',$client_id, PDO::PARAM_INT);
        $requete->bindParam(':id_session',$id_session, PDO::PARAM_STR);
        $requete->execute();
    }

    public static function compter(): int
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT COUNT(id) as total 
                FROM livres";
        $requete = $pdo->prepare($sql);
        $requete->execute();
        $nbLivre = $requete->fetch();
        return (int)$nbLivre['total'];
    }

    public static function trouverClient(): array
    {
        $client = $_SESSION["client2"];
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT * 
                FROM trx_clients
                WHERE id = '$client'";
        $requete = $pdo->prepare($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS, Panier::class);
        $requete->execute();
        $infoClient = $requete->fetchAll();
        return $infoClient;
    }

    public static function trouverClientConnexion($unCourriel):array
    {
        $_SESSION["client"] = $unCourriel;
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT * 
                FROM trx_clients
                INNER JOIN trx_adresses ON trx_clients.id = trx_adresses.client_id
                INNER JOIN trx_modes_paiement ON trx_clients.id = trx_modes_paiement.client_id
                WHERE courriel = :unCourriel && type_adresse = 1";
        $requete = $pdo->prepare($sql);
        $requete->bindParam(':unCourriel', $unCourriel, PDO::PARAM_STR);
        $requete->setFetchMode(PDO::FETCH_CLASS, Panier::class);
        $requete->execute();
        $infoClient = $requete->fetchAll();
        return $infoClient;
    }

    public static function trouverPanier(): array
    {
        $client = $_SESSION["client2"];
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT trx_paniers.*, trx_items_paniers.*, livres.*
                FROM trx_paniers
                INNER JOIN trx_items_paniers ON trx_paniers.id = trx_items_paniers.panier_id 
                INNER JOIN livres ON trx_items_paniers.livre_id = livres.id
                WHERE client_id = '$client'";
        $requete = $pdo->prepare($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS, Panier::class);
        $requete->execute();
        $infoClient = $requete->fetchAll();
        return $infoClient;
    }

    public static function compterQuantite() : int
    {
        $client = $_SESSION["client2"];
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT SUM(quantite) as total 
                FROM trx_paniers
                INNER JOIN trx_items_paniers ON trx_paniers.id = trx_items_paniers.panier_id 
                WHERE client_id = '$client'";
        $requete = $pdo->prepare($sql);
        $requete->execute();
        $nbItem = $requete->fetch();
        return (int) $nbItem['total'];
    }

    public static function compterPrix() : float
    {
        $client = $_SESSION["client2"];

        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT SUM(trx_items_paniers.quantite * livres.prix_can) as total 
                FROM trx_paniers
                INNER JOIN trx_items_paniers ON trx_paniers.id = trx_items_paniers.panier_id 
                INNER JOIN livres ON trx_items_paniers.livre_id = livres.id
                WHERE client_id = '$client'";
        $requete = $pdo->prepare($sql);
        $requete->execute();
        $prix = $requete->fetch();
        return (float) $prix['total'];
    }

    public static function trouverInfoLivre()
    {
        $client = $_SESSION['client2'];
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT auteurs.nom, auteurs.prenom, livres.id, livres.titre, livres.isbn_papier, livres.prix_can, trx_items_paniers.*
                FROM trx_items_paniers
                INNER JOIN livres_auteurs ON trx_items_paniers.livre_id = livres_auteurs.livre_id
                INNER JOIN auteurs ON livres_auteurs.auteur_id = auteurs.id
                INNER JOIN livres ON trx_items_paniers.livre_id = livres.id
                WHERE panier_id = '$client'";
        $requete = $pdo->prepare($sql);
        $requete->execute();
        $livres = $requete->fetchAll();
        return $livres;
    }

    public static function trouverAdresse(): array
    {
        $client = $_SESSION["client2"];
        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT trx_adresses.*
                FROM trx_adresses
                WHERE client_id = '$client' AND id = 1";
        $requete = $pdo->prepare($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS, Panier::class);
        $requete->execute();
        $adresse = $requete->fetchAll();
        return $adresse;
    }

    public static function trouverInfoPaiement(): array
    {
        $client = $_SESSION["client2"];

        $pdo = App::getInstance()->getPDO();
        $sql = "SELECT trx_modes_paiement.*
                FROM trx_modes_paiement
                WHERE client_id = '$client' AND id = 1";
        $requete = $pdo->prepare($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS, Panier::class);
        $requete->execute();
        $paiement = $requete->fetchAll();
        return $paiement;
    }

    public function ajoutBD($prixTotal, $nom, $courriel, $adresse_livraison, $villeLivraison, $codePostalLivraison, $provinceLivraison, $paysLivraison, $adresseFacturation, $villeFacturation,
                            $codePostalFacturation, $provinceFacturation, $paysFacturation,$client_id, $sessionId)
    {
        $date = date("Y-m-d");
        $dateFutur = strtotime("+7 day");
        $dateLivraison = date('Y-m-d', $dateFutur);
        $pdo = App::getInstance()->getPDO();
        $sql = "INSERT INTO trx_commandes (total, montant_livraison, statut, date_commande, date_livraison, nom, courriel, no_civique_livraison, voie_livraison, ville_livraison, 
                        code_postal_livraison, province_livraison, pays_livraison, no_civique_facturation, voie_facturation, ville_facturation, code_postal_facturation, province_facturation, pays_facturation, commentaire, client_id, session_id)
                VALUES ('$prixTotal', 0.00, 1, '$date', '$dateLivraison', '$nom', '$courriel', null, '$adresse_livraison',
                 '$villeLivraison', '$codePostalLivraison', '$provinceLivraison', '$paysLivraison', null, '$adresseFacturation', '$villeFacturation',
                        '$codePostalFacturation', '$provinceFacturation', '$paysFacturation', null, '$client_id', '$sessionId');";
        $requete = $pdo->prepare($sql);
        $requete->execute();
    }

    public function ajoutBDInvite($prixTotal, $nom, $prenom, $courriel, $adresse_livraison, $villeLivraison, $codePostalLivraison, $provinceLivraison, $paysLivraison, $adresseFacturation, $villeFacturation,
                            $codePostalFacturation, $provinceFacturation, $paysFacturation,$client_id, $sessionId)
    {
        $date = date("Y-m-d");
        $dateFutur = strtotime("+7 day");
        $dateLivraison = date('Y-m-d', $dateFutur);
        $pdo = App::getInstance()->getPDO();
        $sql = "INSERT INTO trx_commandes (total, montant_livraison, statut, date_commande, date_livraison, nom, prenom, courriel, no_civique_livraison, voie_livraison, ville_livraison, 
                        code_postal_livraison, province_livraison, pays_livraison, no_civique_facturation, voie_facturation, ville_facturation, code_postal_facturation, province_facturation, pays_facturation, commentaire, client_id, session_id)
                VALUES ('$prixTotal', 0.00, 1, '$date', '$dateLivraison', '$nom', '$prenom', '$courriel', null, '$adresse_livraison',
                 '$villeLivraison', '$codePostalLivraison', '$provinceLivraison', '$paysLivraison', null, '$adresseFacturation', '$villeFacturation',
                        '$codePostalFacturation', '$provinceFacturation', '$paysFacturation', null, '$client_id', '$sessionId');";
        $requete = $pdo->prepare($sql);
        $requete->execute();
    }

    public function MiseAJour(int $unIdLivre, int $uneQuantite)
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "UPDATE trx_items_paniers
                SET quantite = ". $uneQuantite ."
                WHERE livre_id = ". $unIdLivre ."";
        $requete = $pdo->prepare($sql);
        $requete->execute();
    }

    public function deleteLivre(int $unIdLivre)
    {
        $pdo = App::getInstance()->getPDO();
        $sql = "DELETE FROM trx_items_paniers WHERE livre_id=". $unIdLivre ."";
        $requete = $pdo->prepare($sql);
        $requete->execute();
    }


    public function getNomPrenomClient(): string
    {
        return $this->nom . " " . $this->prenom;
    }


    public static function trouverDate(): array
    {

        $datefutur15 = getdate(time()+7*24*3600);
//        Mettre les jours de la semaine en francais
        switch($datefutur15) {
            case $datefutur15["weekday"] == "Monday":
                $datefutur15["weekday"] = "Lundi";
                break;
            case $datefutur15["weekday"] == "Tuesday":
                $datefutur15["weekday"] = "Mardi";
                break;
            case $datefutur15["weekday"] == "Wednesday":
                $datefutur15["weekday"] = "Mercredi";
                break;
            case $datefutur15["weekday"] == "Thursday":
                $datefutur15["weekday"] = "Jeudi";
                break;
            case $datefutur15["weekday"] == "Friday":
                $datefutur15["weekday"] = "Vendredi";
                break;
            case $datefutur15["weekday"] == "Saturday":
                $datefutur15["weekday"] = "Samedi";
                break;
            case $datefutur15["weekday"] == "Sunday":
                $datefutur15["weekday"] = "Dimanche";
                break;
        }
        //Mettre les mois de l'année en francais
        switch($datefutur15){
            case $datefutur15["month"] == "January":
                  $datefutur15["month"] = "Janvier";
                  break;
            case $datefutur15["month"] == "February":
                $datefutur15["month"] = "Février";
                break;
            case $datefutur15["month"] == "March":
                $datefutur15["month"] = "Mars";
                break;
            case $datefutur15["month"] == "April":
                $datefutur15["month"] = "Avril";
                break;
            case $datefutur15["month"] == "May":
                $datefutur15["month"] = "Mai";
                break;
            case $datefutur15["month"] == "June":
                $datefutur15["month"] = "Juin";
                break;
            case $datefutur15["month"] == "August":
                $datefutur15["month"] = "Août";
                break;
            case $datefutur15["month"] == "September":
                $datefutur15["month"] = "Septembre";
                break;
            case $datefutur15["month"] == "October":
                $datefutur15["month"] = "Octobre";
                break;
            case $datefutur15["month"] == "November":
                $datefutur15["month"] = "Novembre";
                break;
            case $datefutur15["month"] == "December":
                $datefutur15["month"] = "Décembre";
                break;
        }
        return $datefutur15;
    }

    public static function trouverDateExpress(): array
    {
        $datefutur2 = getdate(time()+2*24*3600);
//        Mettre les jours de la semaine en francais
        switch($datefutur2) {
            case $datefutur2["weekday"] == "Monday":
                $datefutur2["weekday"] = "Lundi";
                break;
            case $datefutur2["weekday"] == "Tuesday":
                $datefutur2["weekday"] = "Mardi";
                break;
            case $datefutur2["weekday"] == "Wednesday":
                $datefutur2["weekday"] = "Mercredi";
                break;
            case $datefutur2["weekday"] == "Thursday":
                $datefutur2["weekday"] = "Jeudi";
                break;
                break;
            case $datefutur2["weekday"] == "Friday":
                $datefutur2["weekday"] = "Vendredi";
                break;
            case $datefutur2["weekday"] == "Saturday":
                $datefutur2["weekday"] = "Samedi";
                break;
            case $datefutur2["weekday"] == "Sunday":
                $datefutur2["weekday"] = "Dimanche";
                break;
        }
        //Mettre les mois de l'année en francais
        switch($datefutur2){
            case $datefutur2["month"] == "January":
                $datefutur2["month"] = "Janvier";
                break;
            case $datefutur2["month"] == "February":
                $datefutur2["month"] = "Février";
                break;
            case $datefutur2["month"] == "March":
                $datefutur2["month"] = "Mars";
                break;
            case $datefutur2["month"] == "April":
                $datefutur2["month"] = "Avril";
                break;
            case $datefutur2["month"] == "May":
                $datefutur2["month"] = "Mai";
                break;
            case $datefutur2["month"] == "June":
                $datefutur2["month"] = "Juin";
                break;
            case $datefutur2["month"] == "August":
                $datefutur2["month"] = "Août";
                break;
            case $datefutur2["month"] == "September":
                $datefutur2["month"] = "Septembre";
                break;
            case $datefutur2["month"] == "October":
                $datefutur2["month"] = "Octobre";
                break;
            case $datefutur2["month"] == "November":
                $datefutur2["month"] = "Novembre";
                break;
            case $datefutur2["month"] == "December":
                $datefutur2["month"] = "Décembre";
                break;
        }
        return $datefutur2;
    }
}
