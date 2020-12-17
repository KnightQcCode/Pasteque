// export class Fenetre_modale {
//     // Get the modal
//     private modal = document.getElementById("myModal");
//
// // Get the button that opens the modal
//     private btn = document.getElementById("myBtn");
//
// // Get the <span> element that closes the modal
//     private span = document.getElementsByClassName("close")[0];
//
//     constructor() {
//         this.initialiser();
//     }
//
//     private initialiser(): void {
//         //créer les écouteurs d'événement
//         this.btn.addEventListener('click', this.apparaitre.bind(this))
//         this.span.addEventListener('click', this.disparaitre.bind(this))
//     }
//
//     public apparaitre() {
//         this.modal.style.display = "block";
//     }
//
//     public disparaitre() {
//         this.modal.style.display = "block";
//     }
//
// // When the user clicks anywhere outside of the modal, close it
//     window.onclick = function(event) {
//         if (event.target == this.modal) {
//             this.modal.style.display = "none";
//         }
//     }
//
// }
//# sourceMappingURL=fenetre_modale.js.map