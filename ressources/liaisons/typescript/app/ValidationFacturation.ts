export class ValidationFacturation {

    // ATTRIBUTS
    private refTypePaiement: HTMLInputElement = document.querySelector('#typePaiement');
    private refNom: HTMLInputElement = document.querySelector('#nom_carte');
    private refNumeroCarte: HTMLInputElement = document.querySelector('#num_carte');
    private refCodeSecurite: HTMLInputElement = document.querySelector('#codeSecurite');
    private refMois: HTMLInputElement = document.querySelector('#mois');
    private refAnnee: HTMLInputElement = document.querySelector('#annee');
    private refAdresse: HTMLInputElement = document.querySelector('#adresse_facturation');
    private refVille: HTMLInputElement = document.querySelector('#ville_facturation');
    private refProvince: HTMLInputElement = document.querySelector('#province_facturation');
    private refPays: HTMLInputElement = document.querySelector('#pays_facturation');
    private refCodePostal: HTMLInputElement = document.querySelector('#codePostal_facturation');
    // -- Éléments de formulaire à valider

    // Constructeur
    constructor() {
        this.initialiser();
    }

    // Méthodes de validation
    private initialiser(): void {
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
    }

    public validerPattern(element, motif = element.pattern) {
        const regexp = new RegExp(motif);
        return regexp.test(element.value);
    }


    public validerTypePaiement(evenement) {
        const elementTypePaiement = evenement.currentTarget;
        if (elementTypePaiement.value == "") {
            elementTypePaiement
                .closest('.facturation__form')
                .querySelector('.erreurTypePaiementFacturation')
                .innerHTML = "Vous devez choisir un type de paiement.";
        } else {
            elementTypePaiement
                .closest('.facturation__form')
                .querySelector('.erreurTypePaiementFacturation')
                .innerHTML = "";
        }
        return elementTypePaiement.value;
    }

    public validerNom(evenement) {
        const elementNom = evenement.currentTarget;
        if (elementNom.value == "") {
            elementNom
                .closest('.facturation__form')
                .querySelector('.erreurNomFacturation')
                .innerHTML = "Vous devez entrer votre nom sur la carte de crédit.";
        } else {
            let patern = '^[a-zA-ZÀ-ÿ \'-]+$';
            if (this.validerPattern(elementNom, patern) == false) {
                elementNom
                    .closest('.facturation__form')
                    .querySelector('.erreurNomFacturation')
                    .innerHTML = "Vous devez entrer un nom de propriétaire de la carte de crédit valide.";
            } else {
                elementNom
                    .closest('.facturation__form')
                    .querySelector('.erreurNomFacturation')
                    .innerHTML = "";
            }
        }
        return elementNom.value;
    }

    public validerNumeroCarte(evenement) {
        const elementNumeroCarte = evenement.currentTarget;
        if (elementNumeroCarte.value == "") {
            elementNumeroCarte
                .closest('.facturation__form')
                .querySelector('.erreurNumCarteFacturation')
                .innerHTML = "Vous devez entrer votre numéro de carte de crédit.";
        } else {
            let patern = '^[0-9]{16}$';
            if (this.validerPattern(elementNumeroCarte, patern) == false) {
                elementNumeroCarte
                    .closest('.facturation__form')
                    .querySelector('.erreurNumCarteFacturation')
                    .innerHTML = "Vous devez entrer un numéro de carte de crédit valide.";
            } else {
                elementNumeroCarte
                    .closest('.facturation__form')
                    .querySelector('.erreurNumCarteFacturation')
                    .innerHTML = "";
            }
        }
        return elementNumeroCarte.value;
    }

    public validerCodeSecurite(evenement) {
        const elementNumeroSecurite = evenement.currentTarget;
        if (elementNumeroSecurite.value == "") {
            elementNumeroSecurite
                .closest('.facturation__form')
                .querySelector('.erreurNumSecuriteFacturation')
                .innerHTML = "Vous devez entrer votre code de sécurité.";
        } else {
            let patern = '^[0-9]{3}$';
            if (this.validerPattern(elementNumeroSecurite, patern) == false) {
                elementNumeroSecurite
                    .closest('.facturation__form')
                    .querySelector('.erreurNumSecuriteFacturation')
                    .innerHTML = "Vous devez entrer un code de sécurité valide.";
            } else {
                elementNumeroSecurite
                    .closest('.facturation__form')
                    .querySelector('.erreurNumSecuriteFacturation')
                    .innerHTML = "";
            }
        }
        return elementNumeroSecurite.value;
    }




    public validerMois(evenement) {
        const elementMois = evenement.currentTarget;
        if (elementMois.value == "") {
            elementMois
                .closest('.facturation__form')
                .querySelector('.erreurMoisFacturation')
                .innerHTML = "Vous devez entrer un mois.";
        } else {
            let patern = '^[0-9]{1,2}$';
            if (this.validerPattern(elementMois, patern) == false) {
                elementMois
                    .closest('.facturation__form')
                    .querySelector('.erreurMoisFacturation')
                    .innerHTML = "Vous devez entrer un mois valide.";
            } else {
                elementMois
                    .closest('.facturation__form')
                    .querySelector('.erreurMoisFacturation')
                    .innerHTML = "";
            }
        }
        return elementMois.value;
    }
    public validerAnnee(evenement) {
        const elementAnnee = evenement.currentTarget;
        if (elementAnnee.value == "") {
            elementAnnee
                .closest('.facturation__form')
                .querySelector('.erreurAnneeFacturation')
                .innerHTML = "Vous devez entrer une année.";
        } else {
            let patern = '^[0-9]{1,2}$';
            if (this.validerPattern(elementAnnee, patern) == false) {
                elementAnnee
                    .closest('.facturation__form')
                    .querySelector('.erreurAnneeFacturation')
                    .innerHTML = "Vous devez entrer une année valide.";
            } else {
                elementAnnee
                    .closest('.facturation__form')
                    .querySelector('.erreurAnneeFacturation')
                    .innerHTML = "";
            }
        }
        return elementAnnee.value;
    }
    public validerAdresse(evenement) {
        const elementAdresse = evenement.currentTarget;
        if (elementAdresse.value == "") {
            elementAdresse
                .closest('.facturation__form')
                .querySelector('.erreurAdresseLivraison')
                .innerHTML = "Vous devez entrer votre adresse.";
        } else {
            let patern = '^[0-9]+[a-zA-ZÀ-ÿ0-9 \-\'\,]+$';
            if (this.validerPattern(elementAdresse, patern) == false) {
                elementAdresse
                    .closest('.facturation__form')
                    .querySelector('.erreurAdresseLivraison')
                    .innerHTML = "Vous devez entrer une adresse valide.";
            } else {
                elementAdresse
                    .closest('.facturation__form')
                    .querySelector('.erreurAdresseFacturation')
                    .innerHTML = "";
            }
        }
        return elementAdresse.value;
    }

    public validerVille(evenement) {
        const elementVille = evenement.currentTarget;
        if (elementVille.value == "") {
            elementVille
                .closest('.facturation__form')
                .querySelector('.erreurVilleFacturation')
                .innerHTML = "Vous devez entrer le nom de votre ville ou de votre village.";
        } else {
            let patern = '^[A-ÿ]+(?:[\\s-][A-zÀ-ÿ\'-]+)*$';
            if (this.validerPattern(elementVille, patern) == false) {
                elementVille
                    .closest('.facturation__form')
                    .querySelector('.erreurVilleFacturation')
                    .innerHTML = "Vous devez entrer une ville ou un village valide.";
            } else {
                elementVille
                    .closest('.facturation__form')
                    .querySelector('.erreurVilleFacturation')
                    .innerHTML = "";
            }
        }
        return elementVille.value;
    }

    public validerProvince(evenement) {
        const elementProvince = evenement.currentTarget;
        if (elementProvince.value == "") {
            elementProvince
                .closest('.facturation__form')
                .querySelector('.erreurProvinceLivraison')
                .innerHTML = "Vous devez choisir votre province.";
        } else {
            elementProvince
                .closest('.facturation__form')
                .querySelector('.erreurProvinceFacturation')
                .innerHTML = "";
        }
        return elementProvince.value;
    }

    public validerPays(evenement) {
        const elementPays = evenement.currentTarget;
        if (elementPays.value == "") {
            elementPays
                .closest('.facturation__form')
                .querySelector('.erreurPaysFacturation')
                .innerHTML = "Vous devez choisir votre pays.";
        } else {
            elementPays
                .closest('.facturation__form')
                .querySelector('.erreurPaysFacturation')
                .innerHTML = "";
        }
        return elementPays.value;
    }

    public validerCodePostal(evenement) {
        const elementCodePostal = evenement.currentTarget;
        if (elementCodePostal.value == "") {
            elementCodePostal
                .closest('.facturation__form')
                .querySelector('.erreurCodePostalFacturation')
                .innerHTML = "Vous devez entrer votre code postal.";
        } else {
            let patern = '^[A-Za-z][0-9][A-Za-z] [0-9][A-Za-z][0-9]$';
            if (this.validerPattern(elementCodePostal, patern) == false) {
                elementCodePostal
                    .closest('.facturation__form')
                    .querySelector('.erreurCodePostalFacturation')
                    .innerHTML = "Le code postal doit respecter le format X1X 1X1.";
            } else {
                elementCodePostal
                    .closest('.facturation__form')
                    .querySelector('.erreurCodePostalFacturation')
                    .innerHTML = "";
            }
        }
        return elementCodePostal.value;
    }
}
