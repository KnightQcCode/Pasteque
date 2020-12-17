define(["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.MotDePasse = void 0;
    var MotDePasse = /** @class */ (function () {
        function MotDePasse() {
            $(document).ready(function () {
                var checkbox = $("#checkbox");
                var password = $("#mot_de_passe");
                checkbox.click(function () {
                    if (checkbox.prop("checked")) {
                        password.attr("type", "text");
                        document.getElementById("MotDePasse").innerHTML = "Cacher le mot de passe";
                        var motDePasse = document.getElementById("icoMdp");
                        motDePasse.classList.remove("icone__afficher", "fas", "fa-eye", "fa-2x");
                        motDePasse.classList.add("icone__cacher", "fas", "fa-eye-slash", "fa-2x");
                    }
                    else {
                        password.attr("type", "password");
                        document.getElementById("MotDePasse").innerHTML = "Afficher le mot de passe";
                        var motDePasse = document.getElementById("icoMdp");
                        motDePasse.classList.remove("icone__cacher", "fas", "fa-eye-slash", "fa-2x");
                        motDePasse.classList.add("icone__afficher", "fas", "fa-eye", "fa-2x");
                    }
                });
            });
        }
        return MotDePasse;
    }());
    exports.MotDePasse = MotDePasse;
});
//# sourceMappingURL=MotDePasse.js.map