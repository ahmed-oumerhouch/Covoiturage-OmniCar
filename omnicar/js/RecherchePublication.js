class RecherchePublication{
    constructor(site,apiKey,page){
        let college = document.getElementById('selectCollege').value;
        let direction = document.getElementById('selectDirection').value;
        let codePostal = document.getElementById('codePostal').value.toUpperCase().replace(' ','');
        let lat = "";
        let lon = "";
        let regex = /[A-Z][0-9][A-Z][0-9][A-Z][0-9]/;
        if(college === "" && direction !== ""){
            alert("S.V.P. Veuillez saisir un collège.");
        }else if(codePostal.length < 0 && !(regex.test(codePostal) && codePostal.length == 6)){
            alert("S.V.P. Veuillez saisir un code postal valide.");
        }else{
            if(codePostal !== ""){
                gLocalisation();
            }else{
                let url = site+"/?action=recherchePublication&college="+college+"&direction="+direction+"&codePostal="+codePostal+"&lat="+lat+"&lon="+lon+"&page="+page;
                let req = new Requete(url,"conteneurPublications",true);
                req.html();
            }
            
            function gLocalisation(){
                new GoogleLocalisation(apiKey).getInfoFormPostalCodeJSON(codePostal,after);
                function after(json){
                    if(json !== null){
                        lat = json.results[0].geometry.location.lat;
                        lon = json.results[0].geometry.location.lng;
                        let url = site+"/?action=recherchePublication&college="+college+"&direction="+direction+"&codePostal="+codePostal+"&lat="+lat+"&lon="+lon+"&page="+page;
                        let req = new Requete(url,"conteneurPublications",true);
                        req.html();
                    } 
                }
            }  
            
        }
    }
}