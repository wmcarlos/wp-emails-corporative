<?php
	//obtenemos los datos en caso de que ya esten guardados o los dejamos en blanco para evitar las noticias
	$wpemailscpve_options = self::wpemails_cpve_checkoptions();
	//llamamos la clase, autenticando y mostrando todos los correos 
	$cpmm = new cPanelMailManager($wpemailscpve_options['user'], $wpemailscpve_options['pass'], $wpemailscpve_options['host']);

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

	echo '<table class="wpemails_cpve_table_settings" cellpading="0" cellspacing="0">';
	echo '
	<tr>
		<th>Correo</th>
		<th>Quota</th>
	</tr>';
		for($i=0; $i < count($data); $i++){
			$e_separe = explode("@", $data[$i]['email']);
			$cad.="<tr>";
			$cad.="<td>".$data[$i]['email']."</td>";
			$cad.="<td>".$data[$i]['diskquota']."</td>";
			$cad.="</tr>";
		}
	print $cad;
	echo '</table>';


	

