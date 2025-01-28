<?php 

	$data['sucesso'] = true;
	$data['mensagem'] = '';
	$data['wpdb'] = [];

	if(isset($_POST['acao']) && $_POST['acao'] == 'comentario_alterar'){
		$comentario_id = $_POST['comentario_id'];

		global $wpdb;

		$resultado = $wpdb->get_results("SELECT * FROM `wordpress_wp_depoimentos` WHERE `id` = $comentario_id");

		$data['wpdb'] = $resultado;
	}

	die(json_encode($data));

 ?>