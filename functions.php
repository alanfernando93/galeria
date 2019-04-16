<?php
function listar_direct($path)
{
	// abrir un directorio y listarlo recursivo
	$obj = array();
	if (is_dir($path)) {
		if ($dh = opendir($path)) {
			while (($file = readdir($dh)) !== false) {
				if (is_dir($path . $file) && $file!="." && $file!=".."){
					$obj[]=$file;
				}
			}
		}
		closedir($dh);
	}else{
		echo "<br>No es ruta valida";
	}
	return $obj;
}
function getListImag($path)
{
	// Directorio del cuál vamos a extraer las im
	// Extracción de imágenes. Ver http://www.php.net/readdir
	$photos = array();
	$dh = opendir($path);
	while ( ($file = readdir($dh)) !== false) {
		if(substr($file,-4) == '.jpg' || substr($file,-4) == '.bmp' || substr($file,-4) == '.png' || substr($file,-4) == '.gif') {
			$photos[] = $file;
		}
	}
	closedir($dh);
	return $photos;
}
function initNavigation($array){
	//parte 1:
	global  $pag_ant,$pag_act,$pag_ult,$pag_sig,$image_a_mostrar,$imagen_a_empezar,$imagen_a_terminar,$total_imagenes;
	$imagen_a_empezar =0;
	$imagen_a_terminar=0;
	$total_imagenes=count($array);
	$image_a_mostrar=30;
	//estos valores los recibo por GET
	if(isset($_GET['pag'])){
			$imagen_a_empezar=($_GET['pag']-1)*$image_a_mostrar;
		    $imagen_a_terminar=$imagen_a_empezar+$image_a_mostrar-1;
		    $pag_act=$_GET['pag'];
		//caso contrario los iniciamos
	}else{
		$imagen_a_empezar=0;
		$imagen_a_terminar=$imagen_a_empezar+$image_a_mostrar-1;
		$pag_act=1;
	}
	//parte 2: determinar numero de paginas
	$pag_ant=$pag_act-1;
	$pag_sig=$pag_act+1;
	$pag_ult=$total_imagenes/$image_a_mostrar;
    $residuo=$total_imagenes%$image_a_mostrar;	
	if($residuo>0) $pag_ult=floor($pag_ult)+1;
}