var nom = document.forms["Form"]["user_nom"];
var prenom = document.forms["Form"]["user_prenom"];
var AdresseEmail = document.forms["Form"]["user_adresse"];
var password = document.forms["Form"]["user_password"];
var passwordConf = document.forms["Form"]["conf_password"];
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
/*
passwordConf.addEventListener("input", function (event) {
    if (passwordConf.value != password.value) {
        passwordConf.setCustomValidity("Le mot de passe doit être identique dans les deux champs.");
    }
    else {
        passwordConf.setCustomValidity("");
    }
  });
*/

function connexion() {
    if (AdresseEmail.value == "") {
        document.getElementById("error_message").innerHTML = "<br /><br />Aucun champs ne doit être vide.";
        return false;
    }
    else{
        return true;
    }
}

function inscription() {
    if ((nom.value.trim() == "") || (prenom.value.trim() == "") || (AdresseEmail.value.trim() == "") || (password.value.trim() == "") || (passwordConf.value.trim() == "")) {
        document.getElementById("error_message").innerHTML = "<br /><br />Aucun champs ne doit être vide.";
        return false;
    }
    else{
        return true;
    }

}

function motDePasseOublie() {
    if (AdresseEmail.value == "") {
        document.getElementById("error_message").innerHTML = "<br /><br />Aucun champs ne doit être vide.";
        return false;
    }
    return true;
}