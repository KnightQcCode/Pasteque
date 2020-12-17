<?php
/**
 * Controleur Site.
 * Permet de le controle général du site
 * @author Alexandre Bédard - alexandre.bedard123@gmail.com
 * @author Jonathan Collard - Jonathan Collard
 * @author Yoann Bélanger - yoann.belanger@hotmail.com
 */
declare(strict_types=1);

namespace App\Controleurs;

use App\App;
use App\Modeles\Evenement;
use App\Modeles\Actualite;
use App\Modeles\Livre;
use App\Modeles\Compte;
use App\Modeles\ItemPanier;
use App\Modeles\Panier;
use App\Utilitaires\Valider;
use \PDO;
use eftec\bladeone\BladeOne;


class ControleurSite
{
    private ?BladeOne $blade = null;

    public function __construct($refBlade)
    {
        $this->blade = $refBlade;
    }

    public function accueil(): void
    {
        if(isset($_POST['courriel'])){
            $unCourriel = $_POST['courriel'];
        }else{
            $unCourriel = 0;
        }
        $tEvenements = array('evenements' => Evenement::trouverTout());
        $tActualites = array('actualites' => Actualite::trouverTout());
        $tNouveautes = array('nouveautes' => Livre::trouverNouveaute());
        $tNouveautesPlus = array('nouveautesPlus' => Livre::trouverNouveautePlus());
        $tAParaitres = array('aParaitres' => Livre::trouverAParaitre());
        $tAParaitresPlus = array('aParaitresPlus' => Livre::trouverAParaitrePlus());
        $infoClient = array('infoClient' => Panier::trouverClientConnexion($unCourriel));
        $nbItemsPanier = ItemPanier::compteur();
        $_SESSION['nbItemPanierTest'] = $nbItemsPanier;
        $tAccueil = array_merge($tEvenements, $tActualites, $tNouveautes, $tNouveautesPlus, $tAParaitres,$tAParaitresPlus,$infoClient);
        echo $this->blade->run("accueil",$tAccueil);
    }
    public function connexionCompte(): void {
        $_SESSION['mode_livraison'] = $_POST;
        $tComptes = array('connexionCompte' => Compte::trouverTout());
        $tTitre = array("titrePage"=>"Se connecter");
        $tDonnees = array_merge($tComptes,$tTitre);
        echo $this->blade->run("compte.connexionCompte",$tDonnees);
    }
    public function connexionCompteAccueil(): void {
        $tComptes = array('connexionCompte' => Compte::trouverTout());
        $tTitre = array("titrePage"=>"Se connecter");
        $tDonnees = array_merge($tComptes,$tTitre);
        echo $this->blade->run("compte.connexionCompteAccueil",$tDonnees);
        $nbItemsPanier = ItemPanier::compteur();
        $_SESSION['nbItemPanier'] = $nbItemsPanier;
    }
    public function modifierCompte(): void {
        $tConnexions = array('modifierCompte' => Compte::trouverTout());
        $tTitre = array("titrePage"=>"Modifier mon compte");
        $tDonnees = array_merge($tConnexions,$tTitre);
        echo $this->blade->run("compte.modifierCompte",$tDonnees);
    }


    public function creerCompte(): void {
        $tConnexions = array('creerCompte' => Compte::trouverTout());
        $tTitre = array("titrePage"=>"Créer mon compte");
        $tValidation = null;
        $tValidation = ["tValidation" => $tValidation];
        $tDonnees = array_merge($tConnexions,$tValidation,$tTitre);
        echo $this->blade->run("compte.creerCompte",$tDonnees);
    }
    public function insererCompte(): void
    {
        // Récupérer le contenu des messages en format JSON
        $contenuBruteFichierJson = file_get_contents("../ressources/lang/fr_CA.UTF-8/messagesInscriptionValidation.json");
        // Convertir en tableau associatif
        $tMessagesJson = json_decode($contenuBruteFichierJson, false);
        
        if(Valider::valider()==true){
            $compte = new Compte();
            $compte->prenom = $_POST['prenom'];
            $compte->nom = $_POST['nom'];
            $compte->courriel = $_POST['courriel'];
            $compte->mot_de_passe = $_POST['mot_de_passe'];
            $compte->insererCompte();
            header('Location: index.php?controleur=site&action=accueil'); // redirection
        }else{
            header('Location: index.php?controleur=site&action=creerCompte'); // redirection
            exit;
        }
    }
}
