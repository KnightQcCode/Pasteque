<?php
declare(strict_types=1);

namespace App\utilitaires;

class Cookie
{

    public function __construct()
    {
        //vide
    }


    public static function set(string $unNom, string $uneValeur, int $dateExpirationEnSeconde)
    {
        setcookie($unNom,$uneValeur,$dateExpirationEnSeconde);
        //Ajouter le cookie au tableau $_COOKIE côté serveur ainsi la valeur est immédiatement disponible pour relecture
        $_COOKIE[$unNom] = $uneValeur;
    }

    public static function get(string $unNom) : ?string
    {
       $valeur = null;
       if(isset($_COOKIE[$unNom]))
       {
           $valeur = $_COOKIE[$unNom];
       }
       return $valeur;
    }

    public static function supprimer(string $unNom)
    {
        setcookie($unNom, "", 1); //Demander au navigateur de supprimer le cookie côté client. 1 seconde ==> date déja expiré
        unset($_COOKIE[$unNom]); // Supprimer immédiatement le cookie dans le tableau côté serveur
    }

}