define(["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.AfficherPlusParaitre = void 0;
    var AfficherPlusParaitre = /** @class */ (function () {
        function AfficherPlusParaitre() {
            var div = document.getElementById('aParaitrePlus');
            // $("#aParaitrePlus").hide();
            $(document).ready(function () {
                $("#more2").click(function () {
                    $("#aParaitrePlus").slideToggle("slow");
                    div.classList.remove('visuallyhidden');
                });
            });
        }
        return AfficherPlusParaitre;
    }());
    exports.AfficherPlusParaitre = AfficherPlusParaitre;
});
//# sourceMappingURL=AfficherPlusParaitre.js.map