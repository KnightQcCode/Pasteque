export class ValidationLivraison {

    // ATTRIBUTS
    private refNom: HTMLInputElement = document.querySelector('#nom');
    private refCourriel: HTMLInputElement = document.querySelector('#courriel');
    private refMotDePasse: HTMLInputElement = document.querySelector('#mot_de_passe');
    private refAdresse: HTMLInputElement = document.querySelector('#adresse_livraison');
    private refVille: HTMLInputElement = document.querySelector('#ville_livraison');
    private refProvince: HTMLInputElement = document.querySelector('#province_livraison');
    private refPays: HTMLInputElement = document.querySelector('#pays_livraison');
    private refCodePostal: HTMLInputElement = document.querySelector('#codePostal_livraison');
    // -- Éléments de formulaire à valider

    // Constructeur
    constructor() {
        this.initialiser();

    }

    // Méthodes de validation
    private initialiser(): void {
        //créer les écouteurs d'événement
        document.querySelector('form').noValidate = true;
        this.refNom.addEventListener('blur', this.validerNom.bind(this));
        this.refCourriel.addEventListener('blur', this.validerCourriel.bind(this));
        this.refMotDePasse.addEventListener('blur', this.validerMotDePasse.bind(this));
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

    public validerNom(evenement) {
        const elementNom = evenement.currentTarget;
        if (elementNom.value == "") {
            elementNom
                .closest('.livraison__form')
                .querySelector('.erreurNomLivraison')
                .innerHTML = "Vous devez entrer votre nom complet.";
        } else {
            let patern = '^[a-zA-ZÀ-ÿ \'-]+$';
            if (this.validerPattern(elementNom, patern) == false) {
                elementNom
                    .closest('.livraison__form')
                    .querySelector('.erreurNomLivraison')
                    .innerHTML = "Assurez-vous d'entrer un nom complet valide.";
            } else {
                elementNom
                    .closest('.livraison__form')
                    .querySelector('.erreurNomLivraison')
                    .innerHTML = "";
            }
        }
        return elementNom.value;
    }
    public validerCourriel(evenement) {
        const elementCourriel = evenement.currentTarget;
        if (elementCourriel.value == "") {
            elementCourriel
                .closest('.livraison__form')
                .querySelector('.erreurCourrielLivraison')
                .innerHTML = "Vous devez entrer votre adresse courriel.";
        } else {
            let patern = '^[a-zA-Z0-9][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,}$';
            if (this.validerPattern(elementCourriel, patern) == false) {
                elementCourriel
                    .closest('.livraison__form')
                    .querySelector('.erreurCourrielLivraison')
                    .innerHTML = "Assurez-vous d'entrer une adresse courriel valide.";
            } else {
                elementCourriel
                    .closest('.livraison__form')
                    .querySelector('.erreurCourrielLivraison')
                    .innerHTML = "";
            }
        }
        return elementCourriel.value;
    }

    public validerMotDePasse(evenement) {
        const elementMotDePasse = evenement.currentTarget;
        if (elementMotDePasse.value == "") {
            elementMotDePasse
                .closest('.livraison__form')
                .querySelector('.erreurMDPLivraison')
                .innerHTML = "Vous devez entrer votre mot de passe.";
        } else {
            let patern = '^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,10}$';
            if (this.validerPattern(elementMotDePasse, patern) == false) {
                elementMotDePasse
                    .closest('.livraison__form')
                    .querySelector('.erreurMDPLivraison')
                    .innerHTML = "Vous devez entrer un mot de passe valide.";
            } else {
                elementMotDePasse
                    .closest('.livraison__form')
                    .querySelector('.erreurMDPLivraison')
                    .innerHTML = "";
            }
        }
        return elementMotDePasse.value;
    }

    public validerAdresse(evenement) {
        const elementAdresse = evenement.currentTarget;
        if (elementAdresse.value == "") {
            elementAdresse
                .closest('.livraison__form')
                .querySelector('.erreurAdresseLivraison')
                .innerHTML = "Vous devez entrer votre adresse.";
        } else {
            let patern = '^[0-9]+[a-zA-ZÀ-ÿ0-9 \-\'\,]+$';
            if (this.validerPattern(elementAdresse, patern) == false) {
                elementAdresse
                    .closest('.livraison__form')
                    .querySelector('.erreurAdresseLivraison')
                    .innerHTML = "Vous devez entrer une adresse valide.";
            } else {
                elementAdresse
                    .closest('.livraison__form')
                    .querySelector('.erreurAdresseLivraison')
                    .innerHTML = "";
            }
        }
        return elementAdresse.value;
    }

    public validerVille(evenement) {
        const elementVille = evenement.currentTarget;
        if (elementVille.value == "") {
            elementVille
                .closest('.livraison__form')
                .querySelector('.erreurVilleLivraison')
                .innerHTML = "Vous devez entrer le nom de votre ville ou de votre village.";
        } else {
            let patern = '^[A-ÿ]+(?:[\\s-][A-zÀ-ÿ\'-]+)*$';
            if (this.validerPattern(elementVille, patern) == false) {
                elementVille
                    .closest('.livraison__form')
                    .querySelector('.erreurVilleLivraison')
                    .innerHTML = "Vous devez entrer une ville ou un village valide.";
            } else {
                elementVille
                    .closest('.livraison__form')
                    .querySelector('.erreurVilleLivraison')
                    .innerHTML = "";
            }
        }
        return elementVille.value;
    }

    public validerProvince(evenement) {
        const elementProvince = evenement.currentTarget;
        if (elementProvince.value == "") {
            elementProvince
                .closest('.livraison__form')
                .querySelector('.erreurProvinceLivraison')
                .innerHTML = "Vous devez choisir votre province.";
        } else {
            elementProvince
                .closest('.livraison__form')
                .querySelector('.erreurProvinceLivraison')
                .innerHTML = "";
        }
        return elementProvince.value;
    }

    public validerPays(evenement) {
        const elementPays = evenement.currentTarget;
        if (elementPays.value == "") {
            elementPays
                .closest('.livraison__form')
                .querySelector('.erreurPaysLivraison')
                .innerHTML = "Vous devez choisir votre pays.";
        } else {
            elementPays
                .closest('.livraison__form')
                .querySelector('.erreurPaysLivraison')
                .innerHTML = "";
        }
        return elementPays.value;
    }

    public validerCodePostal(evenement) {
        const elementCodePostal = evenement.currentTarget;
        if (elementCodePostal.value == "") {
            elementCodePostal
                .closest('.livraison__form')
                .querySelector('.erreurCodePostalLivraison')
                .innerHTML = "Vous devez entrer votre code postal.";
        } else {
            let patern = '^[A-Za-z][0-9][A-Za-z] [0-9][A-Za-z][0-9]$';
            if (this.validerPattern(elementCodePostal, patern) == false) {
                elementCodePostal
                    .closest('.livraison__form')
                    .querySelector('.erreurCodePostalLivraison')
                    .innerHTML = "Le code postal doit respecter le format X1X 1X1.";
            } else {
                elementCodePostal
                    .closest('.livraison__form')
                    .querySelector('.erreurCodePostalLivraison')
                    .innerHTML = "";
            }
        }
        return elementCodePostal.value;
    }
}
