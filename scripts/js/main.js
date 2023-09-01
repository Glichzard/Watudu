const taskAction = (action, taskId) => {
    const title = document.getElementById(`${titleHtmlId = action === 'save' ? 'task-title' : 'task-new-title'}`)
    const desc = document.getElementById(`${descHtmlId = action === 'save' ? 'task-desc' : 'task-new-desc'}`)
    const urgent = document.getElementById(`${urgentHtmlId = action === 'save' ? 'is-urgent' : 'edit-is-urgent'}`)

    let task = new FormData();
    task.append("title", title.value)
    task.append("desc", desc.value)
    task.append("urgent", urgent.checked)

    const isEdit = action === "edit" ? `?id=${taskId}`: ""

    $.ajax({
        url: `./scripts/php/${add_task = action === 'save' ? 'add_task' : 'save_edit_task'}.php` + isEdit,
        type: "post",
        data: task,
        processData: false,
        contentType: false,
        success: (response) => {
            if(action === "save") {
                title.value = ""
                desc.value = ""
                urgent.checked = false
            }
            
            console.log(response)
            loadTasks()

            setTimeout(() => {
                document.getElementById("tasks").lastElementChild.classList.add("set-visible")
            }, 200);
        }
    })
}


const addTaskBtn = document.getElementById("add-task")
addTaskBtn.addEventListener("click", () => {
    const desc = document.getElementById("task-desc")
    
    if(desc.value != "") {
        desc.classList.remove("is-invalid")
        taskAction("save")
        return
    }
    
    Swal.fire({
        icon: 'error',
        title: 'Description field is empty!',
        text: 'Please insert text',
    })

    desc.classList.add("is-invalid")
    
})

const loadTasks = () => {
    const tasksContainer = document.getElementById("tasks")
    $.ajax({
        url: "./scripts/php/load_tasks.php",
        type: "post",
        success: (response) => {
            tasksContainer.innerHTML = response
            
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        }
    })
}

const loadDoneTasks = () => {
    const tasksContainer = document.getElementById("done-tasks")
    $.ajax({
        url: "./scripts/php/load_done_tasks.php",
        type: "post",
        success: (response) => {
            tasksContainer.innerHTML = response
            
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        }
    })
}


const editTask = (taskId) => {
    $.ajax({
        url: `./scripts/php/get_task.php?taskId=${taskId}`,
        type: "post",
        success: (response) => {
            const task = JSON.parse(response)

            Swal.fire({
                html:
                    `<div class="form-group">
                        <label for="task-new-title">New title</label>
                        <input type="text" class="form-control" id="task-new-title" placeholder="Title" value="${task.title}">
                    </div>
                    <div class="form-group">
                        <label for="task-new-desc">New description</label>
                        <textarea rows="3" class="form-control" id="task-new-desc" placeholder="Description">${task.description}</textarea>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="edit-is-urgent" ${task.urgent === "true" ? "checked" : null}>
                        <label class="form-check-label" for="edit-is-urgent">Urgent</label>
                    </div>
                    `
                ,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: 'Save',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    const desc = document.getElementById("task-new-desc").value
    
                    if(desc != "") {
                        taskAction("edit", task.id)
                        Swal.fire('Saved!', '', 'success')
                        return
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'New description field is empty!',
                        text: 'You can\'t remove the description'
                    })
                }
            })
        }
    })    
} 

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 1500,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
        toast.addEventListener('click', Swal.close)
    }
})

const doneTask = taskId => {
    $.ajax({
        url: `./scripts/php/done_task.php?id=${taskId}`,
        type: "post",
        success: (response) => {
            loadTasks()
            loadDoneTasks()
            
            Toast.fire({
                icon: 'success',
                title: 'Done!'
            })
        }
    })
}

const pendientTask = taskId => {
    $.ajax({
        url: `./scripts/php/pendient_task.php?id=${taskId}`,
        type: "post",
        success: (response) => {
            loadTasks()
            loadDoneTasks()

            Toast.fire({
                icon: 'success',
                title: 'Done!'
              })
        }
    })
}

const deleteTask = taskId => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `./scripts/php/delete_task.php?id=${taskId}`,
                type: "post",
                success: (response) => {
                    loadDoneTasks()

                    Swal.fire(
                        'Deleted!',
                        'Your task has been deleted.',
                        'success'
                    )
                }
            })            
        }
    })
}

const deleteAllDoneTasks = () => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "./scripts/php/delete_done_tasks.php",
                type: "post",
                success: (response) => {
                    console.log(response)
                    loadDoneTasks()

                    Toast.fire({
                        icon: 'success',
                        title: 'Deleted it!'
                    })
                }
            })            
        }
    })
}

window.onload = () => {
    loadTasks()
    loadDoneTasks()    
}