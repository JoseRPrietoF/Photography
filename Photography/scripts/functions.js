function confirmar(url)
{
	if(confirm('Estas seguro de que quieres borrar?'))
	{
		window.location=url;
	}
	else
	{
		return false;
	}	
}
