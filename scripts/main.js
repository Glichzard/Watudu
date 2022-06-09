const task = (id = -1, state) => {
    const formData = new FormData()
    formData.append("title", document.getElementById("title").value)
    formData.append("desc", document.getElementById("desc").value)

    let url = "methods/createTask.php"
    if(state) {
        formData.append("id", id)
        formData.set("title", document.getElementById("newTitle").value)
        formData.set("desc", document.getElementById("newDesc").value)
        url = "methods/editTask.php"
    }

    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: response => {
            console.log(response)
            const status = JSON.parse(response)
            if(status.emptyTitle) document.getElementById("title").style.border = "1px solid red"
            if(!status.emptyTitle) document.getElementById("title").style.border = "1px solid black"
            
            if(status.emptyDesc) document.getElementById("desc").style.border = "1px solid red"
            if(!status.emptyDesc) document.getElementById("desc").style.border = "1px solid black"
            
            if(state){
                if(status.emptyNewTitle) document.getElementById("newTitle").style.border = "1px solid red"
                if(!status.emptyNewTitle) document.getElementById("newTitle").style.border = "1px solid black"
    
                if(status.emptyNewDesc) document.getElementById("newDesc").style.border = "1px solid red"
                if(!status.emptyNewDesc) document.getElementById("newDesc").style.border = "1px solid black"
            }

            if(status.success) {
                if(!state) {    
                    document.getElementById("title").value = null
                    document.getElementById("desc").value = null
                }
                loadTasks()
            }
        }
    })

}

document.getElementById("createTask").addEventListener("click", () => task(undefined, false))

const loadTasks = (id = -1) => {
    console.log("Fui calleado")
    $.ajax({
        url: `methods/loadTasks.php?id=${id}`,
        type: "POST",
        success: (response) => document.getElementById("tasks").innerHTML = response
    })
}

const deleteTask = id => {
    $.ajax({
        url: `methods/deleteTask.php?id=${id}`,
        type: "POST",
        success: () => loadTasks()
    })
}

window.onload = loadTasks