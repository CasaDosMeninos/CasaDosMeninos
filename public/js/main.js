$(function() {


/* Form related plugins
================================================== */

	//===== Validation engine =====//
	
	$(".validate").validationEngine();

/* General stuff
================================================== */


	//===== Left navigation styling =====//
	
	$('li.this').prev('li').css('border-bottom-color', '#2c3237');
	$('li.this').next('li').css('border-top-color', '#2c3237');
	
	/*$('.smalldd ul li').mouseover(
	function() { $(this).prev('li').css('border-bottom-color', '#3d434a') }
	);
	
	$('.smalldd ul li').mouseout(
	function() { $(this).prev('li').css('border-bottom-color', '#1c252a') }
	);*/

	//$('.smalldd ul li').next('li').css('border-top-color', '#2c3237');

	
	/*$('ul.nav li a').mouseover(
		function(){
		$(this).parent().prev('li').children("> a").addClass('bottomBorder'); 
		}
		);
		
		$('ul.nav li a').mouseout(
		function(){
		$(this).parent().prev('li').children("a").removeClass('bottomBorder'); 
		}
	);*/
	
	
	//===== User nav dropdown =====//		
	
	$('.dd').click(function () {
		$('.userDropdown').slideToggle(200);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("dd"))
		$(".userDropdown").slideUp(200);
	});
	  
	  
	  
	//===== Statistics row dropdowns =====//	
		
	$('.ticketsStats > h2 a').click(function () {
		$('#s1').slideToggle(150);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("ticketsStats"))
		$("#s1").slideUp(150);
	});
	
	
	$('.visitsStats > h2 a').click(function () {
		$('#s2').slideToggle(150);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("visitsStats"))
		$("#s2").slideUp(150);
	});
	
	
	$('.usersStats > h2 a').click(function () {
		$('#s3').slideToggle(150);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("usersStats"))
		$("#s3").slideUp(150);
	});
	
	
	$('.ordersStats > h2 a').click(function () {
		$('#s4').slideToggle(150);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("ordersStats"))
		$("#s4").slideUp(150);
	});
	
	
	
	//===== Collapsible elements management =====//
	
	$('.exp').collapsible({
		defaultOpen: 'current',
		cookieName: 'navAct',
		cssOpen: 'active',
		cssClose: 'inactive',
		speed: 200
	});
	
	$('.opened').collapsible({
		defaultOpen: 'opened,toggleOpened',
		cssOpen: 'inactive',
		cssClose: 'normal',
		speed: 200
	});
	
	$('.closed').collapsible({
		defaultOpen: '',
		cssOpen: 'inactive',
		cssClose: 'normal',
		speed: 200
	});
	
	
	$('.goTo').collapsible({
		defaultOpen: 'openedDrop',
		cookieName: 'smallNavAct',
		cssOpen: 'active',
		cssClose: 'inactive',
		speed: 100
	});
	
	/*$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("smalldd"))
		$(".smallDropdown").slideUp(200);
	});*/



	
	//===== Middle navigation dropdowns =====//
	
	$('.mUser').click(function () {
		$('.mSub1').slideToggle(100);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("mUser"))
		$(".mSub1").slideUp(100);
	});
	
	$('.mMessages').click(function () {
		$('.mSub2').slideToggle(100);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("mMessages"))
		$(".mSub2").slideUp(100);
	});
	
	$('.mFiles').click(function () {
		$('.mSub3').slideToggle(100);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("mFiles"))
		$(".mSub3").slideUp(100);
	});
	
	$('.mOrders').click(function () {
		$('.mSub4').slideToggle(100);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("mOrders"))
		$(".mSub4").slideUp(100);
	});



	//===== User nav dropdown =====//		
	
	$('.sidedd').click(function () {
		$('.sideDropdown').slideToggle(200);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("sidedd"))
		$(".sideDropdown").slideUp(200);
	});
	
	
	//$('.smalldd').click(function () {
	//	$('.smallDropdown').slideDown(200);
	//});

/* # Pickers
================================================== */

	//===== Datepicker =====//

	$( ".datepicker" ).datepicker({
        language: 'pt-BR',
		defaultDate: +7,
		autoSize: true,
		appendText: '(dd-mm-yyyy)',
		dateFormat: 'dd-mm-yy',
		numberOfMonths: 1,
        altField: ".hidDatePicker",
        altFormat: "yy-mm-dd"
	});

/* UI stuff
================================================== */

	//===== Form elements styling =====//
	
	$("select, input:checkbox, input:radio, input:file").uniform();

	//===== Tooltips =====//
	
	$('.tipN').tipsy({gravity: 'n',fade: true});

    //===== Dialog =====//

    $( "#dialog-message" ).dialog({
        autoOpen: false,
        modal: true,
        width:400
    });

    $( "#opener" ).click(function() {
        $( "#dialog-message" ).dialog( "open" );
        return false;
    });

/* Tables
================================================== */

	
	//===== Dynamic data table =====//
	
	oTable = $('.dTable').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<""l>t<"F"fp>',
        "language": {
            "search": "Buscar: ",
            "lengthMenu": "Mostrar _MENU_ itens por p&aacute;gina",
            "zeroRecords": "Nenhum registro",
            "info": "Mostrando _PAGE_ p&aacute;ginas de _PAGES_",
        }

	});




});