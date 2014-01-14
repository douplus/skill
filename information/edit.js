$(function(){
  	$('#edit-wrap').imagesLoaded(function () {
	          $('#edit-wrap').masonry({        
		                itemSelector: '.block',
		              columnWidth: 364,
		              animate:true
		            });
		  	});
});

$(document).on('click', '#account_container em.account_modify',function(){  // �s�� ��T
	switch( $(this).attr('_role') ){
		case 'account_experience':
		case 'account_about':
		case 'account_motto':
		case 'account_education':
		case 'account_email':
			var $a = $(this).parent();
			var a = $a.prev().children().text();
			$a.prev().addClass('dom_hidden').prev().removeClass('dom_hidden').children().val( a );
			$(this).data('temp', a).addClass('dom_hidden').next().removeClass('dom_hidden');
			break;
		case 'account_skill':
			Edit_Skill( $(this) );
			break;
		case 'account_need':
			Edit_Need( $(this) );
			break;
		default:
			break;
	}
});
$(document).on('click', '#account_container section.account_edit > [_action=cancel]',function(){  // ���� �ק��T
	switch( $(this).attr('_role') ){
		case 'account_experience':
		case 'account_about':
		case 'account_motto':
		case 'account_education':
	pcase 'account_email':
			var a = $(this).parent().prev().data().temp;
			$(this).parent().addClass('dom_hidden').prev().removeClass('dom_hidden').parent().prev().removeClass('dom_hidden').children().text(a).end().prev().addClass('dom_hidden');
			break;
		case 'account_skill':
			var a = $(this).parent().prev().data().temp;
			var b = a.split(',');
			var temp = '';
			for( var i=0; i<b.length; i++ ){
				temp += '<span>'+b[i]+'</span>';
			}
			$(this).parent().addClass('dom_hidden').prev().removeClass('dom_hidden').parent().prev().removeClass('dom_hidden').html(temp).prev().addClass('dom_hidden').children('#modify_skill').val(a);
			break;
		case 'account_need':
			var a = $(this).parent().prev().data().temp;
			var b = a.split(',');
			var temp = '';
			for( var i=0; i<b.length; i++ ){
				temp += '<span>'+b[i]+'</span>';
			}
			$(this).parent().addClass('dom_hidden').prev().removeClass('dom_hidden').parent().prev().removeClass('dom_hidden').html(temp).prev().addClass('dom_hidden').children('#modify_need').val(a);
			break;
		default:
			break;
	}
});
$(document).on('click', '#account_container section.account_edit > [_action=save]',function(){  // �x�s �ק��T
	var temp = true;
	switch( $(this).attr('_role') ){
		case 'account_experience':
			var experience = $('#modify_experience').val().trim();
			if( experience == '' ){
				alert('����g���e�C');
				temp = false;
			}else{
				if( experience.length > 140 ){
					alert('���e���i�H�W�L 140 �Ӧr���C');
					temp = false;
				}else{
					var bl = CheckTextarea( experience );
					if( !bl ){
						alert('���e�榡���~�A�t�����{�i���S��r���C');
						temp = false;
					}
				}
			}
			if( temp ) SaveExperience( experience, this );
			break;
		case 'account_about':
			var about = $('#modify_about').val().trim();
			if( about == '' ){
				alert('����g���e�C');
				temp = false;
			}else{
				if( about.length > 100 ){
					alert('���e���i�H�W�L 100 �Ӧr���C');
					temp = false;
				}else{
					var bl = CheckTextarea( about );
					if( !bl ){
						alert('���e�榡���~�A�t�����{�i���S��r���C');
						temp = false;
					}
				}
			}
			if( temp ) SaveAbout( about, this );
			break;
		case 'account_motto':
			var motto = $('#modify_motto').val().trim();
			if( motto == '' ){
				alert('����g���e�C');
				temp = false;
			}else{
				if( motto.length > 50 ){
					alert('���e���i�H�W�L 50 �Ӧr���C');
					temp = false;
				}else{
					var bl = CheckTextarea( motto );
					if( !bl ){
						alert('���e�榡���~�A�t�����{�i���S��r���C');
						temp = false;
					}
				}
			}
			if( temp ) SaveMotto( motto, this );
			break;
		case 'account_education':
			var education = $('#modify_education').val().trim();
			if( education == '' ){
				alert('����g���e�C');
				temp = false;
			}else{
				if( education.length > 50 ){
					alert('���e���i�H�W�L 50 �Ӧr���C');
					temp = false;
				}else{
					var bl = CheckTextarea( education );
					if( !bl ){
						alert('���e�榡���~�A�t�����{�i���S��r���C');
						temp = false;
					}
				}
			}
			if( temp ) SaveEducation( education, this );
			break;
		case 'account_email':
			var email = $('#modify_email').val().trim();
			if( email == '' ){
				alert('����g�q�l�H�c�C');
				temp = false;
			}else{
				if( email.length > 50 ){
					alert('�q�l�H�c���פ����ӶW�L 50 �Ӧr���C');
					temp = false;
				}else{
					var bl = CheckEmail( email );
					if( !bl ){
						alert('�q�l�H�c�榡���~�C');
						temp = false;
					}
				}
			}
			if( temp ) SaveEmail( email, this );
			break;
		case 'account_skill':
			if( $('#modify_skill').val().trim() == '' ){
				alert('�п�J�ޯ�');
			}else{
				SaveSkill( $('#modify_skill').val(), this );
			}
			break;
		case 'account_need':
			if( $('#modify_need').val().trim() == '' ){
				alert('�п�J�ݨD');
			}else{
				SaveNeed( $('#modify_need').val(), this );
			}
			break;
		default:
			break;
	}
});

