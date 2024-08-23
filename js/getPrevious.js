let currentDate = new Date();

function formatDate(date) {
    const year = date.getFullYear();
    const month = ('0' + (date.getMonth() + 1)).slice(-2);
    const day = ('0' + date.getDate()).slice(-2);
    return `${year}-${month}-${day}`;
}

function fetchTasks(date) {
    fetch(`PHP/getPreviousTask.php?date=${date}`)
        .then(response => response.json())
        .then(tasks => {
            console.log(tasks, "fetching data..")
            let taskListContainer = document.querySelector('.todo__task')
            taskListContainer.innerHTML = ''

            tasks.forEach(task => {
                const taskHtml = `
                     <div class="todo__task__content" id="task-${task._id}">
                      <div class="todo__task__inputBox">
                         <input type="checkbox" name="checkbox" class="input__checkbox" id="checkbox-${task._id}" ${task.isComplete ? 'checked' : ''}>
                         <label for="checkbox-${task.id}" class="input__label" id="label-${task.id}">
                         ${task.task}
                        </label>
                     </div>
                    `
                taskListContainer.innerHTML += taskHtml
            })
        })
        .catch(error => console.error('Error fetching tasks:', error));
}

function showDate(direction) {
    let footer=document.querySelector('.todo__footer')
    console.log('footer is ',footer)
    footer.classList.add('hidden')
    // Storing today DATE
    let todayDate = new Date();
    todayDate.setMinutes(todayDate.getMinutes() - todayDate.getTimezoneOffset());
    let cuDate = todayDate.toISOString().slice(0, 10);
    console.log(cuDate);

    //Fetching tasks by date
    currentDate.setDate(currentDate.getDate() + direction);
    const formattedDate = formatDate(currentDate);
    console.log(formattedDate)
    if (cuDate === formattedDate) {
        location.href = '/to-do';
    } else {
        console.log('Dates are not equal');
    }

    fetchTasks(formattedDate);
    document.querySelector('.next').classList.remove('show')
    // document.querySelector('.todo__footer').style.opacity="0";
    // Update date display
    document.getElementById('month').innerText = currentDate.toLocaleString('default', { month: 'short' });
    document.getElementById('date').innerText = currentDate.getDate();
}

document.addEventListener('DOMContentLoaded', () => {

});