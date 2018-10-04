
// JavaScript Document
//ritorna true se Expression è un numero, false altrimenti
	var IsNumber = function(Expression)
	{
		Expression = Expression.toLowerCase();
		RefString = "-0123456789.,";
		
		if (Expression.length < 1) 
			return (false);
		
		for (var i = 0; i < Expression.length; i++) 
		{
			var ch = Expression.substr(i, 1);
			var a = RefString.indexOf(ch, 0);
			if (a == -1)
				return (false);
		}
		return(true);
	}