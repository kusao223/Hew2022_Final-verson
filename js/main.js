const button = document.getElementById("closeBtn")
// console.log(button)
// const navbox = document.getElementsByClassName("global-nav")
// function BtnOpenClose(){
//     // button.classList.add("btn-close")
//     navbox.style.backgroundColor = "red"
// }
button.addEventListener("click", () => {
    document.getElementById("global-navBox").style.right = "-1000px"
})
