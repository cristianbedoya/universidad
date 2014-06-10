<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>inicio</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<?php echo form_open('usuario_control/validar'); ?>
	<div >
		<div >Usuario:</div>
		<div ><input type="text" name="user" value="<?= set_value('user'); ?>" size="25" /></div>
		<div >
		<?php
		if(isset($error)){
			echo "<p>".$error."</p>";
		}
		echo form_error('user');
		?>
		</div>
	</div>		
	<div >
		<div >Contraseña:</div>
		<div ><input type="password" name="pass" value="<?= set_value('pass'); ?>" size="25" /></div>
		<div ><?= form_error('pass');?></div>
	</div>
	<div >
		<div><input type="submit" value="Ingresar"></div>
				
</div>
</form>
<?php echo form_open('usuario_control/eliminar'); ?>
	<div >
		<div >Usuario:</div>
		<div ><input type="text" name="usuarioid" value="<?= set_value('usuarioid'); ?>" size="25" /></div>
		<div >
		<?php
		if(isset($error)){
			echo "<p>".$error."</p>";
		}
		echo form_error('user');
		?>
		</div>
	</div>		
	<div >
		<div><input type="submit" value="Ingresar"></div>			
</div>
</form>

<?php echo form_open('usuario_control/insertar'); ?>

		<div >cedula</div>
		<div ><input type="text" name="cedula" value="<?= set_value('cedula'); ?>" size="25" /></div>
		<div >
		<div >primer nombre</div>
		<div ><input type="text" name="nombre1" value="<?= set_value('nombre1'); ?>" size="25" /></div>
		<div >
		<div >segundo nombre</div>
		<div ><input type="text" name="nombre2" value="<?= set_value('nombre2'); ?>" size="25" /></div>
		<div >		
		<div >primer apellido</div>
		<div ><input type="text" name="apellido1" value="<?= set_value('apellido1'); ?>" size="25" /></div>
		<div >
		<div >segundo apellido</div>
		<div ><input type="text" name="apellido2" value="<?= set_value('apellido2'); ?>" size="25" /></div>
		<div >
		<div >telefono</div>
		<div ><input type="text" name="telefono" value="<?= set_value('telefono'); ?>" size="25" /></div>
		<div >
		<div >direccion</div>
		<div ><input type="text" name="direccion" value="<?= set_value('direccion'); ?>" size="25" /></div>
		<div >
		<div >correo</div>
		<div ><input type="text" name="correo" value="<?= set_value('correo'); ?>" size="25" /></div>
		<div >usuario</div>
		<div ><input type="text" name="usuario" value="<?= set_value('usuario'); ?>" size="25" /></div>
		<div >password</div>
		<div ><input type="password" name="pass" value="<?= set_value('pass'); ?>" size="25" /></div>
		<div >
		<?php
		if(isset($error)){
			echo "<p>".$error."</p>";
		}
		echo form_error('user');
		?>
		</div>
	</div>		
	<div >
		<div><input type="submit" value="Ingresar"></div>
				
</div>
</form>





</div>
</body>
</html>