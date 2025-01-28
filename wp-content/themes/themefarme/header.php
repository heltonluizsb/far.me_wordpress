<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	<?php wp_head(); ?>
</head>
<body>

<?php if(!is_404()){ ?>
<header>
	<div class="container">

		<div class="header-desktop">
			<div class="header-img">
				<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo01.svg"></a>
			</div>
			<a href="" class="header-a">Faça o seu orçamento</a>
			<ul>
				<?php
					$tabela_link_menu = $wpdb->get_results("SELECT * FROM  `wordpress_wp_menu` ORDER BY `ordem`");
					foreach ($tabela_link_menu as $key => $value) {?>
				<li><a class="<?php if(strpos($value->link, '#') !== false){echo str_replace('#','',$value->link);} ?>" href="<?php echo $value->link; ?>"><?php echo $value->nome; ?></a></li>
				<?php } ?>
				<li><a href="" class="link-contato">Contato</a></li>
			</ul>
			<div class="clear"></div>
		</div><!-- header-desktop -->

		<div class="header-mobile">
			<div class="header-img">
				<a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo01.svg"></a>
			</div>
			<div class="header-mobile-menu-icon">
				<div></div>
				<div></div>
				<div></div>
			</div>
		</div>

	</div><!-- container -->

</header>
<a href="" class="mobile-header-a">Faça um orçamento</a>
<?php } ?>

<div class="header-mobile-menu-icon-out">
	<div></div>
	<div></div>
	<div></div>
</div>

<div class="header-mobile-menu">
	<ul>
		<?php
			$tabela_link_menu = $wpdb->get_results("SELECT * FROM  `wordpress_wp_menu` ORDER BY `ordem`");
			foreach ($tabela_link_menu as $key => $value) {?>
		<li><a class="<?php if(strpos($value->link, '#') !== false){echo str_replace('#','',$value->link);} ?>" href="<?php echo $value->link; ?>"><?php echo $value->nome; ?></a></li>
		<?php } ?>
		<li><a href="" class="link-contato">Contato</a></li>
	</ul>

</div>