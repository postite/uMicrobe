package microbe.comps.atoms;

using thx.Dates;
import thx.TimePeriod;
import microbe.comps.Atom;
import microbe.Microbe;
import ufront.MVC;

#if js
import js.html.*;
#end
typedef CalendarData={
	monthDays:Array<Int>,
	month:String,
	monthBefore:String,
	monthAfter:String,
	year:String,
	jours:Array<String>,
}

class Calendar<T:{n:String,v:Date}> extends Atom<T> implements Microbe<T>{
	

	#if js
	var me:js.html.DivElement;
	
	var selected:js.html.DivElement;
	#end
	var selectedDate:Date;
	var curDate:Date;
	var curMonth:Int;
	var curYear:Int;
	var curDay:Int;
	var calendarData:Calendar.CalendarData;

	static var mois=["Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Décembre"];
	static var jours=["lundi","mardi","mercredi","jeudi","vendredi","samedi","dimanche"];

	public function new(d:T,name:String,?classes:Array<String>){
		super(d,name,classes);

		if(d.v!=null)
		curDate=d.v;
		else
		curDate=Date.now();

		curDay=curDate.getDate();
		curYear=curDate.getFullYear();
		curMonth=curDate.getMonth();

		calendarData=cast {
			monthDays:[],
			month:curMonth,
			monthBefore:curMonth-1,
			monthAfter:curMonth+1,
			year:curYear,
			jours:["lun","mar","mer","jeu","ven","sam","dim"]
		};

	}

	// microbe methods
	// 
	// 
	public function render():String{

		var buf= new StringBuf();
		buf.add(
				'<div ${getId()} class="calendar">');
		buf.add(
				'<div class="nav">
				<div class="mois before">${calendarData.monthBefore}</div>
				<div class="mois">${calendarData.month}</div>
				<div class="mois after">${calendarData.monthAfter}</div>
				</div>
				');
			buf.add('<div class="monthBox">');
		for(jour in calendarData.jours )	
			buf.add('
				<div class="cell jours">
				$jour
				</div>'
				);
		for(day in calendarData.monthDays )
		buf.add('
				<div class="cell" data-id="$day">
				${(day!=0)? Std.string(day): ""}
				</div>'
				);
		
		buf.add('</div>');
		buf.add('</div>');
		return buf.toString();
	}


	public function execute(ctx:HttpContext):Void{
		#if js

		untyped console.log("calendar execute");
		untyped console.log(this.data);
		create();
		#end
	}

	 override public function setData(d:T):Calendar<T>{

		return this;
	}

	override public function getData():T{

		return cast {n:this.name ,v:(this.selectedDate!=null)? this.selectedDate:this.curDate};
	}

	#if js
	 public function getValue(?e):Date{

		if(untyped(e.target).dataset.id!=null)
		select(Std.parseInt(untyped(e.target).dataset.id));
		return this.selectedDate;

	}



	public function create(?parentNode:Element):DivElement{

		me =  cast js.Browser.document.getElementById(this.id);
		reinit();

		if(parentNode!=null)
		parentNode.appendChild(me);

		return me;
	}
	
	public function reinit(){
		calendarData=getMonthDays(curMonth);
		me.innerHTML=render();
		untyped console.log(calendarData);
		if(selected!=null)toggle(selected);
		selected=cast me.querySelector('.cell[data-id="$curDay"]');
		var cal= me.querySelector(".calendar");
		// cal.style.width=700+"px";
		// for (a in me.querySelectorAll(".cell")){
		// 	untyped a.style.width=(cal.style.width/7);
		// 	untyped a.style.width=(cal.style.width/6);
		// } 
		var inactives=cast me.querySelectorAll('.cell[data-id="0"]');

		trace( "selected="+selected +"-"+curDay);
		toggle(selected);
		toggleInactives(inactives);
		
		me.addEventListener("click",getValue);
		me.querySelector(".mois.before").addEventListener("click",jumpMonth.bind(_,-1));
		me.querySelector(".mois.after").addEventListener("click",jumpMonth.bind(_,1));
		//setData(m);
	}
	

	function select(day:Int){
		toggleSelected(day);
		curDay=day;
		selectedDate=parseDate(day);
		trace( 'selected=$selectedDate');
	}

	function parseDate(day:Int):Date{
		return Dates.create(curYear,curMonth,curDay);
	}

	function getMonthDays(month:Int):CalendarData{
		trace( month);
		

		var debut= new Date(curYear,month,1,0,0,0);
		trace( "yo"+ curYear + month);
		var days= [for (m in 1...debut.daysInThisMonth()+1) m];
		trace( "yo");
		var firstDay= debut.getDay();
		var lastDay=days[days.length-1];
		trace("lastDay ="+lastDay );
		var fin=new Date(curYear,month,lastDay,0,0,0);
		trace( "lastDay="+fin.getDay());
		for (avant in 0...firstDay-1)days.unshift(0);
		while(days.length<(7*6))days.push(0);
		trace( 'firstDay=$firstDay');
		calendarData.monthDays=days;
		calendarData.month=mois[debut.jump(TimePeriod.Month,0).getMonth()];
		calendarData.monthBefore=mois[debut.jump(TimePeriod.Month,-1).getMonth()];
		calendarData.monthAfter=mois[debut.jump(TimePeriod.Month,1).getMonth()];
		
		curMonth=debut.getMonth();
		curYear=debut.getFullYear();
		return calendarData;

	}
	

	function jumpMonth(e:Event,dir:Int){
		curMonth=curMonth+dir;
		reinit();
	}

	function toggleSelected(month:Int){
		toggle(selected);
		selected=cast me.querySelector('.cell[data-id="$month"]');
		toggle(selected);
	}

	function toggle(sel:js.html.DivElement){
		sel.classList.toggle("selected");
	}
	function toggleInactives(sel:NodeList){
		for (i in 0 ... sel.length){
			cast(sel.item(i),Element).classList.toggle("inactive");
		}
	}
	
	#end
	public static function getMois(d:Date):String{
		return mois[d.getMonth()];
	}
	public static function getJour(d:Date):String{
		return jours[d.getDay()-1];
	}

}
// class Cell(){

// 	function new(){

// 	}
// 	function render(){

// 	}

//}