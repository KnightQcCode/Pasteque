define(["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.AfficherPlus = void 0;
    var AfficherPlus = /** @class */ (function () {
        function AfficherPlus() {
            var div = document.getElementById('nouveautesPlus');
            $(document).ready(function () {
                $("#more").click(function () {
                    // $("#nouveautesPlus").hide();
                    $("#nouveautesPlus").slideToggle("slow");
                    div.classList.remove('visuallyhidden');
                });
            });
            $(document).ready(function () {
                $("#btnCategorie").click(function () {
                    $("#categorie").slideToggle("slow");
                });
            });
            $(document).ready(function () {
                $("#btnTri").click(function () {
                    $("#tri").slideToggle("slow");
                });
            });
        }
        return AfficherPlus;
    }());
    exports.AfficherPlus = AfficherPlus;
});
//# sourceMappingURL=AfficherPlus.js.map