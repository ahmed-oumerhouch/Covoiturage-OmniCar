

class SoumettreFormulairePublication{
    constructor(apiKey,page){
        let codePostal = document.getElementById('codePostal_MSG').value.toUpperCase().replace(' ','');
        let actionInput = document.createElement('input');
            actionInput.type = "hidden";
            actionInput.name = "action";
            actionInput.value = "publicationDepart";
        let latInput = document.createElement('input');
            latInput.type = "hidden";
            latInput.name = "latitude";
        let lonInput = document.createElement('input');
            lonInput.type = "hidden";
            lonInput.name = "longitude";
        let pageInput = document.createElement('input');
            pageInput.type = "hidden";
            pageInput.name = "page";
            pageInput.value = page;
        let regex = /[A-Z][0-9][A-Z][0-9][A-Z][0-9]/;
        let lat;
        let lon;
        document.getElementById('formulairePublication').appendChild(actionInput);
        document.getElementById('formulairePublication').appendChild(latInput);
        document.getElementById('formulairePublication').appendChild(lonInput);
        document.getElementById('formulairePublication').appendChild(pageInput);
        if(codePostal.length < 0 && !(regex.test(codePostal) && codePostal.length == 6)){
            alert("S.V.P. Veuillez saisir un code postal valide.");
        }else{
            gLocalisation();
        }
        function gLocalisation(){
            new GoogleLocalisation(apiKey).getInfoFormPostalCodeJSON(codePostal,after);
            function after(json){
                if(json !== null){
                    latInput.value = json.results[0].geometry.location.lat;
                    lonInput.value = json.results[0].geometry.location.lng;
                    document.getElementById('formulairePublication').submit();
                } 
            }
        }
        //alert();
    }
}