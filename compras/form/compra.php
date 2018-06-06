<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/header.php";
require_once('/home/alumnos/1718/germancastro1718/public_html/proyecto/gestion/gestion_discos.php');

	$gestion = new GestionDiscos;


	if (!isset($_SESSION['email'])){
		header('Location: https://void.ugr.es/~germancastro1718/proyecto/html/register.php');
		exit();
	} 

	if (isset($_POST['id'])) {
		if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
		$disco = $gestion->get($_POST['id']);
	} else {
		header('Location: https://void.ugr.es/~germancastro1718/proyecto/index.php');
		exit();
	}
?>
<script src="./../js/compra.js"></script>


		<form onsubmit="return checkForm();" action="confirmacion.php" method="POST">
			<fieldset>
				<div class="row">
					<legend>Información Personal</legend>
				</div>
				<div class="row">
					<label for="">Nombre</label> 
					<span class="error" id="nombreErr">*</span>
					<input type="text" name="nombre"/>
				</div>
				<div class="row">
					<label for="">Apellidos</label>
					<span class="error" id="apellidosErr">* </span>
					<input type="text" name="apellidos"/>
				</div>
				<div class="row">
					<label for="">Dirección</label>
					<span class="error" id="direccionErr">* </span>
					<input type="text" name="direccion" />
				</div>
				<div class="row left">
					<label for="">Fecha de Nacimiento</label>
					<input type="date" name="nacimiento"/>
					<span class="error" id="nacimientoErr">* </span>
				</div>
				<div class="row">
					<label for="">Teléfono</label>
					<span class="error" id="telefonoErr">* </span>
					<input type="tel" name="telefono"  />
				</div>
				<div class="row">
					<label for="">Email</label>
					<span class="error" id="emailErr">*</span>
					<input type="email" name="email" />
				</div>

			</fieldset>

			<fieldset>
				<div class="row">
					<legend>Información de la suscripción</legend>
				</div>
				<div class="row left">
				    <label for="">Disco Seleccionado</label>
					<input type="text" name="disco" value="<?=escape($disco['nombre'])?>" readonly/>
					<label for="">Precio</label>
					<input type="text" name="precio" value="<?=escape($disco['precio']);?>" readonly/>
				</div>
				</div>
				<div class="row">
					<div class="col-2">
						<label for="" id="pago">Método de pago</label>
					</div>
					<div class="col-2 metodo_pago">
						<input type="radio" name="modo_pago" value="tarjeta" checked/>
						<label for="">Tarjeta de Crédito</label> 
					</div>
					<div class="col-8 metodo_pago">
						<input type="radio" name="modo_pago" value="reembolso"/>
						<label for="">Reembolso</label>
					</div>
				</div>
				<div class="row center" id="datos_tarjeta" display:"none">
					<div class="col-6 tarjeta">
						<select name="tipo_tarjeta" id="tipo_tarjeta">
							<option value="visa" selected>Visa</option>
							<option value="mastercard">MasterCard</option>
							<option value="american">American-Express</option>
						</select>
					</div>	
					<div class="col-3 tarjeta">
						<span class="error" id="numero_tarjetaErr">*</span>
						<input type="text" name="numero_tarjeta" id="numero_tarjeta" placeholder="Número de Tarjeta"/>
					</div>
					<div class="col-2 tarjeta">
							<span class="error" id="fecha_tarjetaErr">*</span>
							<input type="text" name="fecha_tarjeta" id="fecha_tarjeta" placeholder="mm/aaaa"/>
					</div>
					<div class="col-1 tarjeta">
							<span class="error" id="cvcErr">*</span>
							<input type="text" name="cvc" id="cvc" placeholder="CVC"/>
					</div>
				</div>
			</fieldset>

			<?php echo '<input type="hidden" name="id" value="'.$_POST['id'].'" >';?>;
			
			<div class="row center">
				<input type="submit" name="submit" value="submit">
			</div>
		</form>



<?php
include "/home/alumnos/1718/germancastro1718/public_html/proyecto/footer.html";
?>