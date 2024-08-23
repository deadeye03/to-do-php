document.addEventListener('DOMContentLoaded',()=>{

    let editButtons = document.querySelectorAll('.edit__btn');
    editButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            let id = button.getAttribute('data-id')
            console.log("id is ",id)
    
    
            let ele = document.getElementById(`input-edit-${id}`);
            ele.style.opacity = 1;
            ele.style.visibility = 'visible';
        })
    }) 
})

