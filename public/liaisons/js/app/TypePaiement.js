define(["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.TypePaiement = void 0;
    var TypePaiement = /** @class */ (function () {
        function TypePaiement() {
            $('input[type=radio]').change(function () {
                if ($(this).val() == "credit") {
                    $('#creditInfo').removeClass('invisible__Facturation');
                }
                else if ($(this).val() == "paypal") {
                    $('#creditInfo').addClass('invisible__Facturation');
                }
            });
        }
        return TypePaiement;
    }());
    exports.TypePaiement = TypePaiement;
});
//# sourceMappingURL=TypePaiement.js.map