const sttb=document.getElementById('closeBtn')

sttb.addEventListener('click',()=>{
    window.scrollTo({top:0,behavior:'smooth'})
})

window.addEventListener('scroll', scroll_event);

const scroll_event=()=>{
    if(window.pageYOffset > 400){
        sttb.style.opacity='1';
    }else if(window.pageYOffset < 400){
        sttb.style.opacity="0";
    }
}

// function scroll_event(){
//     if(window.pageYOffset > 400){
//         sttb.style.opacity='1';
//     }else if(window.pageYOffset < 400){
//         sttb.style.opacity="0";
//     }
// }