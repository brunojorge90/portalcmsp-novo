//2021-03-10: a versão 5.7 do Wordpress tornará jQuery 3.5.1 o padrão e isto requer ajustes em chamadas deprecadas
//
// ????Esta função aqui funciona???? É usada onde????
//
//JQMIGRATE: jQuery.fn.click() event shorthand is deprecated
//
//Cause: The .on() and .trigger() methods can set an event handler or generate an event for any event type, and should be used instead of the shortcut methods.
//This message also applies to the other event shorthands, including:
//blur, focus, focusin, focusout, resize, scroll, dblclick, mousedown, mouseup, mousemove, mouseover, mouseout, mouseenter, mouseleave, change, select, submit, keydown, keypress, keyup, and contextmenu.
//
//Solution: Instead of .click(fn) use .on("click", fn). Instead of .click() use .trigger("click").
(function($){
	$("input[name=telefone]").on("focus", function () {
            $(this).mask("(99) 9999-9999?9");
        });
        $("input[name=telefone]").on("focusout", function () {
            var phone, element;
            element = $(this);
            element.unmask();
            phone = element.val().replace(/\D/g, '');
            if (phone.length > 10) {
                element.mask("(99) 99999-999?9");
            } else {
                element.mask("(99) 9999-9999?9");
            }
        });
	
	$('#contact-form').validate({
		errorPlacement : $.noop
	});

}(jQuery))