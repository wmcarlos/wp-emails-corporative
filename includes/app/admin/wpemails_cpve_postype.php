<?php 

class wpemails_cpve_postype{
	function __construct(){
		add_action('init',array(__CLASS__, 'wpemails_cpve_postype_fn'));
		add_action('add_meta_boxes',array(__CLASS__,'wpemails_cpve_postype_mtb'));
		add_action('save_post',array(__CLASS__,'wpemails_cpve_savemetabox'));
	}
	public static function wpemails_cpve_postype_fn(){
	
		$labels = array(
			'name' => 'Correos Corporativos',
			'singular_name' => 'Correos Corporativos',
			'add_new' => 'Agregar Nuevo Correos Corporativo',
			'all_items'=> 'Listar Correos Corporativos',
			'add_new_item'=> 'Agregar Nuevo Correos Corporativo',
			'edit_item' => 'Editar Correos Corporativo',
			'view_item ' => 'Visualizar Correos Corporativo',
			'search_item' => 'Buscar Correos Corporativo',
			'not_found' => 'No Existe el Correos Corporativo',
			'not_found_in_trash ' => 'No Enlace found in trash',
			'parent_item_colon' => 'Parent Item'
		);
		$args = array(
			'labels'=> $labels,
			'public'=> true,
			'has_archive'=>true,
			'publicly_queryable'=>true,
			'query_var'=>true,
			'rewrite'=>true,
			'capability_type'=>'post',
			'menu_icon' => 'dashicons-list-view',
			'hierarchical' => false,
			'supports'=> array('title'),
			'taxonomies' => array(''),
			'menu_position'=>5,
			'exclude_from_search'=>true
		);
		register_post_type('wpemails_cpve_cpt',$args);

		//postype para planes
		$labels2 = array(
			'name' => 'Planes',
			'singular_name' => 'Planes',
			'add_new' => 'Agregar Nuevo Plan',
			'all_items'=> 'Listar Planes',
			'add_new_item'=> 'Agregar Nuevo Plan',
			'edit_item' => 'Editar Planes',
			'view_item ' => 'Visualizar Planes',
			'search_item' => 'Buscar Planes',
			'not_found' => 'No Existe el Plan',
			'not_found_in_trash ' => 'No Enlace found in trash',
			'parent_item_colon' => 'Parent Item'
		);
		$args2 = array(
			'labels'=> $labels2,
			'public'=> true,
			'has_archive'=>true,
			'publicly_queryable'=>true,
			'query_var'=>true,
			'rewrite'=>true,
			'capability_type'=>'post',
			'menu_icon' => 'dashicons-list-view',
			'hierarchical' => false,
			'supports'=> array('title','editor'),
			'taxonomies' => array(''),
			'menu_position'=>5,
			'exclude_from_search'=>true
		);
		register_post_type('wpemails_cpve_planes',$args2);


	}
	public static function wpemails_cpve_postype_mtb(){
		add_meta_box('wpemails_cpve_postype_mtbx', 'Datos Personales',array(__CLASS__,'wpemails_cpve_postype_mtbx_callback'), array('wpemails_cpve_cpt'), 'normal', 'default');
	}
	//guardar los datos del metabox
	public static function wpemails_cpve_savemetabox($post){
		$settings = new wpemails_cpve_settings();
		$wpemailscpve_options = $settings->wpemails_cpve_checkoptions();
		$wpemails_estatuspost = get_post_status($post->ID);

		//condicion para saber si aceptamos el email
		if(isset($_POST['publish'])){
			$cpmm2 = new cPanelMailManager($wpemailscpve_options['user'], $wpemailscpve_options['pass'], $wpemailscpve_options['host']);
			if($cpmm2->createEmail($_POST['wpemails_cpve_email_corporative'],$_POST['wpemails_cpve_email_password'],$_POST['wpemails_cpve_plan'])){
					$wpemails_cpve_estatus = 'success';
					//=====enviamos un correo electronico al usuario===
					$to = $_POST['wpemails_cpve_email_send'];
					$subject = 'Estatus del correo corporativo '.$_POST['wpemails_cpve_email_corporative'];
					$body = '<h1>Enhorabuena</h1> <p>Estimado '.$_POST['wpemails_cpve_fullname'].' se le ha aceptado la solicitud de su correo electronico corporativo, puede comenzar a disfrutar ya de nuestros servicios!</p>
					<p>Sus datos Registrados Fueron: <br> <strong>Email:</strong>'.$_POST['wpemails_cpve_email_corporative'].' <br> <strong>Contraseña: </strong>'.$_POST['wpemails_cpve_email_password'].'</p>
					<p><strong>Cuota :</strong>'.$_POST['wpemails_cpve_plan'];
					$headers = array('Content-Type: text/html; charset=UTF-8');
					wp_mail($to, $subject, $body, $headers);
					//============enviando correo=============
				}else{
					$wpemails_cpve_estatus = 'error';
			}
		}//condicion del status del gmail
	}

	//crear los datos del metabox
	public static function wpemails_cpve_postype_mtbx_callback($post){
		$wpemails_cpve_data = get_post_meta($post->ID,'wpemails_cpve_cpt_options');
?>
	<!--creamos los campos dinamicos del metabox-->
	<table border="0" width="100%">
		
		<tr>
			<td><strong>Nombre Completo:</strong></td>
			<td><input style="width:100%;" type="text" value="<?php echo $wpemails_cpve_data[0]['wpemails_cpve_fullnamee'];  ?>" name="wpemails_cpve_fullname"></td>
		</tr>
		
		<tr>
			<td><strong>Fecha de Nacimiento:</strong></td>
			<td>
         		<input type="text" placeholder="" name="wpemails_cpve_fechanamiciento"  id="wpemails_cpve_fechanamiciento" value="<?php echo $wpemails_cpve_data[0]['wpemails_cpve_fechanamiciento']; ?>">
			</td>
		</tr	

		<tr>
			<td><strong>Pais:</strong></td>
			<td>
         		<input type="text" placeholder="" name="wpemails_cpve_pais"  id="wpemails_cpve_pais" value="<?php echo $wpemails_cpve_data[0]['wpemails_cpve_pais']; ?>">
			</td>
		</tr>

		<tr>
			<td><strong>Ciudad:</strong></td>
			<td>
				<textarea style="width:100%;" name="wpemails_cpve_full_direction"><?php echo $wpemails_cpve_data[0]['wpemails_cpve_direction'];  ?></textarea>
			</td>
		</tr>
		
		<tr>
			<td><strong>Correo Corporativo:</strong></td>
			<td>
				<input type="text" name="wpemails_cpve_email_corporative" value="<?php echo $wpemails_cpve_data[0]['wpemails_cpve_email_corporative'];  ?>">
			</td>
		</tr>

		<tr>
			<td><strong>Plan escogido</strong></td>
			<td><input type="text" name="wpemails_cpve_plan" value="<?php echo $wpemails_cpve_data[0]['wpemails_cpve_plan'];  ?>"></td>
		</tr>

		<tr>
			<td><strong>Num. Confirmacion Paypal</strong></td>
			<td><input type="text" name="wpemails_cpve_num_confirmacion" value="<?php echo $wpemails_cpve_data[0]['wpemails_cpve_num_confirmacion'];  ?>"></td>
		</tr>


		<tr>
			<td>Enviar correo A:</td>
			<td><input type="text" name="wpemails_cpve_email_send" value="<?php echo $wpemails_cpve_data[0]['wpemails_cpve_email_send']; ?>"></td>
		</tr>
		
		<tr>
			<td><strong>Password:</strong></td>
			<td><input type="text" name="wpemails_cpve_email_password" value="<?php echo $wpemails_cpve_data[0]['wpemails_cpve_email_password']; ?>"></td>
		</tr>


	</table>
		
<?php
	}
}
new wpemails_cpve_postype();