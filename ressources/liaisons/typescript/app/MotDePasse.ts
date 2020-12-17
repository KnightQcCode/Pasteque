export class MotDePasse {
    constructor() {
            $(document).ready(function() {
                let checkbox = $("#checkbox");
                let password = $("#mot_de_passe");
                checkbox.click(function() {
                    if(checkbox.prop("checked")) {
                        password.attr("type", "text");
                        document.getElementById("MotDePasse").innerHTML = "Cacher le mot de passe";
                        let motDePasse =  document.getElementById("icoMdp");
                        motDePasse.classList.remove("icone__afficher","fas","fa-eye","fa-2x");
                        motDePasse.classList.add("icone__cacher","fas","fa-eye-slash","fa-2x");
                    } else {
                        password.attr("type", "password");
                        document.getElementById("MotDePasse").innerHTML = "Afficher le mot de passe";
                        let motDePasse =  document.getElementById("icoMdp");
                        motDePasse.classList.remove("icone__cacher","fas","fa-eye-slash","fa-2x");
                        motDePasse.classList.add("icone__afficher","fas","fa-eye","fa-2x");
                    }
                });
            });
        }
}