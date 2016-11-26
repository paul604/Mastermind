var tab=[0,0,0,0];
function set(color) {
	for (i = 0; i < tab.length; i++) {
		if(tab[i]==0){
		tab[i]=color;
		document.getElementsByClassName('courant')[i].id="c"+color;
		document.forms.choix.elements[i+''].value=color;
		break;
		}
	}
}
