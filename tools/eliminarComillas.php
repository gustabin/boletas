<?php
	//eliminar comillas simples, dobles, slash y slash invertidos	
	 function eliminarComillas($campo) {
	 	$campo=str_replace('"','',$campo);  
		$campo=str_replace("'",'',$campo);
		$campo=stripslashes($campo);
		$campo=str_replace('~','',$campo);
		$campo=str_replace('`','',$campo);
		$campo=str_replace('!','',$campo);		
		$campo=str_replace('#','',$campo);
		$campo=str_replace('$','',$campo);
		$campo=str_replace('%','',$campo);
		$campo=str_replace('^','',$campo);
		$campo=str_replace('&','',$campo);
		$campo=str_replace('*','',$campo);
		$campo=str_replace('(','',$campo);
		$campo=str_replace(')','',$campo);
		$campo=str_replace('_','',$campo);
		$campo=str_replace('=','',$campo);
		$campo=str_replace('+','',$campo);
		$campo=str_replace('[','',$campo);
		$campo=str_replace('{','',$campo);
		$campo=str_replace(']','',$campo);
		$campo=str_replace('}','',$campo);
		$campo=str_replace('\\','',$campo);
		$campo=str_replace('|','',$campo);
		$campo=str_replace(';','',$campo);
		$campo=str_replace(':','',$campo);		
		$campo=str_replace('&#8216;','',$campo);
		$campo=str_replace('&#8217;','',$campo);
		$campo=str_replace('&#8220;','',$campo);
		$campo=str_replace('&#8221;','',$campo);
		$campo=str_replace('&#8211;','',$campo);
		$campo=str_replace('&#8212;','',$campo);
		$campo=str_replace('â€”','',$campo);
		$campo=str_replace('â€“','',$campo);
		$campo=str_replace(',','',$campo);
		$campo=str_replace('<','',$campo);
		$campo=str_replace('>','',$campo);
		$campo=str_replace('/','',$campo);		
		$campo=str_replace('?','',$campo);
		$campo=str_replace('-','',$campo);
		$campo=str_replace('ª',' ',$campo);
		$campo=str_replace('¿',' ',$campo);
		$campo=str_replace('º',' ',$campo);
		$campo=str_replace('¡',' ',$campo);
		$campo=str_replace('´',' ',$campo);
		$campo=str_replace('ç',' ',$campo);
		$campo=str_replace('·',' ',$campo);
		$campo=str_replace('¨',' ',$campo);
		$campo=str_replace('Ç',' ',$campo);
		$campo=str_replace('   ',' ',$campo);
		$campo=str_replace('  ',' ',$campo);
		$campo=str_replace('  ',' ',$campo);		
		return $campo; // Devolver el resultado
		}