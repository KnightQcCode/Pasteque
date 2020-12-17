define(["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.MenuMobile = void 0;
    var MenuMobile = /** @class */ (function () {
        function MenuMobile() {
            this.initialiser();
        }
        MenuMobile.prototype.initialiser = function () {
            $(document).ready(function () {
                $("#menu").click(function () {
                    $("#nav").slideToggle("slow");
                });
            });
            var clickx = document.getElementById('pencet');
            clickx.addEventListener('click', function () {
                clickx.classList.toggle('Diam');
            });
            var menu = document.getElementById('nav');
            menu.addEventListener('click', function () {
                menu.classList.toggle('menu__fermer');
            });
        };
        return MenuMobile;
    }());
    exports.MenuMobile = MenuMobile;
});
//# sourceMappingURL=MenuMobile.js.map