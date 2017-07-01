<?php
	//obtenemos los datos en caso de que ya esten guardados o los dejamos en blanco para evitar las noticias
	$wpemails_cpve_host = isset($wpemails_cpve_options['txtdomain']) ? $wpemails_cpve_options['txtdomain'] : '';
	$wpemails_cpve_user = isset($wpemails_cpve_options['txtuser']) ? $wpemails_cpve_options['txtuser'] : '';
	$wpemails_cpve_pass = isset($wpemails_cpve_options['txtpassword']) ? $wpemails_cpve_options['txtpassword'] : '';
	//llamamos la clase, autenticando y mostrando todos los correos 
	$cpmm = new cPanelMailManager($wpemails_cpve_user, $wpemails_cpve_pass, $wpemails_cpve_host);

	//Separamos los datos del dominio
	$host_ex = explode(".", $wpemails_cpve_host);
	$host_ex[3] = (isset($host_ex[3]) and !empty($host_ex[3])) ? ".".$host_ex[3] : "";
	$last_part_email ="@".$host_ex[1].".".$host_ex[2].$host_ex[3];


	$data = $cpmm->listEmails();

	function compare_domain($e, $e2){
		$part_email = explode("@", $e);
		if("@".$part_email[1] == $e2){
			return true;
		}else{
			return false;
		}
	}

	echo '<table>';
	echo '
	<tr>
		<th>Correo</th>
		<th>Estatus</th>
		<th>--</th>
	</tr>';
		for($i=0; $i < count($data); $i++){
			if(compare_domain($data[$i]['email'], $last_part_email)){
				$e_separe = explode("@", $data[$i]['email']);
				$cad.="<tr>";
				$cad.="<td>".$data[$i]['email']."</td>";
				$cad.="<td>".$data[$i]['diskquota']."</td>";
				$cad.="<td><a href='edit.php?email=".$e_separe[0]."' class='btn btn-info'><i class='fa fa-pencil'></i> Change Password</a>
				<a href='#' class='btn btn-danger delete_email' data-email='".$e_separe[0]."'><i class='fa fa-times'></i> Delete</a></td>";
				$cad.="</tr>";
		}
	}
	print $cad;
	echo '</table>';


	

