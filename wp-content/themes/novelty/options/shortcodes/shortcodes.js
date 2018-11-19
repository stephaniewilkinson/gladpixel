/*
 * jQuery plugin: fieldSelection - v0.1.1 - last change: 2006-12-16
 * (c) 2006 Alex Brem <alex@0xab.cd> - http://blog.0xab.cd
 */
(function(){var fieldSelection={getSelection:function(){var e=(this.jquery)?this[0]:this;return(('selectionStart'in e&&function(){var l=e.selectionEnd-e.selectionStart;return{start:e.selectionStart,end:e.selectionEnd,length:l,text:e.value.substr(e.selectionStart,l)}})||(document.selection&&function(){e.focus();var r=document.selection.createRange();if(r===null){return{start:0,end:e.value.length,length:0}}var re=e.createTextRange();var rc=re.duplicate();re.moveToBookmark(r.getBookmark());rc.setEndPoint('EndToStart',re);return{start:rc.text.length,end:rc.text.length+r.text.length,length:r.text.length,text:r.text}})||function(){return null})()},replaceSelection:function(){var e=(typeof this.id=='function')?this.get(0):this;var text=arguments[0]||'';return(('selectionStart'in e&&function(){e.value=e.value.substr(0,e.selectionStart)+text+e.value.substr(e.selectionEnd,e.value.length);return this})||(document.selection&&function(){e.focus();document.selection.createRange().text=text;return this})||function(){e.value+=text;return jQuery(e)})()}};jQuery.each(fieldSelection,function(i){jQuery.fn[i]=this})})();

jQuery(document).ready(function($) {

$('.radio_img').click(function() {
	$('.radio-images').find(':radio').attr('checked', false);
	$(this).find(":radio").attr('checked', true);
	$('.radio-images').find('span.radio_active').removeClass('radio_active');
	$(this).find("span").addClass('radio_active');
	$('.radio_img').removeClass('radio_img_active');
	$(this).addClass('radio_img_active');
})

setUpTabs();

$('.nav-shortcode-tabs').change(function() {
	var getIndex = $(this).val();
	$('.shortcode-tab').hide();
	$('.shortcode-tab').eq(getIndex).fadeIn();
	$(this).parent().addClass('active');
	e.preventDefault();
});


$('.shortcode-tab form').submit(function(e){

	var $formId = this;
	$('.shortcode-tab form span.error').remove();
	$('.shortcode-tab form .error').removeClass('error');
	var $loading = $('<div id="shortcode-loading"><span></span></div>');
	var $error = $('<span class="error"></span>');
	formAction = $(this).attr('action');
	
	// Validation for required fields
	$('.required',this).each(function(){
		var $parentTag = $(this).parent();
		var inputVal = $(this).val();
		if(inputVal == ''){
			$parentTag.addClass('error').append($error.clone().text('Required'));
		}

	});


	// All validation complete - Check if any errors exist
	if (!$('span.error',this).length){
		$(this).append($loading.clone());
		$.post(formAction, $(this).serialize(),function(data){
			if($($formId).hasClass('helper')){
				var parentFormId = $('.helper-form',$formId).val();
				var $codeContent = $('#'+parentFormId+' .content');
				var current = $($codeContent).val();
				$($codeContent).val(current+data);
				$('.text-input',$formId).val('');
				$('.text-area',$formId).val('');
				$('#shortcode-loading').remove();
			} else {
				var win = window.dialogArguments || opener || parent || top;
				win.send_to_editor(data);
			}
		});
	}
	e.preventDefault();
});


$('.link-create-item').click(function(e){
		var getId = $(this).attr('rel');
		$('#'+getId).slideToggle();
		if($(this).hasClass('set-1')){
			$('form.set-2').slideUp();
		}
		if($(this).hasClass('set-2')){
			$('form.set-1').slideUp();
		}
		e.preventDefault();
});	



	$('.shortcode-link').click(function(){
		var textContent = $('#content').getSelection();
		if(textContent){
			$('.content').val(textContent.text);
		}
	});

	$('#form-item-input').change(function(){
		var selected = $(':selected',this).val();
		selected = '.'+selected+'-form';
		$('.shortcode-tab .hide').hide();
		$('.shortcode-tab '+selected).show();
		$('#form-item-email-from').removeAttr('checked');
			$('#form-item-validation').val('1');
	});

	$('#form-item-validation').change(function(){
		var val = $(':selected',this).val();
		if(val == 2){
			$('#email-from-field').slideDown();
		} else {
			$('#form-item-email-from').removeAttr('checked');
			$('#email-from-field').hide();
			
		}
	});
});


function setUpTabs(){
	jQuery('.shortcode-tab').hide();
	jQuery('.shortcode-tab').eq(0).show();
	jQuery('.nav-shortcode-tabs li').eq(0).addClass('active');
}