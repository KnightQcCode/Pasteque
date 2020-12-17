define(["require", "exports"], function (require, exports) {
    "use strict";
    Object.defineProperty(exports, "__esModule", { value: true });
    exports.ValidationCompte = void 0;
    var ValidationCompte = /** @class */ (function () {
        // -- Éléments de formulaire à valider
        // Constructeur
        function ValidationCompte() {
            // ATTRIBUTS
            this.refPrenom = document.querySelector('#prenom');
            this.refNom = document.querySelector('#nom');
            this.refCourriel = document.querySelector('#courriel');
            this.refMotDePasse = document.querySelector('#mot_de_passe');
            this.initialiser();
        }
        // Méthodes de validation
        ValidationCompte.prototype.initialiser = function () {
            //créer les écouteurs d'événement
            document.querySelector('form').noValidate = true;
            this.refPrenom.addEventListener('blur', this.validerPrenom.bind(this));
            this.refNom.addEventListener('blur', this.validerNom.bind(this));
            this.refCourriel.addEventListener('blur', this.validerCourriel.bind(this));
            this.refMotDePasse.addEventListener('blur', this.validerMotDePasse.bind(this));
        };
        ValidationCompte.prototype.validerPattern = function (element, motif) {
            if (motif === void 0) { motif = element.pattern; }
            var regexp = new RegExp(motif);
            return regexp.test(element.value);
        };
        ValidationCompte.prototype.validerPrenom = function (evenement) {
            var elementPrenom = evenement.currentTarget;
            if (elementPrenom.value == "") {
                elementPrenom
                    .closest('.creerCompte__form')
                    .querySelector('.erreurPrenomCompte')
                    .innerHTML = "Vous devez entrer votre prénom.";
            }
            else {
                var patern = '^[a-zA-ZÀ-ÿ \'-]+$';
                if (this.validerPattern(elementPrenom, patern) == false) {
                    elementPrenom
                        .closest('.creerCompte__form')
                        .querySelector('.erreurPrenomCompte')
                        .innerHTML = "Pour le prénom seulement les accents français, les espaces, les tirets et les apostrophes sont permis.";
                }
                else {
                    elementPrenom
                        .closest('.creerCompte__form')
                        .querySelector('.erreurPrenomCompte')
                        .innerHTML = "";
                }
            }
            return elementPrenom.value;
        };
        ValidationCompte.prototype.validerNom = function (evenement) {
            var elementNom = evenement.currentTarget;
            if (elementNom.value == "") {
                elementNom
                    .closest('.creerCompte__form')
                    .querySelector('.erreurNomCompte')
                    .innerHTML = "Vous devez entrer votre nom de famille.";
            }
            else {
                var patern = '^[a-zA-ZÀ-ÿ \'-]+$';
                if (this.validerPattern(elementNom, patern) == false) {
                    elementNom
                        .closest('.creerCompte__form')
                        .querySelector('.erreurNomCompte')
                        .innerHTML = "Pour le nom de famille seulement les accents français, les espaces, les tirets et les apostrophes sont permis.";
                }
                else {
                    elementNom
                        .closest('.creerCompte__form')
                        .querySelector('.erreurNomCompte')
                        .innerHTML = "";
                }
            }
            return elementNom.value;
        };
        ValidationCompte.prototype.validerCourriel = function (evenement) {
            var elementCourriel = evenement.currentTarget;
            if (elementCourriel.value == "") {
                elementCourriel
                    .closest('.creerCompte__form')
                    .querySelector('.erreurCourrielCompte')
                    .innerHTML = "Vous devez entrer votre adresse courriel.";
            }
            else {
                var patern = '^[a-zA-Z0-9][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,}$';
                if (this.validerPattern(elementCourriel, patern) == false) {
                    elementCourriel
                        .closest('.creerCompte__form')
                        .querySelector('.erreurCourrielCompte')
                        .innerHTML = "Assurez-vous d'entrer une adresse courriel valide.";
                }
                else {
                    elementCourriel
                        .closest('.creerCompte__form')
                        .querySelector('.erreurCourrielCompte')
                        .innerHTML = "";
                }
            }
            return elementCourriel.value;
        };
        ValidationCompte.prototype.validerMotDePasse = function (evenement) {
            var elementMotDePasse = evenement.currentTarget;
            if (elementMotDePasse.value == "") {
                elementMotDePasse
                    .closest('.creerCompte__form')
                    .querySelector('.erreurMDPCompte')
                    .innerHTML = "Vous devez entrer votre mot de passe.";
            }
            else {
                var patern = '^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,10}$';
                if (this.validerPattern(elementMotDePasse, patern) == false) {
                    elementMotDePasse
                        .closest('.creerCompte__form')
                        .querySelector('.erreurMDPCompte')
                        .innerHTML = "Vous devez entrer un mot de passe valide.";
                }
                else {
                    elementMotDePasse
                        .closest('.creerCompte__form')
                        .querySelector('.erreurMDPCompte')
                        .innerHTML = "";
                }
            }
            return elementMotDePasse.value;
        };
        return ValidationCompte;
    }());
    exports.ValidationCompte = ValidationCompte;
});
//# sourceMappingURL=ValidationCompte.js.map