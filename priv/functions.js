function aviso_edit() {
    
    alert('Confirmar alterações?');

}

function  confirmar_delete() {
 
    var input = confirm("Ao eliminar o utilizador também irá eliminar as mensagens enviadas pelo mesmo. Pretende prosseguir?");
    
    if(input == false) {

        event.preventDefault();

    }

}

function marcar_respondida() {

    var input = confirm("Pretende marcar a mensagem como respondida?");
    
    if(input == false) {

        event.preventDefault();

    }

}

function confirmar_elim_msg() {

    var input = confirm("Esta mensagem já foi respondida, pretende mesmo eliminá-la?");
    
    if(input == false) {

        event.preventDefault();

    }

}

function guardar_artigo() {

    var input = confirm("Criar novo artigo?");
    
    if(input == false) {

        event.preventDefault();

    }

}

function  confirmar_elim_artigo() {
 
    var input = confirm("Pretende mesmo eliminar este artigo?");
    
    if(input == false) {

        event.preventDefault();

    }

}