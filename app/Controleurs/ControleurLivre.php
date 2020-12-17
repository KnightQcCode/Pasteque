<?php
/**
 * Controleur Livre.
 * Permet de controler les actions des livres.
 * @author Alexandre Bédard - alexandre.bedard123@gmail.com
 * @author Jonathan Collard - Jonathan Collard
 * @author Yoann Bélanger - yoann.belanger@hotmail.com
 */
declare(strict_types=1);

namespace App\Controleurs;

use App\App;
use App\Modeles\Auteur;
use App\Modeles\Categorie;
use App\Modeles\Livre;
use App\Modeles\Panier;
use App\Modeles\Reconnaissance;
use App\utilitaires\Cookie;
use \PDO;
use eftec\bladeone\BladeOne;


class ControleurLivre
{
    private ?BladeOne $blade = null;

    public function __construct($refBlade)
    {
        $this->blade = $refBlade;
    }

    public function index(): void
    {
        $_SESSION['trier'] = 'index';
        //Aller chercher # de page dans l'url
        if (isset($_GET['page'])) {
            $noPage = $_GET['page'];
        } else {
            $noPage = 0;
        }
        $urlPage = "index.php?controleur=livre&action=index";
        // calculer des choses pour la pagination
        $nbLivresPage = 9;
        $nbTotalLivres = Livre::compter();
        $nbTotalLivre = floor($nbTotalLivres / $nbLivresPage);
        //trouver livre entre la limite demander
        $limitLivres = Livre::paginer($noPage, $nbLivresPage);
        $tDonnee1 = array("titrePage"=>"Liste des livres");
        $tDonnee2 = array('artistes' => Auteur::trouverTout());
        $tDonnee3 = array("nbLivrePage" => $nbLivresPage, 
            "nombreTotalPages" => $nbTotalLivre,
            "numeroPage" => $noPage,
            "urlPagination" => $urlPage,
            "livres" => $limitLivres,);
        $tDonnee4 = array('categories' => Categorie::trouverTout());
        $tDonnees = array_merge($tDonnee1,$tDonnee2,$tDonnee3, $tDonnee4);
        echo $this->blade->run("livres.index",$tDonnees);
    }
    public function fiche($unIdLivre):void
    {
        $panier = array('panier' => Panier::trouverPanier());
        $nbItem = Panier::compterQuantite();
        $prix = Panier::compterPrix();
        $quantite = array("quantite" => $nbItem, "prix" => $prix);
        $tDonnee1 = array("titrePage"=>"Fiche du livre ");
        $tDonnee2 = array('fiche' => Livre::trouver($unIdLivre));
        $tDonnee3 = array('artistes' => Auteur::trouverParLivre($_GET['idLivre']));
        $tDonnee4 = array('livres' => Livre::trouverLesLivre($unIdLivre, $_GET['idAuteur']));
        $tDonnee5 = array('nbId' => Livre::compter());
        $tDonnee6 = array('reconnaissances' => Reconnaissance::trouver((int)$_GET['idLivre']));
        $tDonnees = array_merge($panier, $quantite, $tDonnee1, $tDonnee2, $tDonnee3, $tDonnee4, $tDonnee5, $tDonnee6);
        echo $this->blade->run('livres.fiche',$tDonnees); // livres = le dossie
    }

    public function trierRecence(): void
    {
        $_SESSION['trier'] = 'trierRecence';


        //Aller chercher # de page dans l'url
        if (isset($_GET['page'])) {
            $noPage = $_GET['page'];
        } else {
            $noPage = 0;
        }
        $urlPage = "index.php?controleur=livre&action=trierRecence";
        // calculer des choses pour la pagination
        $nbLivresPage = 9;
        $nbTotalLivres = Livre::compter();
        $nbTotalLivre = floor($nbTotalLivres / $nbLivresPage);
        //trouver livre entre la limite demander
        $limitLivres = Livre::trierRecence($noPage, $nbLivresPage);
        $tDonnee1 = array("titrePage"=>"Index des livres triés par recence");
        $tDonnee2 = array("nbLivrePage" => $nbLivresPage,
            "nombreTotalPages" => $nbTotalLivre,
            "numeroPage" => $noPage,
            "urlPagination" => $urlPage,
            "livres" => $limitLivres,);
        $tDonnee4 = array('categories' => Categorie::trouverTout());
        $tDonnees = array_merge($tDonnee1, $tDonnee2, $tDonnee4);
        echo $this->blade->run("livres.index",$tDonnees);
    }

    public function trierAZ(): void
    {
        $_SESSION['trier'] = 'trierAZ';

        //Aller chercher # de page dans l'url
        if (isset($_GET['page'])) {
            $noPage = $_GET['page'];
        } else {
            $noPage = 0;
        }
        $urlPage = "index.php?controleur=livre&action=trierAZ";
        // calculer des choses pour la pagination
        $nbLivresPage = 9;
        $nbTotalLivres = Livre::compter();
        $nbTotalLivre = floor($nbTotalLivres / $nbLivresPage);
        //trouver livre entre la limite demander
        $limitLivres = Livre::trierAZ($noPage, $nbLivresPage);
        $tDonnee1 = array("titrePage"=>"Index des livres triés par A-Z");
        $tDonnee2 = array("nbLivrePage" => $nbLivresPage,
            "nombreTotalPages" => $nbTotalLivre,
            "numeroPage" => $noPage,
            "urlPagination" => $urlPage,
            "livres" => $limitLivres,);
        $tDonnee4 = array('categories' => Categorie::trouverTout());
        $tDonnees = array_merge($tDonnee1, $tDonnee2, $tDonnee4);
        echo $this->blade->run("livres.index",$tDonnees);
    }

    public function trierZA(): void
    {
        $_SESSION['trier'] = 'trierZA';
        //Aller chercher # de page dans l'url
        if (isset($_GET['page'])) {
            $noPage = $_GET['page'];
        } else {
            $noPage = 0;
        }
        $urlPage = "index.php?controleur=livre&action=trierZA";
        // calculer des choses pour la pagination
        $nbLivresPage = 9;
        $nbTotalLivres = Livre::compter();
        $nbTotalLivre = floor($nbTotalLivres / $nbLivresPage);
        //trouver livre entre la limite demander
        $limitLivres = Livre::trierZA($noPage, $nbLivresPage);
        $tDonnee1 = array("titrePage"=>"Index des livres triés par Z-A");
        $tDonnee2 = array("nbLivrePage" => $nbLivresPage,
            "nombreTotalPages" => $nbTotalLivre,
            "numeroPage" => $noPage,
            "urlPagination" => $urlPage,
            "livres" => $limitLivres,);
        $tDonnee4 = array('categories' => Categorie::trouverTout());
        $tDonnees = array_merge($tDonnee1, $tDonnee2, $tDonnee4);
        echo $this->blade->run("livres.index",$tDonnees);
    }

    public function trierAuteurAZ(): void
    {
        $_SESSION['trier'] = 'trierAuteurAZ';

        //Aller chercher # de page dans l'url
        if (isset($_GET['page'])) {
            $noPage = $_GET['page'];
        } else {
            $noPage = 0;
        }
        $urlPage = "index.php?controleur=livre&action=trierAuteurAZ";
        // calculer des choses pour la pagination
        $nbLivresPage = 9;
        $nbTotalLivres = Livre::compter();
        $nbTotalLivre = floor($nbTotalLivres / $nbLivresPage);
        //trouver livre entre la limite demander
        $limitLivres = Livre::trouverAuteurAz($noPage, $nbLivresPage);
        $tDonnee1 = array("titrePage"=>"Index des livres triés par artistes de A-Z");
        $tDonnee2 = array('livres' => Livre::trierAuteurAZ());
        $tDonnee3 = array("nbLivrePage" => $nbLivresPage,
            "nombreTotalPages" => $nbTotalLivre,
            "numeroPage" => $noPage,
            "urlPagination" => $urlPage,
            "livres" => $limitLivres,);
        $tDonnee4 = array('categories' => Categorie::trouverTout());
        $tDonnees = array_merge($tDonnee1,$tDonnee2,$tDonnee3, $tDonnee4);
        echo $this->blade->run("livres.index",$tDonnees);

    }

    public function trierAuteurZA(): void
    {
        $_SESSION['trier'] = 'trierAuteurZA';

        //Aller chercher # de page dans l'url
        if (isset($_GET['page'])) {
            $noPage = $_GET['page'];
        } else {
            $noPage = 0;
        }
        $urlPage = "index.php?controleur=livre&action=trierAuteurZA";
        // calculer des choses pour la pagination
        $nbLivresPage = 9;
        $nbTotalLivres = Livre::compter();
        $nbTotalLivre = floor($nbTotalLivres / $nbLivresPage);
        //trouver livre entre la limite demander
        $limitLivres = Livre::trouverAuteurZa($noPage, $nbLivresPage);
        $tDonnee1 = array("titrePage"=>"Index des livres triés par artistes de Z-A");
        $tDonnee2 = array('livres' => Livre::trierAuteurZA());
        $tDonnee3 = array("nbLivrePage" => $nbLivresPage,
            "nombreTotalPages" => $nbTotalLivre,
            "numeroPage" => $noPage,
            "urlPagination" => $urlPage,
            "livres" => $limitLivres,);
        $tDonnee4 = array('categories' => Categorie::trouverTout());
        $tDonnees = array_merge($tDonnee1,$tDonnee2,$tDonnee3, $tDonnee4);
        echo $this->blade->run("livres.index",$tDonnees);


    }

     public function trierTouteNouveaute(): void{

         $nouveautes = Livre::trierTouteNouveaute();
         $tDonnees = array("nouveautes"=>$nouveautes);
         echo $this->blade->run("accueil",$tDonnees);

     }

     public function trierISBN(): void
    {
        $_SESSION['trier'] = 'trierIsbn';

        //Aller chercher # de page dans l'url
        if (isset($_GET['page'])) {
            $noPage = $_GET['page'];
        } else {
            $noPage = 0;
        }
        $urlPage = "index.php?controleur=livre&action=trierIsbn";
        // calculer des choses pour la pagination
        $nbLivresPage = 9;
        $nbTotalLivres = Livre::compter();
        $nbTotalLivre = floor($nbTotalLivres / $nbLivresPage);
        //trouver livre entre la limite demander
        $limitLivres = Livre::trierIsbn($noPage, $nbLivresPage);
        $tDonnee1 = array("titrePage"=>"Index des livres triés par ISBN");
        $tDonnee2 = array("nbLivrePage" => $nbLivresPage,
            "nombreTotalPages" => $nbTotalLivre,
            "numeroPage" => $noPage,
            "urlPagination" => $urlPage,
            "livres" => $limitLivres,);
        $tDonnee4 = array('categories' => Categorie::trouverTout());
        $tDonnees = array_merge($tDonnee1, $tDonnee2, $tDonnee4);
        echo $this->blade->run("livres.index",$tDonnees);
    }

    public function trierCategorie(): void
    {
        //Aller chercher # de page dans l'url
        if (isset($_GET['page'])) {
            $noPage = $_GET['page'];
        } else {
            $noPage = 0;
        }
        $urlPage = "index.php?controleur=livre&action=trierCategorie";
        // calculer des choses pour la pagination
        $nbLivresPage = 9;
        $nbTotalLivres = Livre::compter();
        $nbTotalLivre = floor($nbTotalLivres / $nbLivresPage);
        //trouver livre entre la limite demander
        $limitLivres = Livre::trierCategorie($noPage, $nbLivresPage);
        $tDonnee1 = array("titrePage"=>"Index des livres triés par catégorie");
        $tDonnee2 = array("nbLivrePage" => $nbLivresPage,
            "nombreTotalPages" => $nbTotalLivre,
            "numeroPage" => $noPage,
            "urlPagination" => $urlPage,
            "livres" => $limitLivres,);
        $tDonnee4 = array('categories' => Categorie::trouverTout());
        $tDonnees = array_merge($tDonnee1, $tDonnee2, $tDonnee4);
        echo $this->blade->run("livres.index",$tDonnees);
    }

    public function trierBandeDessinee(): void
    {
        $_SESSION['trier'] = '1';

        //Aller chercher # de page dans l'url
        if (isset($_GET['page'])) {
            $noPage = $_GET['page'];
        } else {
            $noPage = 0;
        }

        $categorie = 1;
        $urlPage = "index.php?controleur=livre&action=1";
        // calculer des choses pour la pagination
        $nbLivresPage = 9;
        $nbTotalLivres = Livre::compterLivreCategorie($categorie);
        $nbTotalLivre = floor($nbTotalLivres / $nbLivresPage);
        //trouver livre entre la limite demander
        $limitLivres = Livre::trouverParCategorie($noPage, $nbLivresPage, $categorie);
        $tDonnee1 = array("titrePage"=>"Les BD");
        $tDonnee2 = array("nbLivrePage" => $nbLivresPage,
            "nombreTotalPages" => $nbTotalLivre,
            "numeroPage" => $noPage,
            "urlPagination" => $urlPage,
            "livres" => $limitLivres,);
        $tDonnee4 = array('categories' => Categorie::trouverTout());
        $tDonnees = array_merge($tDonnee1, $tDonnee2, $tDonnee4);
        echo $this->blade->run("livres.index",$tDonnees);
    }

    public function trierBDJeunesse(): void
    {
        $_SESSION['trier'] = '2';

        //Aller chercher # de page dans l'url
        if (isset($_GET['page'])) {
            $noPage = $_GET['page'];
        } else {
            $noPage = 0;
        }
        $categorie = 2;

        $urlPage = "index.php?controleur=livre&action=2";
        // calculer des choses pour la pagination
        $nbLivresPage = 9;
        $nbTotalLivres = Livre::compterLivreCategorie($categorie);
        $nbTotalLivre = floor($nbTotalLivres / $nbLivresPage);
        //trouver livre entre la limite demander
        $limitLivres = Livre::trouverParCategorie($noPage, $nbLivresPage, $categorie);
        $tDonnee1 = array("titrePage"=>"Les BD jeunesses");
        $tDonnee2 = array("nbLivrePage" => $nbLivresPage,
            "nombreTotalPages" => $nbTotalLivre,
            "numeroPage" => $noPage,
            "urlPagination" => $urlPage,
            "livres" => $limitLivres,);
        $tDonnee4 = array('categories' => Categorie::trouverTout());
        $tDonnees = array_merge($tDonnee1, $tDonnee2, $tDonnee4);
        echo $this->blade->run("livres.index",$tDonnees);
    }

    public function trierLivreIllustre(): void
    {
        $_SESSION['trier'] = '3';

        //Aller chercher # de page dans l'url
        if (isset($_GET['page'])) {
            $noPage = $_GET['page'];
        } else {
            $noPage = 0;
        }
        $categorie = 3;

        $urlPage = "index.php?controleur=livre&action=3";
        // calculer des choses pour la pagination
        $nbLivresPage = 9;
        $nbTotalLivres = Livre::compterLivreCategorie($categorie);
        $nbTotalLivre = floor($nbTotalLivres / $nbLivresPage);
        //trouver livre entre la limite demander
        $limitLivres = Livre::trouverParCategorie($noPage, $nbLivresPage, $categorie);
        $tDonnee1 = array("titrePage"=>"Les livres illustrés");
        $tDonnee2 = array("nbLivrePage" => $nbLivresPage,
            "nombreTotalPages" => $nbTotalLivre,
            "numeroPage" => $noPage,
            "urlPagination" => $urlPage,
            "livres" => $limitLivres,);
        $tDonnee4 = array('categories' => Categorie::trouverTout());
        $tDonnees = array_merge($tDonnee1, $tDonnee2, $tDonnee4);
        echo $this->blade->run("livres.index",$tDonnees);
    }

    public function trierAlbumJeunesse(): void
    {
        $_SESSION['trier'] = '4';

        //Aller chercher # de page dans l'url
        if (isset($_GET['page'])) {
            $noPage = $_GET['page'];
        } else {
            $noPage = 0;
        }
        $categorie = 4;

        $urlPage = "index.php?controleur=livre&action=4";
        // calculer des choses pour la pagination
        $nbLivresPage = 9;
        $nbTotalLivres = Livre::compterLivreCategorie($categorie);
        $nbTotalLivre = floor($nbTotalLivres / $nbLivresPage);
        //trouver livre entre la limite demander
        $limitLivres = Livre::trouverParCategorie($noPage, $nbLivresPage, $categorie);
        $tDonnee1 = array("titrePage"=>"Les albums jeunesses");
        $tDonnee2 = array("nbLivrePage" => $nbLivresPage,
            "nombreTotalPages" => $nbTotalLivre,
            "numeroPage" => $noPage,
            "urlPagination" => $urlPage,
            "livres" => $limitLivres,);
        $tDonnee4 = array('categories' => Categorie::trouverTout());
        $tDonnees = array_merge($tDonnee1, $tDonnee2, $tDonnee4);
        echo $this->blade->run("livres.index",$tDonnees);
    }

    public function trierDocumentaire(): void
    {
        $_SESSION['trier'] = '5';

        //Aller chercher # de page dans l'url
        if (isset($_GET['page'])) {
            $noPage = $_GET['page'];
        } else {
            $noPage = 0;
        }
        $categorie = 5;

        $urlPage = "index.php?controleur=livre&action=5";
        // calculer des choses pour la pagination
        $nbLivresPage = 9;
        $nbTotalLivres = Livre::compterLivreCategorie($categorie);
        $nbTotalLivre = floor($nbTotalLivres / $nbLivresPage);
        //trouver livre entre la limite demander
        $limitLivres = Livre::trouverParCategorie($noPage, $nbLivresPage, $categorie);
        $tDonnee1 = array("titrePage"=>"Les documentaires");
        $tDonnee2 = array("nbLivrePage" => $nbLivresPage,
            "nombreTotalPages" => $nbTotalLivre,
            "numeroPage" => $noPage,
            "urlPagination" => $urlPage,
            "livres" => $limitLivres,);
        $tDonnee4 = array('categories' => Categorie::trouverTout());
        $tDonnees = array_merge($tDonnee1, $tDonnee2, $tDonnee4);
        echo $this->blade->run("livres.index",$tDonnees);
    }

    public function trierDivers(): void
    {
        $_SESSION['trier'] = '6';

        //Aller chercher # de page dans l'url
        if (isset($_GET['page'])) {
            $noPage = $_GET['page'];
        } else {
            $noPage = 0;
        }
        $categorie = 6;

        $urlPage = "index.php?controleur=livre&action=6";
        // calculer des choses pour la pagination
        $nbLivresPage = 9;
        $nbTotalLivres = Livre::compterLivreCategorie($categorie);
        $nbTotalLivre = floor($nbTotalLivres / $nbLivresPage);
        //trouver livre entre la limite demander
        $limitLivres = Livre::trouverParCategorie($noPage, $nbLivresPage, $categorie);
        $tDonnee1 = array("titrePage"=>"Divers");
        $tDonnee2 = array("nbLivrePage" => $nbLivresPage,
            "nombreTotalPages" => $nbTotalLivre,
            "numeroPage" => $noPage,
            "urlPagination" => $urlPage,
            "livres" => $limitLivres,);
        $tDonnee4 = array('categories' => Categorie::trouverTout());
        $tDonnees = array_merge($tDonnee1, $tDonnee2, $tDonnee4);
        echo $this->blade->run("livres.index",$tDonnees);
    }

    public function rechercher(): void
    {
        //Aller chercher # de page dans l'url
        if (isset($_POST['rechercherPar'])) {
            $rechercherPar = $_POST['rechercherPar'];
        }
        if (isset($_POST['rechercher'])) {
            $recherche = $_POST['rechercher'];
        }
        if (isset($_GET['page'])) {
            $noPage = $_GET['page'];
        } else {
            $noPage = 0;
        }
        $urlPage = "index.php?controleur=livre&action=index";
        // calculer des choses pour la pagination
        $nbLivresPage = 9;
        $nbTotalLivres = Livre::compter();
        $nbTotalLivre = floor($nbTotalLivres / $nbLivresPage);
        //trouver livre entre la limite demander
        $limitLivres = Livre::paginer($noPage, $nbLivresPage);
        $titrePage = array("titrePage"=>"Recherche");
        $pagination = array("nbLivrePage" => $nbLivresPage,
            "nombreTotalPages" => $nbTotalLivre,
            "numeroPage" => $noPage,
            "urlPagination" => $urlPage,
            "livres" => $limitLivres,);
        $categories = array('categories' => Categorie::trouverTout());
        if (isset($_POST['isbn'])== true){
            $resultatRecherche = array('livres' => Livre::rechercher($rechercherPar, $recherche));
        }else{
            echo 'dans le else lol';
            $resultatRecherche = array('livres' => Livre::rechercherAuteurEtTitre($rechercherPar, $recherche));
        }
        $tDonnees = array_merge($titrePage, $pagination, $categories, $resultatRecherche);
        echo $this->blade->run("livres.index",$tDonnees);
    }
}