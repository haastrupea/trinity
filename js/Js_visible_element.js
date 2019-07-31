class Jsv{
    constructor(elms){
        this.points=elms
        this.srcElm=document.scrollingElement || document.documentElement;
        this.oldScroll=this.srcElm.scrollTop;
        this.vh=window.innerHeight;
        this.triggeredPoint=[];
    }
    getDirection(){
        //get called when scroll event fires
        //let us get the direction
        let newScroll=this.srcElm.scrollTop;
            if(this.oldScroll>newScroll){
                this.direction="up";
            }else{
                this.direction="down";
            }

            this.oldScroll=newScroll;
    }
    entryPoint(callbk){
        //register the callbk into the object;
    this.callbk=callbk;
        //then get the ball rolling;
        //call handler(hanler call this.callbk)
            this.handler();
            //add hander to scroll event
            window.onscroll=()=>{
                this.handler();
            }
            window.onresize=()=>{
                this.vh=window.innerHeight;
            }
    }
    handler(){
             this.getDirection();
        let triggered = this.pullTriger ( this.packager ( this.points ) );
            triggered.sort((a,b)=>a.trigerPoint-b.trigerPoint)
            .forEach((point,k) => {
                this.callbk.call(point,this.direction)
            });
    }
    pullTriger(packagePoints){
           for (const key in packagePoints) {
               if (packagePoints.hasOwnProperty(key)) {
                   const point = packagePoints[key];
                   if(point.trigerPoint<=(this.srcElm.scrollTop) ){
                       this.triggeredPoint.push(point);
                   }
               }
           }
           return this.triggeredPoint;
   }
   packager(points){
        let scrollTop=this.srcElm.scrollTop;
        let offsetBy=Math.ceil(this.vh*(95/100));
    //let package all points every time there is a scroll
        let packagedPoints={};
        points.forEach( (point,i)=>{
                let boxTop=point.getBoundingClientRect().top;
                let trigerPoint=Math.ceil((boxTop+scrollTop)-offsetBy);
                    packagedPoints[`point-${i}`]={
                        elm:point,trigerPoint:trigerPoint
                    }
                })
                return packagedPoints;
    }
}



let el=document.querySelectorAll(".animate");

new Jsv(el).entryPoint(function(direction){
   if(direction==="down" && !(this.elm.classList.contains("animated"))){

    this.elm.classList.add("item-animate","fire");
    
    setTimeout(()=>{

        let allElm=document.querySelectorAll(".animate.item-animate");
            allElm.forEach((elm,i)=>{
                setTimeout(()=>{
                    // elm. style.border="2px solid red"
                    let effect = elm.getAttribute('data-effect');
                    if ( effect ) {
                        elm.classList.add(effect,'animated');
                    } else {
                        elm.classList.add('fadeInUp','animated');
                    }
                    elm.classList.remove("item-animate");
                },(i<5?i*150:i*50));
            });
    },100);
   }
});
