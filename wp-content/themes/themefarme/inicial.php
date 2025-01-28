<?php 

	//Template Name: Inicial


	get_header();

	global $wpdb;
	$upload_dir = wp_upload_dir();
	$tabela_video = $wpdb->get_results("SELECT * FROM  `wordpress_wp_video`");
	$tabela_servicos = $wpdb->get_results("SELECT * FROM  `wordpress_wp_servicos`");
	$tabela_textos_full = $wpdb->get_results("SELECT * FROM  `wordpress_wp_textos`");
	$tabela_textos = array();

	foreach ($tabela_textos_full as $key => $value) {
		$tabela_textos[$value->nome_campo] = $value->texto;
	}
?>
<section class="container box01">
	<div class="box01-wraper">
		<div class="box01-text">
			<h2 class="box01-text-h2-desktop"><?php echo $tabela_textos['titulo_sessao_principal']; ?></h2>
			<h2 class="box01-text-h2-mobile"><?php echo $tabela_textos['titulo_sessao_principal']; ?></h2>
			<p><?php echo $tabela_textos['paragrafo_sessao_principal']; ?></p>
		</div>
		<div class="box01-img">
			<img src="<?php echo str_replace($upload_dir['basedir'],$upload_dir['baseurl'],$tabela_textos['primeira_imagem']); ?>">
		</div>
	</div>
</section>

<?php if($tabela_video['0']->exibir == 'on'){ ?>
<section class="box02" id="sobre">
	<div class="container">
		<h3><?php echo $tabela_textos['chamada_sessao_video']; ?></h3>
		<h2><?php echo $tabela_textos['titulo_sessao_video']; ?></h2>
		<p><?php echo $tabela_textos['paragrafo_sessao_video']; ?></p>
		<div class="box-video">
			<iframe src="<?php echo $tabela_video['0']->link; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>
	</div>
</section><!-- box02 -->
<?php } ?>

<section class="box02 sessao" id="servicos">
	<div class="container">
		<h3><?php echo $tabela_textos['chamada_sessao_servicos']; ?></h3>
		<h2><?php echo $tabela_textos['titulo_sessao_servicos']; ?></h2>
		<p><?php echo $tabela_textos['paragrafo_sessao_servicos']; ?></p>
		<div class="box-servicos">
			<div class="box-servicos-single">
				<div class="box-servicos-single-img">
					<img src="<?php echo str_replace($upload_dir['basedir'],$upload_dir['baseurl'],$tabela_servicos['0']->img); ?>">
				</div>
				<div class="box-servicos-single-text">
					<h3><?php echo $tabela_servicos['0']->nome; ?></h3>
					<h2 class="box-servicos-single-text-desktop"><?php echo $tabela_servicos['0']->titulo_resumo; ?></h2>
					<h2 class="box-servicos-single-text-mobile"><?php echo $tabela_servicos['0']->titulo_resumo; ?></h2>
					<div class="box-servicos-single-line"></div>
					<p><?php echo $tabela_servicos['0']->resumo; ?></p>
					<a href="<?php echo $tabela_servicos['0']->link_resumo; ?>">Saiba Mais</a>
				</div>
			</div><!-- box-servicos-single -->
			<div class="box-servicos-single">
				<div class="box-servicos-single-img">
					<img src="<?php echo str_replace($upload_dir['basedir'],$upload_dir['baseurl'],$tabela_servicos['1']->img); ?>">
				</div>
				<div class="box-servicos-single-text">
					<h3><?php echo $tabela_servicos['1']->nome; ?></h3>
					<h2 class="box-servicos-single-text-desktop"><?php echo $tabela_servicos['1']->titulo_resumo; ?></h2>
					<h2 class="box-servicos-single-text-mobile"><?php echo $tabela_servicos['1']->titulo_resumo; ?></h2>
					<div class="box-servicos-single-line"></div>
					<p><?php echo $tabela_servicos['1']->resumo; ?></p>
					<a href="<?php echo $tabela_servicos['1']->link_resumo; ?>">Saiba Mais</a>
				</div>
			</div><!-- box-servicos-single -->
			<div class="box-servicos-single">
				<div class="box-servicos-single-img">
					<img src="<?php echo str_replace($upload_dir['basedir'],$upload_dir['baseurl'],$tabela_servicos['2']->img); ?>">
				</div>
				<div class="box-servicos-single-text">
					<h3><?php echo $tabela_servicos['2']->nome; ?></h3>
					<h2 class="box-servicos-single-text-desktop"><?php echo $tabela_servicos['2']->titulo_resumo; ?></h2>
					<h2 class="box-servicos-single-text-mobile"><?php echo $tabela_servicos['2']->titulo_resumo; ?></h2>
					<div class="box-servicos-single-line"></div>
					<p><?php echo $tabela_servicos['2']->resumo; ?></p>
					<a href="<?php echo $tabela_servicos['2']->link_resumo; ?>">Saiba Mais</a>
				</div>
			</div><!-- box-servicos-single -->
		</div><!-- box-servicos -->
		<div class="box-servicos02" id="farmebox">
			<div class="box-servicos02-text">
				<div class="box-servicos02-text-wraper">
					<h3><?php echo $tabela_servicos['0']->nome; ?></h3>
					<h2><?php echo $tabela_servicos['0']->titulo_descricao; ?></h2>
					<?php echo $tabela_servicos['0']->descricao; ?>
					<a href="">Faça um orçamento</a> <span>sem compromisso</span>
				</div>
			</div>
			<div class="box-servicos02-img">
				<img src="<?php echo str_replace($upload_dir['basedir'],$upload_dir['baseurl'],$tabela_servicos['0']->img_descricao); ?>">
			</div>
		</div><!-- box-servicos02 -->
	</div>
</section><!-- box02 -->

<section class="box03">
	<div class="container">
		<h2><?php echo $tabela_textos['chamada_sessao_acompanhamento']; ?></h2>
	</div>
</section><!-- box03 -->

<section class="box04">
	<div class="container">
		<div class="box04-text01">
			<h2><?php echo $tabela_textos['titulo_sessao_acompanhamento']; ?></h2>
			<?php echo $tabela_textos['paragrafo_sessao_acompanhamento']; ?>
		</div><!-- box04-text01 -->
		<div class="box-servicos02 type01" id="farmemensal">
			<div class="box-servicos02-img">
				<img src="<?php echo str_replace($upload_dir['basedir'],$upload_dir['baseurl'],$tabela_servicos['1']->img_descricao); ?>">
			</div>
			<div class="box-servicos02-text">
				<div class="box-servicos02-text-wraper">
					<h3><?php echo $tabela_servicos['1']->nome; ?></h3>
					<h2><?php echo $tabela_servicos['1']->titulo_descricao; ?></h2>
					<?php echo $tabela_servicos['1']->descricao; ?>
					<a href="">Faça um orçamento</a> <span>sem compromisso</span>
				</div>
			</div>
		</div><!-- box-servicos02 -->
		<div class="box-servicos02 type02" id="farmepontual">
			<div class="box-servicos02-text">
				<div class="box-servicos02-text-wraper">
					<h3><?php echo $tabela_servicos['2']->nome; ?></h3>
					<h2><?php echo $tabela_servicos['2']->titulo_descricao; ?></h2>
					<?php echo $tabela_servicos['2']->descricao; ?>
					<a href="">Faça um orçamento</a> <span>sem compromisso</span>
				</div>
			</div><!-- box-servicos02-text -->
			<div class="box-servicos02-img">
				<img src="<?php echo str_replace($upload_dir['basedir'],$upload_dir['baseurl'],$tabela_servicos['2']->img_descricao); ?>">
			</div>
		</div><!-- box-servicos02 -->
	</div><!-- container -->
</section><!-- box04 -->

<section class="box05">
	<div class="container">
		<h3><?php echo mb_strtoupper($tabela_textos['chamada_sessao_beneficios'],mb_internal_encoding()); ?></h3>
		<h2><?php echo $tabela_textos['titulo_sessao_beneficios']; ?></h2>
		<p><?php echo $tabela_textos['paragrafo_sessao_beneficios']; ?></p>
		<div class="box-beneficios">
			<div class="box-beneficios-single">
				<div class="box-beneficios-single-img">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/Ativo_7-8.svg">
				</div><!-- box-beneficios-single-img -->
				<div class="box-beneficios-single-text">
					<h2><?php echo $tabela_textos['titulo_item_1_sessao_beneficios']; ?></h2>
					<p><?php echo $tabela_textos['paragrafo_item_1_sessao_beneficios']; ?></p>
				</div><!-- box-beneficios-single-text -->
			</div><!-- box-beneficios-single -->
			<div class="box-beneficios-single">
				<div class="box-beneficios-single-img">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/Ativo_8-8.svg">
				</div><!-- box-beneficios-single-img -->
				<div class="box-beneficios-single-text">
					<h2><?php echo $tabela_textos['titulo_item_2_sessao_beneficios']; ?></h2>
					<p><?php echo $tabela_textos['paragrafo_item_2_sessao_beneficios']; ?></p>
				</div><!-- box-beneficios-single-text -->
			</div><!-- box-beneficios-single -->
			<div class="box-beneficios-single">
				<div class="box-beneficios-single-img">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/Ativo_14-8.svg">
				</div><!-- box-beneficios-single-img -->
				<div class="box-beneficios-single-text">
					<h2><?php echo $tabela_textos['titulo_item_3_sessao_beneficios']; ?></h2>
					<p><?php echo $tabela_textos['paragrafo_item_3_sessao_beneficios']; ?></p>
				</div><!-- box-beneficios-single-text -->
			</div><!-- box-beneficios-single -->
			<div class="box-beneficios-single">
				<div class="box-beneficios-single-img">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/Ativo_18-8.svg">
				</div><!-- box-beneficios-single-img -->
				<div class="box-beneficios-single-text">
					<h2><?php echo $tabela_textos['titulo_item_4_sessao_beneficios']; ?></h2>
					<p><?php echo $tabela_textos['paragrafo_item_4_sessao_beneficios']; ?></p>
				</div><!-- box-beneficios-single-text -->
			</div><!-- box-beneficios-single -->
		</div><!-- box-beneficios -->
	</div>
</section><!-- box05 -->

<section class="box06">
	<div class="container">
		<div class="box06-container-background">
			<h3><?php echo $tabela_textos['chamada_sessao_numeros']; ?></h3>
			<h2><?php echo $tabela_textos['titulo_sessao_numeros']; ?></h2>
			<div class="box-numeros">
				<div class="box-numeros-single">
					<h1><?php echo $tabela_textos['numero_1_sessao_numeros']; ?></h1>
					<h4><?php echo $tabela_textos['titulo_1_sessao_numeros']; ?></h4>
				</div><!-- box-numeros-single -->
				<div class="box-numeros-single">
					<h1><?php echo $tabela_textos['numero_2_sessao_numeros']; ?></h1>
					<h4><?php echo $tabela_textos['titulo_2_sessao_numeros']; ?></h4>
				</div><!-- box-numeros-single -->
				<div class="box-numeros-single">
					<h1><?php echo $tabela_textos['numero_3_sessao_numeros']; ?></h1>
					<h4><?php echo $tabela_textos['titulo_3_sessao_numeros']; ?></h4>
				</div><!-- box-numeros-single -->
			</div>
			<p><?php echo $tabela_textos['paragrafo_sessao_numeros']; ?></p>
		</div><!-- box06-container-background -->
	</div>
</section><!-- box06 -->

<section class="box02 sessao" id="depoimentos">
	<div class="container">
		<h3><?php echo mb_strtoupper($tabela_textos['chamada_sessao_depoimentos'],mb_internal_encoding()); ?></h3>
		<h2><?php echo $tabela_textos['titulo_sessao_depoimentos']; ?></h2>
		<?php				
			$tabela_opcoes_depoimento = $wpdb->prepare("SELECT * FROM `wordpress_wp_opcoes` WHERE `nome` = %s",array('depoimento_animacao'));
			$tabela_opcoes_depoimento = $wpdb->get_results($tabela_opcoes_depoimento);
		?>
		<opcoes valor="<?php echo $tabela_opcoes_depoimento['0']->valor; ?>">
		<div class="box-depoimentos-gallery">

			<div class="box-depoimentos-gallery-arrow-left">
				<?php if($tabela_opcoes_depoimento['0']->valor == 'Setas'){ ?>
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/duvidas_arrow.svg">
				<?php } ?>
			</div>

			<div class="box-depoimentos">
				
				<?php 
					$tabela_depoimentos = $wpdb->get_results("SELECT * FROM  `wordpress_wp_depoimentos`");
					foreach ($tabela_depoimentos as $value) {?>
				<div class="box-depoimentos-single">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/depoimentos_aspas.svg">
					<h2><?php echo $value->texto ?></h2>
					<div class="box-depoimentos-single-postador">
						<div class="box-depoimentos-single-postador-img">
							<?php if($value->imagem == '' || $value->imagem == null){?>
							<img src="<?php echo plugins_url('',__FILE__); ?>/images/unknown.png">
							<?php }else{?>
							<img src="<?php echo str_replace("/opt/bitnami/apps/wordpress/htdocs",get_site_url(),$value->imagem); ?>">
							<?php } ?>
						</div>
						<div class="box-depoimentos-single-postador-text">
							<h4><?php echo $value->nome; if($value->idade != '0'){ echo ', '.$value->idade; } ?></h4>
							<p><?php echo $value->cargo ?></p>
						</div>
					</div>
				</div><!-- box-depoimentos-single -->
				<?php } ?>

			</div><!-- box-depoimentos -->

			<div class="box-depoimentos-gallery-arrow-right">
				<?php if($tabela_opcoes_depoimento['0']->valor == 'Setas'){ ?>
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/duvidas_arrow.svg">
				<?php } ?>
			</div>

		</div><!-- box-depoimentos-gallery -->

		<?php if($tabela_opcoes_depoimento['0']->valor == 'Pontos'){ ?>
		<div class="box-depoimentos-dots">
			<?php for ($i=0; $i < count($tabela_depoimentos); $i++) { 
				echo '<div></div>';
			} ?>
		</div>
		<?php } ?>

	</div><!-- container -->
</section><!-- box02 -->

<section class="box02 duvidas sessao" id="faq">
	<div class="container">
		<h3>DÚVIDAS</h3>
		<h2>Dúvidas frequentes </h2>
		<div class="box-duvidas">
			<?php 
				$tabela_perguntas = $wpdb->get_results("SELECT * FROM  `wordpress_wp_perguntas`");
				foreach ($tabela_perguntas as $key => $value) { ?>
			<div class="box-duvidas-single">
				<div class="box-duvidas-single-titulo" rotated="false">
					<h4><?php echo $value->pergunta ?> </h4>
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/duvidas_arrow.svg">
					<div class="clear"></div>
				</div>
				<p><?php echo $value->resposta ?></p>
			</div>
			<?php } ?>
		</div><!-- box-duvidas -->
	</div>
</section><!-- box07 -->

<section class="form-modal">
	<div class="container">
		<div class="form-modal-wraper">
			<a href="<?php echo get_site_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo01.svg" class="form-modal-logo"></a>
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrow_left.svg" class="form-modal-back">
			<div class="clear"></div><!-- clear -->
			<div class="form-modal-wraper2">
				<div class="form-modal-text">
					<h2>Vamos lá <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/Ativo_14-8.svg"></h2>
					<p>Nós organizamos seus medicamentos de acordo com a hora, a data e a posologia prescritos!</p>
				</div>
				<div class="form-modal-form">
					<div role="main" id="cadastro-box-site-novo-julho-2021-46b3ec0ee59f06093041"></div>
					<script type="text/javascript" src="https://d335luupugsy2.cloudfront.net/js/rdstation-forms/stable/rdstation-forms.min.js">
					</script>
					<script type="text/javascript">
						new RDStationForms('cadastro-box-site-novo-julho-2021-46b3ec0ee59f06093041', 'UA-175230602-1').createForm();
					</script>
				</div>
				<div class="form-modal-form-contato">
					<div role="main" id="site-contato-site-novo-julho-2021-696fe189e32692d6edd4"></div>
					<script type="text/javascript" src="https://d335luupugsy2.cloudfront.net/js/rdstation-forms/stable/rdstation-forms.min.js">
					</script>
					<script type="text/javascript">
						new RDStationForms('site-contato-site-novo-julho-2021-696fe189e32692d6edd4', 'UA-175230602-1').createForm();
					</script>
				</div>
			</div>
			<div class="form-modal-footer">
				<p>Copyright © 2021 Far.me. Todos os direitos reservados.</p>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>