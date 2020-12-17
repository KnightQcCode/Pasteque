<?php

declare(strict_types=1);

namespace App;

use App\Controleurs\ControleurSite;
use App\Controleurs\ControleurLivre;
use App\Controleurs\ControleurAuteur;
use App\Controleurs\ControleurPanier;
use App\Modeles\Panier;
use \PDO;
use eftec\bladeone\BladeOne;


class App
{

    private static $instance = null;
    private ?PDO $pdo = null;
    private ?Bladeone $blade = null;

    private function __construct()
    {
    }

    public static function getInstance(): App
    {
        if (App::$instance === null) {
            App::$instance = new App();
        }
        return App::$instance;
    }

    public function demarrer():void
    {
        $this->demarrerSession();
        $this->configurerEnvironnement();
        $this->routerLaRequete();
    }
    private function demarrerSession():void
    {
        //Démarrer la session
        session_start();
   }

    private function configurerEnvironnement():void
    {
        if($this->getServeur() === 'serveur-local'){
            error_reporting(E_ALL | E_STRICT);
        }
        date_default_timezone_set('America/Montreal');
    }

    public function getServeur(): string
    {
        // Vérifier la nature du serveur (local VS production)
        $env = 'null';
        if ((substr($_SERVER['HTTP_HOST'], 0, 9) == 'localhost') ||
            (substr($_SERVER['HTTP_HOST'], 0, 7) == '192.168')  ||
            (substr($_SERVER['SERVER_ADDR'], 0, 7) == '192.168'))
        {
            $env = 'serveur-local';
        } else {
            $env = 'serveur-production';
        }
        return $env;
    }

    public function getPDO():PDO
    {
        if($this->pdo === null)
        {
            if($this->getServeur() == 'serveur-local')
            {
                // Tentative de connexion
                $chaineDSN = 'mysql:dbname=pasteque;host=localhost;port=8889;';
                $this->pdo = new PDO($chaineDSN, 'root', 'root');

                // Changement d'encodage des caractères UTF-8
                $this->pdo->exec("SET CHARACTER SET utf8");

                // Affectation des attributs de la connexion : Obtenir des rapports d'erreurs et d'exception avec errorInfo()
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            else if($this->getServeur() === 'serveur-production')
            {
                // Tentative de connexion
                $chaineDSN = 'mysql:dbname=20_goyaves;host=localhost;';
                $this->pdo = new PDO($chaineDSN, 'goyaves', 'Rpni3_2020_gs');

                // Changement d'encodage des caractères UTF-8
                $this->pdo->exec("SET CHARACTER SET utf8");

                // Affectation des attributs de la connexion : Obtenir des rapports d'erreurs et d'exception avec errorInfo()
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        }
        return $this->pdo;
    }

    public function getBlade():BladeOne
    {
        if($this->blade === null){
            $cheminDossierVues = '../ressources/vues';
            $cheminDossierCache = '../ressources/cache';
            $this->blade = new BladeOne($cheminDossierVues,$cheminDossierCache,BladeOne::MODE_AUTO);
        }
        return $this->blade;
    }

    public function routerLaRequete():void
    {
        $controleur = null;
        $action = null;

        // Déterminer le controleur responsable de traiter la requête
        if (isset($_GET['controleur'])){
            $controleur = $_GET['controleur'];
        }else{
            $controleur = 'site';
        }

        // Déterminer l'action du controleur
        if (isset($_GET['action'])){
            $action = $_GET['action'];
        }else{
            $action = 'accueil';
        }

        // Instantier le bon controleur selon la page demandée
        if ($controleur === 'site'){
            $this->monControleur = new ControleurSite($this->getBlade());;
            switch ($action) {
                case 'accueil':
                    $this->monControleur->accueil();
                    break;
                case 'rechercher':
                    $this->monControleur->resultatRecherche();
                    break;
                case 'connexionCompte':
                    $this->monControleur->connexionCompte();
                    break;
                case 'connexionCompteAccueil':
                    $this->monControleur->connexionCompteAccueil();
                    break;
                case 'creerCompte':
                    $this->monControleur->creerCompte();
                    break;
                case 'insererCompte':
                    $this->monControleur->insererCompte();
                    break;
                case 'modifierCompte':
                    $this->monControleur->modifierCompte();
                    break;
                default:
                    echo 'Erreur 404';
            }
        }else if($controleur === 'livre'){
            $this->monControleur = new ControleurLivre($this->getBlade());
            switch ($action){
                case 'index';
                    $this->monControleur->index();
                    break;
                case 'fiche':
                    $this->monControleur->fiche($_GET['idLivre']);
                    break;
                case 'trierRecence';
                    $this->monControleur->trierRecence();
                    break;
                case 'trierAZ':
                    $this->monControleur->trierAZ();
                    break;
                case 'trierZA':
                    $this->monControleur->trierZA();
                    break;
                case 'trierAuteurAZ':
                    $this->monControleur->trierAuteurAZ();
                    break;
                case 'trierAuteurZA':
                    $this->monControleur->trierAuteurZA();
                    break;
                case 'trierIsbn':
                    $this->monControleur->trierISBN();
                    break;
                case 'trierCategorie':
                    $this->monControleur->trierCategorie();
                    break;
                case 'trierTouteNouveaute':
                    $this->monControleur->trierTouteNouveaute();
                    break;
                case 'rechercher':
                    $this->monControleur->rechercher();
                    break;
//                    Les catégories de 1 à 6 dans la BD
                case '1':
                    $this->monControleur->trierBandeDessinee();
                    break;
                case '2':
                    $this->monControleur->trierBDJeunesse();
                    break;
                case '3':
                    $this->monControleur->trierLivreIllustre();
                    break;
                case '4':
                    $this->monControleur->trierAlbumJeunesse();
                    break;
                case '5':
                    $this->monControleur->trierDocumentaire();
                    break;
                case '6':
                    $this->monControleur->trierDivers();
                    break;
                default:
                    echo 'Erreur 404';
            }
        }else if($controleur === 'auteur'){
            $this->monControleur = new ControleurAuteur($this->getBlade());
            switch ($action){
                case 'index':
                    $this->monControleur->index();
                    break;
                    case 'fiche':
                        $this->monControleur->fiche($_GET['idAuteur']);
                    break;
                case 'trierAuteurAZ':
                    $this->monControleur->trierAuteurAZ();
                    break;
                case 'trierAuteurZA':
                    $this->monControleur->trierAuteurZA();
                    break;
                default:
                    echo 'Erreur 404';
            }
        } elseif ($controleur === 'panier') {
            $this->monControleur = new ControleurPanier($this->getBlade());
            switch ($action) {
                case 'index':
                    $this->monControleur->index();
                    break;
                case 'ajouterItem':
                    $this->monControleur->ajouterItem();
                    break;
                case 'ajouterlivrepanier':
                    $this->monControleur->ajouterlivrepanier();
                    break;
                case 'fiche':
                    $this->monControleur->fiche();
                    break;
                case 'passerCommande':
                    $this->monControleur->ValiderCommande();
                    break;
                case 'passerCommandeInvite':
                    $this->monControleur->validerCommandeInvite();
                    break;
                case 'confirmerCommande':
                    $this->monControleur->confirmerCommande();
                    break;
                case 'confirmerCommandeInvite':
                    $this->monControleur->confirmerCommandeInvite();
                    break;
                case 'supprimer':
                    $this->monControleur->supprimer();
                    break;
                case 'recalculer':
                    $this->monControleur->recalculer();
                    break;
                case 'delete':
                    $this->monControleur->deleteLivre();
                    break;
                case 'livraison':
                    $this->monControleur->livraison();
                    break;
                case 'livraisonInvite':
                    $this->monControleur->livraisonInvite();
                    break;
                case 'insererLivraison':
                    $this->monControleur->insererLivraison();
                    break;
                case 'insererLivraisonInvite':
                    $this->monControleur->insererLivraisonInvite();
                    break;
                case 'insererFacturation':
                    $this->monControleur->insererFacturation();
                    break;
                case 'insererFacturationInvite':
                    $this->monControleur->insererFacturationInvite();
                    break;
                    case 'facturation':
                    $this->monControleur->facturation();
                    break;
                case 'facturationInvite':
                    $this->monControleur->facturationInvite();
                    break;
            }
        } else {
            echo 'Erreur 404';
        }
    }
}