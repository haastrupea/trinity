
let directions={
    LEFT:"left",
    RIGHT:"right"
}
let getnext=()=>{
    let active=document.querySelector(".slide-item.active");
        return active.nextElementSibling===null?document.querySelector(".slide-item:first-of-type"):active.nextElementSibling;
}
let getprev=()=>{
    let active=document.querySelector(".slide-item.active");
        return active.previousElementSibling===null?document.querySelector(".slide-item:last-of-type"):active.previousElementSibling;
}
let initPrevNextElm=(direction={})=>{
    if(direction.RIGHT){
        getprev().classList.add("prev-slide")
    }
    if(direction.LEFT){
        getnext().classList.add("next-slide");
    }
}
let slideLeft=()=>{
    let nextElm= document.querySelector(".next-slide")
    let activeElm= document.querySelector(".slide-item.active")
        activeElm.classList.add("left-slide")
        nextElm.classList.add("left-slide")
    }
let slideRight=()=>{
    let activeElm= document.querySelector(".slide-item.active")
    let prevElm= document.querySelector(".prev-slide")
        activeElm.classList.add("right-slide")
        prevElm.classList.add("right-slide")
    }
let next=()=>{
    let nextElm= document.querySelector(".next-slide")
    let activeElm= document.querySelector(".slide-item.active")
    let prevElm= document.querySelector(".prev-slide")
        activeElm.className="slide-item"
        prevElm?prevElm.className="slide-item": null;
        nextElm?(nextElm.className="slide-item active" ):null;
        initPrevNextElm({LEFT:"left"})     
}

     //make next and prev elm
    initPrevNextElm({LEFT:"left"});
    setInterval(()=>{
    slideLeft();
    setTimeout(next,1000);
    },20000)