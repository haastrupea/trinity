let daysInMonth=(year=new Date().getFullYear(),month=new Date().getMonth())=>{
    return new Date(year, month+1, 0).getDate()
}

let getMonthStartDay=(year=new Date().getFullYear(),month=new Date().getMonth())=>{
    let d=new Date(year,month,1)
    let wdTxt=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]
    return {num:d.getDay(),str: wdTxt[d.getDay()] }
}

let monthCalender=(year,month)=>{
    let days=daysInMonth(year,month);
    let calender=[];
    let week=0;
    let wkarr=[];
//let pad the first week to achieve an offset
for (let i = 0; i <getMonthStartDay(year,month).num; i++) {
        wkarr.push(0);    
    }

for (let i = 1; i <= days; i++) {
        
        wkarr.push(i);
    if(wkarr.length===7){
        //to handle month that start on saturday(6)
        calender[week]=wkarr
        wkarr=[];
        week++
    }
    calender[week]=wkarr
}
return calender
}

let renderCalender=(callbk,year,month)=>{
    if(month !==undefined){
        if(month<1 || month>12 || !Number.isInteger(month)){
            return;
        }
       month--
    }
    let tbody=document.createElement("tbody")
    let cal=monthCalender(year,month);        
        cal.forEach( (week,i)=>{
            let tr=document.createElement("tr")
                tr.setAttribute("id",`week-${i+1}`)
                tr.setAttribute("class","week")
                for (let k = 0; k < week.length; k++) {
                    const element = week[k];
                    if(element===0){
                    let td=document.createElement("td")
                        tr.appendChild(td)
                    }else{
                        let td=document.createElement("td")
                            td.textContent=element.toString()
                            td.setAttribute("id",`day-${element}`)
                            td.setAttribute("class","day");
                            if(new Date().getFullYear()===year && new Date().getMonth()===month && element===new Date().getDate()){
                                td.classList.add("today");
                            }
                            td.addEventListener("click",callbk,false)
                            tr.appendChild(td)
                    }
                }
            tbody.appendChild(tr)
        })
    let table=document.getElementById("date-table");
    let oldtbody=table.querySelector("tbody");
    table.replaceChild(tbody,oldtbody)
}

let initCalender=(callbk,pickerDomloc)=>{
    let selectyear=document.createElement("select");
        selectyear.setAttribute("id","year")
        selectyear.setAttribute("class","form-control-sm")
        selectyear.setAttribute("name","year")
    let curdate=new Date()
    // init year select options
    let thisyear=curdate.getFullYear()
    let Docfragyr=document.createDocumentFragment();
        for(let i=thisyear-50;i<=(thisyear+100);i++){
            let option=document.createElement("option");
            option.value=`${i}`;
            if(i===thisyear){
                //sellect current year as the default
                option.selected=true;
            }
            option.textContent=`${i}`
            Docfragyr.appendChild(option);
        }
        selectyear.append(Docfragyr)
    
    //handle month select populate
    let months=["January","February","March","April","May","June","July","August","September","October","November","December"]
  let selectmonth=document.createElement("select");
      selectmonth.setAttribute("id","month")
      selectmonth.setAttribute("class","form-control-sm")
      selectmonth.setAttribute("name","month")
  let thismonth=curdate.getMonth()
  let Docfragmonth=document.createDocumentFragment();
        months.forEach((month,i) => {
            let option=document.createElement("option");
            option.value=`${i}`;
            option.textContent=month
            if(i===thismonth){
                option.selected=true
            }
            Docfragmonth.appendChild(option)
        });
       selectmonth.appendChild(Docfragmonth)

//handle form rendering
let formSelects=[selectyear,selectmonth];
let formWrp=document.createElement("div")
    formWrp.setAttribute("class","date-header")
let form=document.createElement("form")
    form.method="post";
    form.action="#";
    form.setAttribute("class","form-row justify-content-around align-items-center");
    formSelects.forEach(select=>{
        let formGrp=document.createElement("div")
            formGrp.setAttribute("class","form-group")

        let label=document.createElement("label")
            label.setAttribute("for",select.id);
            label.textContent=select.id;
            formGrp.appendChild(label)
            formGrp.appendChild(select)
        form.appendChild(formGrp)
    })

    formWrp.appendChild(form)
    
//handle calendar table rendering
let weekdays=["Sun","Mon","Tue","Wed","Thur","Fri","Sat"]
let tableWrp=document.createElement("div")
    tableWrp.setAttribute("class","date-body")
let table=document.createElement("table");
    table.setAttribute("id","date-table");
let thead=document.createElement("thead");
let tbody=document.createElement("tbody");
let thtr=document.createElement("tr");
    weekdays.forEach(weekday=>{
        let th=document.createElement("th");
            th.setAttribute("id",weekday);
            th.setAttribute("class","weekdays");
            th.textContent=weekday;
            thtr.appendChild(th)
    })
    thead.appendChild(thtr)
    table.appendChild(thead)
    table.appendChild(tbody)
    tableWrp.appendChild(table)

//datepickerinner contains both the form and table wrp
let datepickerinner=document.createElement("div")
    datepickerinner.setAttribute("class","date-container")
    datepickerinner.appendChild(formWrp)
    datepickerinner.appendChild(tableWrp)

    //datepicker footer
let datepickerfooter=document.createElement("p")
    datepickerfooter.setAttribute("class","date-footer")
    datepickerfooter.textContent=`© ${new Date().getFullYear()} designed by`
let datefooterlink=document.createElement("a")
    datefooterlink.setAttribute("href","#");
    datefooterlink.textContent=" Wikytek";
    datepickerfooter.appendChild(datefooterlink)

    datepickerinner.appendChild(datepickerfooter)

     //prevent contextmenu on date
     datepickerinner.addEventListener("contextmenu",(e)=>{
        e.preventDefault()
    },false)//contextmenu event end

//append constructed ddatepicker to provided location in the dom
//where to insert datepickerinner
pickerDomloc.appendChild(datepickerinner)

    //handle day of the month populating i.e content of the tbody
    //this is seperated as the content changes as year and month changes
    renderCalender(callbk,thisyear,curdate.getMonth()+1)

let callRenderCallender=(e)=>{
        let year=Number(selectyear.value);
        //converted from 0 to 1 base index by +1
        let month=Number(selectmonth.value)+1;      
        renderCalender(callbk,year,month)

    }
selectyear.addEventListener("change",callRenderCallender,false)
selectmonth.addEventListener("change",callRenderCallender,false)
}

let clear=(elm)=>{
    elm.parentElement.removeChild(elm)
}

let saveChanges=function(e){
    let datepickerWrp= document.querySelector(".date-container")
    let domloc=datepickerWrp.parentElement;
    
    //reset previous active day
    let active=document.querySelector(".day.active")
        active? active.classList.remove("active"):"";
    //select current target as active day
        e.target.classList.add("active");

//this call bk is the entry point into values entered in a calender
    let dateyear=domloc.querySelector("#year").value;
    let datemonth=Number(domloc.querySelector("#month").value)+1;
    let dayselected=e.target.innerHTML;
    
    //let update the input field
    let dateInput=domloc.querySelector(`input[data-input="date"]`)

        dateInput.value=`${dayselected<10?"0"+dayselected:dayselected}-${datemonth<10?"0"+datemonth:datemonth}-${dateyear}`


        //clear the dom up of date picker
        clear(datepickerWrp)
}

let fillpickerAt=(domloc)=>{
    let dateInput=domloc.querySelector(`input[data-input="date"]`).value
    if(dateInput){
        let inputevalue=dateInput.split("-")
            let year=inputevalue[2]
            let month=inputevalue[1]
        let yearSelect=domloc.querySelector(`#year option[value="${inputevalue[2]}"]`)

            yearSelect.selected=true;
        let monthSelect=domloc.querySelector(`#month option[value="${inputevalue[1]-1}"]`)
            monthSelect.selected=true;
        
        renderCalender(saveChanges,year,month)
        console.log(month)
        console.log(year,"y")
    }
}
let showDatepicker=function(e){
    //dom loc
    let domloc=e.target.parentElement;
    let datepickerWrp= domloc.querySelector(".date-container");
    //render date picker when user needed it
    datepickerWrp===null?initCalender(saveChanges,domloc):clear(datepickerWrp);
    //let us renter value ,if any,of date input into the date picker
    fillpickerAt(domloc)
    
}
   
//set all date to default values to current date;

    //target all the carets on the input btn with id date-picker
let datepick=document.querySelectorAll(`#data-picker span`)
    datepick!==null?datepick.forEach(pick=>{
        pick.addEventListener("click",showDatepicker,false)
    }):"don nothing"