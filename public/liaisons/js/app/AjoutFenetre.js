// author Jonahtan Collard - jonath2897@gmail.com
define(["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.AjoutFenetre = void 0;
    var AjoutFenetre = /** @class */ (function () {
        function AjoutFenetre() {
            this.initialiser();
        }
        AjoutFenetre.prototype.initialiser = function () {
            //créer les écouteurs d'événement
            var div = document.getElementById('fenetre');
            $(document).ready(function () {
                $("#fenetre").hide();
                div.classList.remove('visuallyhidden');
                $(".boutons").click(function () {
                    $("#fenetre").slideToggle();
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            });
            $("#btnClose").click(function () {
                $("#fenetre").slideToggle();
                div.classList.add('visuallyhidden');
            });
        };
        return AjoutFenetre;
    }());
    exports.AjoutFenetre = AjoutFenetre;
});
//# sourceMappingURL=AjoutFenetre.js.map