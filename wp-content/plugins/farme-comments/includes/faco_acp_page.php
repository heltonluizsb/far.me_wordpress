<?php 
	include('faco_uploads.php');
	$include_path = plugins_url('',__FILE__);
	$upload_dir = wp_upload_dir();
 ?>
<div class="wrap">
	<base include_path="<?php echo $include_path ?>" wp-admin="<?php echo admin_url(); ?>" plugins-url="<?php echo plugins_url('',__FILE__); ?>" get-site-url="<?php echo get_site_url(); ?>">


	<h2>Links do Menu</h2>
	<form method="post" class="form-comentario form-menu" enctype="multipart/form-data" >
		<?php

			if(isset($_POST['criar_menu'])){
				global $wpdb;

				if($_POST['menu_id'] == 'new'){

					$tabela_menu = $wpdb->get_results("SELECT * FROM `wordpress_wp_menu` ORDER BY `ordem`");

					$nova_ordem = end($tabela_menu)->ordem + 1;

					echo '<br>Ordem: '.$nova_ordem;

					$wpdb->insert('wordpress_wp_menu', array(
						'nome' => $_POST['nome'],
						'link' => $_POST['link'],
						'ordem' => $nova_ordem));
				}
				else{

					$wpdb->update('wordpress_wp_menu', array(
						'nome' => $_POST['nome'],
						'link' => $_POST['link']
					),array(
						'id' => $_POST['menu_id']));

						$wpdb->show_errors();
						if($wpdb->last_error !== '')
						    $wpdb->print_error();
				}

				$wpdb->show_errors();
				if($wpdb->last_error !== '')
				    $wpdb->print_error();

			}

			;
		 ?>
		<table class="tabela-form">
			<tr>
				<td class="table-label"><label>Nome do Link</label></td>
				<td class="table-input"><input type="text" name="nome"></td>
			</tr>
			<tr>
				<td class="table-label"><label>Link</label></td>
				<td class="table-input"><input type="text" name="link"></td>
			</tr>
		</table>
		<input type="hidden" name="menu_id" value="new">
		<input type="submit" name="criar_menu" value="Criar">		
	</form>

	<h2>Links do Menu Cadastrados</h2>
	<table class="tabela-lista-comentario">
		<tr>
			<th class="tabela-lista-comentario-primeiro">Nome</th>
			<th>Link</th>
			<th>Ordem</th>
			<th class="tabela-lista-comentario-ultimo">Alterar</th>
		</tr>
		<?php 
			$tabela_menu = $wpdb->get_results("SELECT * FROM `wordpress_wp_menu` ORDER BY `ordem`");
			foreach ($tabela_menu as $value) {?>
		<tr>
			<td class="tabela-lista-comentario-primeiro"><?php echo $value->nome ?></td>
			<td><?php echo $value->link ?></td>
			<td>
				<a href="" class="aumentar-ordem" menu_id="<?php echo $value->id ?>" style="font-size: 20px">&#x2B06;</a>
				<a href="" class="diminuir-ordem" menu_id="<?php echo $value->id ?>" style="font-size: 20px">&#x2B07;</a>
			</td>
			<td class="tabela-lista-comentario-ultimo">
				<a href="" class="menu-alterar" menu_id="<?php echo $value->id ?>">Alterar</a> |
				<a href="" class="menu-excluir" menu_id="<?php echo $value->id ?>">Excluir</a>
			</td>
		</tr>
		<?php } ?>
	</table>

	<h2>Imagem da Primeira Sessão</h2>
	<?php $primeira_imagem = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'primeira_imagem'"); ?>
	<form method="post" class="servico_<?php echo $value->id ?> form_servico" enctype="multipart/form-data" >
		<?php 
			if(isset($_POST['primeira_imagem_alterar'])){


				$sucesso = true;

				$imagem = @$_FILES['img'];

				if(isset($imagem['name']) && $imagem['name'] != ''){
					if(faco_uploads::imagemValida($imagem) == false){
						$sucesso = false;
						echo '<div style="color:red;">Imagem com formato incorreto ou arquivo maior que 10MB.</div>';
					}
				}
				else if(isset($imagem['name']) && $imagem['name'] == ''){					
					$sucesso = false;
					echo '<div style="color:red;">Precisa escolher uma imagem.</div>';
				}

				if($sucesso){

					if(isset($imagem['name']) && $imagem['name'] != ''){
						faco_uploads::deleteFile($_POST['imagem_antiga']);
						$imagem = faco_uploads::uploadFile($imagem,'posts');

						if(count($primeira_imagem) < 1){
							$wpdb->insert('wordpress_wp_textos', array(
								'texto' => $imagem,
								'nome_campo' => 'primeira_imagem'
							));

							$wpdb->show_errors();
							if($wpdb->last_error !== '')
							    $wpdb->print_error();

						}
						else{

							$wpdb->update('wordpress_wp_textos', array(
								'texto' => $imagem
							),array(
								'nome_campo' => 'primeira_imagem'));

							$wpdb->show_errors();
							if($wpdb->last_error !== '')
							    $wpdb->print_error();
							}

						$primeira_imagem = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'primeira_imagem'");
					}
				}

			}
		 ?>
		<img src="<?php echo str_replace($upload_dir['basedir'],$upload_dir['baseurl'],$primeira_imagem['0']->texto) ?>" id="primeira-imagem" style="max-width: 200px;"><br>
		<input type="file" name="img" class="primeira-imagem" servico_img="servico-img-<?php echo $value->id ?>">
		<input type="hidden" name="imagem_antiga" value="<?php echo $primeira_imagem['0']->texto ?>">
		<input type="submit" name="primeira_imagem_alterar" value="ALTERAR" style="padding: 10px 20px;">
	</form>

	<h2>Vídeo da Far.Me</h2>
	<form method="post" class="form-comentario">
		<?php 

			if(isset($_POST['alterar_video'])){

				global $wpdb;

				$_POST['link'] = str_replace('watch?v=', 'embed/', $_POST['link']);

				if(isset($_POST['exibir'])){
					$exibir = 'on';
				}
				else{
					$exibir = 'off';
				}

				$tabela_video = $wpdb->get_results("SELECT * FROM `wordpress_wp_video`");

				if(count($tabela_video) < 1){
					$wpdb->insert('wordpress_wp_video', array(
								'link' => $_POST['link']
							));
				}
				else{
					$wpdb->update('wordpress_wp_video', array(
								'link' => $_POST['link'],
								'exibir' => $exibir
							),array(
								'id' => '1'));
				}
			}

			$tabela_video = $wpdb->get_results("SELECT * FROM `wordpress_wp_video`");
		 ?>
		<table class="tabela-form">
			<tr>
				<td class="table-label"><label>Vídeo</label></td>
				<td class="table-input"><input type="text" name="link" required value="<?php echo $tabela_video['0']->link; ?>"></td>
				<td class="table-checkbox"><input type="checkbox" name="exibir" <?php if($tabela_video['0']->exibir == "on"){echo 'checked';} ?>><label>Exibir Seção do vídeo?</label></td>
			</tr>
		</table>

		<input type="submit" name="alterar_video" value="Alterar">	

	</form>

	<h2>Serviços da Far.Me</h2>
	<table class="tabela-lista-comentario tabela-servicos">
		<tr>
			<th class="tabela-lista-comentario-primeiro">Serviço</th>
			<th>Imagem do Resumo</th>
			<th>Título do Resumo</th>
			<th>Resumo</th>
			<th>Link do Resumo</th>
			<th>Imagem da Descrição</th>
			<th>Título da Descrição</th>
			<th>Descrição</th>
			<th class="tabela-lista-comentario-ultimo">Alterar</th>
		</tr>
		<?php 
			if(isset($_POST['acao']) && $_POST['acao'] == 'servico_alterar'){
				global $wpdb;

				$imagem = @$_FILES['img'];
				$imagem_descricao = @$_FILES['img_descricao'];
				$sucesso = true;

				if(isset($imagem['name']) && $imagem['name'] != ''){
					if(faco_uploads::imagemValida($imagem) == false){
						$sucesso = false;
						echo '<div style="color:red;">Imagem com formato incorreto ou arquivo maior que 10MB.</div>';
					}
				}

				if(isset($imagem_descricao['name']) && $imagem_descricao['name'] != ''){
					if(faco_uploads::imagemValida($imagem_descricao) == false){
						$sucesso = false;
						echo '<div style="color:red;">Imagem com formato incorreto ou arquivo maior que 10MB.</div>';
					}
				}


				// $wpdb->update('wordpress_wp_servicos', array(
				// 	'descricao' => $_POST['descricao']
				// ),array(
				// 	'id' => $_POST['servico_id']));

				if($sucesso){
					if(isset($imagem['name']) && $imagem['name'] != ''){
						faco_uploads::deleteFile($_POST['imagem_antiga']);
						$imagem = faco_uploads::uploadFile($imagem,'posts');

						$wpdb->update('wordpress_wp_servicos', array(
							'img' => $imagem
						),array(
							'id' => $_POST['servico_id']));
					}

					if(isset($imagem_descricao['name']) && $imagem_descricao['name'] != ''){
						faco_uploads::deleteFile($_POST['imagem_antiga_descricao']);
						$imagem_descricao = faco_uploads::uploadFile($imagem_descricao,'posts');

						$wpdb->update('wordpress_wp_servicos', array(
							'img_descricao' => $imagem_descricao
						),array(
							'id' => $_POST['servico_id']));
					}

					$wpdb->update('wordpress_wp_servicos', array(
						'nome' => $_POST['nome'],
						'titulo_resumo' => $_POST['titulo_resumo'],
						'resumo' => $_POST['resumo'],
					),array(
						'id' => $_POST['servico_id']));

					$wpdb->query($wpdb->prepare("UPDATE `wordpress_wp_servicos` SET `link_resumo` = %s, `titulo_descricao` = %s, `descricao` = %s WHERE `id` = %s",array( $_POST['link_resumo'],$_POST['titulo_descricao'],$_POST['descricao'],$_POST['servico_id'])));
				}

			}

			$tabela_servicos = $wpdb->get_results("SELECT * FROM `wordpress_wp_servicos`");
			if(count($tabela_servicos) < 1){
				echo '<br> Inserindo linhas na tabela...';

				$wpdb->insert('wordpress_wp_servicos', array(
					'nome' => 'insira'
				));

				$wpdb->show_errors();
				$wpdb->last_query;

				$wpdb->insert('wordpress_wp_servicos', array(
					'nome' => 'insira'
				));

				$wpdb->show_errors();
				$wpdb->last_query;

				$wpdb->insert('wordpress_wp_servicos', array(
					'nome' => 'insira'
				));

				$wpdb->show_errors();
				$wpdb->last_query;
			}
			foreach ($tabela_servicos as $value) {?>
		<tr>
			<form method="post" class="servico_<?php echo $value->id ?> form_servico" enctype="multipart/form-data" >
				<td class="tabela-lista-comentario-primeiro"><input type="text" name="nome" value="<?php echo $value->nome ?>"></td>
				<td>
					<img src="<?php echo str_replace($upload_dir['basedir'],$upload_dir['baseurl'],$value->img) ?>" id="servico-img-<?php echo $value->id ?>" ><br>
					<input type="file" name="img" class="servico_img" servico_img="servico-img-<?php echo $value->id ?>">
				</td>
				<td>
					<textarea name="titulo_resumo"><?php echo $value->titulo_resumo ?></textarea>
				</td>
				<td><textarea name="resumo"><?php echo $value->resumo ?></textarea>
				<td><input type="text" name="link_resumo" value="<?php echo $value->link_resumo ?>"></td>
				<td>
					<img src="<?php echo str_replace($upload_dir['basedir'],$upload_dir['baseurl'],$value->img_descricao) ?>" id="servico-img-descricao-<?php echo $value->id ?>" ><br>
					<input type="file" name="img_descricao" class="servico_img_descricao" servico_img_descricao="servico-img-descricao-<?php echo $value->id ?>">
				</td>
				<td>
					<textarea name="titulo_descricao"><?php echo $value->titulo_descricao ?></textarea>
				</td>
				<td><textarea name="descricao"><?php echo $value->descricao ?></textarea>
				<td class="tabela-lista-comentario-ultimo">
					<a href="" class="comentario-alterar" comentario_id="<?php echo $value->id ?>">Salvar Alterações</a><!--  |
					<a href="" class="comentario-excluir" comentario_id="<?php echo $value->id ?>">Excluir</a> -->
				</td>
				<input type="hidden" name="acao" value="servico_alterar">
				<input type="hidden" name="imagem_antiga" value="<?php echo $value->img ?>">
				<input type="hidden" name="imagem_antiga_descricao" value="<?php echo $value->img_descricao ?>">
				<input type="hidden" name="servico_id" value="<?php echo $value->id ?>">
			</form>
		</tr>
		<?php } ?>
	</table>

	<h2>Outros Textos</h2>
	<form method="post" class="form-comentario" enctype="multipart/form-data" >
		<?php 
			if(isset($_POST['atualizar_texto'])){

				foreach ($_POST as $key => $value) {

					if($key != 'atualizar_texto' && $value != '' && $value != null){
						$valida_tabela_texto = $wpdb->prepare("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = %s",array($key));
						$valida_tabela_texto = $wpdb->get_results($valida_tabela_texto);

						$wpdb->show_errors();
						if($wpdb->last_error !== '')
						    $wpdb->print_error();

						if(count($valida_tabela_texto) < 1){

							$wpdb->insert('wordpress_wp_textos', array(
								'nome_campo' => $key,
								'texto' => $value));

						}else{

							$wpdb->update('wordpress_wp_textos', array(
								'texto' => $value
							),array(
								'nome_campo' => $key));

						}
					}

				}

				$wpdb->show_errors();
				if($wpdb->last_error !== '')
				    $wpdb->print_error();

				$tabela_textos = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos`");

			}
		 ?>
		<table class="tabela-lista-comentario tabela-textos">
			<tr>
				<th class="tabela-lista-comentario-primeiro">Nome do Campo</th>
				<th class="tabela-lista-comentario-ultimo">Texto</th>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Título da Sessão Principal</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'titulo_sessao_principal'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="titulo_sessao_principal"><?php echo $tabela_textos_single['0']->texto; ?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Parágrafo da Sessão Principal</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'paragrafo_sessao_principal'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="paragrafo_sessao_principal"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Chamada da Sessão do Vídeo</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'chamada_sessao_video'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="chamada_sessao_video"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Título da Sessão do Vídeo</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'titulo_sessao_video'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="titulo_sessao_video"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Parágrafo da Sessão do Vídeo</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'paragrafo_sessao_video'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="paragrafo_sessao_video"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Chamada da Sessão de Serviços</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'chamada_sessao_servicos'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="chamada_sessao_servicos"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Título da Sessão de Serviços</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'titulo_sessao_servicos'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="titulo_sessao_servicos"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Parágrafo da Sessão de Serviços</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'paragrafo_sessao_servicos'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="paragrafo_sessao_servicos"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Chamada da Sessão de Acompanhamento</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'chamada_sessao_acompanhamento'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="chamada_sessao_acompanhamento"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Título da Sessão de Acompanhamento</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'titulo_sessao_acompanhamento'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="titulo_sessao_acompanhamento"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Parágrafo da Sessão de Acompanhamento</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'paragrafo_sessao_acompanhamento'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="paragrafo_sessao_acompanhamento"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Chamada da Sessão de Benefícios</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'chamada_sessao_beneficios'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="chamada_sessao_beneficios"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Título da Sessão de Benefícios</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'titulo_sessao_beneficios'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="titulo_sessao_beneficios"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Parágrafo da Sessão de Benefícios</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'paragrafo_sessao_beneficios'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="paragrafo_sessao_beneficios"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Título do Item 1 da Sessão de Benefícios</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'titulo_item_1_sessao_beneficios'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="titulo_item_1_sessao_beneficios"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Parágrafo do Item 1 da Sessão de Benefícios</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'paragrafo_item_1_sessao_beneficios'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="paragrafo_item_1_sessao_beneficios"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Título do Item 2 da Sessão de Benefícios</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'titulo_item_2_sessao_beneficios'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="titulo_item_2_sessao_beneficios"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Parágrafo do Item 2 da Sessão de Benefícios</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'paragrafo_item_2_sessao_beneficios'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="paragrafo_item_2_sessao_beneficios"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Título do Item 3 da Sessão de Benefícios</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'titulo_item_3_sessao_beneficios'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="titulo_item_3_sessao_beneficios"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Parágrafo do Item 3 da Sessão de Benefícios</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'paragrafo_item_3_sessao_beneficios'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="paragrafo_item_3_sessao_beneficios"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Título do Item 4 da Sessão de Benefícios</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'titulo_item_4_sessao_beneficios'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="titulo_item_4_sessao_beneficios"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Parágrafo do Item 4 da Sessão de Benefícios</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'paragrafo_item_4_sessao_beneficios'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="paragrafo_item_4_sessao_beneficios"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Chamada da Sessão de Números</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'chamada_sessao_numeros'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="chamada_sessao_numeros"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Título da Sessão de Números</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'titulo_sessao_numeros'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="titulo_sessao_numeros"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Parágrafo da Sessão de Números</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'paragrafo_sessao_numeros'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="paragrafo_sessao_numeros"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Número 1 da Sessão de Números</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'numero_1_sessao_numeros'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="numero_1_sessao_numeros"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Título 1 da Sesssão de Números</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'titulo_1_sessao_numeros'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="titulo_1_sessao_numeros"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Número 2 da Sessão de Números</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'numero_2_sessao_numeros'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="numero_2_sessao_numeros"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Título 2 da Sesssão de Números</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'titulo_2_sessao_numeros'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="titulo_2_sessao_numeros"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Número 3 da Sessão de Números</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'numero_3_sessao_numeros'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="numero_3_sessao_numeros"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Título 3 da Sesssão de Números</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'titulo_3_sessao_numeros'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="titulo_3_sessao_numeros"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Chamada da Sessão de Depoimentos</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'chamada_sessao_depoimentos'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="chamada_sessao_depoimentos"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Título da Sessão de Depoimentos</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'titulo_sessao_depoimentos'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="titulo_sessao_depoimentos"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Rodapé Texto 01</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'footer_texto_01'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="footer_texto_01"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Rodapé Texto 02</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'footer_texto_02'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="footer_texto_02"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Rodapé Links</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'footer_links'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="footer_links"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
			<tr>
				<td class="tabela-lista-comentario-primeiro">Rodapé Endereços</td>
				<?php
					$tabela_textos_single = $wpdb->get_results("SELECT * FROM `wordpress_wp_textos` WHERE `nome_campo` = 'footer_enderecos'");
				 ?>
				<td class="tabela-lista-comentario-ultimo"><textarea name="footer_enderecos"><?php echo $tabela_textos_single['0']->texto;?></textarea></td>
			</tr>
		</table>
		<br><input type="submit" name="atualizar_texto" value="Atualizar Textos">
	</form>

	<h2>Novo Depoimento</h2>
	<form method="post" class="form-comentario" enctype="multipart/form-data" >
		<?php

			$falha_post = false;

			if(isset($_POST['criar_comentario'])){
				global $wpdb;

				if($_POST['comentario_id'] == 'new'){

					$imagem = @$_FILES['imagem'];
					$sucesso = true;

					if(isset($imagem['name']) && $imagem['name'] != ''){
						if(faco_uploads::imagemValida($imagem) == false){
							$sucesso = false;
							echo '<div style="color:red;">Imagem com formato incorreto ou arquivo maior que 3MB.</div>';
						}
					}

					if($sucesso){
						if($imagem != ''){
							$imagem = faco_uploads::uploadFile($imagem);
						}
						else{
							$imagem = '';
						}

						$wpdb->insert('wordpress_wp_depoimentos', array(
							'nome' => $_POST['nome'],
							'idade' => $_POST['idade'],
							'cargo' => $_POST['cargo'],
							'texto' => $_POST['texto'],
							'imagem' => $imagem));
					}
					else{
						$falha_post = true;
						echo $imagem['type'];
					}
				}
				else{

					$imagem = @$_FILES['imagem'];
					$sucesso = true;

					if(isset($imagem['name']) && $imagem['name'] != ''){
						if(faco_uploads::imagemValida($imagem) == false){
							$sucesso = false;
							echo '<div style="color:red;">Imagem com formato incorreto ou arquivo maior que 3MB.</div>';
						}
					}

					if($sucesso){
						if($imagem != ''){
							faco_uploads::deleteFile($_POST['imagem_antiga']);
							$imagem = faco_uploads::uploadFile($imagem,'posts');
						}
						else{
							$imagem = '';
						}

						$wpdb->update('wordpress_wp_depoimentos', array(
							'nome' => $_POST['nome'],
							'idade' => $_POST['idade'],
							'cargo' => $_POST['cargo'],
							'texto' => $_POST['texto'],
							'imagem' => $imagem
						),array(
							'id' => $_POST['comentario_id']));
					}
					else{
						$falha_post = true;
					}
				}

			}

			// global $wpdb;

			// $resultado = $wpdb->get_results("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'wordpress' AND TABLE_NAME = 'wordpress_wp_depoimentos'");

			// echo "<pre>";
			// print_r($resultado);
			// echo "</pre>";

			;
		 ?>
		<table class="tabela-form">
			<tr>
				<td class="table-label"><label>Nome</label></td>
				<td class="table-input"><input type="text" name="nome" required value="<?php if($falha_post){echo $_POST['nome'];} ?>"></td>
			</tr>
			<tr>
				<td class="table-label"><label>Idade</label></td>
				<td class="table-input"><input type="number" name="idade" value="<?php if($falha_post){echo $_POST['idade'];} ?>"></td>
			</tr>
			<tr>
				<td class="table-label"><label>Cargo</label></td>
				<td class="table-input"><input type="text" name="cargo" value="<?php if($falha_post){echo $_POST['cargo'];} ?>"></td>
			</tr>
			<tr>
				<td class="table-label"><label>Texto</label></td>
				<td class="table-input"><textarea name="texto" required><?php if($falha_post){echo $_POST['texto'];} ?></textarea></td>
			</tr>
			<tr>
				<td class="table-label"><label>Imagem</label></td>
				<td class="table-input table-input-img">
					<img src="<?php echo plugins_url('',__FILE__) ?>/images/unknown.png" id="editar-imagem-img" >
					<input type="file" name="imagem"onchange="document.getElementById('editar-imagem-img').src = window.URL.createObjectURL(this.files[0])">
				</td>
			</tr>
		</table>
		<input type="hidden" name="imagem_antiga" value="">
		<input type="hidden" name="comentario_id" value="new">
		<input type="submit" name="criar_comentario" value="Criar">		
	</form>
	<h2>Animação do Depoimento</h2>
	<?php 
		if(isset($_POST['depoimento_animacao_alterar'])){
			$tabela_opcoes_depoimento = $wpdb->prepare("SELECT * FROM `wordpress_wp_opcoes` WHERE `nome` = %s",array('depoimento_animacao'));
			$tabela_opcoes_depoimento = $wpdb->get_results($tabela_opcoes_depoimento);

			$wpdb->show_errors();
			if($wpdb->last_error !== '')
			    $wpdb->print_error();

			if(count($tabela_opcoes_depoimento) < 1){
				$wpdb->insert('wordpress_wp_opcoes', array(
					'nome' => 'depoimento_animacao',
					'valor' => $_POST['depoimento_animacao']));
			}
			else{
				$wpdb->update('wordpress_wp_opcoes', array(
						'valor' => $_POST['depoimento_animacao']
					),array(
						'nome' => 'depoimento_animacao'));
			}
		}
	?>
	<form method="post" class="form-comentario" enctype="multipart/form-data">
		<?php 
			$tabela_opcoes_depoimento = $wpdb->prepare("SELECT * FROM `wordpress_wp_opcoes` WHERE `nome` = %s",array('depoimento_animacao'));
			$tabela_opcoes_depoimento = $wpdb->get_results($tabela_opcoes_depoimento);			
		?>
		<select name="depoimento_animacao">
			<option <?php if($tabela_opcoes_depoimento['0']->valor == 'Setas'){echo 'selected';} ?>>Setas</option>
			<option <?php if($tabela_opcoes_depoimento['0']->valor == 'Pontos'){echo 'selected';} ?>>Pontos</option>
		</select>
		<input type="submit" name="depoimento_animacao_alterar" value="Alterar">
	</form>
	<h2>Depoimentos Cadastrados</h2>
	<table class="tabela-lista-comentario">
		<tr>
			<th class="tabela-lista-comentario-primeiro">Imagem</th>
			<th>Nome</th>
			<th>Idade</th>
			<th>Cargo</th>
			<th>Texto</th>
			<th class="tabela-lista-comentario-ultimo">Alterar</th>
		</tr>
		<?php 
			$tabela_depoimentos = $wpdb->get_results("SELECT * FROM `wordpress_wp_depoimentos`");
			foreach ($tabela_depoimentos as $value) {?>
		<tr>
			<td class="tabela-lista-comentario-primeiro">
				<?php if($value->imagem == '' || $value->imagem == null){?>
				<img src="<?php echo plugins_url('',__FILE__); ?>/images/unknown.png">
				<?php }else{?>
				<img src="<?php echo str_replace("/opt/bitnami/apps/wordpress/htdocs",get_site_url(),$value->imagem); ?>">
				<?php } ?>
			</td>
			<td><?php echo $value->nome ?></td>
			<td><?php echo $value->idade ?></td>
			<td><?php echo $value->cargo ?></td>
			<td><?php echo $value->texto ?></td>
			<td class="tabela-lista-comentario-ultimo">
				<a href="" class="comentario-alterar" comentario_id="<?php echo $value->id ?>">Alterar</a> |
				<a href="" class="comentario-excluir" comentario_id="<?php echo $value->id ?>">Excluir</a>
			</td>
		</tr>
		<?php } ?>
	</table>




	<h2>Nova Pergunta</h2>
	<form method="post" class="form-comentario form-perguntas" enctype="multipart/form-data" >
		<?php

			if(isset($_POST['criar_resposta'])){
				global $wpdb;

				if($_POST['pergunta_id'] == 'new'){

					// echo '<br> Entrou aqui.<br>Pergunta: '.$_POST['pergunta'].'<br>Resposta: '.$_POST['resposta'];

					$wpdb->insert('wordpress_wp_perguntas', array(
						'pergunta' => $_POST['pergunta'],
						'resposta' => $_POST['resposta']));
				}
				else{

					$wpdb->update('wordpress_wp_perguntas', array(
						'pergunta' => $_POST['pergunta'],
						'resposta' => $_POST['resposta']
					),array(
						'id' => $_POST['pergunta_id']));
				}

				$wpdb->show_errors();
				if($wpdb->last_error !== '')
				    $wpdb->print_error();

			}

			;
		 ?>
		<table class="tabela-form">
			<tr>
				<td class="table-label"><label>Pergunta</label></td>
				<td class="table-input"><textarea name="pergunta"></textarea></td>
			</tr>
			<tr>
				<td class="table-label"><label>Resposta</label></td>
				<td class="table-input"><textarea name="resposta"></textarea></td>
			</tr>
		</table>
		<input type="hidden" name="pergunta_id" value="new">
		<input type="submit" name="criar_resposta" value="Criar">		
	</form>

	<h2>Perguntas Cadastradas</h2>
	<table class="tabela-lista-comentario">
		<tr>
			<th class="tabela-lista-comentario-primeiro">Pergunta</th>
			<th>Resposta</th>
			<th class="tabela-lista-comentario-ultimo">Alterar</th>
		</tr>
		<?php 
			$tabela_perguntas = $wpdb->get_results("SELECT * FROM `wordpress_wp_perguntas`");
			foreach ($tabela_perguntas as $value) {?>
		<tr>
			<td class="tabela-lista-comentario-primeiro"><?php echo $value->pergunta ?></td>
			<td><?php echo $value->resposta ?></td>
			<td class="tabela-lista-comentario-ultimo">
				<a href="" class="pergunta-alterar" pergunta_id="<?php echo $value->id ?>">Alterar</a> |
				<a href="" class="pergunta-excluir" pergunta_id="<?php echo $value->id ?>">Excluir</a>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>