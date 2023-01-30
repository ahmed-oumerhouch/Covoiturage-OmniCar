var nom = document.forms["Form"]["user_nom"];
var prenom = document.forms["Form"]["user_prenom"];
var AdresseEmail = document.forms["Form"]["ancien_email"];
var passwordAncien = document.forms["Form"]["ancien_password"]
var password = document.forms["Form"]["nouveau_password"];
var passwordConf = document.forms["Form"]["confirm_password"];
var AdresseEmail = document.forms["Form"]["user_adresse"];

// valide que chaque input de type email est une bonne adresse
AdresseEmail.addEventListener("input", function (event) {
    if (AdresseEmail.validity.typeMismatch) {
        AdresseEmail.setCustomValidity("L'adresse email doit être dans un format valide exemple@exemple.ex");
    }
    else if( (AdresseEmail.value.indexOf(".") == -1) || ((AdresseEmail.value.length - (AdresseEmail.value.indexOf(".") + 1)) < 2) ){
        AdresseEmail.setCustomValidity("L'adresse email doit être dans un format valide exemple@exemple.ex");
    }
    else {
        AdresseEmail.setCustomValidity("");
    }
  });

password.addEventListener("input", function (event){} );

// vérifie que le mot de passe de confirmation est le même que celui entré
passwordConf.addEventListener("input", function (event) {
    if (passwordConf.value != password.value) {
        passwordConf.setCustomValidity("Le mot de passe doit être identique dans les deux champs.");
    }
    else {
        passwordConf.setCustomValidity("");
    }
  });

