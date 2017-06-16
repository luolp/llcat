 function n(){
	function t(){
		s=window.innerWidth,a=window.innerHeight,h={x:0,y:a},
		c=document.getElementById("anm-canvas"),
		c.width=s,
		c.height=a,
		f=c.getContext("2d"),
		l=[];
		for(var t=0;t<.5*s;t++){
			var e=new o;
			l.push(e)
			}
		i()
	}
	function e(){
		window.addEventListener("scroll",n),
		window.addEventListener("resize",r)
	}
	function n(){
		//p=!(document.body.scrollTop>a)
	}
	function r(){
		s=window.innerWidth,
		a=window.innerHeight,
		c.width=s,
		c.height=a
	}
	function i(){
		if(p){
			f.clearRect(0,0,s,a);
			for(var t in l)
				l[t].draw()
			}
		requestAnimationFrame(i)
	}
	function o(){
		function t(){
			e.pos.x=Math.random()*s,
			e.pos.y=a+100*Math.random(),
			e.alpha=.1+.3*Math.random(),
			e.scale=.1+.3*Math.random(),
			e.velocity=Math.random()
		}
		var e=this;
		!function(){
			e.pos={},
			t()
		}(),
		this.draw=function(){
			e.alpha<=0&&t(),
			e.pos.y-=e.velocity,
			e.alpha-=5e-4,
			f.beginPath(),
			f.arc(e.pos.x,e.pos.y,10*e.scale,0,2*Math.PI,!1),
			f.fillStyle="rgba(255,255,255,"+e.alpha+")",
			f.fill()
		}
	}
	var s,a,c,f,l,h,p=!0;
	t(),
	e()
	
}
n();