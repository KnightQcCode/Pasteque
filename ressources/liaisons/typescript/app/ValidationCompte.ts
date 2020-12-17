export class ValidationCompte {

    // ATTRIBUTS
    private refPrenom: HTMLInputElement = document.querySelector('#prenom');
    private refNom: HTMLInputElement = document.querySelector('#nom');
    private refCourriel: HTMLInputElement = document.querySelector('#courriel');
    private refMotDePasse: HTMLInputElement = document.querySelector('#mot_de_passe');

    // -- Éléments de formulaire à valider

    // Constructeur
    constructor() {
        this.initialiser();
    }

    // Méthodes de validation
    private initialiser(): void {
        //créer les écouteurs d'événement
        document.querySelector('form').noValidate = true;
        this.refPrenom.addEventListener('blur', this.validerPrenom.bind(this));
        this.refNom.addEventListener('blur', this.validerNom.bind(this));
        this.refCourriel.addEventListener('blur', this.validerCourriel.bind(this));
        this.refMotDePasse.addEventListener('blur', this.validerMotDePasse.bind(this));
    }

    public validerPattern(element, motif = element.pattern) {
        const regexp = new RegExp(motif);
        return regexp.test(element.value);
    }


    public validerPrenom(evenement) {
        const elementPrenom = evenement.currentTarget;
        if (elementPrenom.value == "") {
            elementPrenom
                .closest('.creerCompte__form')
                .querySelector('.erreurPrenomCompte')
                .innerHTML = "Vous devez entrer votre prénom.";
        } else {
            let patern = '^[a-zA-ZÀ-ÿ \'-]+$';
            if (this.validerPattern(elementPrenom, patern) == false) {
                elementPrenom
                    .closest('.creerCompte__form')
                    .querySelector('.erreurPrenomCompte')
                    .innerHTML = "Pour le prénom seulement les accents français, les espaces, les tirets et les apostrophes sont permis.";
            } else {
                elementPrenom
                    .closest('.creerCompte__form')
                    .querySelector('.erreurPrenomCompte')
                    .innerHTML = "";
            }
        }
        return elementPrenom.value;
    }
    public validerNom(evenement) {
        const elementNom = evenement.currentTarget;
        if (elementNom.value == "") {
            elementNom
                .closest('.creerCompte__form')
                .querySelector('.erreurNomCompte')
                .innerHTML = "Vous devez entrer votre nom de famille.";
        } else {
            let patern = '^[a-zA-ZÀ-ÿ \'-]+$';
            if (this.validerPattern(elementNom, patern) == false) {
                elementNom
                    .closest('.creerCompte__form')
                    .querySelector('.erreurNomCompte')
                    .innerHTML = "Pour le nom de famille seulement les accents français, les espaces, les tirets et les apostrophes sont permis.";
            } else {
                elementNom
                    .closest('.creerCompte__form')
                    .querySelector('.erreurNomCompte')
                    .innerHTML = "";
            }
        }
        return elementNom.value;
    }

    public validerCourriel(evenement) {
        const elementCourriel = evenement.currentTarget;
        if (elementCourriel.value == "") {
            elementCourriel
                .closest('.creerCompte__form')
                .querySelector('.erreurCourrielCompte')
                .innerHTML = "Vous devez entrer votre adresse courriel.";
        } else {
            let patern = '^[a-zA-Z0-9][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[@][a-zA-Z0-9_-]+([.][a-zA-Z0-9_-]+)*[.][a-zA-Z]{2,}$';
            if (this.validerPattern(elementCourriel, patern) == false) {
                elementCourriel
                    .closest('.creerCompte__form')
                    .querySelector('.erreurCourrielCompte')
                    .innerHTML = "Assurez-vous d'entrer une adresse courriel valide.";
            } else {
                elementCourriel
                    .closest('.creerCompte__form')
                    .querySelector('.erreurCourrielCompte')
                    .innerHTML = "";
            }
        }
        return elementCourriel.value;
    }

    public validerMotDePasse(evenement) {
        const elementMotDePasse = evenement.currentTarget;
        if (elementMotDePasse.value == "") {
            elementMotDePasse
                .closest('.creerCompte__form')
                .querySelector('.erreurMDPCompte')
                .innerHTML = "Vous devez entrer votre mot de passe.";
        } else {
            let patern = '^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,10}$';
            if (this.validerPattern(elementMotDePasse, patern) == false) {
                elementMotDePasse
                    .closest('.creerCompte__form')
                    .querySelector('.erreurMDPCompte')
                    .innerHTML = "Vous devez entrer un mot de passe valide.";
            } else {
                elementMotDePasse
                    .closest('.creerCompte__form')
                    .querySelector('.erreurMDPCompte')
                    .innerHTML = "";
            }
        }
        return elementMotDePasse.value;
    }
}
