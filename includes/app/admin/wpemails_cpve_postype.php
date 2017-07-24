<?php 

class wpemails_cpve_postype{
	function __construct(){
		add_action('init',array(__CLASS__, 'wpemails_cpve_postype_plan_fn'));
		add_action('add_meta_boxes',array(__CLASS__,'wpemails_cpve_postype_mtb'));
		add_action('add_meta_boxes',array(__CLASS__,'wpmails_cpve_plan_mtb'));
		add_action('save_post',array(__CLASS__,'wpemails_cpve_savemetabox'));
		add_action('save_post',array(__CLASS__,'wpemails_cpve_saveplan'));
	}
	public static function wpemails_cpve_postype_plan_fn(){
	
		$labels = array(
			'name' => 'Solicitud de Correo Corporativo',
			'singular_name' => 'Solicitud de Correos Corporativos',
			'add_new' => 'Nuevo Solicitud de Correos Corporativo',
			'all_items'=> 'Listar Solicitudes de Correos Corporativos',
			'add_new_item'=> 'Agregar Nueva Solicitud de Correo Corporativo',
			'edit_item' => 'Editar Solicitud',
			'view_item ' => 'Visualizar Solicitud',
			'search_item' => 'Buscar Solicitud',
			'not_found' => 'No Existe el Solicitudes de Correos Corporativo',
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
	//FUNCION PARA GUARDAR LOS DATOS DEL PLAN
	public static function wpemails_cpve_saveplan($post){
		$dataplan['wpemails_cpve_email_check'] =  isset($_POST['wpemails_cpve_email_check']) ? $_POST['wpemails_cpve_email_check'] : '';
		$dataplan['wpemails_cpve_fullname_check'] =  isset($_POST['wpemails_cpve_fullname_check']) ? $_POST['wpemails_cpve_fullname_check'] : '';
		$dataplan['wpemails_cpve_fechanamiciento_check'] =  isset($_POST['wpemails_cpve_fechanamiciento_check']) ? $_POST['wpemails_cpve_fechanamiciento_check'] : '';
		$dataplan['wpemails_cpve_phone_check'] =  isset($_POST['wpemails_cpve_phone_check']) ? $_POST['wpemails_cpve_phone_check'] : '';
		$dataplan['wpemails_cpve_ciudad_check'] =  isset($_POST['wpemails_cpve_ciudad_check']) ? $_POST['wpemails_cpve_ciudad_check'] : '';
		$dataplan['wpemails_cpve_corporative_check'] =  isset($_POST['wpemails_cpve_corporative_check']) ? $_POST['wpemails_cpve_corporative_check'] : '';
		$dataplan['wpemails_cpve_clave_check'] =  isset($_POST['wpemails_cpve_clave_check']) ? $_POST['wpemails_cpve_clave_check'] : '';
		$dataplan['wpmails_cpve_terminos_check'] =  isset($_POST['wpmails_cpve_terminos_check']) ? $_POST['wpmails_cpve_terminos_check'] : '';
		$dataplan['wpemails_cpve_recibir_ofertas_check'] =  isset($_POST['wpemails_cpve_recibir_ofertas_check']) ? $_POST['wpemails_cpve_recibir_ofertas_check'] : '';
		$dataplan['wpemails_cpve_recibir_mejoras_check'] =  isset($_POST['wpemails_cpve_recibir_mejoras_check']) ? $_POST['wpemails_cpve_recibir_mejoras_check'] : '';
		update_post_meta($post,'wpemails_cpve_cpt_plan',$dataplan);
	}
	//CAMPOS PARA EL POSTYPE DE PLANES
	public static function wpmails_cpve_plan_mtb(){
		add_meta_box('wpmails_cpve_plan_mtbx', 'Reglas de campos',array(__CLASS__,'wpmails_cpve_plan_callback'), array('wpemails_cpve_planes'), 'normal', 'default');
	}
	//callback metabox postype planes
	public static function wpmails_cpve_plan_callback($post){
	$wpemails_dataplan = get_post_meta($post->ID,'wpemails_cpve_cpt_plan');
	?>	
		<style type="text/css">
			.table-planes caption{
				padding: 10px;
				font-size: 20px;
				background-color: #4097C0;
				color: white;
				font-weight: bold;
				text-shadow:1px 1px 1px black;
			}
			.table-planes tr th{
				border:1px solid #ccc;
				padding: 10px;
			}
			.table-planes tr td{
				border: 1px solid #ccc;
				text-align: center;
				border-top: none;
				padding: 10px;
			}
		</style>
		<table class="table-planes" width="100%" cellspacing="0">
			<caption>Tabla de campos</caption>
			<tr>
				<th>Campo</th>
				<th>Descripcion</th>
				<th>Obligatorio</th>
			</tr>
			<tr>
				<td>Tu Correo:</td>
				<td>Digite su correo electrónico personal. Ej. minombre@gmail.com</td>
				<td><input type="checkbox" <?php  checked($wpemails_dataplan[0]['wpemails_cpve_email_check'],'y');  ?>  value="y" name="wpemails_cpve_email_check"></td>
			</tr>
			<tr>
				<td>Nombre Completo:</td>
				<td>Ingrese su Nombre y Apellidos.</td>
				<td><input type="checkbox" value="y" <?php  checked($wpemails_dataplan[0]['wpemails_cpve_fullname_check'],'y');  ?> name="wpemails_cpve_fullname_check"></td>
			</tr>
			<tr>
				<td>Fecha Nacimiento:</td>
				<td>Selecione el día, mes y año de su nacimiento.</td>
				<td><input type="checkbox" value="y" <?php  checked($wpemails_dataplan[0]['wpemails_cpve_fechanamiciento_check'],'y');  ?> name="wpemails_cpve_fechanamiciento_check"></td>
			</tr>
			<tr>
				<td>Seleccione su país e ingrese su número de telefono:</td>
				<td>Primero seleccione su país y luego digite su número de teléfono.</td>
				<td><input type="checkbox" value="y" name="wpemails_cpve_phone_check" <?php  checked($wpemails_dataplan[0]['wpemails_cpve_phone_check'],'y');  ?>></td>
			</tr>
			<tr>
				<td>Ciudad:</td>
				<td>Ingrese la Ciudad de su residencia.</td>
				<td><input type="checkbox" value="y" name="wpemails_cpve_ciudad_check" <?php  checked($wpemails_dataplan[0]['wpemails_cpve_ciudad_check'],'y');  ?>></td>
			</tr>
			<tr>
				<td>Correo Corporativo:</td>
				<td>Ingresa tu nombre y apellido paterno, debe ser en el siguiente formato: Ej. jose.caceres@club-profesionales.com</td>
				<td><input type="checkbox" value="y" name="wpemails_cpve_corporative_check" <?php  checked($wpemails_dataplan[0]['wpemails_cpve_corporative_check'],'y');  ?>></td>
			</tr>
			<tr>
				<td>Contraseña:</td>
				<td>Genere su clave. Para mayor seguridad debe contener letras alfanuméricas y caracteres.</td>
				<td><input type="checkbox" value="y" name="wpemails_cpve_clave_check" <?php  checked($wpemails_dataplan[0]['wpemails_cpve_clave_check'],'y');  ?>></td>
			</tr>
			<tr>
				<td>Términos y Condiciones</td>
				<td></td>
				<td><input type="checkbox" value="y" name="wpmails_cpve_terminos_check" <?php  checked($wpemails_dataplan[0]['wpmails_cpve_terminos_check'],'y');  ?>></td>
			</tr>
			<tr>
				<td>(*) Recibir ofertas de empleo en las siguientes áreas:</td>
				<td></td>
				<td><input type="checkbox" value="y" name="wpemails_cpve_recibir_ofertas_check" <?php  checked($wpemails_dataplan[0]['wpemails_cpve_recibir_ofertas_check'],'y');  ?>></td>
			</tr>
			<tr>
				<td>(*) Recibir las mejoras ofertas de:</td>
				<td></td>
				<td><input type="checkbox" value="y" name="wpemails_cpve_recibir_mejoras_check" <?php  checked($wpemails_dataplan[0]['wpemails_cpve_recibir_mejoras_check'],'y');  ?>></td>
			</tr>
		</table>
	<?php
	}

	//===============FORMULARIO DE VISUALIZACION EN  EL PANEL ADMIN SOBRE LOS DATOS DE LOS CLIENTES=========
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
					//Condicion para la subscripcion
					if($_POST['wpmails_cpve_ofertas']!=''){
						self::wpemails_subscription_newsletter($_POST['wpemails_cpve_fullname'],$_POST['wpemails_cpve_email_corporative']);
					}
				}else{
					$wpemails_cpve_estatus = 'error';
				}
		}//condicion del status del gmail

	}
	public static function wpemails_subscription_newsletter($fullname, $emailsend){
		$data_options = get_option('wpemails_cpve_newsletter');
		$host = isset($data_options['wpemails_cpve_hostnamerelay']) ? $data_options['wpemails_cpve_hostnamerelay'] : '';
		$apikey = isset($data_options['wpemails_cpve_apikeyrelay']) ? $data_options['wpemails_cpve_apikeyrelay'] : '';
		$curl = curl_init('https://'.$host.'/ccm/admin/api/version/2/&type=json');
		$postData = array(
		    'function' => 'addSubscriber',
		    'apiKey' => $apikey,
		    'email' => $emailsend,
		    'name' => $fullname,
		    'groups' => array(
		        1
		    )
		);
		$post = http_build_query($postData);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$json = curl_exec($curl);
	}//cieerre de la subscripcion del newsletter

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
		</tr>	

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
			<td><strong>Titulo de plan</strong></td>
			<td><b><?php echo $wpemails_cpve_data[0]['wpmails_cpve_text_plan'];  ?></b></td>
		</tr>
		<tr>
			<td><strong>Num. Confirmacion Paypal</strong></td>
			<td><input type="text" name="wpemails_cpve_num_confirmacion" value="<?php echo $wpemails_cpve_data[0]['wpemails_cpve_num_confirmacion'];  ?>"></td>
		</tr>
		<tr>
			<td><strong>Num. Telefono</strong></td>
			<td><input type="text" name="wpemails_cpve_phone" value="<?php echo $wpemails_cpve_data[0]['wpemails_cpve_phone'];  ?>"></td>
		</tr>


		<tr>
			<td>Enviar correo A:</td>
			<td><input type="text" name="wpemails_cpve_email_send" value="<?php echo $wpemails_cpve_data[0]['wpemails_cpve_email_send']; ?>"></td>
		</tr>
		
		<tr>
			<td><strong>Password:</strong></td>
			<td><input type="text" name="wpemails_cpve_email_password" value="<?php echo $wpemails_cpve_data[0]['wpemails_cpve_email_password']; ?>"></td>
		</tr>

		<tr>
			<td><strong>Recibir Ofertas de empleo:</strong></td>
			<td><input type="text" name="wpmails_cpve_ofertas" readonly="readonly" value="<?php echo $wpemails_cpve_data[0]['wpmails_cpve_ofertas']; ?>"></td>
		</tr>

		<tr>
			<td><strong>Recibir Mejoras de:</strong></td>
			<td><input type="text" name="wpmails_cpve_mejoras" readonly="readonly" value="<?php echo $wpemails_cpve_data[0]['wpmails_cpve_mejoras']; ?>"></td>
		</tr>
	</table>
	<!--CAMPO PARA COLOCAR EL TIPO DE PLAN-->

<?php
	}
}
new wpemails_cpve_postype();