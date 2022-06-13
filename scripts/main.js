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

let filtro = "id"
let orden = "DESC"

const loadTasks = (id = -1, filter, order) => {
    if(filter != undefined) filtro = filter
    if(order != undefined) orden = order

    console.log(`el filtro acutal es ${filtro} \n el orden actual es ${orden} \n methods/loadTasks.php?id=${id}&&filter=${filter}&&order=${order}`)
    
    let open = false
    if(typeof(document.getElementById("done-tasks")) != 'undefined' && document.getElementById("done-tasks") != null)
        if(document.getElementById("done-tasks").parentElement.hasAttribute("open")) open = true
    
    $.ajax({
        url: `methods/loadTasks.php?id=${id}&&filter=${filtro}&&order=${orden}`,
        type: "POST",
        success: (response) => {
            document.getElementById("tasks").innerHTML = response
            if(open) document.getElementById("done-tasks").click()

            if(filter === "id" && order === "ASC") document.getElementById("recentIndicator").classList.add("rotate")
            if(filter === "id" && order === "DESC") document.getElementById("recentIndicator").classList.remove("rotate")
        }
    })
}

let recent = 0
let lastMod = 0
const sorter = (filter) => {
    if(filter === "recent") {
        recent++
        if(recent > 1) recent = 0
        loadTasks(undefined, "id", recent ? "ASC" : "DESC")
    }
    if(filter === "lastMod") {
        lastMod++
        if(lastMod > 1) lastMod = 0
        loadTasks(undefined, 'lastMod', lastMod ? "ASC" : "DESC")
    }

}

const actTask = (id, action) => {
    $.ajax({
        url: `methods/${action}.php?id=${id}`,
        type: "POST",
        success: () => loadTasks()
    })
}

window.onload = loadTasks