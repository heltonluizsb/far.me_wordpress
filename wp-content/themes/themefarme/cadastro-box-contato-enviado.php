<?php 
	//Template Name: Contato Enviado

	get_header();
?>

<section class="form-success">
	<div class="container">
		<div class="form-modal-wraper">
			<a href="<?php echo get_site_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo01.svg" class="form-modal-logo"></a>
			<a href="<?php echo get_site_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/arrow_left.svg" class="form-modal-back"></a>
			<div class="clear"></div><!-- clear -->
			<div class="form-modal-wraper2">
				<div class="form-modal-sucesso">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/Ativo_19-8.svg">
					<h2>Obrigado</h2>
					<p>Em breve entraremos em contato ;)</p>
					<a href="<?php echo get_site_url(); ?>">Voltar ao início</a>
				</div>
			</div>
			<div class="form-modal-footer">
				<p>Copyright © 2021 Far.me. Todos os direitos reservados.</p>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>