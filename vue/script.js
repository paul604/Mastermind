var tab=[0,0,0,0];
var nb=0;

function submit(b){//change l'état du bouton submit
	if (b){
		document.getElementById('submit').disabled=false;
		bool =false;
	}else{
		document.getElementById('submit').disabled=true;
		bool =true;
	}
}

function set(color){ //ajoute une couleur au choix
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

function unSet(i){//retir une couleur au choix
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

function up(indice, color){//ajoute une couleur placée précédemment au choix 
	i=indice-1;
	if(tab[i]==0){
		nb++;
		tab[i]=color;
		document.getElementsByClassName('courant')[0].getElementsByTagName("LI")[i+1].className="c"+color;
		document.forms.choix.elements[i].value=color;
		if(nb>=4){
			submit(true);
		}
	}
}
