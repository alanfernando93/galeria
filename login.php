<?php
$username = "$usuario,$contrase�a";
$fp = fopen('contactos.txt','r');
if (!$fp) {echo 'ERROR: No ha sido posible abrir el archivo. Revisa su nombre y sus permisos.'; exit;}

$loop = 0; // contador de l�neas
while (!feof($fp)) { // loop hasta que se llegue al final del archivo
	$loop++;
	$line = fgets($fp); // guardamos toda la l�nea en $line como un string
	// dividimos $line en sus celdas, separadas por el caracter |
	// e incorporamos la l�nea a la matriz $field
	$field[$loop] = explode (',', $line);
	// generamos la salida HTML
  	if ($username == trim($field[$loop][0]).','.trim($field[$loop][1]))
  	{
	  	$fil = trim($field[$loop][0]).','.trim($field[$loop][1]);  	
	  	break;
  	}
	//echo $fil;
	$fp++; // necesitamos llevar el puntero del archivo a la siguiente l�nea
}
fclose($fp);

