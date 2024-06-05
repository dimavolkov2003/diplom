$('.pop-up').hide().css('opacity', 1);
$('.project-page .ok-date').hide().css('opacity', 1);
$('.doc-page .alert').hide().css('opacity', 1);
$('.doc-page .ok-date').hide().css('opacity', 1);

$(document).ready(function(){
	
	if( $('.user-msg').length > 0 ){
		$('.user-msg').fadeOut(10000);
		setTimeout(() => $('.user-msg').remove(), 5000);
	}
	
	let menuActive = $('.wrap .main .menu .active')
	if( menuActive.hasClass('project') ){
		menuActive.find('img').attr('src', '/img/i4.png');
	}
	if( menuActive.hasClass('doc') ){
		menuActive.find('img').attr('src', '/img/i5.png');
	}
	if( menuActive.hasClass('user') ){
		menuActive.find('img').attr('src', '/img/i6.png');
	}
	if( menuActive.hasClass('log') ){
		menuActive.find('img').attr('src', '/img/i18.png');
	}
	
	$('.wrap .login-page .form .view .view-btn').on( "click", function(e) {
		if( $('.wrap .login-page .form .pass').attr('type') == 'password' ){
			$('.wrap .login-page .form .pass').attr('type', 'text');
		}else{
			$('.wrap .login-page .form .pass').attr('type', 'password');
		}
	});
	
	
	$('.wrap .header .show-menu').on( "click", function(e) {
		$('.wrap .main .menu .link span').toggle(250);
	});
	
	
	$('.wrap .header .sub-menu .img').on( "click", function(e) {
		$('.wrap .header .sub-menu .list').toggle(50);
	});
	$('.wrap .header .sub-menu .list').on( "click", function(e) {
		$('.wrap .header .sub-menu .list').toggle(50);
	});
	
	$('.wrap .main .items .item .select img').on( "click", function(e) {
		let up = $(this).parents('.item');
		
		if( up.hasClass('active') ){
			up.removeClass('active');
			up.find('.select img').attr('src', '/img/i13.png');
		}else{
			$('.wrap .main .items .item').removeClass('active');
			$('.wrap .main .items .item .select img').attr('src', '/img/i13.png');
			
			up.addClass('active');
			$(this).attr('src', '/img/i14.png');
		}
	});
	
	
	$('.pop-up .center').on( "click", function(e) {
		e.stopPropagation();
	});
	$('.pop-up').on( "click", function(e) {
		$('.pop-up').toggle();
	});
	$('.pop-up .close').on( "click", function(e) {
		$('.pop-up').toggle();
	});
	$('.main .content .manage .create-show').on( "click", function(e) {
		$('.pop-up .name').text('Новий користувач');
		$('.pop-up').toggle();
	});
	
	$('.wrap .content .manage .right .create-show .create').on( "click", function(e) {
		$('.user-page .pop-up input:not(.btn)').each(function( index ) {
			$(this).val('');
		});
	});
	
	/* manage user-page */
	
	$('.user-page .content .manage .edit').on( "click", function(e) {
		if( $('.wrap .main .items .data-list .active').length == 0 ){
			return;
		}
		
		$('.pop-up .name').text('Редагування користувача');
		
		let access = $('.wrap .main .items .data-list .item.active').data('lvl');
		let docLvl = $('.wrap .main .items .data-list .item.active').data('doclvl');

		$('.pop-up').toggle();
		
		$('.user-page .pop-up .inp-id').val( $('.wrap .main .items .data-list .item.active').data('id') );
		$('.user-page .pop-up .inp-name').val( $('.wrap .main .items .data-list .item.active .name span').text() );
		$('.user-page .pop-up .inp-email').val( $('.wrap .main .items .data-list .item.active .email').text() );
		$('.user-page .pop-up .inp-login').val( $('.wrap .main .items .data-list .item.active .login').text() );
		
		$('.user-page .pop-up .inp-access').removeAttr('selected');
		
		$('.user-page .pop-up .inp-access option').each(function( index ) {
			if( $(this).attr('value') == access ){
				$(this).attr("selected", "selected");
			}
		});
		
		$('.user-page .pop-up .inp-doc-lvl option').each(function( index ) {
			$(this).removeAttr("selected");
			
			if( $(this).attr('value') == docLvl ){
				$(this).attr("selected", "selected");
			}
		});
	});
	
	$('.user-page .content .manage .del').on( "click", function(e) {
		let id = $('.wrap .main .items .data-list .item.active').data('id');
		
		if( id > 0 ){
			window.location.href = "/main/remove?id=" + id;
		}
	});
	
	/* manage project-page */
	
	$('.project-page .content .manage .edit').on( "click", function(e) {
		if( $('.wrap .main .items .data-list .active').length == 0 ){
			return;
		}
		
		$('.pop-up .name').text('Редагування');
		
		let status = $('.wrap .main .items .data-list .item.active').data('status');
		let user = $('.wrap .main .items .data-list .item.active').data('user');
		let audit = $('.wrap .main .items .data-list .item.active').data('audit');
		
		$('.pop-up').toggle();
		
		$('.project-page .pop-up .inp-id').val( $('.wrap .main .items .data-list .item.active').data('id') );
		$('.project-page .pop-up .inp-name').val( $('.wrap .main .items .data-list .item.active').data('name') );
		$('.project-page .pop-up .inp-about').val( $('.wrap .main .items .data-list .item.active').data('des') );
		
		$('.project-page .pop-up .inp-from').val( $('.wrap .main .items .data-list .item.active .from').data('date') );
		$('.project-page .pop-up .inp-to').val( $('.wrap .main .items .data-list .item.active .to').data('date') );
		$('.project-page .pop-up .inp-label').val( $('.wrap .main .items .data-list .item.active .name').text() );
		
		
		$('.project-page .pop-up .inp-user option').each(function( index ) {
			if( user_level_id == 2 ){
				if( $(this).attr('value') == user_curr_id ){
					$(this).show().attr("selected", "selected");
				}else{
					$(this).remove();
				}
			}else{
				$(this).removeAttr("selected");
				
				$(this).show();
				
				if( $(this).data('lvl') != 4 ){
					$(this).hide();
				}
				
				if( $(this).attr('value') == user ){
					$(this).show().attr("selected", "selected");
				}
			}	
		});
		
		$('.project-page .pop-up .inp-audit option').each(function( index ) {
			$(this).removeAttr("selected");
			
			$(this).show();
			
			if( $(this).data('lvl') != 4 ){
				$(this).hide();
			}
			
			if( $(this).attr('value') == audit ){
				$(this).show().attr("selected", "selected");
			}
				
		});

		
		$('.project-page .pop-up .inp-status').removeAttr('selected');
		
		$('.project-page .pop-up .inp-status option').each(function( index ) {
			if( $(this).attr('value') == status ){
				$(this).attr("selected", "selected");
			}
		});
		
		$('.project-page .pop-up .inp-status-label').show();
		$('.project-page .pop-up .inp-status').show();
		$('.project-page .pop-up .inp-audit').hide();
		$('.project-page .pop-up .inp-audit-label').hide();
	});
	
	
	$('.project-page .main .content .manage .create-show').on( "click", function(e) {
		$('.pop-up .name').text('Новий запис');
		
		if( user_level_id == 2 ){
			$('.project-page .pop-up .inp-user option').each(function( index ) {
				if( $(this).attr('value') == user_curr_id ){
					$(this).show().attr("selected", "selected");
				}else{
					$(this).remove();
				}
			});
		}else{
			$('.project-page .pop-up .inp-user option').each(function( index ) {
				$(this).show();
				
				if( $(this).data('lvl') != 4 ){
					$(this).hide();
				}
			});
		}
		
		$('.project-page .pop-up .inp-audit option').each(function( index ) {
			$(this).show();
			
			if( $(this).data('lvl') != 4 ){
				$(this).hide();
			}
		});
		
		$('.project-page .pop-up .inp-status-label').hide();
		$('.project-page .pop-up .inp-status').hide();
		
		$('.project-page .pop-up .inp-audit').show();
		$('.project-page .pop-up .inp-audit-label').show();
	});
	
	$('.wrap .content .manage .right .create-show .create').on( "click", function(e) {
		$('.project-page .pop-up input:not(.btn)').each(function( index ) {
			$(this).val('');
		});
		$('.project-page .pop-up textarea').val('');
	});
	
	$('.project-page .content .manage .ok').on( "click", function(e) {
		if( $('.wrap .main .items .data-list .active').length == 0 ){
			return;
		}
		
		if( $('.wrap .main .items .data-list .active').hasClass('warning') ){
			$('.project-page .ok-date .warning').show();
		}else{
			$('.project-page .ok-date .warning').hide();
		}
	
		$('.project-page .ok-date .name span').text( $('.wrap .main .items .data-list .item.active .name').text() );
		$('.project-page .ok-date').toggle();
	});
	
	$('.project-page .ok-date .like-btn').on( "click", function(e) {
		let id = $('.wrap .main .items .data-list .item.active').data('id'),
			date = $('.ok-date .data .full').val();
		
		if( id > 0 && date != ''){
			window.location.href = "/project/status?id=" + id + "&date=" + date;
		}
	});
	
	
	$('.project-page .ok-date .close').on( "click", function(e) {
		$('.project-page .ok-date').toggle();
	});
	
	$('.project-page .content .manage .del').on( "click", function(e) {
		let id = $('.wrap .main .items .data-list .item.active').data('id');
		
		if( id > 0 ){
			window.location.href = "/project/remove?id=" + id;
		}
	});
	
	/* manage doc-page */
	
	$('.doc-page .content .manage .edit').on( "click", function(e) {
		if( $('.wrap .main .items .data-list .active').length == 0 ){
			return;
		}
		
		$('.pop-up .name').text('Редагування документу');
		
		$('.doc-page .pop-up .inp-load').prop('required', false).addClass('reload');
		let status = $('.wrap .main .items .data-list .item.active').data('status');
		let user = $('.wrap .main .items .data-list .item.active').data('user');
		let docLvl = $('.wrap .main .items .data-list .item.active').data('doclvl');
		
		$('.pop-up').toggle();
		
		$('.doc-page .pop-up .inp-id').val( $('.wrap .main .items .data-list .item.active').data('id') );
		$('.doc-page .pop-up .inp-name').val( $('.wrap .main .items .data-list .item.active').data('name') );
		$('.doc-page .pop-up .inp-about').val( $('.wrap .main .items .data-list .item.active').data('des') );
		$('.doc-page .pop-up .inp-words').val( $('.wrap .main .items .data-list .item.active').data('words') );
		

		$('.doc-page .pop-up .inp-from').val( $('.wrap .main .items .data-list .item.active .from').data('date') );
		$('.doc-page .pop-up .inp-to').val( $('.wrap .main .items .data-list .item.active .to').data('date') );
		$('.doc-page .pop-up .inp-label').val( $('.wrap .main .items .data-list .item.active .name').text() );
		
		
		$('.doc-page .pop-up .inp-user option').each(function( index ) {
			$(this).removeAttr("selected");
			
			$(this).show();
				
			if( $(this).data('lvl') != 4 ){
				$(this).hide();
			}
				
			if( $(this).attr('value') == user ){
				$(this).show().attr("selected", "selected");
			}	
		});

		

		$('.doc-page .pop-up .inp-status option').each(function( index ) {
			$(this).removeAttr("selected");
			
			if( $(this).attr('value') == status ){
				$(this).attr("selected", "selected");
			}
		});
		
		$('.doc-page .pop-up .inp-doc-lvl option').each(function( index ) {
			$(this).removeAttr("selected");
			
			if( $(this).attr('value') == docLvl ){
				$(this).attr("selected", "selected");
			}
		});
		
		$('.doc-page .pop-up .btn').show();
	});
	
	
	$('.doc-page .main .content .manage .create-show').on( "click", function(e) {
		$('.pop-up .name').text('Новий документ');
		
		$('.doc-page .pop-up .inp-load').prop('required', true).removeClass('reload');
		
		$('.doc-page .hide-for-doc').hide();
		
		$('.doc-page .pop-up .inp-user option').each(function( index ) {
			$(this).show();
			
			if( $(this).data('lvl') != 4 ){
				$(this).hide();
			}
		});
		
		$('.doc-page .pop-up .inp-user option').each(function( index ) {
			$(this).removeAttr("selected");	
		});
		
		$('.doc-page .pop-up .btn').show();
	});
	
	$('.wrap .content .manage .right .create-show .create').on( "click", function(e) {
		$('.doc-page .pop-up input:not(.btn)').each(function( index ) {
			if( !$(this).hasClass('inp-proj-id') ){
				$(this).val('');
			}
		});
		$('.doc-page .pop-up textarea').val('');
	});
	
	
	$(".doc-page .pop-up .inp-load").on( "change", function(e) {
		$('.doc-page .hide-for-doc').show();
	});
	
	$(".doc-page .pop-up .inp-user").on( "change", function(e) {
		let newLvl = $('.doc-page .pop-up .inp-doc-lvl').val(),
			userLvl = $(this).find('option:selected').data('doc');
		
		if( newLvl < userLvl ){
			$('.doc-page .alert').toggle();
		}
	});
	
	/*
	$('.doc-page .content .manage .ok').on( "click", function(e) {
		let id = $('.wrap .main .items .data-list .item.active').data('id');
		
		if( id > 0 ){
			window.location.href = "/doc/status?id=" + id;
		}
	});
	*/
	
	$('.doc-page .content .manage .ok').on( "click", function(e) {
		if( $('.wrap .main .items .data-list .active').length == 0 ){
			return;
		}
	
		$('.doc-page .ok-date .name span').text( $('.wrap .main .items .data-list .item.active .name').text() );
		$('.doc-page .ok-date').toggle();
	});
	
	$('.doc-page .ok-date .like-btn').on( "click", function(e) {
		let id = $('.wrap .main .items .data-list .item.active').data('id'),
			date = $('.ok-date .data .full').val();
		
		if( id > 0 && date != ''){
			window.location.href = "/doc/status?id=" + id + "&date=" + date;
		}
	});
	
	
	$('.doc-page .ok-date .close').on( "click", function(e) {
		$('.doc-page .ok-date').toggle();
	});
	
	
	
	
	
	$('.doc-page .content .manage .del').on( "click", function(e) {
		let id = $('.wrap .main .items .data-list .item.active').data('id');
		
		if( id > 0 ){
			window.location.href = "/doc/remove?id=" + id;
		}
	});
	
	
	
	$('.doc-page .alert .like-btn').on( "click", function(e) {
		$('.doc-page .pop-up .btn').show();
		$('.doc-page .alert').toggle();
	});
	
	$('.doc-page .alert .close').on( "click", function(e) {
		$('.doc-page .pop-up .btn').hide();
		$('.doc-page .alert').toggle();
	});
	
	
	$('.doc-page .pop-up .btn').hide();
	
	
	
	$('.data-list .show-img').on( "click", function(e) {
		$('.pop-up-img').toggle();
		$('.pop-up-img img').attr("src", $('.data-list .show-img').data('url') )
	});
	
	$('.pop-up-img').on( "click", function(e) {
		$(this).toggle();
	});
	
	$('.pop-up-img').hide();
});



































