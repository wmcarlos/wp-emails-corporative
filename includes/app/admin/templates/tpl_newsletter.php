<?php
 
/*Funcion curl para conectar con el mailrelay y devolver la data*/
function wpemails_curl_mailrelay($postData,$curl){
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$json = curl_exec($curl);
	if ($json === false) {
	    die('Request failed with error: '. curl_error($curl));
	}
	$result = json_decode($json);
	return $result;
}


$data_options = get_option('wpemails_cpve_newsletter');

$host = isset($data_options['wpemails_cpve_hostnamerelay']) ? $data_options['wpemails_cpve_hostnamerelay'] : '';

$apikey = isset($data_options['wpemails_cpve_apikeyrelay']) ? $data_options['wpemails_cpve_apikeyrelay'] : '';

$group_list = isset($data_options['wpemails_cpve_group']) ? $data_options['wpemails_cpve_group'] : '';


$curl = curl_init('https://'.$host.'/ccm/admin/api/version/2/&type=json');

/*Obtener la lista de subscriptores*/
$getSubscribers = array(
    'function' => 'getSubscribers',
    'apiKey' => $apikey,
    'offset' => 0,
    'count' => 2
);
/*Obtener los grupos*/
$getGroups = array(
    'function' => 'getGroups',
    'apiKey' => $apikey,
    'offset' => 0,
    'count' => 2,
); 


if(!empty($host) && !empty($apikey)){
	$wpmails_subscribers = wpemails_curl_mailrelay($getSubscribers,$curl);
	$wpmails_groups = wpemails_curl_mailrelay($getGroups,$curl);
}

?>
	
<!--primeramente creamos el formulario mailrelay-->
<center>
<div class="card-form" style="margin-left:20px;" >
  <form class="signup" method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>">
	<input type="hidden" name="action" value="wpemails_cpve_newsletter">
    <div class="form-title">Configuración Mail Relay</div>
    <div class="form-body">
      <div class="row">
        <input type="text" name="wpemails_cpve_hostnamerelay" placeholder="Hostname" value="<?php echo $host; ?>">
      </div>
       <div class="row">
        <input type="text" name="wpemails_cpve_apikeyrelay" placeholder="ApiKey" value="<?php echo $apikey; ?>">
      </div>
      <?php  if($wpmails_groups->status != 0) {?>

      <div class="row">
      	<select name="wpemails_cpve_group">
      		<option value="">Seleccione El Grupo</option>
      		<?php foreach ($wpmails_groups->data as $group) { ?>
      			<option <?php selected($group->id,$group_list); ?> value="<?php echo $group->id; ?>"><?php echo $group->name; ?></option>
      		<?php } ?>
      	</select>
      </div>

      <?php } ?>
      
    </div>
    <div class="rule"></div>
    <div class="form-footer">
    	<center>
    		<input  class="fa fa-thumbs-o-up" type="submit" value="Guardar">
      	</center>
    </div>
  </form>
</div>
</center>



<center>
<!--mostrando la lista de subscritos-->
<?php
if ($wpmails_subscribers->status == 0) {
	echo '<h3 style="color:red;">Host o Apikey Invalida!</h3>';
}else{
	if(!empty($host) && !empty($apikey)){
		echo '
		<br>
		<hr>
		<br>';
		echo '<h2>Lista de Subscritos</h2>';
		echo '<table class="wpemails_cpve_table_settings" cellpading="0" cellspacing="0">';
		echo '
		<thead>
		<tr>
			<th>ID</th>
			<th>Nombre Completo</th>
			<th>Email</th>
		</tr>
		</thead>
		<tbody>';
	 
	//print_r($result->data);
	foreach ($wpmails_subscribers->data as $key) {
		echo '<tr>';
		echo '<td>'.$key->id.'</td>';
		echo '<td>'.$key->name.'</td>';
		echo '<td>'.$key->email.'</td>';
		echo '</tr>';
	}
		echo '
		</tbody>
		</table>';
	}//closed if
}//cierre if principal
?>
</center>
<?php 