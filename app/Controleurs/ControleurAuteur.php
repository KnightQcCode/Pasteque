<?php
/**
 * Controleur Auteur.
 * Permet de controler les actions des auteurs!
 * @author Alexandre Bédard - alexandre.bedard123@gmail.com
 * @author Jonathan Collard - Jonathan Collard
 * @author Yoann Bélanger - yoann.belanger@hotmail.com
 */

declare(strict_types=1);

namespace App\Controleurs;

use App\App;
use App\Modeles\Auteur;
use \PDO;
use App\utilitaires\Cookie;
use eftec\bladeone\BladeOne;


class ControleurAuteur
{
    private ?BladeOne $blade = null;

    public function __construct($refBlade)
    {
        $this->blade = $refBlade;
    }

    public function index(): void
    {
        $_SESSION['trierAuteur'] = 'index';
        //Aller chercher # de page dans l'url
        if (isset($_GET['page'])) {
            $noPage = $_GET['page'];
        } else {
            $noPage = 0;
        }

        $urlPage = "index.php?controleur=auteur&action=index";

        // calculer des choses pour la pagination
        $nbArtistesPage = 12;
        $nbTotalArtistes = Auteur::compter();
        $nbTotalArtistes = floor($nbTotalArtistes /$nbArtistesPage);

        //trouver livre entre la limite demander
        $limitArtistes = Auteur::paginer($noPage, $nbArtistesPage);
        $tTitres = array("titrePage"=>"Liste des artistes");
        $tNbArtistePage = array("nbArtistesPage" => $nbArtistesPage,
            "nombreTotalPages" => $nbTotalArtistes,
            "numeroPage" => $noPage,
            "urlPagination" => $urlPage,
            "artistes" => $limitArtistes,);
        $tListeArtistes = array_merge($tTitres,$tNbArtistePage);
        echo $this->blade->run("auteurs.index",$tListeArtistes);
    }
    public function fiche($unIdAuteur):void
    {
        $tTitres = array("titrePage"=>"Fiche d'un artiste ");
        $tFicheArtiste = array('ficheArtiste' => Auteur::trouver($unIdAuteur));
        $tLivres = array('listeLivres' => Auteur::trouverLesLivre($unIdAuteur));
        $tNbId = array('nbId' => Auteur::compter());
        $tFicheArtistes = array_merge($tTitres, $tFicheArtiste, $tLivres, $tNbId);
        echo $this->blade->run('auteurs.fiche',$tFicheArtistes);
    }
    public function trierAuteurAZ(): void
    {
        $_SESSION['trierAuteur'] = 'trierAuteurAZ';

        //Aller chercher # de page dans l'url
        if (isset($_GET['page'])) {
            $noPage = $_GET['page'];
        } else {
            $noPage = 0;
        }
        $urlPage = "index.php?controleur=auteur&action=trierAuteurAZ";
        // calculer des choses pour la pagination
        $nbArtistesPage = 12;
        $nbTotalArtistes = Auteur::compter();
        $nbTotalArtistes = floor($nbTotalArtistes / $nbArtistesPage);
        //trouver auteur entre la limite demander
        $limitArtistes = Auteur::trierAuteurAZ($noPage, $nbArtistesPage);
        $tTitres = array("titrePage"=>"Index des artistes trié par A-Z");
        $tNbArtistePage = array("nbArtistesPage" => $nbArtistesPage,
            "nombreTotalPages" => $nbTotalArtistes,
            "numeroPage" => $noPage,
            "urlPagination" => $urlPage,
            "artistes" => $limitArtistes,);
        $tTrierArtistesAZ = array_merge($tTitres, $tNbArtistePage);
        echo $this->blade->run("auteurs.index",$tTrierArtistesAZ);
    }

    public function trierAuteurZA(): void
    {
        $_SESSION['trierAuteur'] = 'trierAuteurZA';

        //Aller chercher # de page dans l'url
        if (isset($_GET['page'])) {
            $noPage = $_GET['page'];
        } else {
            $noPage = 0;
        }
        $urlPage = "index.php?controleur=auteur&action=trierAuteurZA";
        // calculer des choses pour la pagination

        $nbArtistesPage = 12;
        $nbTotalArtistes = Auteur::compter();
        $nbTotalArtistes = floor($nbTotalArtistes / $nbArtistesPage);
        //trouver auteur entre la limite demander
        $limitArtistes = Auteur::trierAuteurZA($noPage, $nbArtistesPage);
        $tTitres = array("titrePage"=>"Index des artistes trié par Z-A");
        $tNbArtistePage = array("nbArtistesPage" => $nbArtistesPage,
            "nombreTotalPages" => $nbTotalArtistes,
            "numeroPage" => $noPage,
            "urlPagination" => $urlPage,
            "artistes" => $limitArtistes,);
        $tTrierArtistesZA = array_merge($tTitres, $tNbArtistePage);
        echo $this->blade->run("auteurs.index",$tTrierArtistesZA);
    }
}