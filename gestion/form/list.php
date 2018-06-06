<form method="post">
  <input name="csrf" type="hidden" value="<?php echo escape($_SESSION['csrf']); ?>">
      <?php foreach ($data as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	    <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
      <br>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<button onclick="location.href='/~germancastro1718/proyecto/admin.php'" type="button">
     Volver</button>