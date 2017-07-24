<h1>Terminos y Condiciones</h1>
<form class="signup" method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>">
<input type="hidden" name="action" value="wpemails_cpve_terminos">
<?php 
	$wpemails_cpve_terminos = get_option('wpemails_cpve_terminos');
	wp_editor(@$wpemails_cpve_terminos['wpemails_cpve_terminos'],'wpemails_cpve_terminos');
?>
<br>
<input  class="fa fa-thumbs-o-up button-primary" type="submit" value="Guardar">
</form>