export class AfficherPlus {
    constructor() {


        const div = document.getElementById('nouveautesPlus');
            $(document).ready(function(){
                $("#more").click(function () {
                    // $("#nouveautesPlus").hide();
                    $("#nouveautesPlus").slideToggle("slow");
                    div.classList.remove('visuallyhidden');
                });
            });


        $(document).ready(function(){
            $("#btnCategorie").click(function () {
                $("#categorie").slideToggle("slow");
            });
        });

        $(document).ready(function(){
            $("#btnTri").click(function () {
                $("#tri").slideToggle("slow");
            });
        });
    }

}