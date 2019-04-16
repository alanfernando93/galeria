<?php
session_start();
if(!empty($_POST['salir'])){
	if(isset($_SESSION)){
		$_SESSION['inicio'] = '';
		session_destroy();
	}
}

if(empty($_SESSION['inicio'])){
	header('location: index.php');
}
$dir = array();
$archivos=array();
$ruta="";
include_once dirname(__FILE__).'/functions.php';
$dd = "";
if(isset($_GET['ruta']))
{
	$dd .= trim($_GET['ruta'])."/";
	$ruta .= trim($_GET['ruta']);
	if($_GET['ruta'] != ""){
		$r = $_GET['ruta'];
		$countRuta = strlen($r);
		$pos=0;
		for($i = $countRuta-1; $i > 0; $i--)
		{
			if( $r[$i] == '/'){
				$pos = $i;
				break;
			}
		}
		if($pos>0){
			$dirAnterior=substr($ruta,0,$pos);
		}else{
			$dirAnterior="./";
		}
	}
}
if($ruta == ""){
	$ruta_base = dirname(__FILE__)."/cd";
}
else
{
	$ruta_base = dirname(__FILE__) ."/cd".'/';
}
$dir = listar_direct($ruta_base.$ruta."/");
$archivos= getListImag($ruta_base.$dd);
initNavigation($archivos);
include_once dirname(__FILE__).'/init.php';