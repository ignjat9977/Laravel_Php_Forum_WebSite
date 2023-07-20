<script>
    window.onload = ()=>{

        var modalBtn = document.querySelectorAll(".ik-modal-edit-btn")
        var modal = document.querySelector(".modal-edit-tag-category")
        var modalClose = document.querySelectorAll(".ik-close-modal")

        modalBtn.forEach(m=>{
            m.addEventListener("click", ()=>{
                modal.style.display = "block"

                modalClose.forEach(m=>{
                    m.addEventListener("click", ()=>{
                        modal.style.display = "none"
                    })
                })

                let title = m.getAttribute("data-title")
                let content = m.getAttribute("data-content")
                var url = m.getAttribute("data-url")
                var id = m.getAttribute("data-id")

                let modalSaveBtn = document.querySelector(".ik-save-modal")
                var titleInput = document.querySelector("#editTitle")
                var contentInput = document.querySelector("#editContent")

                titleInput.value = title
                contentInput.value = content



                modalSaveBtn.addEventListener("click", ()=>{
                    var regexTitle = /^[A-Z][a-z.]{2,19}$/
                    var regexContent = /^[A-Z][a-z .A-Z0-9]{2,254}$/


                    var er1 = checkRegex(regexTitle, titleInput, document.querySelector("#errorTitle"), "Title min length 3 first letter uppercase max length 20")
                    var er2 = checkRegex(regexContent, contentInput, document.querySelector("#errorContent"), "Content min length 3 first letter uppercase max length 255")

                    if(er1 + er2 == 0){
                        if(url === "category"){
                            url = "/editCategory"

                        }

                        if(url === "tag"){
                            url = "/editTag"
                        }
                        var data = {
                            "title" : titleInput.value,
                            "content": contentInput.value,
                            "id": id
                        }
                        fetch(url, {
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
                                if(data == "success"){
                                    m.parentElement.parentElement.previousElementSibling.innerText =  titleInput.value
                                }
                                if(data.errors){
                                    if(data.errors.title)
                                        document.querySelector("#errorTitle").innerText= data.errors.title
                                        document.querySelector("#errorTitle").style.backgroundColor = "red"
                                    if(data.errors.content)
                                        document.querySelector("#errorContent").innerText= data.errors.content
                                        document.querySelector("#errorContent").style.backgroundColor = "red"
                                }

                            })
                            .catch((error) => {
                                console.log(error);
                            });
                    }


                })
            })
        })


    }
    function checkRegex(regex, input, div, message){
        if(regex.test(input.value)){
            div.innerText = ""
            return 0
        }else{
            div.innerText = message
            div.style.backgroundColor = "red"
            return 1
        }


    }
</script>
