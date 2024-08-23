
function submitForm(taskId) {
    document.getElementById('task-form-' + taskId).submit();
 
}
document.addEventListener('DOMContentLoaded',(e)=>{
    let allCheckbox=document.querySelectorAll('.input__checkbox');
    allCheckbox.forEach(chckbox =>{
        
    if( chckbox.checked){
        let taskIds = chckbox.getAttribute('data-id')
        document.getElementById('label-'+taskIds).style.textDecoration='line-through';
        document.getElementById('label-'+taskIds).style.color='#666';
        document.getElementById('label-'+taskIds).style.textDecorationColor='rgb(182, 88, 88)';
       }
    })
})
