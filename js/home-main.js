let nav = document.getElementById( "navbar" );

let navscroll=() => {
   let scr=document.scrollingElement.scrollTop;
   let scrpos=nav.offsetHeight+50;
    if(scr>scrpos){
       nav.classList.add("scrolled")
    }else{
       nav.classList.remove("scrolled","deactivate")
   }
    if(scr>(scrpos+100)){
       nav.classList.add("activate")
   }else{
    nav.classList.replace("activate","deactivate")
   }
  
  }

  navscroll();
   window.addEventListener( "scroll", ()=>{
      navscroll()
    },false )
