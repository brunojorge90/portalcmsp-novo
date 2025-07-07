
// limpar preposicoes da busca
function limparPreposicoes(str) {
	str = str.replace(/ dos /gi, " ");
	str = str.replace(/ das /gi, " ");
	str = str.replace(/ do /gi, " ");
	str = str.replace(/ da /gi, " ");
	str = str.replace(/ de /gi, " ");
	str = str.replace(/ nos /gi, " ");
	str = str.replace(/ nas /gi, " ");
	str = str.replace(/ no /gi, " ");
	str = str.replace(/ na /gi, " ");
	str = str.replace(/ em /gi, " ");
	str = str.replace(/ aos /gi, " ");
	str = str.replace(/ às /gi, " ");
	str = str.replace(/ ao /gi, " ");
	str = str.replace(/ à /gi, " ");
	str = str.replace(/ a /gi, " ");
	str = str.replace(/ e /gi, " ");
	str = str.replace(/ o /gi, " ");
	str = str.replace(/ os /gi, " ");
	str = str.replace(/ as /gi, " ");
	return str;
}

function limparAcentos(str)
{
    /*
    str = str.replace(/[ÀÁÂÃÄÅ]/,"A");
    str = str.replace(/[àáâãäå]/,"a");
    str = str.replace(/[ÈÉÊË]/,"E");
    str = str.replace(/[èéêë]/,"e");
    str = str.replace(/[ÌÍÎÏ]/,"I");
    str = str.replace(/[ìíîï]/,"i");
    str = str.replace(/[ÒÓÔÕÖ]/,"O");
    str = str.replace(/[òóôõö]/,"o");
    str = str.replace(/[ÙÚÛÜ]/,"U");
    str = str.replace(/[ùúûü]/,"u");
    str = str.replace(/[Ç]/,"C");
    str = str.replace(/[ç]/,"c");

    // o resto
    return str.replace(/[^a-z0-9 ]/gi,'');
    */
   	var r=str.toLowerCase();
	//r = r.replace(new RegExp("\\s", 'g'),"");
	r = r.replace(new RegExp("[àáâãäå]", 'g'),"a");
	r = r.replace(new RegExp("æ", 'g'),"ae");
	r = r.replace(new RegExp("ç", 'g'),"c");
	r = r.replace(new RegExp("[èéêë]", 'g'),"e");
	r = r.replace(new RegExp("[ìíîï]", 'g'),"i");
	r = r.replace(new RegExp("ñ", 'g'),"n");
	r = r.replace(new RegExp("[òóôõö]", 'g'),"o");
	r = r.replace(new RegExp("œ", 'g'),"oe");
	r = r.replace(new RegExp("[ùúûü]", 'g'),"u");
	r = r.replace(new RegExp("[ýÿ]", 'g'),"y");
	//r = r.replace(new RegExp("\\W", 'g'),"");
	return r;
}

var parExprSearch  = "&exprSearch=";
var parIndexSearch = "&indexSearch=";
var parEydatabase  = "%5EyDATABASE";

var iahProjetoTipo = function(baseIah, inputProjetoTipo){
	var iahProjetoTipo = '';
	if (inputProjetoTipo === '') { iahProjetoTipo = "";
	} else {
		var parProjetoTipo = '';
		if (baseIah == "proje") { parProjetoTipo = "%5EnCm%5ELTipo+de+projeto%5Etshort%5Ex%2F20"; }
		if (baseIah == "legis") { parProjetoTipo = "%5EnTn%5ELTipo+de+norma%5Ex%2F5"; }
		if (inputProjetoTipo == "TODOS") { inputProjetoTipo = "$"; }
		iahProjetoTipo = parExprSearch + inputProjetoTipo + parIndexSearch + parProjetoTipo + parEydatabase;
	}
	return iahProjetoTipo;
}

var iahProjetoNumero = function(baseIah, inputProjetoNumero){
	var iahProjetoNumero = '';
	if (inputProjetoNumero === '') { iahProjetoNumero = "";
	} else {
		var parProjetoNumero = '';
		if (baseIah == "proje") { parProjetoNumero = "%5EnPj%5ELN%FAmero+do+projeto%5Ex%2F30"; }
		if (baseIah == "legis") { parProjetoNumero = "%5EnNn%5ELN%FAmero+da+norma%5Ex%2F6"; }
		iahProjetoNumero = parExprSearch + parseInt(inputProjetoNumero, 10) + parIndexSearch + parProjetoNumero + parEydatabase;
	}
	return iahProjetoNumero;
}

var iahProjetoAno = function(baseIah, inputProjetoAno){
	var iahProjetoAno = '';
	if (inputProjetoAno==='') { iahProjetoAno = "";
	} else {
		var parProjetoAno = '';
		if (baseIah == "proje") { parProjetoAno = "%5EnDp%5ELAno+do+projeto%5Ex%2F40%5Etshort"; }
		if (baseIah == "legis") { parProjetoAno = "%5EnDn%5ELAno+da+norma%5Ex%2F10"; }
		iahProjetoAno = parExprSearch + inputProjetoAno + parIndexSearch + parProjetoAno + parEydatabase;
	}
	return iahProjetoAno
}

var iahProjetoAutor = function(baseIah, inputProjetoAutor){
	var iahProjetoAutor = '';
	if (inputProjetoAutor==='') { iahProjetoAutor = "";
	} else {
		var parAutorNome = '';
		if (baseIah == "proje") { parAutorNome = "%5EnAu%5ELAutor+do+projeto%5Ex%2F50"; }
		if (baseIah == "legis") { parAutorNome = "%5EnAu%5ELAutor+do+projeto%5Ex%2F32"; }
		iahProjetoAutor = parExprSearch + inputProjetoAutor + parIndexSearch + parAutorNome + parEydatabase;
		//var parProjetoAutor = '';
		//if (baseIah == "proje") { parProjetoAutor = "%5EnAu%5ELAutor+do+projeto%5Ex%2F50"; }
		//if (baseIah == "legis") { parProjetoAutor = "%5EnAu%5ELAutor+da+norma%5Ex%2F32"; }
		//iahProjetoAutor = parExprSearch + inputProjetoAutor + parIndexSearch + parProjetoAutor + parEydatabase;
	}
	return iahProjetoAutor;
}

var iahProjetoAssunto = function(baseIah, inputProjetoAssunto){
	var iahProjetoAssunto;
	iahProjetoAssunto = limparAcentos(inputProjetoAssunto);
	iahProjetoAssunto = limparPreposicoes(iahProjetoAssunto);

	if (inputProjetoAssunto==='') { iahProjetoAssunto = "";
	} else {
		var assuntoPalavras = iahProjetoAssunto.split(" ");
		var contador=0;
		while (contador < assuntoPalavras.length) {
			// adaptacao para otimizacao do sistema (sugestao da marcia em 06/08/2010)
			var temp = assuntoPalavras[contador].substring(0, assuntoPalavras[contador].length);
			assuntoPalavras[contador] = "" + (temp) + "/(70)"; // assunto

			//somente base proje
			if (baseIah == "proje") {
				assuntoPalavras[contador] = assuntoPalavras[contador] + "%20OR%20" + (temp) + "/(71)"; // nome de logradouro
				assuntoPalavras[contador] = assuntoPalavras[contador] + "%20OR%20" + (temp) + "/(72)"; // homenageado
			}

			//substituido para ir ate ultimo caracter
			//assuntoPalavras[contador] = (assuntoPalavras[contador].substring(0,assuntoPalavras[contador].length));
			contador += 1;
		}
		//assuntoFrase = assuntoPalavras.join("$%20AND%20"); substituido para nao haver truncamento
		assuntoFrase = assuntoPalavras.join(")%20AND%20(");
		//iahProjetoAssunto = parExprSearch +       assuntoFrase +"$"  + parIndexSearch + "^nTw^LTodos+os+campos^2Todos+los+campos^3All+fields^yDATABASE^xALL+";  substituido para nao haver truncamento
		//iahProjetoAssunto = parExprSearch + "(" + assuntoFrase + ")" + parIndexSearch + "^nTw^LTodos+os+campos^2Todos+los+campos^3All+fields^yDATABASE^xALL+";
		iahProjetoAssunto =   parExprSearch + "(" + assuntoFrase + ")";// + parIndexSearch;
		//Procurar pelo termo completo Ex. Lei 14.485/2007 [08/04/2016]
		iahProjetoAssunto = iahProjetoAssunto + " OR (" + inputProjetoAssunto + ")" + parIndexSearch;
		iahProjetoAssunto = iahProjetoAssunto + "%5EnTw%5ELTodos+os+campos%5E2Todos+los+campos%5E3All+fields" + parEydatabase + "%5ExALL+";
	}
	return iahProjetoAssunto;
}

var montarLinkIah = function(baseIah, parProjetoTipo, parProjetoNumero, parProjetoAno, parProjetoAutor, parProjetoAssunto) {
	var domain = "https://www.saopaulo.sp.leg.br/cgi-bin/wxis.bin/iah/scripts/?IsisScript=iah.xis";
	var params = "&form=A&format=standard.pft&navBar=OFF&hits=200&lang=pt&nextAction=search&base=" + baseIah + "&conectSearch=init";
	var parAnd  = "&conectSearch=and";
	var URL = domain + params + iahProjetoTipo(baseIah, parProjetoTipo);
	if(parProjetoNumero !== "") URL += parAnd + iahProjetoNumero(baseIah, parProjetoNumero);
	if(parProjetoAno    !== "") URL += parAnd + iahProjetoAno(baseIah, parProjetoAno);
	if(typeof parProjetoAutor !== 'undefined'){
		if(parProjetoAutor !== "") URL += parAnd + iahProjetoAutor(baseIah, parProjetoAutor);
	}
	if(typeof parProjetoAssunto !== 'undefined'){
		if(parProjetoAssunto   !== "") URL += parAnd + iahProjetoAssunto(baseIah, parProjetoAssunto);
	}
	return URL;
}

function mostrarPopupIah(baseIah, parProjetoTipo, parProjetoNumero, parProjetoAno, parAutorNome, parAssunto) {
	var URL = montarLinkIah(baseIah, parProjetoTipo, parProjetoNumero, parProjetoAno, parAutorNome, parAssunto);
//function mostrarPopupIah(baseIah, parProjetoTipo, parProjetoNumero, parProjetoAno, parProjetoAutor, parAssunto) {
	//var URL = montarLinkIah(baseIah, parProjetoTipo, parProjetoNumero, parProjetoAno, parProjetoAutor, parAssunto);
	var parPopup = "toolbar=0,scrollbars=1,location=no,statusbar=0,menubar=0,resizable=0,width=790,height=500,left=465,top=275";
	window.open(URL, "resultado", parPopup);
	//return false;
}
