window.onload= ()=>{

    filterTrigger("#usersSearch",".admin-pagination-btn", "/adminDashboard/")
    filterTrigger("#messages-search",".admin-pagination-btn-message", "/adminMessages/")


}
function filterTrigger(search, btn, where){
    document.querySelectorAll(btn).forEach(e=>{
        e.addEventListener("click", ()=> {
            filterAll(e, where, search)
        })
    })
    document.querySelector(search).addEventListener("keyup", ()=>{
        filterAll(null, where, search)
    })

}
function filterAll(e, where, search){
    var offset
    if(e===null) {
        offset = 0
    }
    else
        offset = e.getAttribute("data-li")

    var search = document.querySelector(search).value

    var query
    if(search !== "")
        query = "/" + search
    else
        query=""


    var r

    fetch(where + offset + query, {
        method: 'GET', // or 'PUT'
        headers: {
            'Content-Type': 'application/json',
            "Accept": "application/json",
            "X-CSRF-TOKEN": token
        }
    }).then((response) =>{
        r = response.status
        return response.json()
    }).then((data) => {
        if(r == 200){
            if(data.users){
                showUsers(data.users)
                showPagination(data.numOfPages, ".ik-dash-pag", "admin-pagination-btn")
            }
            else if(data.messages){
                showMessages(data.messages)
                showPagination(data.numOfPages, ".ik-dash-pag-messages", "admin-pagination-btn-message")

            }

            filterTrigger("#usersSearch",".admin-pagination-btn", "/adminDashboard/")
            filterTrigger("#messages-search",".admin-pagination-btn-message", "/adminMessages/")
        }
        if(r == 500){
            openModalResponse(data)
        }
    }).catch((error) => {
       console.log(error)
    });

}
function showUsers(data){
    var html=''
    data.forEach(d=>{
        html+=`<tr>
                    <td>${d.first_name}</td>
                    <td>${d.last_name}</td>
                    <td>${d.numOfPosts}</td>
                    <td>${d.numOfComments}</td>
                    <td>${d.email}</td>
                    <form>
                        <input type="hidden" value="${d.id_user}">
                        <td><input type="submit" class="btn btn-sm btn-primary" value="Delete"></td>
                    </form>

               </tr>`
    })

    document.querySelector(".ik-table-body").innerHTML = html;


}
function showMessages(data){
    var html = ''
    data.forEach(e=>{
        html+=` <div class="d-flex align-items-center border-bottom py-3">
                        <img class="rounded-circle flex-shrink-0" src="http://127.0.0.1:8000/assets/images/unknown.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="w-100 ms-3">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-0">${e.email}</h6>
                                <small>${e.created_at}</small>
                            </div>
                            <span class="ik-text">${e.message}</span>
                        </div>
                    </div>`
    })
    document.querySelector(".admin-messages-container").innerHTML = html;

}
function showPagination(pagesNum, div, name){
    var html=''
    for(var i =0; i<pagesNum; i++){
        html+=` <li class="page-item">
                        <a class="page-link ${name}" data-li="${i}" href="#" tabindex="-1">${i+1}</a>
                    </li>`
    }

    document.querySelector(div).innerHTML = html
}
function openModalResponse(data){
    var modal = document.querySelector(".modal-response-dashboard")

    var body = modal.querySelector(".ik-modal-body")

    body.innerHTML = data

    modal.querySelectorAll(".ik-close").forEach(c=>{
        c.addEventListener("click",()=>{
            modal.style.display = 'none'
        })
    })



}
