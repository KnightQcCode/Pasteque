define(["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.ValidationFacturation = void 0;
    var ValidationFacturation = /** @class */ (function () {
        // -- Éléments de formulaire à valider
        // Constructeur
        function ValidationFacturation() {
            // ATTRIBUTS
            this.refTypePaiement = document.querySelector('#typePaiement');
            this.refNom = document.querySelector('#nom_carte');
            this.refNumeroCarte = document.querySelector('#num_carte');
            this.refCodeSecurite = document.querySelector('#codeSecurite');
            this.refMois = document.querySelector('#mois');
            this.refAnnee = document.querySelector('#annee');
            this.refAdresse = document.querySelector('#adresse_facturation');
            this.refVille = document.querySelector('#ville_facturation');
            this.refProvince = document.querySelector('#province_facturation');
            this.refPays = document.querySelector('#pays_facturation');
            this.refCodePostal = document.querySelector('#codePostal_facturation');
            this.initialiser();
        }
        // Méthodes de validation
        ValidationFacturation.prototype.initialiser = function () {
            //créer les écouteurs d'événement
            document.querySelector('form').noValidate = true;
            this.refTypePaiement.addEventListener('blur', this.validerTypePaiement.bind(this));
            this.refNom.addEventListener('blur', this.validerNom.bind(this));
            this.refNumeroCarte.addEventListener('blur', this.validerNumeroCarte.bind(this));
            this.refCodeSecurite.addEventListener('blur', this.validerCodeSecurite.bind(this));
            this.refMois.addEventListener('blur', this.validerMois.bind(this));
            this.refAnnee.addEventListener('blur', this.validerAnnee.bind(this));
            this.refAdresse.addEventListener('blur', this.validerAdresse.bind(this));
            this.refVille.addEventListener('blur', this.validerVille.bind(this));
            this.refProvince.addEventListener('blur', this.validerProvince.bind(this));
            this.refPays.addEventListener('blur', this.validerPays.bind(this));
            this.refCodePostal.addEventListener('blur', this.validerCodePostal.bind(this));
        };
        ValidationFacturation.prototype.validerPattern = function (element, motif) {
            if (motif === void 0) { motif = element.pattern; }
            var regexp = new RegExp(motif);
            return regexp.test(element.value);
        };
        ValidationFacturation.prototype.validerTypePaiement = function (evenement) {
            var elementTypePaiement = evenement.currentTarget;
            if (elementTypePaiement.value == "") {
                elementTypePaiement
                    .closest('.facturation__form')
                    .querySelector('.erreurTypePaiementFacturation')
                    .innerHTML = "Vous devez choisir un type de paiement.";
            }
            else {
                elementTypePaiement
                    .closest('.facturation__form')
                    .querySelector('.erreurTypePaiementFacturation')
                    .innerHTML = "";
            }
            return elementTypePaiement.value;
        };
        ValidationFacturation.prototype.validerNom = function (evenement) {
            var elementNom = evenement.currentTarget;
            if (elementNom.value == "") {
                elementNom
                    .closest('.facturation__form')
                    .querySelector('.erreurNomFacturation')
                    .innerHTML = "Vous devez entrer votre nom sur la carte de crédit.";
            }
            else {
                var patern = '^[a-zA-ZÀ-ÿ \'-]+$';
                if (this.validerPattern(elementNom, patern) == false) {
                    elementNom
                        .closest('.facturation__form')
                        .querySelector('.erreurNomFacturation')
                        .innerHTML = "Vous devez entrer un nom de propriétaire de la carte de crédit valide.";
                }
                else {
                    elementNom
                        .closest('.facturation__form')
                        .querySelector('.erreurNomFacturation')
                        .innerHTML = "";
                }
            }
            return elementNom.value;
        };
        ValidationFacturation.prototype.validerNumeroCarte = function (evenement) {
            var elementNumeroCarte = evenement.currentTarget;
            if (elementNumeroCarte.value == "") {
                elementNumeroCarte
                    .closest('.facturation__form')
                    .querySelector('.erreurNumCarteFacturation')
                    .innerHTML = "Vous devez entrer votre numéro de carte de crédit.";
            }
            else {
                var patern = '^[0-9]{16}$';
                if (this.validerPattern(elementNumeroCarte, patern) == false) {
                    elementNumeroCarte
                        .closest('.facturation__form')
                        .querySelector('.erreurNumCarteFacturation')
                        .innerHTML = "Vous devez entrer un numéro de carte de crédit valide.";
                }
                else {
                    elementNumeroCarte
                        .closest('.facturation__form')
                        .querySelector('.erreurNumCarteFacturation')
                        .innerHTML = "";
                }
            }
            return elementNumeroCarte.value;
        };
        ValidationFacturation.prototype.validerCodeSecurite = function (evenement) {
            var elementNumeroSecurite = evenement.currentTarget;
            if (elementNumeroSecurite.value == "") {
                elementNumeroSecurite
                    .closest('.facturation__form')
                    .querySelector('.erreurNumSecuriteFacturation')
                    .innerHTML = "Vous devez entrer votre code de sécurité.";
            }
            else {
                var patern = '^[0-9]{3}$';
                if (this.validerPattern(elementNumeroSecurite, patern) == false) {
                    elementNumeroSecurite
                        .closest('.facturation__form')
                        .querySelector('.erreurNumSecuriteFacturation')
                        .innerHTML = "Vous devez entrer un code de sécurité valide.";
                }
                else {
                    elementNumeroSecurite
                        .closest('.facturation__form')
                        .querySelector('.erreurNumSecuriteFacturation')
                        .innerHTML = "";
                }
            }
            return elementNumeroSecurite.value;
        };
        ValidationFacturation.prototype.validerMois = function (evenement) {
            var elementMois = evenement.currentTarget;
            if (elementMois.value == "") {
                elementMois
                    .closest('.facturation__form')
                    .querySelector('.erreurMoisFacturation')
                    .innerHTML = "Vous devez entrer un mois.";
            }
            else {
                var patern = '^[0-9]{1,2}$';
                if (this.validerPattern(elementMois, patern) == false) {
                    elementMois
                        .closest('.facturation__form')
                        .querySelector('.erreurMoisFacturation')
                        .innerHTML = "Vous devez entrer un mois valide.";
                }
                else {
                    elementMois
                        .closest('.facturation__form')
                        .querySelector('.erreurMoisFacturation')
                        .innerHTML = "";
                }
            }
            return elementMois.value;
        };
        ValidationFacturation.prototype.validerAnnee = function (evenement) {
            var elementAnnee = evenement.currentTarget;
            if (elementAnnee.value == "") {
                elementAnnee
                    .closest('.facturation__form')
                    .querySelector('.erreurAnneeFacturation')
                    .innerHTML = "Vous devez entrer une année.";
            }
            else {
                var patern = '^[0-9]{1,2}$';
                if (this.validerPattern(elementAnnee, patern) == false) {
                    elementAnnee
                        .closest('.facturation__form')
                        .querySelector('.erreurAnneeFacturation')
                        .innerHTML = "Vous devez entrer une année valide.";
                }
                else {
                    elementAnnee
                        .closest('.facturation__form')
                        .querySelector('.erreurAnneeFacturation')
                        .innerHTML = "";
                }
            }
            return elementAnnee.value;
        };
        ValidationFacturation.prototype.validerAdresse = function (evenement) {
            var elementAdresse = evenement.currentTarget;
            if (elementAdresse.value == "") {
                elementAdresse
                    .closest('.facturation__form')
                    .querySelector('.erreurAdresseLivraison')
                    .innerHTML = "Vous devez entrer votre adresse.";
            }
            else {
                var patern = '^[0-9]+[a-zA-ZÀ-ÿ0-9 \-\'\,]+$';
                if (this.validerPattern(elementAdresse, patern) == false) {
                    elementAdresse
                        .closest('.facturation__form')
                        .querySelector('.erreurAdresseLivraison')
                        .innerHTML = "Vous devez entrer une adresse valide.";
                }
                else {
                    elementAdresse
                        .closest('.facturation__form')
                        .querySelector('.erreurAdresseFacturation')
                        .innerHTML = "";
                }
            }
            return elementAdresse.value;
        };
        ValidationFacturation.prototype.validerVille = function (evenement) {
            var elementVille = evenement.currentTarget;
            if (elementVille.value == "") {
                elementVille
                    .closest('.facturation__form')
                    .querySelector('.erreurVilleFacturation')
                    .innerHTML = "Vous devez entrer le nom de votre ville ou de votre village.";
            }
            else {
                var patern = '^[A-ÿ]+(?:[\\s-][A-zÀ-ÿ\'-]+)*$';
                if (this.validerPattern(elementVille, patern) == false) {
                    elementVille
                        .closest('.facturation__form')
                        .querySelector('.erreurVilleFacturation')
                        .innerHTML = "Vous devez entrer une ville ou un village valide.";
                }
                else {
                    elementVille
                        .closest('.facturation__form')
                        .querySelector('.erreurVilleFacturation')
                        .innerHTML = "";
                }
            }
            return elementVille.value;
        };
        ValidationFacturation.prototype.validerProvince = function (evenement) {
            var elementProvince = evenement.currentTarget;
            if (elementProvince.value == "") {
                elementProvince
                    .closest('.facturation__form')
                    .querySelector('.erreurProvinceLivraison')
                    .innerHTML = "Vous devez choisir votre province.";
            }
            else {
                elementProvince
                    .closest('.facturation__form')
                    .querySelector('.erreurProvinceFacturation')
                    .innerHTML = "";
            }
            return elementProvince.value;
        };
        ValidationFacturation.prototype.validerPays = function (evenement) {
            var elementPays = evenement.currentTarget;
            if (elementPays.value == "") {
                elementPays
                    .closest('.facturation__form')
                    .querySelector('.erreurPaysFacturation')
                    .innerHTML = "Vous devez choisir votre pays.";
            }
            else {
                elementPays
                    .closest('.facturation__form')
                    .querySelector('.erreurPaysFacturation')
                    .innerHTML = "";
            }
            return elementPays.value;
        };
        ValidationFacturation.prototype.validerCodePostal = function (evenement) {
            var elementCodePostal = evenement.currentTarget;
            if (elementCodePostal.value == "") {
                elementCodePostal
                    .closest('.facturation__form')
                    .querySelector('.erreurCodePostalFacturation')
                    .innerHTML = "Vous devez entrer votre code postal.";
            }
            else {
                var patern = '^[A-Za-z][0-9][A-Za-z] [0-9][A-Za-z][0-9]$';
                if (this.validerPattern(elementCodePostal, patern) == false) {
                    elementCodePostal
                        .closest('.facturation__form')
                        .querySelector('.erreurCodePostalFacturation')
                        .innerHTML = "Le code postal doit respecter le format X1X 1X1.";
                }
                else {
                    elementCodePostal
                        .closest('.facturation__form')
                        .querySelector('.erreurCodePostalFacturation')
                        .innerHTML = "";
                }
            }
            return elementCodePostal.value;
        };
        return ValidationFacturation;
    }());
    exports.ValidationFacturation = ValidationFacturation;
});
//# sourceMappingURL=ValidationFacturation.js.map