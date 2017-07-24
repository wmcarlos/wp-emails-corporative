<?php
	//obtenemos los datos en caso de que ya esten guardados o los dejamos en blanco para evitar las noticias
	$wpemailscpve_options = self::wpemails_cpve_checkoptions();
	//llamamos la clase, autenticando y mostrando todos los correos 
	$cpmm = new cPanelMailManager($wpemailscpve_options['user'], $wpemailscpve_options['pass'], $wpemailscpve_options['host']);

	//Separamos los datos del dominio
	$host_ex = explode(".", $wpemails_cpve_host);
	$host_ex[3] = (isset($host_ex[3]) and !empty($host_ex[3])) ? ".".$host_ex[3] : "";
	$last_part_email ="@".$host_ex[1].".".$host_ex[2].$host_ex[3];

		//borraremos el email desde aqui
	if($_GET['delete']){
		if($cpmm->deleteEmail($_GET['delete'])){		
			'<h2>Email Eliminado Con Exito</h2>
			<a href="edit.php?post_type=wpemails_cpve_cpt&page=wpemails_cpve_settings&section=emails">Volver</a>
			';

		}else{
			'<h2>No se pudo Eliminar el email</h2>';
		}
			
	}else{

	$data = $cpmm->listEmails();

	//print_r($data);
	function compare_domain($e, $e2){
		$part_email = explode("@", $e);
		if("@".$part_email[1] == $e2){
			return true;
		}else{
			return false;
		}
	}

	echo '<table class="wpemails_cpve_table_settings" cellpading="0" cellspacing="0">';
	echo '
	<thead>
	<tr>
		<th>Correo</th>
		<th>Cuota</th>
		<th>Accion</th>
	</tr>
	</thead>
	<tbody>';
		for($i=0; $i < count($data); $i++){
			$e_separe = explode("@", $data[$i]['email']);
			$cad.="<tr>";
			$cad.="<td>".$data[$i]['email']."</td>";
			$cad.="<td>".$data[$i]['diskquota']."</td>";
			$cad.="<td>
						<a href='edit.php?post_type=wpemails_cpve_cpt&page=wpemails_cpve_settings&section=emails&delete=".$data[$i]['email']."' class='btn btn-danger delete_email' data-email='".$e_separe[0]."'><i class='fa fa-times'></i> Delete</a></td>";
			$cad.="</tr>";
		}
	print $cad;
	echo '
	</tbody>
	</table>';
	

}//cierre del else delete email

