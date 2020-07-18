$(document).ready(function(){
	$('.form-input-holder').hide();	
	$('form').append($('<input type="button" class="form-toggle-button" value="show">'));
	
	$('.form-toggle-button').click(function(){
		var btnVal = $(this).val();
		if (btnVal == 'show') {
			$(this).parent().children('.form-input-holder').show();
			$(this).attr('value', 'hide');
		}else{
			$(this).parent().children('.form-input-holder').hide();
			$(this).attr('value', 'show');	
		}
	});
	
	/*
	$('.button').click(function(){
		var clickBtnValue = $(this).val();
		var ajaxurl = '../controller/requestHandler.php';
		data = {'action': clickBtnValue};
		$.get(ajaxurl, data, function(response){
			alert(response);		
		});
	});
	*/
});