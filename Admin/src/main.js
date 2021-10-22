// <=================== Category =======================>  //
    // Thêm và Sửa category
    var modalTriggerBtn = document.querySelectorAll('.modal-open'); 
    
    modalTriggerBtn.forEach(function(btn){
        btn.onclick = function(){
            var modal = btn.getAttribute('data-modal');
            chosenModal = document.getElementById(modal);
            chosenModal.className=chosenModal.className.replace("modal-hidden","");
            chosenModal.className +=" modal-show";        
            chosenModal.style.display="flex";
            document.body.style.display="hidden";
            if(modal == 'modal-edit'){
                var id = btn.getAttribute('id-item');
                var name = btn.getAttribute('name-item');
                document.getElementById('id_category_edit').value = id;
                document.getElementById('name_category_edit').value = name;
            }
        };
        
    });
    var closeBtns = document.querySelectorAll('.close-modal');
    closeBtns.forEach(function(btn){
        btn.onclick = function(){
            var modal = btn.closest('.modal-category');
            modal.className=modal.className.replace("modal-show","");
            modal.className +=" modal-hidden";        
            modal.style.display="none";
            document.body.style.display="initial";
        }
    })
 





