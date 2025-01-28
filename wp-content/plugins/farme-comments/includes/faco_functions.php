<?php 

	add_action('admin_menu','faco_Add_My_Admin_Link');
	add_action('init','faco_wp_styles');
	add_action('wp_ajax_altera_comentario','altera_comentario');
	add_action('wp_ajax_altera_servico','altera_servico');
	add_action('wp_ajax_altera_pergunta','altera_pergunta');
	add_action('wp_ajax_altera_menu','altera_menu');

	function faco_Add_My_Admin_Link(){
		add_menu_page(
			'Dados na Página da Far Me',
			'Dados da Far me',
			'manage_options',
			'farme-comments/includes/faco_acp_page.php'
		);
	}	
	
	function faco_wp_styles(){
		wp_enqueue_style('style_css',plugins_url('css/style.css',__FILE__));

		wp_enqueue_script('jquery_js',plugins_url('js/jquery.js',__FILE__),'',true);
		wp_enqueue_script('jquery_ajaxform_js',plugins_url('js/jquery.ajaxform.js',__FILE__),'',true);
		wp_enqueue_script('functions_js',plugins_url('js/functions.js',__FILE__),'',true);
	}

	function altera_comentario(){

		$data['sucesso'] = true;
		$data['mensagem'] = '';
		$data['wpdb'] = [];

		if(isset($_POST['acao']) && $_POST['acao'] == 'comentario_alterar'){
			$comentario_id = $_POST['comentario_id'];

			global $wpdb;

			$resultado = $wpdb->get_results("SELECT * FROM `wordpress_wp_depoimentos` WHERE `id` = $comentario_id");

			$data['wpdb'] = $resultado;
		}
		else if(isset($_POST['acao']) && $_POST['acao'] == 'comentario_excluir'){
			$comentario_id = $_POST['comentario_id'];

			global $wpdb;

			$wpdb->delete('wordpress_wp_depoimentos', array(
				'id' => $comentario_id));
		}

		wp_die(json_encode($data));
	}

	function altera_servico(){

		$data['sucesso'] = true;
		$data['mensagem'] = '';
		$data['wpdb'] = [];

		if(isset($_POST['acao']) && $_POST['acao'] == 'servico_alterar'){
			$servico_id = $_POST['servico_id'];
			$servico_post = [];

			foreach ($_POST['servico_post'] as $key => $value) {
				$servico_post[$value['name']] = $value['value'];
			}

			$imagem = $servico_post['img'];

			global $wpdb;

			$data['servico_post'] = $servico_post;

		}
		else if(isset($_POST['acao']) && $_POST['acao'] == 'comentario_excluir'){
			$comentario_id = $_POST['comentario_id'];

			global $wpdb;

			$wpdb->delete('wordpress_wp_depoimentos', array(
				'id' => $comentario_id));
		}

		wp_die(json_encode($data));
	}

	function altera_pergunta(){

		$data['sucesso'] = true;
		$data['mensagem'] = '';
		$data['wpdb'] = [];

		if(isset($_POST['acao']) && $_POST['acao'] == 'pergunta_alterar'){
			$pergunta_id = $_POST['pergunta_id'];

			global $wpdb;

			$resultado = $wpdb->get_results("SELECT * FROM `wordpress_wp_perguntas` WHERE `id` = $pergunta_id");

			$data['wpdb'] = $resultado;
		}
		else if(isset($_POST['acao']) && $_POST['acao'] == 'pergunta_excluir'){
			$pergunta_id = $_POST['pergunta_id'];

			global $wpdb;

			$wpdb->delete('wordpress_wp_perguntas', array(
				'id' => $pergunta_id));
		}

		wp_die(json_encode($data));
	}

	function altera_menu(){

		$data['sucesso'] = true;
		$data['mensagem'] = '';
		$data['wpdb'] = [];

		if(isset($_POST['acao']) && $_POST['acao'] == 'menu_alterar'){
			$menu_id = $_POST['menu_id'];

			global $wpdb;

			$resultado = $wpdb->get_results("SELECT * FROM `wordpress_wp_menu` WHERE `id` = $menu_id");

			$data['wpdb'] = $resultado;
		}
		else if(isset($_POST['acao']) && $_POST['acao'] == 'menu_excluir'){
			$menu_id = $_POST['menu_id'];

			global $wpdb;

			$wpdb->delete('wordpress_wp_menu', array(
				'id' => $menu_id));
		}
		else if(isset($_POST['acao']) && $_POST['acao'] == 'menu_aumentar'){
			$menu_id = $_POST['menu_id'];

			$data['comeco'] = false;

			global $wpdb;

			$resultado = $wpdb->get_results("SELECT * FROM `wordpress_wp_menu` ORDER BY `ordem`");

			$resultado2 = $wpdb->get_results("SELECT * FROM `wordpress_wp_menu` WHERE `id` = $menu_id");

			if((int)reset($resultado)->ordem < (int)$resultado2['0']->ordem){

				$outra_ordem = $resultado2['0']->ordem - 1;

				$outra_ordem_dados = $wpdb->get_results("SELECT * FROM `wordpress_wp_menu` WHERE `ordem` = $outra_ordem");

				$wpdb->update('wordpress_wp_menu', array(
					'ordem' => $resultado2['0']->ordem
				),array(
					'id' => $outra_ordem_dados['0']->id));

				$wpdb->update('wordpress_wp_menu', array(
					'ordem' => $outra_ordem
				),array(
					'id' => $resultado2['0']->id));

				$wpdb->show_errors();
				if($wpdb->last_error !== '')
				    $wpdb->print_error();

			}
			else{
				$data['comeco'] = true;
			}
		}
		else if(isset($_POST['acao']) && $_POST['acao'] == 'menu_diminuir'){
			$menu_id = $_POST['menu_id'];

			$data['fim'] = false;

			global $wpdb;

			$resultado = $wpdb->get_results("SELECT * FROM `wordpress_wp_menu` ORDER BY `ordem`");

			$resultado2 = $wpdb->get_results("SELECT * FROM `wordpress_wp_menu` WHERE `id` = $menu_id");

			if((int)end($resultado)->ordem > (int)$resultado2['0']->ordem){

				$outra_ordem = $resultado2['0']->ordem + 1;

				$outra_ordem_dados = $wpdb->get_results("SELECT * FROM `wordpress_wp_menu` WHERE `ordem` = $outra_ordem");

				$wpdb->update('wordpress_wp_menu', array(
					'ordem' => $resultado2['0']->ordem
				),array(
					'id' => $outra_ordem_dados['0']->id));

				$wpdb->update('wordpress_wp_menu', array(
					'ordem' => $outra_ordem
				),array(
					'id' => $resultado2['0']->id));

				$wpdb->show_errors();
				if($wpdb->last_error !== '')
				    $wpdb->print_error();

			}
			else{
				$data['fim'] = true;
			}
		}

		wp_die(json_encode($data));
	}

 ?>