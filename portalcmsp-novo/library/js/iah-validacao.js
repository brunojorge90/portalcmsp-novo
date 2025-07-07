jQuery(document).ready(function($) {
  resetVereadorAtual = function(){
    $("select#autorVereadorAtual option").filter(function() {
      return $(this).val() == "default";
    }).attr("selected", true);
    $("#autorVereadorAtual").closest("div").addClass("hidden");
  };
  resetVereadorAnterior = function(){
    $("#autorVereadorAnterior").val("");
    $("#autorVereadorAnterior").closest("div").addClass("hidden");
  };

changeAuthorType = function(authorType){
  switch(authorType){
    case "autorVereaAtual":
      $("#autorVereadorAtual").closest("div").removeClass("hidden");
      resetVereadorAnterior();
    break;
    case "autorVereaAnterior":
      resetVereadorAtual();
      $("#autorVereadorAnterior").closest("div").removeClass("hidden");
    break;
    default:
      resetVereadorAtual();
      resetVereadorAnterior();
  }
};

validateForm = function(){
  var isValid = true;
  var projetoTipo = $("#projetoTipo").val();
  var autorTipo = $("#autorTipo").val();
  var autorVereadorAtual = $("#autorVereadorAtual").val();
  if(
      projetoTipo == "TODOS"      &&
      !$("#projetoNumero").val()  &&
      !$("#projetoAno").val()     &&
      (
        (autorTipo == "default")  ||
        (autorTipo == "autorVereaAtual" && autorVereadorAtual == "default") ||
        //(autorTipo == "autorVereaAnterior" && !autorVereadorAtual)
		(autorTipo == "autorVereaAnterior" && !autorVereadorAnterior)
      ) &&
      !$("#assunto").val()
    )
  {
    isValid = false;
    $("#textoAjuda").removeClass("hidden");
  }
  else
  {
    isValid = true;
    $("#textoAjuda").addClass("hidden");
  }

  return isValid;
};

getAuthorName = function(){
  var autorTipo = $("#autorTipo").find("option:selected").val();
  var autorNome = "";
  switch(autorTipo) {
    case "autorVereaAtual":
      if(!($("#autorVereadorAtual").find("option:selected").val())){
        autorNome = $("#autorVereadorAtual").find("option:selected").text();
      } else {
        autorNome = $("#autorVereadorAtual").find("option:selected").val();
      }
    break;
    case "autorVereaAnterior":
      autorNome = $("#autorVereadorAnteriorInput").val() + "$";
    break;
    case "autorExecutivo":
      autorNome = "EXECUTIVO";
    break;
    case "autorMesa":
      autorNome = "MESA";
    break;
  }
  return autorNome;
};

  setFieldMasks = function(){
    $("#projetoNumero"  ).mask("?99999",   {placeholder:""});
    $("#projetoAno"  ).mask("9999",   {placeholder:""});
  }();

  $("#autorTipo").change(function(){
    var authorType = $(this).find("option:selected").val();
    changeAuthorType(authorType);
  });

  $("#limparBtn").click(function(){
    resetVereadorAtual();
    resetVereadorAnterior();
    $("#buscarForm")[0].reset();
  });

  $("#buscarBtn").click(function(){
      	if(validateForm()){
      		var baseDados = $("#baseDados").val();
      		var projetoTipo = $("#projetoTipo").find("option:selected").val();
      		var projetoNumero = $.trim($("#projetoNumero").val());
      		var projetoAno = $.trim($("#projetoAno").val());
			var autorNome = getAuthorName();
      		var assunto = $("#assunto").val();
      		mostrarPopupIah(baseDados, projetoTipo, projetoNumero, projetoAno, autorNome, assunto);
      	}
  	});
});
