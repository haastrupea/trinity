//countdown

let dayIntElm=document.getElementById("day-int")
let hourIntElm=document.getElementById("hour-int")
let minuteIntElm=document.getElementById("minute-int")
let secondIntElm=document.getElementById("second-int")
let countdown=document.querySelector(".countdown")
// countdown to date from database
let countDownTo = new Date("may 5, 2019 24:00:00").getTime();

let timer=setInterval(()=>{
   let moment = new Date().getTime();
   let timeStamp = countDownTo - moment;

   //calc for day, hr, min and sec
   let dy=Math.floor(timeStamp/ (1000 * 60 * 60 * 24));
   let hr=Math.floor((timeStamp%(1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
   let min=Math.floor((timeStamp % (1000 * 60 * 60)) / (1000 * 60));
   let sec=Math.floor((timeStamp % (1000 * 60)) / 1000);

   if(dy<0 && hr<0 && min<0 && sec<0){
      clearInterval(timer);
      return;
   }

dayIntElm.innerHTML=(dy<10?"0":"")+dy+(dy>1?"<small>Days</small>":"<small>Day</small>");
hourIntElm.innerHTML=(hr<10?"0":"")+hr+(hr>1?"<small>Hours</small>":"<small>Hour</small>");
minuteIntElm.innerHTML=(min<10?"0":"")+min+(min>1?"<small>Minutes</small>":"<small>Minute</small>");
secondIntElm.innerHTML=(sec<10?"0":"")+sec+(sec>1?"<small>Seconds</small>":"<small>Second</small>");


if(dy===0 && hr===0 && min===0 && sec<10){
   countdown.classList.add("secondsdown");
}
if(dy<=0 && hr<=0 && min<=0 && sec<=0){
   countdown.classList.replace("secondsdown","live");
   clearInterval(timer);
   return;
}

},1000)