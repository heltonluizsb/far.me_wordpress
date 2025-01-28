<?php 

	$tabela_textos_full = $wpdb->get_results("SELECT * FROM  `wordpress_wp_textos`");
	$tabela_textos = array();

	foreach ($tabela_textos_full as $key => $value) {
		$tabela_textos[$value->nome_campo] = $value->texto;
	}
 ?>

<footer>
	<div class="container">
		<div class="box-footer01">

			<div class="box-footer01-01">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/footer_logo.svg">
				<?php echo $tabela_textos['footer_texto_01']; ?>
			</div><!-- box-footer01-01 -->

			<div class="box-footer01-02">
				<h2><?php echo $tabela_textos['footer_texto_02']; ?></h2>
				<div><a href="" class="link-contato">Preencher Formulário</a></div>				
			</div><!-- box-footer01-02 -->

			<div class="box-footer01-03" id="contato">
				<h2>Se preferir, liga pra gente! </h2>
				<div class="box-footer01-03-cidade">
					<p>Belo Horizonte - MG</p>
					<h5>31 2528 4229 | 31 98372 3906 </h5>					
				</div>
				<div class="box-footer01-03-cidade">
					<p>São Paulo - SP </p>
					<h5>11 3289 8232</h5>					
				</div>
				<div class="box-footer01-03-sociais">
					<a href="https://www.facebook.com/somosfarme"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/footer_facebook.svg"></a>
					<a href="https://www.instagram.com/somosfarme/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/footer_instagram.svg"></a>
					<a href="https://www.linkedin.com/company/farme/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/footer_linkedin.svg"></a>
				</div>
			</div><!-- box-footer01-03 -->

		</div><!-- box-footer01 -->
		<div class="box-footer02">
			<?php echo $tabela_textos['footer_links']; ?>
		</div><!-- box-footer02 -->
		<div class="box-footer03">
			<?php echo $tabela_textos['footer_enderecos']; ?>
		</div><!-- box-footer03 -->
		<div class="box-footer04">
			<p>Copyright © 2021 Far.me. Todos os direitos reservados.</p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>
</html>