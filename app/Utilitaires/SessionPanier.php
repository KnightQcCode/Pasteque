<?php
declare(strict_types=1);

namespace App\utilitaires;

use App\App;
use App\Modeles\Livre;

class SessionPanier
{
    private $items = [];

    public function __construct()
    {
    }


    // Ajoute un item au panier avec la qantité X
    // Attention: Si l'item existe déjà dans le panier alors mettre à jour la quantité (la quantité maximum est de 10 à valider...)
    public function ajouterItem(Livre $unLivre, int $uneQte): void
    {
        if (isset($this->items[$unLivre->isbn])){
            $this->setQuantiteItem($unLivre->isbn, $uneQte);
        } else {
            $this->items[$unLivre->isbn] = new SessionItem($unLivre, $uneQte);
        }
        $this->sauvegarder();
    }

    // Supprimer un item du panier
    public function supprimerItem(string $isbn): void
    {
        unset($this->items[$isbn]);
        $this->sauvegarder();
    }

    // Retourner le tableau d'items du panier
    public function getItems(): array
    {
        return $this->items;

    }

    // Mettre à jour la quantité d'un item
    public function setQuantiteItem(string $isbn, int $uneQte): void
    {
        $this->items[$isbn]->__set("quantite", $uneQte);

    }

    // Retourner la quantité d'un item
    public function getQuantiteItem(string $isbn): int
    {
        $quantite = count($this->items[$isbn]);;
        return $quantite;
    }


    // Retourner le nombre d'item différents (unique) dans le panier
    public function getNombreTotalItemsDifferents(): int
    {
        $quantite = 0;
        foreach ($this->items as $item){
            $quantite = $quantite + 1;
        }
        return $quantite;
    }

    // Retourner le nombre de livres total dans le panier (somme de la quantité de chaque item)
    private function getNombreTotalItems(): int
    {
        return count($this->items);
    }


    // Retourner le montant sousTotal du panier (somme des montantTotals de chaque item)
    public function getMontantSousTotal():? float
    {

        $soustotal = null;
        foreach ($this->items as $item){
            $soustotal = $soustotal + $item->livre->prix * $item->quantite;
        }
        return $soustotal;
    }


    // Retourner de montant de la TPS
    // TPS = 5%
    public function getMontantTPS(): float
    {
        $TPS = $this->getMontantSousTotal() * 5 / 100;
        return $TPS;
    }


    // Retourner le montant des frais de livraison
    // Frais de livraison (base=4$ + taux par item=3,50$) Exemple, 1livre=7,50$, 2livres=11$ etc.
    // Il n’y a pas de taxes sur les frais de livraison. Ils s’ajoutent en dernier.
    public function getMontantFraisLivraison(): float
    {

        $totalLivre = $this->getNombreTotalItems();
        $base = 4;
        $parItem = 3.50;
        $fraisLivraison = $base + $totalLivre * $parItem;
        return $fraisLivraison;
    }

    // Retourner le montant total de la commande (montant sous-total + TPS + montant livraison)
    public function getMontantTotal(): float
    {

        return $total = $this->getMontantSousTotal() + $this->getMontantTPS() + $this->getMontantFraisLivraison();
    }


    // Sauvegarder le panier en variable session nommée: panier
    public function sauvegarder(): void
    {

        $session = App::getInstance()->getSession();
        $session->setItem("panier", $this);
    }

    // Supprimer le panier en variable session nommée: panier
    public function supprimer()
    {

        $session = App::getInstance()->getSession();
        $session->supprimerItem('panier');
    }
}
