<?php 
if(!empty($_POST['salir'])){
	if(isset($_SESSION)){
		$_SESSION['inicio'] = '';
		session_destroy();
	}else{
		session_start();
	}
}

if(empty($_SESSION['inicio'])){
	header('location: index.php');
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/bootstrap.min.css" />	
		<style>
		body{margin:0;padding:0;background:#fff;}
		.slideshow img{opacity: 0.5}
		.slideshow img:hover{opacity:1;}
		#file-explorer-container nav ul{list-style:none;padding:0;margin:0;}
		#file-explorer-container nav ul li{}
		#file-explorer-container nav ul li a{display:block;color:#FFA500;}
		
		</style>
		<title>Libreria de Imagenes</title>
	</head>
	<body>	
	<form action="" method="post">
	<div id="" class="wrap">
		<header style="text-align:center;">
		      <div style='color:#008000'>
		      	<h1>Libreria de Imagenes</h1>
			  </div>
		   <button name="salir" value="1">Salir</button>
		</header>
		<br>
		<?php
			if(empty($archivos)){
				echo "<div style='color:#008000;text-align:center;'>";
				if($_GET){
					echo "Vacio";
				}else{
					echo "Selecciona una carpeta";
				}
				echo "</div>";
			}
			?>	
		<div class="row">
			<div id="the-image-container" class="col-md-4">
				<div id="show" class="text-center">
					<div id="copy">
					</div>
				</div>
			</div><!-- end id="the-image-container" -->
			<div id="images-container" class="text-center col-md-6">
		   		<div class="slideshow" id="imag">
		   		<?php 
					$col = 0;
					if(!empty($archivos))
					{
						echo "<table>";
						while($imagen_a_empezar <= $imagen_a_terminar)
						{
							if($col==0){
								echo "<tr style='padding: 2'>";
							}
							//si se pasa de total de imagenes salir de bucle
							if($imagen_a_empezar >= $total_imagenes) break;
							echo "<td style='padding : 2'>";
							?>						
							<img src="<?php echo "cd/".$ruta."/".$archivos[$imagen_a_empezar]?>" style="width: 100px ; height: 100px ; cursor: pointer;" onclick="envio('<?php print "cd/$ruta/$archivos[$imagen_a_empezar]";?>');"/>
							<?php
							echo "</td>";
							if($col == 5){
								$col = -1;
								echo "</tr>";
							}
							$col++;
							$imagen_a_empezar++;
						}
						echo "</table>";
						echo "<br>";
					}
				?>
				</div>
			</div><!-- end id="images-container" -->
			<div id="file-explorer-container" class="col-md-2">
				<nav>
					<ul>
						<?php
						if(!empty($dirAnterior)){
							if($dirAnterior != "./"){
								echo "<li><a href='gelery.php?ruta=$dirAnterior'>Atras</a></li>";
							}else{
								echo "<li><a href='gelery.php'>Atras</a></li>";
							}
						}
						foreach ($dir as $d){
							if(!empty($ruta)) {
								echo "<li><a href='gelery.php?ruta=$ruta/$d'>$d</a></li>";
							}else{
								echo "<li><a href='gelery.php?ruta=$d'>$d</a></li>";
							}
						}
						?>
					</ul>
				</nav>
			</div>
		</div><!-- end class="row" -->
		<div style="text-align:center;">
			<?php if(!empty($archivos)):?>
				<a href="gelery.php?ruta=<?php print $ruta;?>" onclick="Pagina('1')">Primero</a>
				<?php if($pag_act>1):?>
					<a href="gelery.php?ruta=<?php print $ruta;?>&pag=<?php print $pag_ant?>" onclick="Pagina('<?php print $pag_ant;?>')">Anterior</a>
				<?php endif;?>
				<strong>Pagina <?php print $pag_act."/".$pag_ult;?></strong>
				<?php if($pag_act<$pag_ult):?>
					<a href="gelery.php?ruta=<?php print $ruta;?>&pag=<?php print $pag_sig;?>" onclick="Pagina('<?php print $pag_sig;?>')">Siguiente</a>
				<?php endif;?>
				<a href="gelery.php?ruta=<?php print $ruta;?>&pag=<?php print $pag_ult;?>" onclick="Pagina('<?php print $pag_ult;?>')">Ultimo</a>
			<?php endif;?>
		</div>
		<footer style="color:#008000;text-align:center;">
		Todos los Derechos Reservados - Copyright (<?php $hoy = getdate(); echo $hoy['year'];?>), 500sitios.com
		</footer> 
	</div><!-- end id="container" -->
   </form>
   </body>	
	<script src="js/clipboard/dist/clipboard.min.js"></script>
	<script>
	var clipboard = new Clipboard('.btn');
	clipboard.on('success', function(e) {
        console.log(e);
    });
	clipboard.on('error', function(e) {
        console.log(e);
    });

    function envio(dir){
		var div = document.getElementById('show');
		div.innerHTML="";
		var d = document.createElement('div');
		d.id="copy";
		var imag = document.createElement("IMG");
		imag.name="mostrar";
		imag.src = dir;
	    imag.className = "center-block img-responsive";
		div.appendChild(imag);
		div.appendChild(d);
		d.innerHTML = "<p name='copy' class=\"text-center\"><input class='btn btn-default' type='button' data-clipboard-text='"+imag.src+"' value='Copiar la URL de la imagen' /></p>"
					 //+"<p name='viewURL' class=\"text-center\"><input class='btn btn-default' type='button' onclick=\"window.prompt('Copia este texto (Presione Ctrl + C) :','"+imag.src+"');\" value='Mostrar la URL de la imagen'  /></p>"
					 +"<p name='viewURL' class=\"text-center\"><input class='btn btn-default' type='button' onclick=\"window.prompt('Copie este texto (presione Ctrl + C)','"+imag.src+"');\" value='Mostrar la URL de la imagen'  /></p>"
					 +"<p name='viewImag' class=\"text-center\"><input class='btn btn-default' type='button' onclick=\"window.open('"+imag.src+"','View Imag','width="+screen.width+"px, height="+screen.height+"px')\" value='Mostrar imagen' /></p>";
	}    
	function Pagina(nropagina){
		ajax=objetoAjax();
		url = "gelery.php?ruta=<?php print $ruta;?>";
		if(nropagina != 1){
			url += "&pag="+nropagina;
		}
		ajax.open("GET", url);
		ajax.onreadystatechange=function() {
		  	if (ajax.readyState==4) {
		 }
		}
		ajax.send(null);
	}
	function objetoAjax(){
		 var xmlhttp=false;
		  try{
		   xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		  }catch(e){
		   try {
		    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		   }catch(E){
		    xmlhttp = false;
		   }
		  }
		  if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		   xmlhttp = new XMLHttpRequest();
		  }
		  return xmlhttp;
		}
	</script>
</html>
