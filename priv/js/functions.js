
function getText(id) {

    var text;

    switch(id) {

        case "edit_user":
            text = "As alterações serão guardadas";
            alerta(text);
        break;
        case "delete_user":
            text = "Pretende eliminar o utilizador selecionado?";
            confirmar(text);
        break;
        case "mark_mensagem":
            text = "Pretende marcar a mensagem como respondida?";
            confirmar(text);
        break;
        case "delete_mensagem":
            text = "Pretende eliminar a mensagem selecionada?";
            confirmar(text);
        break;
        case "add_artigo":
            text = "O artigo será adicionado";
            alerta(text);
        break;
        case "edit_artigo":
            text = "As alterações serão guardadas";
            alerta(text);
        break;
        case "delete_artigo":
            text = "Pretende eliminar o artigo selecionado?";
            confirmar(text);
        break;

    }

}

function confirmar(text) {

    var input = confirm(text);

    if(input == false) {

        event.preventDefault();

    }

}

function alerta(text) {
    
    alert(text);

}
