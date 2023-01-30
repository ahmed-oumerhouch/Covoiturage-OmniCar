/*var script = document.createElement('script');
script.src = '/js/jQuery_min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);*/


class Requete {
	constructor(url,idElementDestination,aSync) {
		this._url = url;
		this._idElementDestination = '#' + idElementDestination;
		this._aSync = aSync;
	}
	
	get url(){
		return this._url;
	}	
	get idElementDestination(){	
		return this._idElementDestination;
	}	
	get aSync(){
		return this._aSync;
	}
	
	set url(u){
		this._url = u;
	}
	set idElementDestination(id){
		this._idElementDestination = id;
	}
	set aSync(a){
		this._aSync = a;
	}
	
	append() {
		$.ajax({
			type: "POST",
			url: this._url,
			dest : this._idElementDestination,
			async: this._aSync,
			success: function (contenu) { $(this.dest).append(contenu); },
		});
	}
	prepend() {
		$.ajax({
			type: "POST",
			url: this._url,
			dest: this._idElementDestination,
			async: this._aSync,
			success: function (contenu) { $(this.dest).prepend(contenu); },
		});
	}
	html() {
		$.ajax({
			type: "POST",
			url: this._url,
			dest: this._idElementDestination,
			async: this._aSync,
			success: function (contenu) { $(this.dest).html(contenu); },
		});
	}

	submit(){
		$.ajax({
			type: "POST",
			url: this._url,
			dest: "BODY",
			async: this._aSync,
			success: function (contenu) { $(this.dest).html(contenu); },
		});
	}
}
