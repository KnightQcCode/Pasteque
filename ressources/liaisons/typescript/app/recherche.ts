export class Recherche {
    constructor() {
        $(document).ready(function(){
            $("#jeRecherche").click(function () {
                $("#champRechercher").slideToggle("slow");
            });
        });

        const recherche= document.getElementById('champRechercher');

        recherche.addEventListener('click', function(){
            recherche.classList.toggle('menu__fermer');
        });
    }
}