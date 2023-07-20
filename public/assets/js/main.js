window.onload=function(){
    let addImgBtn = document.querySelector(".ik-plus")
    addImgBtn.addEventListener("click", e=>{
        let pictureForm = document.querySelector("#accountPictureForm")
        if(pictureForm.style.display=="none")
            pictureForm.style.display="block"
        else
            pictureForm.style.display="none"

    })

    let showAccInfo = document.querySelector(".ik-plus-info")
    showAccInfo.addEventListener("click", e=>{
        let accInfo = document.querySelector(".accountInfo")
        if(accInfo.style.display=="none")
            accInfo.style.display="block"
        else
            accInfo.style.display="none"
    })
    let showPassword = document.querySelector(".ik-plus-password")
    showPassword.addEventListener("click", e=>{
        let passReset = document.querySelector(".passwordInfo")
        if(passReset.style.display=="none")
            passReset.style.display="block"
        else
            passReset.style.display="none"
    })

}
