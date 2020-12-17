define(["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.Recherche = void 0;
    var Recherche = /** @class */ (function () {
        function Recherche() {
            $(document).ready(function () {
                $("#jeRecherche").click(function () {
                    $("#champRechercher").slideToggle("slow");
                });
            });
            var recherche = document.getElementById('champRechercher');
            recherche.addEventListener('click', function () {
                recherche.classList.toggle('menu__fermer');
            });
        }
        return Recherche;
    }());
    exports.Recherche = Recherche;
});
//# sourceMappingURL=recherche.js.map