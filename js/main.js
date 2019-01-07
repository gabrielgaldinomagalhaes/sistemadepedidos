(function ($) {
	"use strict";

	var $window = $(window),
		$body = $('body');

	jQuery(document).ready(function($){

		/*======== Smoothscroll js ===========*/
		$(function() {
			$('a.smoth-scroll').on('click', function(event) {
			var $anchor = $(this);
			$('html, body').stop().animate({
				scrollTop: $($anchor.attr('href')).offset().top - 0
			}, 1000);
			event.preventDefault();
			});
		});  

		/*======== jquery scroll spy ===========*/
		$body.scrollspy({
			target : ".navbar-collapse",
			offset : 95
		});

		/*========  Bootstrap menu fix ===========*/
		$(".navbar-toggle").on("click", function(){
			$body.addClass("mobile-menu-activated");
		});

		$("ul.nav.navbar-nav li a").on("click", function(){
			$(".navbar-collapse").removeClass("in");
		});

		/*======== background-image flickering solution for mobile ===========*/
		var bg = jQuery("#home");
		function resizeBackground() {
			bg.height(jQuery(window).height() + 60);
		}
		resizeBackground();

		/*======== Modal js ===========*/
		$("#projectModal1, #projectModal2, #projectModal3, #projectModal4, #projectModal5, #projectModal6, #projectModal7, #projectModal8, #projectModal9").on('hidden.bs.modal', function (e) {
			$("#projectModal1 iframe, #projectModal2 iframe, #projectModal3 iframe, #projectModal3 iframe, #projectModal4 iframe, #projectModal5 iframe, #projectModal6 iframe, #projectModal7 iframe, #projectModal8 iframe, #projectModal9 iframe").attr("src", $("projectModal1 iframe, #projectModal2 iframe, #projectModal3 iframe, #projectModal3 iframe, #projectModal4 iframe, #projectModal5 iframe, #projectModal6 iframe, #projectModal7 iframe, #projectModal8 iframe, #projectModal9 iframe").attr("src"));
		});

	});

	$window.on('load', function(){

	/*======== Preloder ===========*/
	setTimeout(function() {
		$('body').addClass('loaded');
	}, 2500);	

	});

	$('#delete-modal').on('show.bs.modal', function (event) {

	var button = $(event.relatedTarget);
	var id = button.data('order');

	var modal = $(this);
	modal.find('.modal-title').text('Excluir Pedido #' + id);
	modal.find('#confirm').attr('href', 'delete.php?id=' + id);
	});

	$(".items-amount").keypress(function (evt) {
		evt.preventDefault();
	});

}(jQuery));	


function check_amount(quantity,linhas){
	var quant = quantity.value;
	var id = quantity.id;

	var split = id.split("_");


	var price = $("#item-price_"+split[1]).val();	
	var calculo = quant * price;
	calculo = calculo.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
	$("#item-total_"+split[1]).val(calculo);
	$("#item-total-hid_"+split[1]).val(calculo);
	check_order(linhas);
	value_final_total(linhas);
}

function check_order(linhas){
	var check_rent = true;
	var check_quan = false;
	var x= 1;
	for (x; x<= linhas; x++){
		if($('#rentability_'+x).hasClass('bad')){
		   check_rent = false;	  
		}
		if ($('#amount-item_'+x).val()>0){
			check_quan = true;
		}
	}
	if(check_rent && check_quan){
		value_final_total(linhas);
		enable_button();
	}else{
		disable_button();
	}

}


function enable_button(){
	$("#salvar").prop('disabled',false);
	$("#block-text").addClass('hidden');
}

function disable_button(){
	$("#salvar").prop('disabled',true);
	$("#block-text").removeClass('hidden');
}

function value_final_total(linhas){
	var x= 1
	var final_value = 0;
	for (x; x<= linhas; x++){
		var item_value = $("#item-total_"+x).val().replace(/[^\d]+/g,'');
		item_value = parseInt(item_value, 10);
		if($.isNumeric(item_value)){
		}else{
			item_value =0;
		}
		final_value = final_value + item_value;
	}
	final_value = final_value/100;
	final_value = final_value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
	$("#order-total").val(final_value);
	$("#order-total-hidden").val(final_value);

}

function value_update(value,linhas){

	var value_item = value.value;
	var split = value.id;
	var id = split.split("_");
	var qtd = $("#amount-item_"+id[1]).val();

	var calculo = qtd * value_item;
	calculo = calculo.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
	$("#item-total_"+id[1]).val(calculo);
	$("#item-total-hid_"+id[1]).val(calculo);


	var suggested_price= $("#suggest-price_"+id[1]).val().replace(/[^\d]+/g,'');
	value_item = parseFloat(value_item).toFixed(2);
	$("#item-price_"+id[1]).val(value_item);	
	value_item = value_item.replace(/[^\d]+/g,'');

	value_item= parseInt(value_item, 10);
	suggested_price= parseInt(suggested_price, 10);
	
	if(eval(value_item > suggested_price)){
		$("#rentability_"+id[1]).addClass('great');
		$("#rentability_"+id[1]).removeClass('good');
		$("#rentability_"+id[1]).removeClass('bad');


		$("#text-great_"+id[1]).removeClass('hidden');
		$("#text-good_"+id[1]).addClass('hidden');
		$("#text-bad_"+id[1]).addClass('hidden');

		$("#rentab_"+id[1]).val("Ótima");
	}else if(eval(value_item >= eval(suggested_price - (suggested_price/10)))){
		$("#rentability_"+id[1]).addClass('good');
		$("#rentability_"+id[1]).removeClass('great');
		$("#rentability_"+id[1]).removeClass('bad');

		$("#text-good_"+id[1]).removeClass('hidden');
		$("#text-great_"+id[1]).addClass('hidden');
		$("#text-bad_"+id[1]).addClass('hidden');

		$("#rentab_"+id[1]).val("Boa");
	}else{
		$("#rentability_"+id[1]).addClass('bad');
		$("#rentability_"+id[1]).removeClass('great');
		$("#rentability_"+id[1]).removeClass('good');

		$("#text-bad_"+id[1]).removeClass('hidden');
		$("#text-great_"+id[1]).addClass('hidden');
		$("#text-good_"+id[1]).addClass('hidden');

		$("#rentab_"+id[1]).val("Ruim");
	}

	value_final_total(linhas);
	check_order(linhas);

}