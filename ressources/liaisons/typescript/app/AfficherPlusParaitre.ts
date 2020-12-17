export class AfficherPlusParaitre {
    constructor(){
        const div = document.getElementById('aParaitrePlus');
        // $("#aParaitrePlus").hide();
        $(document).ready(function(){
            $("#more2").click(function () {

                $("#aParaitrePlus").slideToggle("slow");
                div.classList.remove('visuallyhidden');
            });
        });
    }
}
