<?php
	$formatos   = array('.jpg', '.png', '.gif');
	$directorio = 'archivos'; 
	if (isset($_POST['boton'])){
		$nombreArchivo    = $_FILES['archivo']['name'];
		$nombreTmpArchivo = $_FILES['archivo']['tmp_name'];
		$ext              = substr($nombreArchivo, strrpos($nombreArchivo, '.'));
		if (in_array($ext, $formatos)){
			if (move_uploaded_file($nombreTmpArchivo, "$directorio/$nombreArchivo")){
				echo "Felicitaciones, archivo $nombreArchivo subido exitosamente";
			}else{
				echo 'Ocurrió un error subiendo el archivo, valida los permisos de la carpeta "archivos"';
			}
		}else{
			echo 'Aquí va el mensaje que quieres mostrar cuando un usuario suba un archivo con una extensión diferente';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Como subir archivos - PHP por José Parra
	</title>
	<meta charset="utf-8">
	<meta description="Subir archivos en PHP por José Parra">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
</head>
<body>
	<div class="container mt-3">
		<div class="card">
			<div class="card-header">
				Archivos existentes en el directorio
			</div>
			<div class="card-block">
				<div class="row">
				<?php
					if ($dir = opendir($directorio)){
						while ($archivo = readdir($dir)) {
							if ($archivo != '.' && $archivo != '..'){
								//este div es para darle caché y que se vea bien en todos los dispositivos. son clases del nuevo bootstrap -> framewrok css
								echo '<div class="col-sm-3 col-xs-12">';
									echo "Archivo: <strong>$archivo</strong><br />";
									echo '<img src="'.$directorio.'/'.$archivo.'" title="imagen" alt="imagen"/>';
								echo '</div>';
							}
						}
					}
				?>
				</div>
			</div>
		</div>

		<h1>Selecciona tu archivo</h1>
		<form method="post" action="" enctype="multipart/form-data">
			<div class="form-group">
				<label for="archvio">Archivo</label>
				<input type="file" class="form-control-file" id="archvio" aria-describedby="fileHelp" name="archivo">
				<small id="fileHelp" class="form-text text-muted">Archivos permitidos (.jpg .png .gif)</small>
			</div>
			<button type="submit" class="btn btn-primary" name="boton">Subir archivo</button>
		</form>
	</div>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>