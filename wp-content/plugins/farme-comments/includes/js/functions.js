$(function(){
	var include_path = $('base').attr('include_path');
	var wp_admin = $('base').attr('wp-admin');
	var wp_admin_ajax = wp_admin + 'admin-ajax.php';
	var plugins_url = $('base').attr('plugins-url');
	var get_site_url = $('base').attr('get-site-url');

	/**************** PIMEIRA IMAGEM *******************/

	$(document).on('change','.primeira-imagem',function(){
		document.getElementById('primeira-imagem').src = window.URL.createObjectURL(this.files[0]);
	})

	/**************** COMENTÁRIOS *******************/

	$('.comentario-alterar').click(function(){
		var comentario_id = $(this).attr('comentario_id');

		if(!$(this).parent().parent().parent().parent().hasClass('tabela-servicos')){
			$.ajax({
					dataType:'json',
					url:wp_admin_ajax,
					method:'post',
					data: {
						'acao':'comentario_alterar',
						'comentario_id':comentario_id,
						action: 'altera_comentario'}
				}).done(function(data){
					$('.form-comentario [name=nome]').val(data.wpdb[0].nome);
					$('.form-comentario [name=idade]').val(data.wpdb[0].idade);
					$('.form-comentario [name=cargo]').val(data.wpdb[0].cargo);
					$('.form-comentario [name=texto]').text(data.wpdb[0].texto);
					var new_path = data.wpdb[0].imagem;
					if(data.wpdb[0].imagem == '' || data.wpdb[0].imagem == null){
						new_path = plugins_url + '/images/unknown.png';
					}
					if(data.wpdb[0].imagem.includes('/opt/bitnami/apps/wordpress/htdocs')){
						new_path = data.wpdb[0].imagem.replace('/opt/bitnami/apps/wordpress/htdocs',get_site_url);
					}
					$('.form-comentario .table-input-img img').attr('src',new_path);
					$('.form-comentario [name=imagem_antiga]').val(data.wpdb[0].imagem);
					$('.form-comentario [name=comentario_id]').attr('value',data.wpdb[0].id);
					$('.form-comentario [name=criar_comentario]').attr('value','ALTERAR');
				});

			return false;
		}
		else{
			$('.servico_'+comentario_id).submit();
			return false;
		}
	})

	$('.comentario-excluir').click(function(){
		var comentario_id = $(this).attr('comentario_id');

		$.ajax({
				dataType:'json',
				url:wp_admin_ajax,
				method:'post',
				data: {
					'acao':'comentario_excluir',
					'comentario_id':comentario_id,
					action: 'altera_comentario'}
			}).done(function(data){
				location.reload();
			});

		return false;
	})

	/**************** SERVIÇOS *******************/

	$(document).on('change','.servico_img',function(){
		var servico_img = $(this).attr('servico_img');
		document.getElementById(servico_img).src = window.URL.createObjectURL(this.files[0]);
	})

	$(document).on('change','.servico_img_descricao',function(){
		var servico_img = $(this).attr('servico_img_descricao');
		document.getElementById(servico_img).src = window.URL.createObjectURL(this.files[0]);
	})

	/**************** PERGUNTAS *******************/

	$('.pergunta-alterar').click(function(){
		var pergunta_id = $(this).attr('pergunta_id');

		$.ajax({
				dataType:'json',
				url:wp_admin_ajax,
				method:'post',
				data: {
					'acao':'pergunta_alterar',
					'pergunta_id':pergunta_id,
					action: 'altera_pergunta'}
			}).done(function(data){
				$('.form-perguntas [name=pergunta]').val(data.wpdb[0].pergunta);
				$('.form-perguntas [name=resposta]').val(data.wpdb[0].resposta);
				$('.form-perguntas [name=pergunta_id]').attr('value',data.wpdb[0].id);
				$('.form-perguntas [name=criar_resposta]').attr('value','ALTERAR');
			});

		return false;

	})

	$('.pergunta-excluir').click(function(){
		var pergunta_id = $(this).attr('pergunta_id');

		$.ajax({
				dataType:'json',
				url:wp_admin_ajax,
				method:'post',
				data: {
					'acao':'pergunta_excluir',
					'pergunta_id':pergunta_id,
					action: 'altera_pergunta'}
			}).done(function(data){
				location.reload();
			});

		return false;
	})

	/**************** MENU *******************/

	$('.menu-alterar').click(function(){
		var menu_id = $(this).attr('menu_id');

		$.ajax({
				dataType:'json',
				url:wp_admin_ajax,
				method:'post',
				data: {
					'acao':'menu_alterar',
					'menu_id':menu_id,
					action: 'altera_menu'}
			}).done(function(data){
				$('.form-menu [name=nome]').val(data.wpdb[0].nome);
				$('.form-menu [name=link]').val(data.wpdb[0].link);
				$('.form-menu [name=menu_id]').attr('value',data.wpdb[0].id);
				$('.form-menu [name=criar_menu]').attr('value','ALTERAR');
			});

		return false;

	})

	$('.menu-excluir').click(function(){
		var menu_id = $(this).attr('menu_id');

		$.ajax({
				dataType:'json',
				url:wp_admin_ajax,
				method:'post',
				data: {
					'acao':'menu_excluir',
					'menu_id':menu_id,
					action: 'altera_menu'}
			}).done(function(data){
				location.reload();
			});

		return false;
	})

	$('.aumentar-ordem').click(function(){
		var menu_id = $(this).attr('menu_id');

		$.ajax({
				dataType:'json',
				url:wp_admin_ajax,
				method:'post',
				data: {
					'acao':'menu_aumentar',
					'menu_id':menu_id,
					action: 'altera_menu'}
			}).done(function(data){
				if(!data.comeco){
					location.reload();

				}
			});

		return false;
	})

	$('.diminuir-ordem').click(function(){
		var menu_id = $(this).attr('menu_id');

		$.ajax({
				dataType:'json',
				url:wp_admin_ajax,
				method:'post',
				data: {
					'acao':'menu_diminuir',
					'menu_id':menu_id,
					action: 'altera_menu'}
			}).done(function(data){
				if(!data.fim){
					location.reload();

				}
			});

		return false;
	})

})

// window.onbeforeunload = function() {
//   return false;
// }