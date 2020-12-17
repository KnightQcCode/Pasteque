define(["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.TrisLivre = void 0;
    var TrisLivre = /** @class */ (function () {
        function TrisLivre() {
            console.log('dans le constructor de trier');
            $('#tri').change(function () {
                console.log($('#tri').val());
                // alert('Select field value has changed to' + $('#tri').val());
                console.log('index.php?controleur=livre&action=' + $('#tri').val());
                $.ajax({
                    url: 'index.php?controleur=livre&action=' + $('#tri').val(),
                    type: 'POST',
                });
            });
        }
        return TrisLivre;
    }());
    exports.TrisLivre = TrisLivre;
});
//# sourceMappingURL=TrisLivre.js.map