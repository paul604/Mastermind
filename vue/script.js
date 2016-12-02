var tab=[0,0,0,0];
var nb=0;

function submit(b){
	if (b){
		document.getElementById('submit').disabled=false;
		bool =false;
	}else{
		document.getElementById('submit').disabled=true;
		bool =true;
	}
}

function set(color){
	for (i = 0; i < tab.length; i++) {
		if(tab[i]==0){
			nb++;
			tab[i]=color;
			//console.log(document.getElementsByClassName('courant')[0].getElementsByTagName("LI")[i]);
			document.getElementsByClassName('courant')[0].getElementsByTagName("LI")[i+1].className="c"+color;
			document.forms.choix.elements[i].value=color;
			if(nb>=4){
				submit(true);
			}
			break;
		}
	}
}

function unSet(i){
	i=i-1
	if(tab[i]!=0){
		nb--;
		tab[i]=0;
		document.getElementsByClassName('courant')[0].getElementsByTagName("LI")[i+1].className="c0";
		if(nb<4){
			submit(false);
		}
	}
}
