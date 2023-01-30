

class GoogleLocalisation{
    constructor(apiKey){
        let _key = apiKey;
        
        this.getInfoFormPostalCodeJSON = function(pc,func){
            var xhttp = new XMLHttpRequest();
            var json = null;
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    json = JSON.parse(xhttp.responseText);
                }
                return func(json);
            };
            xhttp.open("POST", "https://maps.googleapis.com/maps/api/geocode/json?address="+pc+"&key="+_key, true);
            xhttp.send();
        }

        this.getInfoFormPostalCodeXML = function(pc,func){
            var xhttp = new XMLHttpRequest();
            var xml = null;
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    xml = xhttp.responseXML;
                }
                return func(xml);
            };
            xhttp.open("POST", "https://maps.googleapis.com/maps/api/geocode/xml?address="+pc+"&key="+_key, true);
            xhttp.send();
        }

        this.getCoordinatesFromJSON = function(json){
            return{
                latitude : json.results[0].geometry.location.lat,
                longitude : json.results[0].geometry.location.lng
            };
        }
    }
}