$(function(){


	/*************** ANIMAÇÃO MENU ********************/

	var windowOffY = $(window).scrollTop();
	var scrollBottom = $(window).scrollTop() + $(window).height();
	var menu = $('header');
	var menu_top = menu.offset().top;
	var menu_original_position = menu.css('position');
	var menu_original_margin_top = menu.css('margin-top');
	var menu_original_background = menu.css('background-color');
	var box06 = $('.box06');
	// var box06_top = box06.offset().top;
	var box06_top = null;
	var box06_height = box06.height();
	var count_end = false;
	// var menu_animation = false;

	if(typeof box06.offset() !== "undefined"){
		box06_top = box06.offset().top;
	}

	verify_menu();

	function verify_menu(){
		if(windowOffY >= menu_top){
			menu.css('position','fixed');
			menu.css('margin-top','0px');
			menu.css('background-color','#FFF3E2');
			// menu_animation = true;
			// console.log(menu_animation);
			// menu.animate({
			// 	backgroundColor:"#FFF3E2"
			// },500,function(){
			// 	menu_animation = false;
			// 	console.log(menu_animation);
			// });
		}
		else if(windowOffY < menu_top){
			menu.css('position',menu_original_position);
			menu.css('margin-top',menu_original_margin_top);
			menu.css('background-color',menu_original_background);
			// menu_animation = true;
			// console.log(menu_animation);
			// menu.animate({
			// 	backgroundColor:"transparent"
			// },500,function(){
			// 	menu_animation = false;
			// 	console.log(menu_animation);
			// });
		}		
	}

	$(window).scroll(function(){
		windowOffY = $(window).scrollTop();
		scrollBottom = $(window).scrollTop() + $(window).height();
		var windowHeight = $(window).height();

		$('.sessao').each(function(){
			var elOffY = $(this).offset().top;
			if(elOffY < (windowOffY + windowHeight) && elOffY+$(this).height() > windowOffY){
				$('header ul li a').css('text-decoration','none');
				var target = $(this).attr('id');
				$('.'+target).css('text-decoration','underline');
				return;
			}
			else if((elOffY+$(this).height() < windowOffY) || elOffY > windowOffY){
				var target = $(this).attr('id');
				$('.'+target).css('text-decoration','none');
			}
		});

		if(windowOffY > menu_top){
			menu.css('position','fixed');
			menu.css('margin-top','0px');
			menu.css('background-color','#FFF3E2');
			// menu_animation = true;
			// console.log(menu_animation);
			// menu.animate({
			// 	backgroundColor:"#FFF3E2"
			// },500,function(){
			// 	menu_animation = false;
			// 	console.log(menu_animation);
			// });
			if((windowOffY >= (box06_top - (box06_height / 8))) && !count_end){
				number_counter();
			}
		}
		else if(windowOffY <= menu_top){
			menu.css('position',menu_original_position);
			menu.css('margin-top',menu_original_margin_top);
			menu.css('background-color',menu_original_background);
			// menu_animation = true;
			// console.log(menu_animation);
			// menu.animate({
			// 	backgroundColor:"transparent"
			// },500,function(){
			// 	menu_animation = false;
			// 	console.log(menu_animation);
			// });
		}
	})

	$('header ul li a').hover(function(){
		$(this).css('text-decoration','underline');
	},function(){
		$(this).css('text-decoration','none');		
	})


	/*************** MENU RESPONSIVO ********************/

	var menu_responsivo_on = false;

	$('.header-mobile-menu-icon, .header-mobile-menu-icon-out, .header-mobile-menu a').click(function(){

		if(menu_responsivo_on){
			$('.header-mobile-menu-icon div:nth-of-type(1)').css('transform','rotate(0deg)');
			$('.header-mobile-menu-icon div:nth-of-type(1)').css('top','0px');
			$('.header-mobile-menu-icon div:nth-of-type(2)').css('background-color','black');
			$('.header-mobile-menu-icon div:nth-of-type(3)').css('transform','rotate(0deg)');
			$('.header-mobile-menu-icon div:nth-of-type(3)').css('bottom','0px');


			$('.header-mobile-menu-icon-out div:nth-of-type(1)').css('transform','rotate(0deg)');
			$('.header-mobile-menu-icon-out div:nth-of-type(1)').css('top','0px');
			$('.header-mobile-menu-icon-out div:nth-of-type(2)').css('background-color','black');
			$('.header-mobile-menu-icon-out div:nth-of-type(3)').css('transform','rotate(0deg)');
			$('.header-mobile-menu-icon-out div:nth-of-type(3)').css('bottom','0px');

			$('.header-mobile-menu').animate({
				width: '0px'
			},function(){
				$('.header-mobile-menu').hide();
				$('.header-mobile-menu-icon-out').hide();
			});

			menu_responsivo_on = false;
		}
		else{
			$('.header-mobile-menu-icon div:nth-of-type(1)').css('transform','rotate(45deg)');
			$('.header-mobile-menu-icon div:nth-of-type(1)').css('top','9px');
			$('.header-mobile-menu-icon div:nth-of-type(2)').css('background-color','transparent');
			$('.header-mobile-menu-icon div:nth-of-type(3)').css('transform','rotate(-45deg)');
			$('.header-mobile-menu-icon div:nth-of-type(3)').css('bottom','9px');

			$('.header-mobile-menu-icon-out').show();
			$('.header-mobile-menu').show();

			$('.header-mobile-menu-icon-out div:nth-of-type(1)').css('transform','rotate(45deg)');
			$('.header-mobile-menu-icon-out div:nth-of-type(1)').css('top','9px');
			$('.header-mobile-menu-icon-out div:nth-of-type(2)').css('background-color','transparent');
			$('.header-mobile-menu-icon-out div:nth-of-type(3)').css('transform','rotate(-45deg)');
			$('.header-mobile-menu-icon-out div:nth-of-type(3)').css('bottom','9px');

			$('.header-mobile-menu').animate({
				width: '100%'
			});


			menu_responsivo_on = true;
		}

	})


	/*************** ANIMAÇÃO CONTAGEM DE NÚMEROS ********************/

	reset_numbers_count();

	function reset_numbers_count(){
		$('.box-numeros-single h1 span').each(function () {
			$(this).attr('oldnumber',$(this).text());
			$(this).text('0');
		});

	}

	function number_counter(){
		$('.box-numeros-single h1 span').each(function () {
		    $(this).prop('Counter',0).animate({
		        Counter: $(this).attr('oldnumber')
		    }, {
		        duration: 2000,
		        easing: 'swing',
		        step: function (now) {
		            $(this).text(formatar(Math.ceil(now)));
		        }
		    });
		});
		count_end = true;
	}

	function formatar(nr) {
	  return String(nr)
	    .split('').reverse().join('').split(/(\d{3})/).filter(Boolean)
	    .join('.').split('').reverse().join('');
	}


	/*************** ANIMAÇÃO DÚVIDAS ********************/


	$('.box-duvidas-single-titulo').click(function(){
		$(this).parent().find('p').slideToggle(300);
		if($(this).attr('rotated') == 'false'){
  			$(this).find('img').css('transform','rotateX(180deg)');
  			$(this).attr('rotated','true');
		}
		else{
  			$(this).find('img').css('transform','rotateX(0deg)');
  			$(this).attr('rotated','false');			
		}
	})


	/*************** SCROLL PARA SEÇÕES ********************/

	$('.header-desktop ul li a, .header-mobile-menu ul li a').click(function(){

		if($(this).attr('href').includes('#')){
			var menu_scrollTo = (($($(this).attr('href')).offset().top) - 100);
		    $([document.documentElement, document.body]).animate({
		        scrollTop: menu_scrollTo
		    }, 1000);
			return false;
		}

	})
	
	$('.box-footer02 > div a').click(function(){

		if($(this).attr('href').includes('#')){
			var menu_scrollTo = (($($(this).attr('href')).offset().top) - 100);
		    $([document.documentElement, document.body]).animate({
		        scrollTop: menu_scrollTo
		    }, 1000);
			return false;
		}

	})
	
	$('.box-servicos-single-text > a').click(function(){

		if($(this).attr('href').includes('#')){
			var menu_scrollTo = (($($(this).attr('href')).offset().top) - 100);
		    $([document.documentElement, document.body]).animate({
		        scrollTop: menu_scrollTo
		    }, 1000);
			return false;
		}

	})


	/*************** ABRINDO FORMULÁRIO MODAL ********************/

	var form_modal = false;

	$('.header-a, .form-modal-back, .box-servicos02-text a, .mobile-header-a').click(function(){

		if(form_modal){
			$('.form-modal').fadeOut();
			$('header').fadeIn();
			form_modal = false;
		} else{
			$('.form-modal-form').show();
			$('.form-modal-form-contato').hide();
			$('.form-modal').fadeIn();
			$('header').fadeOut();
			$('#rd-select_field-kre29nll option:first-of-type').text('Quem é você?');
			$('#rd-select_field-kre29nll option:first-of-type').prop('disabled',true);
			$('#rd-select_field-kre29nlm option:first-of-type').text('Como conheceu a Far.Me?');
			$('#rd-select_field-kre29nlm option:first-of-type').prop('disabled',true);
			form_modal = true;			
		}

		return false;
	})

	$('.link-contato').click(function(){

		if(form_modal){
			$('.form-modal').fadeOut();
			$('header').fadeIn();
			form_modal = false;
		} else{
			$('.form-modal-form').hide();
			$('.form-modal-form-contato').show();
			$('.form-modal').fadeIn();
			$('header').fadeOut();
			form_modal = true;			
		}

		return false;
	})


	/*************** ANIMAÇÃO DO LABEL DO FORMULÁRIO ********************/

	$('#rd-form-kql9ohpa .bricks-form__input').each(function(){
		console.log('focus');
		$(this).parent().find('.bricks-form__label').animate({
			top: 0,
			left: 0
		})
	})

	/**************** WINDOW RESIZE *******************/
	var isMobile = false; //initiate as false
	// device detection
	if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
	    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
	    isMobile = true;
	}

	var rtime;
	var timeout = false;
	var delta = 200;
	$(window).resize(function() {
	    rtime = new Date();
	    if (!isMobile && timeout === false) {
	        timeout = true;
	        setTimeout(resizeend, delta);
	    }
	});

	function resizeend() {
	    if (new Date() - rtime < delta) {
	        setTimeout(resizeend, delta);
	    } else {
	        timeout = false;
	        location.reload();
	    }               
	}

	$(window).on('load',function() {


		/*************** ANIMAÇÃO GALERIA DE DEPOIMENTOS ********************/

		var depoimentos_opcoes_valor = $('#depoimentos .container opcoes').attr('valor');

		$('.box-depoimentos-gallery-arrow-right').click(function(){
	  		var leftPos = $('.box-depoimentos').scrollLeft();
	  		if( $(window).width() > 1054){
		  		$(".box-depoimentos").animate({
		  			scrollLeft: leftPos + 374
		  		}, 400);
	  		}
	  		else{
		  		$(".box-depoimentos").animate({
		  			scrollLeft: leftPos + 282
		  		}, 400);  			
	  		}
		})

		$('.box-depoimentos-gallery-arrow-left').click(function(){
	  		var leftPos = $('.box-depoimentos').scrollLeft();
	  		if( $(window).width() > 1054){
		  		$(".box-depoimentos").animate({
		  			scrollLeft: leftPos - 374
		  		}, 400);
	  		}
	  		else{
		  		$(".box-depoimentos").animate({
		  			scrollLeft: leftPos - 282
		  		}, 400);  			
	  		}
		})

		var dots_length = $('.box-depoimentos-dots div').length;
		var dots_pos = 0;

		galeria_start();

		function galeria_start(){
			$('.box-depoimentos-dots div:first-of-type').css('background-color','#FFC875');
		}

		setInterval(function(){
			if(depoimentos_opcoes_valor == 'Pontos'){
		  		var leftPos = $('.box-depoimentos').scrollLeft();

		  		$('.box-depoimentos-dots div').each(function(){
		  			$(this).css('background-color','#999999');
		  		})

		  		dots_pos++;
				if(dots_pos > (dots_length - 1)){
					dots_pos = 0;
				}
		  		$('.box-depoimentos-dots div:nth-of-type('+(dots_pos + 1)+')').css('background-color','#FFC875');

				if(dots_pos == 0){
					dots_pos = 0;
			  		$(".box-depoimentos").animate({
			  			scrollLeft: 0
			  		}, 400);
				} else{

			  		if( $(window).width() > 1054){
				  		$(".box-depoimentos").animate({
				  			scrollLeft: leftPos + 374
				  		}, 1000);
			  		}
			  		else{
				  		$(".box-depoimentos").animate({
				  			scrollLeft: leftPos + 282
				  		}, 1000);  			
			  		}

				}
			}
		},8000);

		$('.box-depoimentos-dots div').click(function(){
	  		var leftPos = $('.box-depoimentos').scrollLeft();
	  		var dots_goto = $(this).index() - dots_pos;

	  		$('.box-depoimentos-dots div').each(function(){
	  			$(this).css('background-color','#999999');
	  		})

	  		$(this).css('background-color','#FFC875');

	  		if( $(window).width() > 1054){
		  		$(".box-depoimentos").animate({
		  			scrollLeft: leftPos + (374 * dots_goto)
		  		}, 400);
	  		}
	  		else{
		  		$(".box-depoimentos").animate({
		  			scrollLeft: leftPos + (282 * dots_goto)
		  		}, 400);  			
	  		}

			dots_pos = $(this).index();
		})


		/*************** CORREÇÃO DO CAMPO DE SELEÇÃO DO RD ********************/

		$('.header-desktop .header-a').click(function(){
		})

	});

});