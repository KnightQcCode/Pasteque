export class ModeLivraison {
    public constructor(){
        $('#modeLivraison').change(function() {
            if($(this).val() == "standart"){
                $('#prix_livraison').removeClass('invisible__prixLivraison');
                $('#dateNormal').removeClass('invisible__prixLivraison');
                $('#prix_normal').removeClass('invisible__prixLivraison');
                $('#total_normal').removeClass('invisible__prixLivraison');
                $('#tps_normal').removeClass('invisible__prixLivraison');
                $('#prix_livraisonExpress').addClass('invisible__prixLivraison');
                $('#dateExpress').addClass('invisible__prixLivraison');
                $('#prix_express').addClass('invisible__prixLivraison');
                $('#total_express').addClass('invisible__prixLivraison');
                $('#tps_express').addClass('invisible__prixLivraison');

            }
            else if($(this).val() == "express"){
                $('#prix_livraison').addClass('invisible__prixLivraison');
                $('#dateNormal').addClass('invisible__prixLivraison');
                $('#prix_normal').addClass('invisible__prixLivraison');
                $('#total_normal').addClass('invisible__prixLivraison');
                $('#tps_normal').addClass('invisible__prixLivraison');
                $('#prix_livraisonExpress').removeClass('invisible__prixLivraison');
                $('#dateExpress').removeClass('invisible__prixLivraison');
                $('#prix_express').removeClass('invisible__prixLivraison');
                $('#total_express').removeClass('invisible__prixLivraison');
                $('#tps_express').removeClass('invisible__prixLivraison');
            }
        });
    }
}