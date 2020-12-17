<?php
/**
 * Controleur Panier.
 * Permet de gérer les actions du panier et de la transaction
 * @author Alexandre Bédard - alexandre.bedard123@gmail.com
 * @author Jonathan Collard - Jonathan Collard
 * @author Yoann Bélanger - yoann.belanger@hotmail.com
 */
declare(strict_types=1);

namespace App\Controleurs;

use App\App;
use App\Modeles\Livre;
use App\Modeles\Panier;
use App\Modeles\Client;
use App\Modeles\ItemPanier;
use App\SessionItem;
use App\SessionPanier;


class ControleurPanier
{
    private $blade = null;

    public function __construct()
    {
        $this->blade = App::getInstance()->getBlade();
    }

    public function index()
    {
        //Trouver le client
        $infoClient = array('infoClient' => Panier::trouverClient());
        //Trouver panier
        $panier = array('panier' => Panier::trouverPanier());
        //Compter le nb d'item
        $nbItem = Panier::compterQuantite();
        //Trouver info du livre
        $livres = array('livres' => Panier::trouverInfoLivre());
        //Compter le prix
        $prix = Panier::compterPrix();
        $prixExpress = $prix + 8;
        //Ajout TPS au prix
        $tps = 5;
        $tpsCalcul = ($prix / 100) * $tps;
        $tpsCalculExpress = ($prixExpress / 100) * $tps;
        $sousTotalIncorrect = $prix + $tpsCalcul;
        $sousTotalIncorrectExpress = $prixExpress + $tpsCalcul;
        $totalTPS = number_format($tpsCalcul, 2, ",", ".");
        $totalTPSExpress = number_format($tpsCalculExpress, 2, ",", ".");
        $total = number_format($sousTotalIncorrect, 2, ",", ".");
        $totalExpress = number_format($sousTotalIncorrectExpress, 2, ",", ".");
        //Information de l'adresse
        $adresse = array('adresse' => Panier::trouverAdresse());
        //Information de paiement
        $paiement = array('paiement' => Panier::trouverInfoPaiement());
        //Trouver Date
        $date = array('date'=>Panier::trouverDate());
        $dateExpress = array('dateExpress'=>Panier::trouverDateExpress());
        $_SESSION['quantite'] = $nbItem;
        $_SESSION['panier'] = $panier;
        $_SESSION['prix'] = $prix;
        $_SESSION['prixExpress'] = $prixExpress;
        $_SESSION['prixTotal'] = (float) $total;
        $_SESSION['prixTotalExpress'] = $totalExpress;
        $_SESSION['totalTPS'] = $totalTPS;
        $_SESSION['totalTPSExpress'] = $totalTPSExpress;
        $_SESSION['infoLivre'] = $livres;
        $nomPage = array("nomPage" => "Mon panier");
        $quantite = array("quantite" => $nbItem, "prix" => $prix, "prix_express"=>$prixExpress, "tps" =>$totalTPS, "tps_express"=>$totalTPSExpress,
            "total" => $total, "total_express"=>$totalExpress);
        $tDonnees = array_merge($nomPage, $infoClient, $panier, $livres, $adresse, $date, $dateExpress, $paiement, $quantite);
//         Assemblé une vue
        echo $this->blade->run('panier.index', $tDonnees);
    }

    public function ValiderCommande()
    {
        //Trouver le client
        //Trouver panier
        $panier = array('panier' => Panier::trouverPanier());
        //Compter le nb d'item
        $nbItem = Panier::compterQuantite();
        //Compter le prix
        $prix = Panier::compterPrix();
        //Ajout TPS au prix
        $tps = 5;
        $tpsCalcul = ($prix / 100) * $tps;
        $sousTotalIncorrect = $prix + $tpsCalcul;
        $totalTPS = number_format($tpsCalcul, 2, ",", ".");
        $total = number_format($sousTotalIncorrect, 2, ",", ".");
        //Information de l'adresse
        $tdonneLivraison = array('tValidationLivraison' => $_SESSION['tValidationLivraison']);
        $tdonneFacturation = array('tValidationFacturation' => $_SESSION['tValidationFacturation']);
        //Trouver Date
        $date = array('date'=>Panier::trouverDate());
        $nomPage = array("nomPage" => "Validation de ma commande");
        $quantite = array("quantite" => $nbItem, "prix" => $prix, "tps" =>$totalTPS,
                            "total" => $total);
        $tDonnees = array_merge($nomPage, $panier, $tdonneLivraison, $tdonneFacturation, $date, $quantite);
//         Assemblé une vue
        echo $this->blade->run('panier.validationCommande', $tDonnees);
    }
    public function validerCommandeInvite()
    {
        //Trouver le client
        //Trouver panier
        $panier = array('panier' => Panier::trouverPanier());
        //Compter le nb d'item
        $nbItem = Panier::compterQuantite();
        //Compter le prix
        $prix = Panier::compterPrix();
        //Ajout TPS au prix
        $tps = 5;
        $tpsCalcul = ($prix / 100) * $tps;
        $sousTotalIncorrect = $prix + $tpsCalcul;
        $totalTPS = number_format($tpsCalcul, 2, ",", ".");
        $total = number_format($sousTotalIncorrect, 2, ",", ".");
        //Information de l'adresse
        $tdonneLivraison = array('tValidationLivraisonInvite' => $_SESSION['tValidationLivraisonInvite']);
        $tdonneFacturation = array('tValidationFacturationInvite' => $_SESSION['tValidationFacturationInvite']);
        //Trouver Date
        $date = array('date'=>Panier::trouverDate());
        $nomPage = array("nomPage" => "Validation de ma commande");
        $quantite = array("quantite" => $nbItem, "prix" => $prix, "tps" =>$totalTPS,
            "total" => $total);
        $tDonnees = array_merge($nomPage, $panier, $tdonneLivraison, $tdonneFacturation, $date, $quantite);
//         Assemblé une vue
        echo $this->blade->run('panier.validationCommandeInvite', $tDonnees);
    }

    public function confirmerCommande()
    {
        if (isset($_POST['total'])) {
            $total = $_POST['total'];
        }
        if (isset($_POST['client_id'])) {
            $clientId = $_POST['client_id'];
        }
        $prixTotal = $_SESSION['prixTotal'];
        $courriel = $_SESSION['tValidationLivraison']['courriel']['valeur'];
        $nom = $_SESSION['tValidationLivraison']['nom']['valeur'];
        $adresseLivraison = $_SESSION['tValidationLivraison']['adresse_livraison']['valeur'];
        $adresseFacturation = $_SESSION['tValidationFacturation']['adresse_facturation']['valeur'];
        $villeLivraison = $_SESSION['tValidationLivraison']['ville_livraison']['valeur'];
        $villeFacturation = $_SESSION['tValidationFacturation']['ville_facturation']['valeur'];
        $codePostalLivraison = $_SESSION['tValidationLivraison']['code_postal_livraison']['valeur'];
        $codePostalFacturation = $_SESSION['tValidationFacturation']['code_postal_facturation']['valeur'];
        $provinceLivraison = $_SESSION['tValidationLivraison']['province_livraison']['valeur'];
        $provinceFacturation = $_SESSION['tValidationFacturation']['province_facturation']['valeur'];
        $paysLivraison = $_SESSION['tValidationLivraison']['pays_livraison']['valeur'];
        $paysFacturation = $_SESSION['tValidationFacturation']['pays_facturation']['valeur'];
        $client_id = $_SESSION['panier']['panier'][0]->client_id;
        $sessionId = session_id();
        (new Panier)->ajoutBD($prixTotal, $nom, $courriel, $adresseLivraison, $villeLivraison, $codePostalLivraison, $provinceLivraison, $paysLivraison, $adresseFacturation, $villeFacturation
        , $codePostalFacturation, $provinceFacturation, $paysFacturation, $client_id,$sessionId);
        //Trouver le client
        $infoClient = array('infoClient' => Panier::trouverClient());
        $panier = array('panier' => Panier::trouverPanier());
        $livres = array('livres' => Panier::trouverInfoLivre());
        //Compter le nb d'item
        $nbItem = Panier::compterQuantite();
        //Compter le prix
        $prix = Panier::compterPrix();
        //Ajout TPS au prix
        $tps = 5;
        $tpsCalcul = ($prix / 100) * $tps;
        $sousTotalIncorrect = $prix + $tpsCalcul;
        $totalTPS = number_format($tpsCalcul, 2, ",", ".");
        $total = number_format($sousTotalIncorrect, 2, ",", ".");
        //Trouver Date
        $date = array('date'=>Panier::trouverDate());
        $nomPage = array("nomPage" => "Validation");
        $quantite = array("quantite" => $nbItem, "prix" => $prix, "tps" =>$totalTPS,
            "total" => $total);
        $_SESSION["tValidationLivraison"] = null;
        $_SESSION["tValidationFacturation"] = null;
        $tDonnees = array_merge($nomPage, $infoClient, $panier,$livres, $date, $quantite);
//         Assemblé une vue
        echo $this->blade->run('panier.confirmerCommande', $tDonnees);

    }

    public function confirmerCommandeInvite()
    {
        if (isset($_POST['total'])) {
            $total = $_POST['total'];
        }
        if (isset($_POST['client_id'])) {
            $clientId = $_POST['client_id'];
        }
//        var_dump($_SESSION['tValidationLivraisonInvite']);
        $prixTotal = $_SESSION['prixTotal'];
        $nom = $_SESSION['tValidationLivraisonInvite']['nom']['valeur'];
        $prenom = $_SESSION['tValidationLivraisonInvite']['prenom']['valeur'];
        $courriel = $_SESSION['tValidationLivraisonInvite']['courriel']['valeur'];
        $adresseLivraison = $_SESSION['tValidationLivraisonInvite']['adresse_livraison']['valeur'];
        $adresseFacturation = $_SESSION['tValidationFacturationInvite']['adresse_facturation']['valeur'];
        $villeLivraison = $_SESSION['tValidationLivraisonInvite']['ville_livraison']['valeur'];
        $villeFacturation = $_SESSION['tValidationFacturationInvite']['ville_facturation']['valeur'];
        $codePostalLivraison = $_SESSION['tValidationLivraisonInvite']['code_postal_livraison']['valeur'];
        $codePostalFacturation = $_SESSION['tValidationFacturationInvite']['code_postal_facturation']['valeur'];
        $provinceLivraison = $_SESSION['tValidationLivraisonInvite']['province_livraison']['valeur'];
        $provinceFacturation = $_SESSION['tValidationFacturationInvite']['province_facturation']['valeur'];
        $paysLivraison = $_SESSION['tValidationLivraisonInvite']['pays_livraison']['valeur'];
        $paysFacturation = $_SESSION['tValidationFacturationInvite']['pays_facturation']['valeur'];
        $client_id = $_SESSION['panier']['panier'][0]->client_id;
        $sessionId = session_id();
        (new Panier)->ajoutBDInvite($prixTotal, $nom, $prenom, $courriel, $adresseLivraison, $villeLivraison, $codePostalLivraison, $provinceLivraison, $paysLivraison, $adresseFacturation, $villeFacturation
            , $codePostalFacturation, $provinceFacturation, $paysFacturation, $client_id,$sessionId);
        //Trouver le client
        $infoClient = array('infoClient' => Panier::trouverClient());
        $panier = array('panier' => Panier::trouverPanier());
        $livres = array('livres' => Panier::trouverInfoLivre());
        //Compter le nb d'item
        $nbItem = Panier::compterQuantite();
        //Compter le prix
        $prix = Panier::compterPrix();
        //Ajout TPS au prix
        $tps = 5;
        $tpsCalcul = ($prix / 100) * $tps;
        $sousTotalIncorrect = $prix + $tpsCalcul;
        $totalTPS = number_format($tpsCalcul, 2, ",", ".");
        $total = number_format($sousTotalIncorrect, 2, ",", ".");
        //Trouver Date
        $date = array('date'=>Panier::trouverDate());
        $nomPage = array("nomPage" => "Validation");
        $quantite = array("quantite" => $nbItem, "prix" => $prix, "tps" =>$totalTPS,
            "total" => $total);
        $_SESSION["tValidationLivraison"] = null;
        $_SESSION["tValidationFacturation"] = null;
        $tDonnees = array_merge($nomPage, $infoClient, $panier,$livres, $date, $quantite);
//         Assemblé une vue
        echo $this->blade->run('panier.confirmerCommandeInvite', $tDonnees);

    }

    public function deleteLivre(){
        if (isset($_GET['idLivre'])){
            $unID = $_GET['idLivre'];
        }
        (new Panier)->deleteLivre((int) $unID);
        header('Location: index.php?controleur=panier&action=index');
        exit;
    }


    public function ajouterlivrepanier():void {
        if (isset($_POST['idLivre'])){
            $unIdLivre = $_POST['idLivre'];

        }
        if(isset($_POST['quantite'])){
            $unQuantite = $_POST['quantite'];
        }

        (new ItemPanier)->ajouterlivrepanier($unQuantite, (int) $unIdLivre);
        $nbItemsPanier = ItemPanier::compteur();
        $_SESSION['nbItemPanier'] = $nbItemsPanier;
    }
    
        public function recalculer(){

        if (isset($_POST['idLivre'])){
            $unID = $_POST['idLivre'];
        }
        if (isset($_POST['quantite'])) {
            $uneQuantite = $_POST['quantite'];
        }
        (new Panier)->MiseAJour((int) $unID, (int) $uneQuantite);
        header('Location: index.php?controleur=panier&action=index');
        exit;
    }

    public function livraison()
    {
        if (isset($_SESSION["tValidationLivraison"])) {
            // On va set le cookie
            $tValidation = $_SESSION["tValidationLivraison"];
        } else {
            $_SESSION["tValidationLivraison"] = "allo";
        }
        if(isset($_POST['courriel'])){
            $unCourriel = $_POST['courriel'];
        }




        $nomPage = array("nomPage" => "Livraison");
        $tValidation = ["tValidation" => $tValidation];
        $infoClient = array('infoClient' => Panier::trouverClientConnexion($unCourriel));
        $tDonnees = array_merge($nomPage, $tValidation, $infoClient);
//         Assemblé une vue
        echo $this->blade->run('panier.livraison', $tDonnees);

    }

    public function livraisonInvite()
    {
        if (isset($_SESSION["tValidationLivraisonInvite"])) {
            // On va set le cookie
            $tValidation = $_SESSION["tValidationLivraisonInvite"];

        }
        $nomPage = array("nomPage" => "Livraison");
        $tValidation = ["tValidation" => $tValidation];
        $tDonnees = array_merge($nomPage, $tValidation);
//         Assemblé une vue
        echo $this->blade->run('panier.livraisonInvite', $tDonnees);

    }

    public function facturation()
    {
        if (isset($_SESSION['tValidationLivraison'])) {
            $adresse = $_SESSION['tValidationLivraison'];
        } else {
            $_SESSION['tValidationLivraison'] = "allo";
        }
        if (isset($_SESSION["tValidationFacturation"])) {
            // On va set le cookie
            $tValidationFacturation = $_SESSION["tValidationFacturation"];
        }
        if(isset($_SESSION['tValidationLivraison']['courriel']['valeur'])){
            $unCourriel = $_SESSION['tValidationLivraison']['courriel']['valeur'];
        }
        $nomPage = array("nomPage" => "Facturation");
        $tabAdresse = array("adresse" => $adresse);
        $tValidation = ["tValidation" => $tValidationFacturation];
        $infoClient = array('infoClient' => Panier::trouverClientConnexion($unCourriel));
        $tDonnees = array_merge($nomPage, $tabAdresse, $tValidation,$infoClient);
//         Assemblé une vue
        echo $this->blade->run('panier.facturation', $tDonnees);

    }

    public function facturationInvite()
    {
        if (isset($_SESSION['tValidationLivraisonInvite'])) {
            $adresse = $_SESSION['tValidationLivraisonInvite'];
        }
        if (isset($_SESSION["tValidationFacturationInvite"])) {
            // On va set le cookie
            $tValidation= $_SESSION["tValidationFacturationInvite"];
        }
        $nomPage = array("nomPage" => "Facturation");
        $tabAdresse = array("adresse" => $adresse);
        $tValidation = ["tValidation" => $tValidation];
        $tDonnees = array_merge($nomPage, $tabAdresse, $tValidation);
//         Assemblé une vue
        echo $this->blade->run('panier.facturationInvite', $tDonnees);

    }
    

    public function insererLivraison(): void
    {

        $nomComplet = $_POST['nom'];
        $courriel = $_POST['courriel'];
        $mdp = $_POST['mot_de_passe'];
        $adresse = $_POST['adresse_livraison'];
        $ville = $_POST['ville_livraison'];
        $province = $_POST['province_livraison'];
        $pays = $_POST['pays_livraison'];
        $code_postal = $_POST['codePostal_livraison'];
        $memeAdresse = $_POST['memeAdresse'];

        // Récupérer le contenu des messages en format JSON
        $contenuBruteFichierJson = file_get_contents("../ressources/lang/fr_CA.UTF-8/messagesErreurValidation.json");
        // Convertir en tableau associatif
        $tMessagesJson = json_decode($contenuBruteFichierJson, true);

        //Validation nom complet
        $tNomComplet = ["valeur" => $nomComplet, "valide" => false, "message" => ""];
        if ($nomComplet != "") {
            $regExpNomComplet = "#^[a-zA-ZÀ-ÿ '-]+$#";
            if (!preg_match($regExpNomComplet, $nomComplet)) {
                $tNomComplet["valide"] = false;
                $tNomComplet["message"] = $tMessagesJson["nom_complet"]['pattern'];
            } else if (preg_match($regExpNomComplet, $nomComplet)) {
                $tNomComplet["valide"] = true;
            }
        } else {
            //Message d'erreur si vide
            $tNomComplet["message"] = $tMessagesJson["nom_complet"]['vide'];
        }
        //Validation courriel
        $tCourriel = ["valeur" => $courriel, "valide" => false, "message" => ""];
        if ($courriel != "") {
            $regExpCourriel = "#^[a-zA-Z0-9][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,}$#";
            if (!preg_match($regExpCourriel, $courriel)) {
                $tCourriel["valide"] = false;
                $tCourriel["message"] = $tMessagesJson["courriel"]['pattern'];
            } else if (preg_match($regExpCourriel, $courriel)) {
                $tCourriel["valide"] = true;
            }
        } else {
            //Message d'erreur si vide
            $tCourriel["message"] = $tMessagesJson["courriel"]['vide'];
        }
        //Validation mot de passe
        $tMDP = ["valeur" => $mdp, "valide" => false, "message" => ""];
        if ($mdp != "") {
            $regExpMDP = "#^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,10}$#";
            if (!preg_match($regExpMDP, $mdp)) {
                $tMDP["valide"] = false;
                $tMDP["message"] = $tMessagesJson["mot_de_passe"]['pattern'];
            } else if (preg_match($regExpMDP, $mdp)) {
                $tMDP["valide"] = true;
            }
        } else {
            //Message d'erreur si vide
            $tMDP["message"] = $tMessagesJson["mot_de_passe"]['vide'];
        }
        //Validation adresse
        $tAdresse = ["valeur" => $adresse, "valide" => false, "message" => ""];
        if ($adresse != "") {
            $regExpAdresse = "#^[0-9]+[a-zA-ZÀ-ÿ0-9 \-\'\,]+$#";
            if (!preg_match($regExpAdresse, $adresse)) {
                $tAdresse["valide"] = false;
                $tAdresse["message"] = $tMessagesJson["adresse"]['pattern'];
            } else if (preg_match($regExpAdresse, $adresse)) {
                $tAdresse["valide"] = true;
            }
        } else {
            //Message d'erreur si vide
            $tAdresse["message"] = $tMessagesJson["adresse"]['vide'];
        }
        //Validation ville
        $tVille = ["valeur" => $ville, "valide" => false, "message" => ""];
        if ($ville != "") {
            $regExpVille = "#^[A-ÿ]+(?:[\s-][A-zÀ-ÿ'-]+)*$#";
            if (!preg_match($regExpVille, $ville)) {
                $tVille["valide"] = false;
                $tVille["message"] = $tMessagesJson["ville"]['pattern'];
            } else if (preg_match($regExpVille, $ville)) {
                $tVille["valide"] = true;
            }
        } else {
            //Message d'erreur si vide
            $tVille["message"] = $tMessagesJson["ville"]['vide'];
        }
        //Validation province
        $tProvince = ["valeur" => $province, "valide" => false, "message" => ""];
        if ($province != "") {
            $tProvince["valide"] = true;
        } else {
            //Message d'erreur si vide
            $tProvince["message"] = $tMessagesJson["province"]['vide'];
        }
        //Validation pays
        $tPays = ["valeur" => $pays, "valide" => false, "message" => ""];
        if ($pays != "") {
            $tPays["valide"] = true;
        } else {
            //Message d'erreur si vide
            $tPays["message"] = $tMessagesJson["pays"]['vide'];
        }
        //Validation code postal
        $tCodePostal = ["valeur" => $code_postal, "valide" => false, "message" => ""];
        if ($code_postal != "") {
            $regExpCodePostal = "#^[A-Za-z][0-9][A-Za-z] [0-9][A-Za-z][0-9]$#";
            if (!preg_match($regExpCodePostal, $code_postal)) {
                $tCodePostal["valide"] = false;
                $tCodePostal["message"] = $tMessagesJson["code_postal"]['pattern'];
            } else if (preg_match($regExpCodePostal, $code_postal)) {
                $tCodePostal["valide"] = true;
            }
        } else {
            //Message d'erreur si vide
            $tCodePostal["message"] = $tMessagesJson["code_postal"]['vide'];
        }

        //Validation meme addresse de facturation
        $tMemeAdresse = ["valeur" => $memeAdresse, "valide" => true];


        $tValidationLivraison = ["nom"=>$tNomComplet,  "courriel"=>$tCourriel, "mot_de_passe"=>$tMDP, "adresse_livraison"=>$tAdresse, "ville_livraison"=>$tVille, "province_livraison"=>$tProvince, "pays_livraison"=>$tPays, "code_postal_livraison"=>$tCodePostal, "memeAdresse"=>$tMemeAdresse];

        if (!isset($_SESSION["tValidationLivraison"])) {
            // On va set le cookie
            $_SESSION["tValidationLivraison"] = $tValidationLivraison;
        } else {
            $_SESSION['tValidationLivraison']=null;
            $_SESSION["tValidationLivraison"] = $tValidationLivraison;
        }
        $champValide = 0;
        foreach ($tValidationLivraison as $champ) {
            if ($champ['valide'] == true) {
                $champValide = $champValide + 1;
            }
        }
        if ($champValide == count($tValidationLivraison)) {
            $touteEntreeValide = true;
        } else {
            $touteEntreeValide = false;
        }
        if ($touteEntreeValide == true) {
            header('Location: index.php?controleur=panier&action=facturation'); // redirection
            exit();
        } else {
            header('Location: index.php?controleur=panier&action=livraison'); // redirection
            exit();
        }
    }

    public function insererLivraisonInvite(): void
    {

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $courriel = $_POST['courriel'];
        $adresse = $_POST['adresse_livraison'];
        $ville = $_POST['ville_livraison'];
        $province = $_POST['province_livraison'];
        $pays = $_POST['pays_livraison'];
        $code_postal = $_POST['codePostal_livraison'];
        $memeAdresse = $_POST['memeAdresse'];
        //Validation nom
        $tNom = ["valeur" => $nom, "valide" => "faux", "message" => ""];
        if ($nom != "") {
            $regExpNom = "#^[a-zA-ZÀ-ÿ '-]+$#";
            if (!preg_match($regExpNom, $nom)) {
                $tNom["valide"] = "faux";
                $tNom["message"] = "Entrez un nom valide";
            } else if (preg_match($regExpNom, $nom)) {
                $tNom["valide"] = "vrais";
            }
        } else {
//            Message d'erreur si vide
            $tNom["message"] = "Entrez votre nom";
        }


        $tPrenom = ["valeur" => $prenom, "valide" => "faux", "message" => ""];
        if ($prenom != "") {
            $regExpNom = "#^[a-zA-ZÀ-ÿ\-\s]*#";
            if (!preg_match($regExpNom, $prenom)) {
                $tPrenom["valide"] = "faux";
                $tPrenom["message"] = "Entrez un Prenom valide";
            } else if (preg_match($regExpNom, $prenom)) {
                $tPrenom["valide"] = "vrais";
            }
        } else {
//            Message d'erreur si vide
            $tPrenom["message"] = "Entrez votre prenom";
        }
        //validation courriel
        $tCourriel = ["valeur" => $courriel, "valide" => "faux", "message" => ""];
        if ($courriel != "") {
            $regExpCourriel = "#^[a-zA-Z0-9][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,}$#";
            if(!preg_match($regExpCourriel, $courriel))  {
                $tCourriel["valide"] = "faux";
                $tCourriel["message"] = "Entrez un courriel valide";
            } else if (preg_match($regExpCourriel, $courriel)) {
                    $tCourriel["valide"] = "vrais";
            }
        } else {
//            Message d'erreur si vide
            $tCouriel["message"] = "Entrez un adresse courriel";
        }
        //validation adresse
        $tAdresse = ["valeur" => $adresse, "valide" => "faux", "message" => ""];
        if ($adresse != "") {
            $regExpAdresse = "#^[0-9]+[a-zA-ZÀ-ÿ0-9 \-\'\,]+$#";
            if (!preg_match($regExpAdresse, $adresse)) {
                $tAdresse["valide"] = "faux";
//                $tAdresse["message"] = $tMessagesJson["adresse"]['pattern'];
                $tAdresse["message"] = "Entrez une adresse valide";
            } else if (preg_match($regExpAdresse, $adresse)) {
                $tAdresse["valide"] = "vrais";
            }
        } else {
//            Message d'erreur si vide
            $tAdresse["message"] = "Entrez une adresse";
        }
        //validation ville
        $tVille = ["valeur" => $ville, "valide" => "faux", "message" => ""];
        if ($ville != "") {
            $regExpVille = "#^[A-ÿ]+(?:[\s-][A-zÀ-ÿ'-]+)*$#";
            if (!preg_match($regExpVille, $ville)) {
                $tVille["valide"] = "faux";
                $tVille["message"] = "Entrez une ville valide";
            } else if (preg_match($regExpVille, $ville)) {
                $tVille["valide"] = "vrais";
            }
        } else {
//            Message d'erreur si vide
            $tVille["message"] = "Entrez une ville";
        }

        //validation pays
        $tProvince = ["valeur" => $province, "valide" => "faux", "message" => ""];
        if ($province != "") {
            $tProvince["valide"] = "vrais";
        } else {
//            Message d'erreur si vide
            $tProvince["message"] = "Choisissez une province";
        }

        //validation pays
        $tPays = ["valeur" => $pays, "valide" => "faux", "message" => ""];
        if ($pays != "") {
            $tPays["valide"] = "vrais";
        } else {
//            Message d'erreur si vide
            $tPays["message"] = "Choisissez un pays";
        }

        //validation code postal
        $tCodePostal = ["valeur" => $code_postal, "valide" => "faux", "message" => ""];
        if ($code_postal != "") {
            $regExpCodePostal = "#^[A-Za-z][0-9][A-Za-z] [0-9][A-Za-z][0-9]$#";
            if (!preg_match($regExpCodePostal, $code_postal)) {
                $tCodePostal["valide"] = "faux";
                $tCodePostal["message"] = "Entrez un code postal valide";
            } else if (preg_match($regExpCodePostal, $code_postal)) {
                $tCodePostal["valide"] = "vrais";
            }
        } else {
//            Message d'erreur si vide
            $tCodePostal["message"] = "Entrez un code postal";
        }

        //validation meme addresse de facturation
        $tMemeAdresse = ["valeur" => $memeAdresse, "valide" => "vrais"];

        $tValidationLivraisonInvite = ["nom"=>$tNom, "prenom"=>$tPrenom, "courriel"=>$tCourriel, "adresse_livraison"=>$tAdresse, "ville_livraison"=>$tVille, "province_livraison"=>$tProvince, "pays_livraison"=>$tPays, "code_postal_livraison"=>$tCodePostal, "memeAdresse"=>$tMemeAdresse];


        if (!isset($_SESSION["tValidationLivraisonInvite"])) {
            // On va set le cookie
            $_SESSION["tValidationLivraisonInvite"] = $tValidationLivraisonInvite;
        } else {
            $_SESSION['tValidationLivraisonInvite']=null;
            $_SESSION["tValidationLivraisonInvite"] = $tValidationLivraisonInvite;
        }

        $champValide = 0;
        foreach ($tValidationLivraisonInvite as $champ) {
            if ($champ['valide'] == 'vrais') {
                $champValide = $champValide + 1;
            }
        }

        if ($champValide == count($tValidationLivraisonInvite)) {
            $touteEntreeValide = true;
        } else {
            $touteEntreeValide = false;
        }


        if ($touteEntreeValide == true) {
            header('Location: index.php?controleur=panier&action=facturationInvite'); // redirection
            exit();
        } else {
            header('Location: index.php?controleur=panier&action=livraisonInvite'); // redirection
            exit();
        }
    }

    public function insererFacturation(): void
    {
        $typePaiement = $_POST['typePaiement'];
        $nomCarte = $_POST['nom_carte'];
        $numeroCarte = $_POST['num_carte'];
        $codeSecurite = $_POST['code_securite'];
        $mois = $_POST['mois_expiration'];
        $annee = $_POST['annee_expiration'];
        $adresse = $_POST['adresse_facturation'];
        $ville = $_POST['ville_facturation'];
        $province = $_POST['province_facturation'];
        $pays = $_POST['pays_facturation'];
        $code_postal = $_POST['codePostal_facturation'];


        // Récupérer le contenu des messages en format JSON
        $contenuBruteFichierJson = file_get_contents("../ressources/lang/fr_CA.UTF-8/messagesErreurValidation.json");
        // Convertir en tableau associatif
        $tMessagesJson = json_decode($contenuBruteFichierJson, true);

        //Validation type paiement
        $tTypePaiement = ["valeur" => $typePaiement, "valide" => false, "message" => ""];
        if ($typePaiement != "") {
            $tTypePaiement["valide"] = true;
        } else {
            //Message d'erreur si vide
            $tTypePaiement["message"] = $tMessagesJson["type_paiement"]['vide'];
        }

        //Validation nom carte
        $tNomCarte = ["valeur" => $nomCarte, "valide" => false, "message" => ""];
        if ($nomCarte != "") {
            $regExpNomCarte = "#^[a-zA-ZÀ-ÿ '-]+$#";
            if (!preg_match($regExpNomCarte, $nomCarte)) {
                $tNomCarte["valide"] = false;
                $tNomCarte["message"] = $tMessagesJson["nom_carte"]['pattern'];
            } else if (preg_match($regExpNomCarte, $nomCarte)) {
                $tNomCarte["valide"] = true;
            }
        } else {
            //Message d'erreur si vide
            $tNomCarte["message"] = $tMessagesJson["nom_carte"]['vide'];
        }

        //Validation no carte crédit
        $tNumeroCarte = ["valeur" => $numeroCarte, "valide" => false, "message" => ""];
        if ($numeroCarte != "") {
            $regExpNum = "#^[0-9]{16}$#";
            if (!preg_match($regExpNum, $numeroCarte)) {
                $tNumeroCarte["valide"] = false;
                $tNumeroCarte["message"] = $tMessagesJson["num_carte"]['pattern'];
            } else if (preg_match($regExpNum, $numeroCarte)) {
                $tNumeroCarte["valide"] = true;
            }
        } else {
            //Message d'erreur si vide
            $tNomCarte["message"] = $tMessagesJson["num_carte"]['vide'];
        }
        //Validation code sécurité
        $tCodeSecurite = ["valeur" => $codeSecurite, "valide" => false, "message" => ""];
        if ($codeSecurite != "") {
            $regExpCodeSecurite = "#^[0-9]{3}$#";
            if (!preg_match($regExpCodeSecurite, $codeSecurite)) {
                $tCodeSecurite["valide"] = false;
                $tCodeSecurite["message"] = $tMessagesJson["code_securite"]['pattern'];
            } else if (preg_match($regExpCodeSecurite, $codeSecurite)) {
                $tCodeSecurite["valide"] = true;
            }
        } else {
            //Message d'erreur si vide
            $tCodeSecurite["message"] = $tMessagesJson["code_securite"]['vide'];
        }
        //Validation mois carte crédit
        $tMois = ["valeur" => $mois, "valide" => false, "message" => ""];
        if ($mois != "") {
            $regExpMoisSecurite = "#^[0-9]{1,2}$#";
            if (!preg_match($regExpMoisSecurite, $mois)) {
                $tMois["valide"] = false;
                $tMois["message"] = $tMessagesJson["mois_securite"]['pattern'];
            } else if (preg_match($regExpMoisSecurite, $mois)) {
                $tMois["valide"] = true;
            }
        } else {
            //Message d'erreur si vide
            $tMois["message"] = $tMessagesJson["mois_securite"]['vide'];
        }
        //Validation mois carte crédit
        $tAnnee = ["valeur" => $annee, "valide" => false, "message" => ""];
        if ($mois != "") {
            $regExpAnneeSecurite = "#^[0-9]{1,2}$#";
            if (!preg_match($regExpAnneeSecurite, $annee)) {
                $tAnnee["valide"] = false;
                $tAnnee["message"] = $tMessagesJson["annee_securite"]['pattern'];
            } else if (preg_match($regExpAnneeSecurite, $annee)) {
                $tAnnee["valide"] = true;
            }
        } else {
            //Message d'erreur si vide
            $tAnnee["message"] = $tMessagesJson["annee_securite"]['vide'];
        }
    //Validation adresse
        $tAdresse = ["valeur" => $adresse, "valide" => false, "message" => ""];
        if ($adresse != "") {
            $regExpAdresse = "#^[0-9]+[a-zA-ZÀ-ÿ0-9 \-\'\,]+$#";
            if (!preg_match($regExpAdresse, $adresse)) {
                $tAdresse["valide"] = false;
                $tAdresse["message"] = $tMessagesJson["adresse"]['pattern'];
            } else if (preg_match($regExpAdresse, $adresse)) {
                $tAdresse["valide"] = true;
            }
        } else {
            //Message d'erreur si vide
            $tAdresse["message"] = $tMessagesJson["adresse"]['vide'];
        }
        //Validation ville
        $tVille = ["valeur" => $ville, "valide" => false, "message" => ""];
        if ($ville != "") {
            $regExpVille = "#^[A-ÿ]+(?:[\s-][A-zÀ-ÿ'-]+)*$#";
            if (!preg_match($regExpVille, $ville)) {
                $tVille["valide"] = false;
                $tVille["message"] = $tMessagesJson["ville"]['pattern'];
            } else if (preg_match($regExpVille, $ville)) {
                $tVille["valide"] = true;
            }
        } else {
            //Message d'erreur si vide
            $tVille["message"] = $tMessagesJson["ville"]['vide'];
        }
        //Validation province
        $tProvince = ["valeur" => $province, "valide" => false, "message" => ""];
        if ($province != "") {
            $tProvince["valide"] = true;
        } else {
            //Message d'erreur si vide
            $tProvince["message"] = $tMessagesJson["province"]['vide'];
        }
        //Validation pays
        $tPays = ["valeur" => $pays, "valide" => false, "message" => ""];
        if ($pays != "") {
            $tPays["valide"] = true;
        } else {
            //Message d'erreur si vide
            $tPays["message"] = $tMessagesJson["province"]['vide'];
        }
        //Validation code postal
        $tCodePostal = ["valeur" => $code_postal, "valide" => false, "message" => ""];
        if ($code_postal != "") {
            $regExpCodePostal = "#^[A-Za-z][0-9][A-Za-z] [0-9][A-Za-z][0-9]$#";
            if (!preg_match($regExpCodePostal, $code_postal)) {
                $tCodePostal["valide"] = false;
                $tCodePostal["message"] = $tMessagesJson["code_postal"]['pattern'];
            } else if (preg_match($regExpCodePostal, $code_postal)) {
                $tCodePostal["valide"] = true;
            }
        } else {
            //Message d'erreur si vide
            $tCodePostal["message"] = $tMessagesJson["code_postal"]['vide'];
        }

        $tValidationFacturation = ['type_paiement'=>$tTypePaiement ,"nom_carte"=>$tNomCarte, "num_carte"=>$tNumeroCarte, "code_securite"=>$tCodeSecurite, "mois_expiration"=>$tMois, "annee_expiration"=>$tAnnee, "adresse_facturation"=>$tAdresse, "ville_facturation"=>$tVille, "province_facturation"=>$tProvince, "pays_facturation"=>$tPays, "code_postal_facturation"=>$tCodePostal];

        if (!isset($_SESSION["tValidationFacturation"])) {
            // On va set le cookie
            $_SESSION["tValidationFacturation"] = $tValidationFacturation;
        } else {
            $_SESSION['tValidationFacturation']=null;
            $_SESSION["tValidationFacturation"] = $tValidationFacturation;
        }

        $champValide = 0;
        foreach ($tValidationFacturation as $champ) {
            if ($champ['valide'] == true) {
                $champValide = $champValide + 1;
            }
        }

        if ($champValide == count($tValidationFacturation)) {
            $touteEntreeValide = true;
        } else {
            $touteEntreeValide = false;
        }


        if ($touteEntreeValide == true) {
            header('Location: index.php?controleur=panier&action=passerCommande'); // redirection
            exit();
        } else {
            header('Location: index.php?controleur=panier&action=facturation'); // redirection
            exit();
        }
    }

    public function insererFacturationInvite(): void
    {
        $typePaiement = $_POST['typePaiement'];
        $nom = $_POST['nom_carte'];
        $numeroCarte = $_POST['num_carte'];
        $codeSecurtie = $_POST['codeSecurtie'];
        $mois = $_POST['mois_expiration'];
        $annee = $_POST['annee_expiration'];
        $adresse = $_POST['adresse_facturation'];
        $ville = $_POST['ville_facturation'];
        $province = $_POST['province_facturation'];
        $pays = $_POST['pays_facturation'];
        $code_postal = $_POST['codePostal_facturation'];


        $tAnnee = ["valeur" => $annee, "valide" => "faux", "message" => ""];
        if ($annee != "") {
            $tAnnee["valide"] = "vrais";
        } else {
//            Message d'erreur si vide
            $tAnnee["message"] = "Choisissez une année";
        }

        $tMois = ["valeur" => $mois, "valide" => "faux", "message" => ""];
        if ($mois != "") {
            $tMois["valide"] = "vrais";
        } else {
//            Message d'erreur si vide
            $tMois["message"] = "Choisissez un mois";
        }

        $tTypePaiement = ["valeur" => $typePaiement, "valide" => "faux", "message" => ""];
        if ($typePaiement != "") {
            $tTypePaiement["valide"] = "vrais";
        } else {
//            Message d'erreur si vide
            $tTypePaiement["message"] = "Choisissez une option de paiement";
        }

        //Validation nom
        $tNom = ["valeur" => $nom, "valide" => "faux", "message" => ""];
        if ($nom != "") {
            $regExpNom = "#^[a-zA-ZÀ-ÿ '-]+$#";
            if (!preg_match($regExpNom, $nom)) {
                $tNom["valide"] = "faux";
//                $tPrenom["message"] = $tMessagesJson["prenom"]['pattern'];
                $tNom["message"] = "Entrez un nom valide";
            } else if (preg_match($regExpNom, $nom)) {
                $tNom["valide"] = "vrais";
            }
        } else {
//            Message d'erreur si vide
            $tNom["message"] = "Entrez votre nom";
        }

        //Validation numero carte
        $tNumeroCarte = ["valeur" => $numeroCarte, "valide" => "faux", "message" => ""];
        if ($numeroCarte != "") {
            $regExpNum = "#^[0-9]{16}$#";
            if (!preg_match($regExpNum, $numeroCarte)) {
                $tNumeroCarte["valide"] = "faux";
//                $tPrenom["message"] = $tMessagesJson["prenom"]['pattern'];
                $tNumeroCarte["message"] = "Entrez un numéro valide";
            } else if (preg_match($regExpNum, $numeroCarte)) {
                $tNumeroCarte["valide"] = "vrais";
            }
        } else {
//            Message d'erreur si vide
            $tNumeroCarte["message"] = "Un numéro de carte de crédit";
        }

        //Validation code securité
        $tCodeSecurite = ["valeur" => $codeSecurtie, "valide" => "faux", "message" => ""];
        if ($codeSecurtie != "") {
            $regExpNom = "#^[0-9]{3}$#";
            if (!preg_match($regExpNom, $codeSecurtie)) {
                $tCodeSecurite["valide"] = "faux";
                $tCodeSecurite["message"] = "Entrez un numéro valide";
            } else if (preg_match($regExpNom, $codeSecurtie)) {
                $tCodeSecurite["valide"] = "vrais";
            }
        } else {
//            Message d'erreur si vide
            $tCodeSecurite["valide"] = "faux";
            $tCodeSecurite["message"] = "Le numéro de sécurite se trouvant à l'arrière de la carte";
        }


        //validation adresse
        $tAdresse = ["valeur" => $adresse, "valide" => "faux", "message" => ""];
        if ($adresse != "") {
            $regExpAdresse = "#^[0-9]+[a-zA-ZÀ-ÿ0-9 \-\'\,]+$#";
            if (!preg_match($regExpAdresse, $adresse)) {
                $tAdresse["valide"] = "faux";
                $tAdresse["message"] = "Entrez une adresse valide";
            } else if (preg_match($regExpAdresse, $adresse)) {
                $tAdresse["valide"] = "vrais";
            }
        } else {
//            Message d'erreur si vide
            $tAdresse["message"] = "Entrez une adresse";
        }

        //validation ville
        $tVille = ["valeur" => $ville, "valide" => "faux", "message" => ""];
        if ($ville != "") {
            $regExpVille = "#^[A-ÿ]+(?:[\s-][A-zÀ-ÿ'-]+)*$#";
            if (!preg_match($regExpVille, $ville)) {
                $tVille["valide"] = "faux";
                $tVille["message"] = "Entrez une ville valide";
            } else if (preg_match($regExpVille, $ville)) {
                $tVille["valide"] = "vrais";
            }
        } else {
//            Message d'erreur si vide
            $tVille["message"] = "Entrez une ville";
        }

        //validation province
        $tProvince = ["valeur" => $province, "valide" => "faux", "message" => ""];
        if ($province != "") {
            $tProvince["valide"] = "vrais";
        } else {
//            Message d'erreur si vide
            $tProvince["message"] = "Choisissez une province";
        }

        //validation pays
        $tPays = ["valeur" => $pays, "valide" => "faux", "message" => ""];
        if ($pays != "") {
            $tPays["valide"] = "vrais";
        } else {
//            Message d'erreur si vide
            $tPays["message"] = "Choisissez un pays";
        }

        //validation code postal
        $tCodePostal = ["valeur" => $code_postal, "valide" => "faux", "message" => ""];
        if ($code_postal != "") {
            $regExpCodePostal = "#^[A-Za-z][0-9][A-Za-z] [0-9][A-Za-z][0-9]$#";
            if (!preg_match($regExpCodePostal, $code_postal)) {
                $tCodePostal["valide"] = "faux";
                $tCodePostal["message"] = "Entrez un code postal valide";
            } else if (preg_match($regExpCodePostal, $code_postal)) {
                $tCodePostal["valide"] = "vrais";
            }
        } else {
//            Message d'erreur si vide
            $tCodePostal["message"] = "Entrez un code postal";
        }


        $tValidationFacturationInvite = ['type_paiement'=>$tTypePaiement ,"nom"=>$tNom, "numero_carte"=>$tNumeroCarte, "numero_securite"=>$tCodeSecurite, "mois"=>$tMois, "annee"=>$tAnnee, "adresse_facturation"=>$tAdresse, "ville_facturation"=>$tVille, "province_facturation"=>$tProvince, "pays_facturation"=>$tPays, "code_postal_facturation"=>$tCodePostal];

        if (!isset($_SESSION["tValidationFacturationInvite"])) {
            // On va set le cookie
            $_SESSION["tValidationFacturationInvite"] = $tValidationFacturationInvite;
        } else {
            $_SESSION['tValidationFacturationInvite']=null;
            $_SESSION["tValidationFacturationInvite"] = $tValidationFacturationInvite;
        }

        $champValide = 0;
        foreach ($tValidationFacturationInvite as $champ) {
            if ($champ['valide'] == 'vrais') {
                $champValide = $champValide + 1;
            }
        }

        if ($champValide == count($tValidationFacturationInvite)) {
            $touteEntreeValide = true;
        } else {
            $touteEntreeValide = false;
        }


        if ($touteEntreeValide == true) {
            header('Location: index.php?controleur=panier&action=passerCommandeInvite'); // redirection
            exit();
        } else {
            header('Location: index.php?controleur=panier&action=facturationInvite'); // redirection
            exit();
        }
    }
}

