$(function() {
	
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
	
	$("select, input:checkbox, input:radio, input:file").uniform();
	
	
	/* Tables
	================================================== */


		//===== Check all checbboxes =====//
		
		$(".titleIcon input:checkbox").click(function() {
			var checkedStatus = this.checked;
			$("#checkAll tbody tr td:first-child input:checkbox").each(function() {
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
			"sPaginationType": "full_numbers",
			"sDom": '<""l>t<"F"fp>'
		});
});

function updateMainBalance(differenceValue){
	
	var mainBalanceValue = toFloat(_mainBalanceValue);
	mainBalanceValue += toFloat(differenceValue);
	
	$('#mainBalanceAmount').html('R$ '+toCurrency(mainBalanceValue));
}

function doSaveMain(){
	
	$('#'+getModuleName()+'Form').submit();
}

function doGetNew(){
	
	location.href = _webRoot+'/'+getModuleName()+'/new';
}