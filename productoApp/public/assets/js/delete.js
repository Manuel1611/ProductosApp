(function () {
    
    // método 1
    let enlacesBorrar = document.getElementsByClassName('deleteLink');
    for(var i = 0; i < enlacesBorrar.length; i++) {
        enlacesBorrar[i].addEventListener('click', submitFormConfirmation);
    }
    
    function submitFormConfirmation(event) {
        let retVal = confirm('Delete?');
        if(retVal) {
            let formDelete = document.getElementById('deleteProductForm');
            let url = event.target.dataset.url; //data-url
            formDelete.action = url;
            formDelete.submit();
        }
    }
    
    // método 2
    let formulariosBorrar = document.getElementsByClassName('deleteForm');
    for(var i = 0; i < formulariosBorrar.length; i++) {
        formulariosBorrar[i].addEventListener('submit', function(event) {
            let retVal = confirm('Delete?');
            if(!retVal) {
                event.preventDefault();
            }
        });
    }
    
    // método 3
    let modalDelete = document.getElementById('modalDelete');
    modalDelete.addEventListener('show.bs.modal', function (event) {
        let element = event.relatedTarget;
        let action = element.getAttribute('data-url');
        let form = document.getElementById('modalDeleteProductForm');
        form.action = action;
    });
    
})();