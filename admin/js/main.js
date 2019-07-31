if(!document.querySelector(".log-cont")){


let collapsed=document.querySelector(".menu-collapse");
    collapsed.onclick=(e)=>{
        let page=document.getElementById("side-collapse");
        page.classList.toggle("side-collapsed");
        let page2=document.getElementById("admin-canvas");
            page2.classList.toggle("side-collapsed");
          
    }

Element.prototype.addEvent=function(event,callbk){
    this.addEventListener(event,callbk,false);
    }
Element.prototype.removeEvent=(event,callbk)=>{
    this.removeEventListener(event,callbk,false);
    }
let hideNreset=(elm,resetToval="0")=>{
    let reset=elm.querySelector(".input")
        elm.classList.remove("show")
        reset?reset.value=`${resetToval}`:"nothing to reset now";
    }


let getWeeksInMonth=(monthnum, year)=>{
    if(monthnum===0){
        return;
    }
    let month=monthnum-1;
    let first_day=new Date(year, month, 1).getDay();
    let numDays=new Date(year, month+1, 0).getDate();
     
    if(first_day > 1 && first_day< 6){ 
        // month started on Tuesday-Friday, no chance of having 5 weeks
            return 4;
        
    } else if(numDays == 31) return 5;
    else if(numDays == 30) return (first_day == 0 || first_day == 1)? 5:4;
    else if(numDays == 29) return first_day == 1? 5:4;
     } 
     
let addtodate=(date,day=0,mth=0,yr=0)=>{
        let start=new Date(date);
        let mmm=new Date(start.getFullYear()+yr,start.getMonth()+mth,start.getDate()+day);
        
        return `${mmm.getFullYear()}-${mmm.getMonth()<10?"0"+(mmm.getMonth()+1):(mmm.getMonth()+1)}-${mmm.getDate()<10?"0"+mmm.getDate():mmm.getDate()}`;
           
    }
     //event form js
     if(document.getElementById("event")){
        //run only on event page 
        
        let allday=document.getElementById("all-day");

        allday.addEvent("change",(e)=>{
            let checked=e.target.checked;
            let startTime=document.getElementById("start-time")
            let endTime=document.getElementById("end-time")
            if(checked){
                startTime.disabled=true;
                endTime.disabled=true;
            }else{
                startTime.disabled=false;
                endTime.disabled=false;
            }
            
        })
        let eventNameAsFlyer=document.getElementById("use_event_name");
        eventNameAsFlyer.addEvent("change",(e)=>{
            let checked=e.target.checked;
            let eventFlyer=document.getElementById("event-flyer-file")
            if(checked){
                eventFlyer.disabled=true;
            }else{
                eventFlyer.disabled=false;
            }
            
        })
        
  
    //hep to set min attribute of end date or time relative to the value of the start date or time
    let startDate=document.getElementById("event-date-start")
    let endDate=document.getElementById("event-date-end")    
    let untilMin=document.getElementById("until")
        startDate.addEvent("change",(e)=>{
                untilMin.min=e.target.value;
            let repeatEvent=document.getElementById("repeat-event").value.trim();
            if(repeatEvent==="yearly"){
               let ayear=addtodate(e.target.value,0,0,1)
                untilMin.min=ayear;
            }
            if(repeatEvent==="monthly"){
               let amonth=addtodate(e.target.value,0,1)
                untilMin.min=amonth;
            }
            if(repeatEvent==="weekly"){
               let aweek=addtodate(e.target.value,7)
                untilMin.min=aweek;
            }
            endDate.min=e.target.value;
            endDate.value=e.target.value;
            untilMin.value=untilMin.min;
            
        })
    let startTime=document.getElementById("start-time")
    let endtTime=document.getElementById("end-time")
        startTime.addEvent("change",(e)=>{
            //start and end date to timestamp
            let start_date_timestamp=new Date(startDate.value).getTime();
            let end_date_timestamp=new Date(endDate.value).getTime();
            
            console.log(end_date_timestamp);
            console.log(start_date_timestamp);
            if(start_date_timestamp>=end_date_timestamp){
                endtTime.min=e.target.value;       
            }else if(start_date_timestamp<end_date_timestamp){
                endtTime.removeAttribute("min"); 
            }
    })

    let until=document.querySelector(".until")
    let occurency=document.querySelector(".occurency")
    let repeat=document.querySelector(".repeat-for")
    let everyLabel=document.querySelector(".every-label")
    let weekdays=document.querySelector(".weekdays")
    let weekofmonth=document.querySelector(".weekofmonth")
    let interval=document.querySelector(".interval")

    
    let hideLabel=(lebelFor)=>{
        let label=interval.querySelector(`.${lebelFor}`)
        label!==null?label.classList.remove("show"):"";
    }
    let showLabel=(lebelFor)=>{
        let label=interval.querySelector(`.${lebelFor}`)
        label!==null?label.classList.add("show"):"";
    }
    let hideAlllabel=()=>{
        hideLabel('daily')
        hideLabel('weekly')
        hideLabel('monthly')
        hideLabel('yearly')
    }
    let hideNresetAll=()=>{
        //hide and reset values
        hideNreset(repeat)
        hideNreset(occurency,"2")
        hideNreset(until,"")
        hideNreset(interval)
        hideNreset(everyLabel)
    }

        repeat.addEvent("change",(e)=>{
        let val=e.target.value.toLowerCase();
        if(val==="0"){
            //hide & reset the needful
            hideNreset(occurency,"2")
            hideNreset(until,"")
            return;
        }
        if(val==="occurencies"){
             //hide & reset value daily
        let untilInput=until.querySelector('.input').value; 
             hideNreset(until,untilInput)
             //display proper input            
             occurency.classList.add("show")
        }else if(val==="until"){
            hideNreset(occurency,"2")
            //display proper input
            until.classList.add("show")
        }

    })
  
   
   
    let repeatEvent=document.getElementById("repeat-event");
        repeatEvent.addEvent("change",(e)=>{
            let val=e.target.value.toLowerCase().trim();
            if(val==="no_repeat"){
                hideNresetAll();
                hideNreset(weekdays)
                hideNreset(weekofmonth)
                return;
            }else if(val==="daily" || val==="weekly" || val==="monthly" || val==="yearly"){
                hideNresetAll()
                hideAlllabel();
                 //repeat
                repeat.classList.add("show")
                //repeat every
                everyLabel.classList.add("show")
                interval.classList.add("show");
                showLabel(val);

                
                    
            }else{
                console.log("unknown value");
                return
            }

            if(val==="daily"){ 
                //hide all other
                hideNreset(weekdays)
                hideNreset(weekofmonth)
                // hideNreset(everyLabel)
                interval.classList.add("show");
                untilMin.min=addtodate(startDate.value,1);
                untilMin.value=untilMin.min;
            }else if(val==="weekly"){
                //hide week of month
                hideNreset(weekofmonth)
                hideNreset(weekdays)
                let aweek=addtodate(startDate.value,7);
                    untilMin.min=aweek;
                    untilMin.value=untilMin.min;
                //show days of week


               
                weekdays.classList.add("show")
                
            }else if(val==="monthly" || val==="yearly"){
                hideNreset(weekofmonth)
                hideNreset(weekdays)
                //show both week of month and days of week

                everyLabel.classList.add("show")
                weekofmonth.classList.add("show")
                weekdays.classList.add("show")
            }

            if(val==='monthly'){
                let amonth=addtodate(startDate.value,0,1);
                    untilMin.min=amonth;
                    untilMin.value=untilMin.min;
            }
            if(val==='yearly'){

                let ayear=addtodate(startDate.value,0,0,1);
                    untilMin.min=ayear
                    untilMin.value=untilMin.min;
                }
        })
}//event form js

//sermon /bulletin form js
if(document.getElementById("sermon") || document.getElementById("bulletin")){
    let publishDate=document.querySelector(".publish")

    let publishPreset=document.getElementById("publish")
        publishPreset!==null?publishPreset.addEvent("change",(e)=>{
            let val=e.target.value.toLowerCase();  
            if(val!=="until"){
                hideNreset(publishDate,"")
                return;
            }else if(val==="until"){ 
            //hide and reset
                hideNreset(publishDate,"")
                //show proper input
                publishDate.classList.add("show")       
            }else{
                console.log("unknown value");  
            }
    }):"do nothing";
        
}//sermon/bulletin form js

}

function cleared(){
    let d=document.querySelectorAll("#msg-alert.alert");    
    d.forEach((elm,i)=>{
        setTimeout(() => {
            elm?elm.parentElement.removeChild(elm):"do nothing"   
        }, 100*i);
    })
 }

window.addEventListener("load",()=>{
   setTimeout(cleared,10000)
 },false);
 