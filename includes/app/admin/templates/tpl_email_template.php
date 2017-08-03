<h1>Plantilla Para Envio de Correo</h1>
<p>Variables disponibles: <b>{{fullname}} , {{email}} , {{email_corporative}}  ,  {{plan}} , {{city}}</b></p>
<form class="signup" method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>">
<input type="hidden" name="action" value="wpemails_cpve_template">
<?php 
	$wpemails_cpve_template = get_option('wpemails_cpve_template');
	wp_editor(@$wpemails_cpve_template['wpemails_cpve_template'],'wpemails_cpve_template');
?>
<br>
<input  class="fa fa-thumbs-o-up button-primary" type="submit" value="Guardar">
</form>