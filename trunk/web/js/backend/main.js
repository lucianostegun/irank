$(function() {
	
	//===== Alerta padrão =====//
	$('#mainAlertDialog').dialog({
		autoOpen: false,
		modal: true,
		resizable: false,
		width: 550,
		height: 150,
		buttons: {
			Ok: function() {
				$('#mainAlertDialog').dialog('close');
			}
		}
	});
	
	//===== Collapsible elements management =====//
	
	$('.exp').collapsible({
		defaultOpen: 'current',
		cookieName: 'navAct',
		cssOpen: 'active',
		cssClose: 'inactive',
		speed: 200
	});
	
	//===== Tabs =====//
	
	$.fn.contentTabs = function(){ 
	
		$(this).find(".tab_content").hide(); //Hide all content
		$(this).find("ul.tabs li:first").addClass("activeTab").show(); //Activate first tab
		$(this).find(".tab_content:first").show(); //Show first tab content
	
		$("ul.tabs li").click(function() {
			return false;
		});
		
		$("ul.tabs li").mousedown(function() {
			$(this).parent().parent().find("ul.tabs li").removeClass("activeTab"); //Remove any "active" class
			$(this).addClass("activeTab"); //Add "active" class to selected tab
			$(this).parent().parent().find(".tab_content").hide(); //Hide all tab content
			var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
			$(activeTab).show(); //Fade in the active content
			
			return false;
		});
	};
	$("div[class^='widget']").contentTabs(); //Run function on any div with class name of "Content Tabs"
	


	//===== Form elements styling =====//
	
	$("select, input:checkbox, input:radio, input:file").uniform({
		maxSelectChars: 3
	});
	
	
	/* Tables
	================================================== */


		//===== Check all checbboxes =====//
		
		buildCheckboxTable(1);
		
		
		
		//===== Resizable columns =====//
		
		$("#res, #res1").colResizable({
			liveDrag:true,
			draggingClass:"dragging" 
		});
		  
		  
		  
		//===== Sortable columns =====//
		
		$("table").tablesorter();
		
		
		
		//===== Dynamic data table =====//
		
		oTable = $('.dTable').dataTable({
			"bJQueryUI": true,
			"iDisplayLength": 15,
			"sPaginationType": "full_numbers",
			"sDom": '<""l>t<"F"fp>',
			"aaSorting": [],
		});
		
		$(".datepicker").datepicker({ 
			defaultDate: +0,
			autoSize: false,
			appendText: '(dd/mm/aaaa)',
			dateFormat: 'dd/mm/yy'
			});

		$(".datepickerClean").datepicker({ 
			defaultDate: +0,
			autoSize: true,
			dateFormat: 'dd/mm/yy',
		});
		
		//===== Masked input =====//
		
		updateFieldMasks = function(){
			
			$.mask.definitions['~'] = "[+-]";
			$(".maskDate").mask("99/99/9999");
			$(".maskPhone").mask("(99) 9999-9999");
		}
		
		updateFieldMasks();
});

function updateMainBalance(mainBalanceValue){
	
	if( mainBalanceValue > 10000 )
		$('#mainBalanceCode').addClass('small');
	else
		$('#mainBalanceCode').removeClass('small');
	
	$('#mainBalanceAmount').html(toCurrency(mainBalanceValue));
}

function updateMainBalanceChanges(percent){
	
	$('#mainBalanceChanges').attr('class', (percent>0?'sPositive':(percent<0?'sNegative':'sZero')));
	$('#mainBalanceChanges').html(toCurrency(Math.abs(percent), 0)+'%');
}

function doSaveMain(){
	
	$('#'+getModuleName()+'Form').submit();
}

function doGetNew(){
	
	location.href = _webRoot+'/'+getModuleName()+'/new';
}

function getTabIndicator(){
	
	var html = '<div class="tabIndicator">';
	html += '<img src="'+_imageRoot+'/backend/loaders/loader9.gif" /> <span class="mt10">Carregando informações, por favor aguarde...</span>';
	html += '</div>';
	
	return html;
}

function loadTabContent(tabId, urlAjax, force, successHandler){
	
	if( !force && $('#'+tabId).hasClass('loaded') )
		return;
	
	var successFunc = function(content){
		
		$('#'+tabId).html(content);
		$('#'+tabId).addClass('loaded');
		
		if( typeof(successHandler)=='function' )
			successHandler();
	}

	var failureFunc = function(t){
		
		$('#'+tabId).html('<div class="tabContentError">Não foi possível carregar as informações da aba selecionada!\nPor favor, tente novamente.</div>');
		
		if( isDebug() )
			debug(t.responseText);
	}
	
	urlAjax = _webRoot+urlAjax;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}

function buildCheckboxTable(){
	
	$(".titleIcon input:checkbox").click(function() {
		var checkedStatus = this.checked;
		
		$("#checkAll tbody tr td:first-child input").each(function() {
			this.checked = checkedStatus;
				if (checkedStatus == this.checked) {
					$(this).closest('.checker > span').removeClass('checked');
				}
				if (this.checked) {
					$(this).closest('.checker > span').addClass('checked');
				}
		});
	});

	$(".titleIcon.titleIcon2 input:checkbox").click(function() {
		var checkedStatus = this.checked;
		
		$("#checkAll2 tbody tr td:first-child input:checkbox").each(function() {
			this.checked = checkedStatus;
			if (checkedStatus == this.checked) {
				$(this).closest('.checker > span').removeClass('checked');
			}
			if (this.checked) {
				$(this).closest('.checker > span').addClass('checked');
			}
		});
	});
		
	$('#checkAll tbody tr td:first-child').next('td').css('border-left-color', '#CBCBCB');
	$('#checkAll2 tbody tr td:first-child').next('td').css('border-left-color', '#CBCBCB');
}

function updateProgressBar( percent, progressBarId ){
	
	// jQuery UI progress bar
	$("#"+progressBarId).progressbar({
		value: percent
	});
}

function showAlert(message, title){
	
	title = (title?title:'Alerta interno');
	
	message = message.replace(/\n/g, '<br/>');
	
	$('#mainAlertMessage').html(message);
	$('#mainAlertDialog').dialog({
        title: title
    });
	
	$('#mainAlertDialog').dialog('open');
}