export class ItemPanier {
    private btn_ajt_panier:HTMLButtonElement = document.querySelector('.boutonsPanier');

    public constructor(){
        this.btn_ajt_panier.addEventListener("click", this.executerAjax.bind(this));
    }

    private retournerResultat(data:string, textStatus:string, jqXHR:any, idLivreEncours:string):void {
        let conteneurNbLivresPanier:HTMLElement = document.querySelector("#panierEntete");
        $(conteneurNbLivresPanier).text(data);
    }

    private executerAjax():void{
        let unIdLivre:string = this.btn_ajt_panier.id;
        let unQuantite = $('#quantite option:selected').text();
        let thisRef:any = this;
        $.ajax({
            url: 'index.php?controleur=panier&action=ajouterlivrepanier',
            type: 'POST',
            data: 'quantite='+unQuantite+'&idLivre='+unIdLivre,
            dataType: 'html'
        })
            .done(function (data, textStatus, jqXHR) {
                thisRef.retournerResultat(data, textStatus, jqXHR, unQuantite,unIdLivre);
            });
    }
}