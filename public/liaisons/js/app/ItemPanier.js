define(["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.ItemPanier = void 0;
    var ItemPanier = /** @class */ (function () {
        function ItemPanier() {
            this.btn_ajt_panier = document.querySelector('.boutonsPanier');
            this.btn_ajt_panier.addEventListener("click", this.executerAjax.bind(this));
        }
        ItemPanier.prototype.retournerResultat = function (data, textStatus, jqXHR, idLivreEncours) {
            var conteneurNbLivresPanier = document.querySelector("#panierEntete");
            $(conteneurNbLivresPanier).text(data);
        };
        ItemPanier.prototype.executerAjax = function () {
            var unIdLivre = this.btn_ajt_panier.id;
            var unQuantite = $('#quantite option:selected').text();
            var thisRef = this;
            $.ajax({
                url: 'index.php?controleur=panier&action=ajouterlivrepanier',
                type: 'POST',
                data: 'quantite=' + unQuantite + '&idLivre=' + unIdLivre,
                dataType: 'html'
            })
                .done(function (data, textStatus, jqXHR) {
                thisRef.retournerResultat(data, textStatus, jqXHR, unQuantite, unIdLivre);
            });
        };
        return ItemPanier;
    }());
    exports.ItemPanier = ItemPanier;
});
//# sourceMappingURL=ItemPanier.js.map