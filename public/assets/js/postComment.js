window.onload = function(){
    addComment()
    deleteComment()
    likeComment()
    likePost()
}
function addComment(){
    document.querySelectorAll(".ik-btn-comment").forEach(e=>{
        e.addEventListener("click", function(){
            let content = e.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.value
            let id_user = e.previousElementSibling.value
            let id_post = e.previousElementSibling.previousElementSibling.previousElementSibling.value
            let id_parent = e.previousElementSibling.previousElementSibling.value

            var data = {
                "content" : content,
                "id_user" : id_user,
                "id_post" : id_post,
                "id_parent": id_parent
            }
            fetch("/commented", {
                method: 'POST', // or 'PUT'
                headers: {
                    'Content-Type': 'application/json',
                    "Accept": "application/json",
                    "X-CSRF-Token": token
                },
                body: JSON.stringify(data),
            })
                .then((response) => response.json())
                .then( result => {
                    var div = e.parentElement.parentElement.parentElement.querySelector(".ikSubComment")
                    result.forEach(x => {
                        if (x.id_parent == 0) {
                            var combobox = document.querySelector("#commentBox")

                            var el = document.createElement("div")
                            el.setAttribute("class", "ikSubComment");
                            combobox.appendChild(el)


                            div = combobox.lastElementChild
                        }

                    })
                    if(div.innerHTML!==""){
                        let x = e.parentElement.parentElement.parentElement;
                        let el = document.createElement("div")
                        el.setAttribute("class", "ikSubComment");
                        x.appendChild(el)
                        div = x.lastElementChild
                    }
                    showComments(result, div)
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        })
    })
}
function showComments(data, div){
    let html = ""

    data.forEach(d=>{
        html+=`<div class="media mt-4">
    ${printPicture(d.picture_href)}
    <div class="media-body">
        <div class="row">
            <div class="col-12 d-flex justify-content-between">
                <h5 class="w-75">${d.first_name+" "+d.last_name}</h5>
                <a class="deleteComBtn btn btn-danger" data-li="${d.id_comment}">Delete</a>
                <span class="d-block w-25"> ${d.created_at}</span>
                Likes:<span class="num-of-likes">0</span>
                <a href="#" class="like-btn" data-li="${d.id_comment}"><i class="bi bi-hand-thumbs-up mr-2"></i></a>
            </div>
        </div>

        ${d.content}

        <div class="col-12 mt-3">
            <form class="d-flex">
                <input type="text" id="" placeholder="Comment here" class="form-control content">
                <input type="hidden" value="${d.id_post}" class="id_post"/>
                <input type="hidden" value="${d.id_comment}" class="id_parent"/>
                <input type="hidden" value="${d.id_user}" class="id_user"/>
                <a  class="btn rounded-0 ik-btn-comment btn-primary" >Send</a>
            </form>

        </div>

        <div class="ikSubComment">

        </div>`
    })

    div.innerHTML = html
    addComment()
    deleteComment()
    likeComment()
}
function printPicture(pic){
    let html = ""
    if(pic === null)
        html = `<img class="mr-3 rounded-circle" alt="Bootstrap Media Preview" src="http://127.0.0.1:8000/assets/images/unknown.jpg" />`
    else if(pic.substring(0,6)==="https:")
        html = `<img class="mr-3 rounded-circle" src="${pic}" alt="User picture">`
    else
        html = `<img class="mr-3 rounded-circle" src="../../storage/posts/${pic}" alt="User picture">`

    return html

}
function deleteComment(){
    document.querySelectorAll(".deleteComBtn").forEach(e=>{
        e.addEventListener("click", function(){
            var comment = e.parentElement.parentElement.parentElement.parentElement
            var data = {
                "id": e.getAttribute("data-li")
            }
            fetch('/commentedDelete', {
                method: 'POST', // or 'PUT'
                headers: {
                    'Content-Type': 'application/json',
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": token
                },
                body: JSON.stringify(data),
            })
                .then((response) => response.json())
                .then((data) => {
                    if(data === "success"){
                        comment.remove();
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        })
    })
}
function likeComment(){
    var likeBtnComment = document.querySelectorAll(".like-btn")

    likeBtnComment.forEach(l => {
        l.addEventListener("click", e => {
            e.preventDefault()
            var commentId = l.getAttribute("data-li");
            var data = {
                "id_comment" : commentId
            }
            fetch('/likedComment', {
                method: 'POST', // or 'PUT'
                headers: {
                    'Content-Type': 'application/json',
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": token
                },
                body: JSON.stringify(data),
            })
                .then((response) => response.json())
                .then((data) => {
                    if(data === "up"){
                        l.previousElementSibling.innerHTML = parseInt(l.previousElementSibling.innerHTML) + 1
                    }else if(data === 'down'){
                        l.previousElementSibling.innerHTML = parseInt(l.previousElementSibling.innerHTML) - 1
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        })
    })
}
function likePost(){
    var likeBtnPost = document.querySelectorAll(".like-btn-post")

    likeBtnPost.forEach(l => {
        l.addEventListener("click", e => {
            e.preventDefault()
            var postId = l.getAttribute("data-li");
            var data = {
                "id_post" : postId
            }
            fetch('/likedPost', {
                method: 'POST', // or 'PUT'
                headers: {
                    'Content-Type': 'application/json',
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": token
                },
                body: JSON.stringify(data),
            })
                .then((response) => response.json())
                .then((data) => {
                    if(data === "up"){
                        l.previousElementSibling.innerHTML = parseInt(l.previousElementSibling.innerHTML) + 1
                    }else if(data === 'down'){
                        l.previousElementSibling.innerHTML = parseInt(l.previousElementSibling.innerHTML) - 1
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        })
    })
}
