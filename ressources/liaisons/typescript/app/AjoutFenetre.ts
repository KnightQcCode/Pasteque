// author Jonahtan Collard - jonath2897@gmail.com

export class AjoutFenetre {

    constructor() {
        this.initialiser();
    }

    private initialiser(): void {
        //créer les écouteurs d'événement
        const div = document.getElementById('fenetre');
        $(document).ready(function () {

            $("#fenetre").hide();
            div.classList.remove('visuallyhidden');

            $(".boutons").click(function () {
                $("#fenetre").slideToggle()
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });

        $("#btnClose").click(function () {
            $("#fenetre").slideToggle();
            div.classList.add('visuallyhidden');
        });
    }

}