var canvas = document.querySelector(".canvas");
var signup = document.querySelector(".signup");
var signin = document.querySelector(".signin");
var canvassignin = document.querySelector(".canvassignin")
function unset(e){
    canvas.classList.toggle("hide");
}
function unset2(e){
    canvassignin.classList.toggle("hide")
}
signin.addEventListener("click",unset2);
signup.addEventListener("click",unset);
canvassignin.addEventListener("click",function(e){
    if(e.target == e.currentTarget){
        unset2(e);
    }
})
canvas.addEventListener("click",function(e){
    if(e.target == e.currentTarget){
        unset(e);
    }
});

const passField = document.querySelector(".passwordsignin input");
       const showBtn = document.querySelector(".show-btn i");
       showBtn.onclick = (()=>{
         if(passField.type === "password"){
           passField.type = "text";
           showBtn.classList.add("hide-btn");
         }else{
           passField.type = "password";
           showBtn.classList.remove("hide-btn");
         }
       });
