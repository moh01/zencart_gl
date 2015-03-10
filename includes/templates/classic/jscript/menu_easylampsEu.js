var timerEffacement = null;
var sousMenuAffiche = new Array();
sousMenuAffiche['smenuInfo']= null;
//sousMenuAffiche['unSeulSousMenu']= null;

/*function autreSousMenu(id) 
{
	return (id=='smenuInfo'?'unSeulSousMenu':'smenuInfo');
}
*/

function sousMenuEstAffiche(id) 
{
	return (sousMenuAffiche[id]	!= null);
}

function montrerSousMenu(id) 
{
//	On annule le timer si enclenché
	if (timerEffacement != null)
		annulerTimer();
//	On efface l'autre menu si affiché
//	if (sousMenuEstAffiche(autreSousMenu(id)))
//		cacherSousMenus(autreSousMenu(id));

	if (!sousMenuEstAffiche(id))
	{
		sousMenuAffiche[id]	= document.getElementById(id);
		if (sousMenuAffiche[id])
		{
			sousMenuAffiche[id].style.display = 'block';
		}
	}
}

function effacerSousMenu(id)
{
	if (sousMenuEstAffiche(id))
		if (timerEffacement == null)
			timerEffacement = window.setTimeout('cacherSousMenus("'+id+'")', 150);
}

function cacherSousMenus(id)
{
	if (sousMenuEstAffiche(id))
	{
		sousMenuAffiche[id].style.display = 'none';
		sousMenuAffiche[id] = null;
	}
}

function annulerTimer()
{
	if (timerEffacement != null)
	{
		window.clearTimeout(timerEffacement);
		timerEffacement = null;
	}
}

