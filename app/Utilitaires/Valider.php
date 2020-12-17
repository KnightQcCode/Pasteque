<?php
declare(strict_types=1);
namespace App\utilitaires;


class Valider
{
    public function __construct()
    {

    }
    public static function valider(): bool
    {

        $contenuBruteFichierJson = file_get_contents("../ressources/lang/fr_CA.UTF-8/messagesErreurValidation.json");
        $tMessagesJson = json_decode($contenuBruteFichierJson, false);

        $tValidation = array();
        $tValidation[0] = array(
            'valeur' => $_POST['prenom'],
            'valide' => true,
            'preg_match' => "#^[a-zA-ZÀ-ÿ '-]+$#",
            'objJson' => "prenom",
            'messageErreur' => "",
        );
        $tValidation[1] = array(
            'valeur' => $_POST['nom'],
            'valide' => true,
            'preg_match' => "#^[a-zA-ZÀ-ÿ '-]+$#",
            'objJson' => "nom",
            'messageErreur' => ""
        );
        $tValidation[2] = array(
            'valeur' => $_POST['courriel'],
            'valide' => true,
            'preg_match' => "#^[a-zA-Z0-9][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,}$#",
            'objJson' => "courriel",
            'messageErreur' => "",
        );
        $tValidation[3] = array(
            'valeur' => $_POST['mot_de_passe'],
            'valide' => true,
            'preg_match' => "#^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8}$#",

            'objJson' => "mot_de_passe",
            'messageErreur' => "",
        );
        for($i = 0; $i < 4; $i++){
            if (isset($tValidation[$i]['valeur'])) {
                if (preg_match($tValidation[$i]['preg_match'], $tValidation[$i]['valeur'])) {
                    $formulaireEstValide = true;
                    $tValidation[$i]['valide'] = true;

                }else{
                    $formulaireEstValide = false;
                    $valeur = $tValidation[$i]['valeur'];
                    $jSontest= $tValidation[$i]['objJson'];
                    $tValidation[$i]['valide'] = false;
                    if ($valeur == "") {
                        $messageErreur2 = $tMessagesJson->$jSontest->vide;

                    } else {
                        $messageErreur2 = $tMessagesJson->$jSontest->pattern;
                    }
                    array_push($tValidation[$i], $messageErreur2);
                }
            }
        }
        $_SESSION['tValidation'] = $tValidation;
        return $formulaireEstValide;
    }
}