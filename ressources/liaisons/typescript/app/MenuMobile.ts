export class MenuMobile {
    constructor() {
        this.initialiser();
    }

    private initialiser(): void {
        $(document).ready(function(){
            $("#menu").click(function () {
                $("#nav").slideToggle("slow");
            });
        });
        const clickx= document.getElementById('pencet');

        clickx.addEventListener('click', function(){
            clickx.classList.toggle('Diam');
        });

        const menu= document.getElementById('nav');

        menu.addEventListener('click', function(){
            menu.classList.toggle('menu__fermer');
        });
    }
}