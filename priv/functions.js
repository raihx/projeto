function aviso_edit() {
    
    alert('Confirmar alterações?');

}

function  confirmar_delete(){
 
    var input = confirm("Pretende eliminar o utilizador?");
    
    if(input == false) {

        event.preventDefault();

    }


}