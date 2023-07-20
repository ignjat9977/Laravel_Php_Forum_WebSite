
window.onload = ()=>{

    filterAction()
    document.querySelectorAll(".delete-post-btn").forEach(e=>{
        e.addEventListener("click", ()=>{
            deletePost(e)
        })
    })
}
function filterAction(){
    var paginationBtn = document.querySelectorAll(".ik-admin-pagination-posts")
    var checkboxesBtn = document.querySelectorAll(".admin-check-cat")
    var search = document.querySelector("#admin-posts-search");

    paginationBtn.forEach(p=>{
        p.addEventListener("click", ()=>{
            filterAll(p)
        })
    })
    checkboxesBtn.forEach(c=>{
        c.addEventListener("click", ()=>{
            filterAll();
        })
    })
    search.addEventListener("keyup", ()=>{
        filterAll();
    })
}
function filterAll(p = false){

    var page = p ? p.getAttribute("data-li") : 1


    var checkBoxesIds = []
    document.querySelectorAll(".admin-check-cat:checked").forEach(e=>{
        checkBoxesIds.push(parseInt(e.value))
    })

    var string = ''
    checkBoxesIds.forEach(c=>{
        string += `&categoryIds[]=${c}`
    })

    var search = document.querySelector("#admin-posts-search").value

    fetch("/postsAdmin?page="+page+string+"&search="+search, {
        method: 'GET', // or 'PUT'
        headers: {
            'Content-Type': 'application/json',
            "Accept": "application/json",
            "X-CSRF-TOKEN": token
        },
    }).then((response) =>{
        return response.json()
    }).then((data) => {
        printPosts(data.items)
        printPagination(data.numOfPages)
    }).catch((error) => {
        console.log(error)
    });

}
function deletePost(p){
    var id = p.getAttribute('data-li')
    fetch('/postDeletedAdmin/'+id, {
        method: 'DELETE', // or 'PUT'
        headers: {
            'Content-Type': 'application/json',
            "Accept": "application/json",
            "X-CSRF-TOKEN": token
        },
    })
        .then((response) => response.json())
        .then((data) => {
            if(data === "success"){
                p.parentElement.parentElement.parentElement.remove();
            }
        })
        .catch((error) => {
            console.log(error);
        });
}
function printPosts(data){
    var html = ''

    data.forEach(d=>{
        html += `<div class="p-5 col-12 col-md-6">
                    <div class="card">

                        ${printPicture(d.picture_href)}
                        <div class="card-body">
                            <h5 class="card-title text-info">${d.mega_title}</h5>
                            <p class="card-text">${d.content}</p>
                            <a href="/posts/${d.id_post}"> View full Post</a>
                            <a href="#" data-li="${d.id_post}" class="btn btn-danger delete-post-btn">Delete</a>
                        </div>
                    </div>
                </div>`
    })
    document.querySelector("#admin-post-holder").innerHTML = html

    document.querySelectorAll(".delete-post-btn").forEach(e=>{
        e.addEventListener("click", ()=>{
            deletePost(e)
        })
    })

}
function printPagination(data){
    var html = ''

    for(var i =0; i<data; i++){
        html+=` <li class="page-item">
                         <li class="page-item ik-admin-pagination-posts" data-li="${i+1}"><a class="page-link" href="#">${i+1}</a></li>
                    </li>`
    }



    document.querySelector("#post-admin-pagination-nav").innerHTML = html
    filterAction()
}
function printPicture(pic){
    let html = ""
    if(pic === null)
        html = `<img className="card-img-top" src="http://127.0.0.1:8000/assets/images/noimage.jpg" alt="Card image cap">`
    else if(pic.substring(0,6)==="https:")
        html = `<img className="card-img-top" src="${pic}" alt="Card image cap">`
    else
        html = `<img className="card-img-top" src="../../storage/posts/${pic}" alt="Card image cap">`
    return html

}
