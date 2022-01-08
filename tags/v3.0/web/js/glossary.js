function searchPokerTerm(){
	
	var term = $('glossaryPokerTerm').value;
	if( !term )
		return false;
	
	showIndicator();
	
	var successFunc = function(t){
		
		$('termDescription').innerHTML = '<hr/><h1 class="header">'+term+'</h1>'+t.responseText;
		hideIndicator();
	}
		
	var failureFunc = function(t){
	
		$('termDescription').innerHTML = '<h1>Termo não encontrado!</h1>';
		hideIndicator();
	}
	
	var urlAjax  = _webRoot+'/glossary/getTerm?term='+term;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function loadDictionary(dictionary){
	
	var successFunc = function(t){
		
		$('speechContent').innerHTML = t.responseText;
	}

	var failureFunc = function(t){
		
		$('speechContent').innerHTML = 'Não foi possível carregar a definição de "'+dictionary+'".<br/>Clique sobre o termo para carregar a definição novamente.';
	}
	
	var urlAjax = _webRoot+'/blog/getDictionary/'+dictionary;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}

function showDictionary(evt){
	
	var clientX      = evt.clientX;
	var clientY      = evt.clientY;
	var scroll       = window.scrollY;
	var dictionary   = ucwords(this.innerHTML);
	var screenHeight = getScreenHeight();
	var screenWidth  = getScreenWidth();
	
	var top  = (clientY+scroll+15);
	var left = (clientX-20);
	
	if( top > (screenHeight-20+scroll ) )
		top -= 195;

	if( left > (screenWidth-520 ) )
			left -= 200;

	html  = '<span class="header">';
	html += '	<span id="speechHeader">'+dictionary+'</span>';
	html += '	<div class="closeButton" onclick="hideDiv(\'speechDialog\'); $(\'speechHeader\').innerHTML = \'\'"></div>';
	html += '</span>';
	html += '<div class="content" id="speechContent">';
	html += '	<div class="loading">Carregando definição, aguarde...</div>';
	html += '</div>';
	
	if( $('speechDialog')!=null ){
		
		if( dictionary==$('speechHeader').innerHTML )
			return;
		
//		showDiv('speechDialog');
		$('speechDialog').style.left = left+'px';
		$('speechDialog').style.top  = top+'px';
		$('speechDialog').innerHTML = html;
		
		showDiv('speechDialog');
		return loadDictionary(dictionary);
	}
	
	var speechDiv = document.createElement('div');
	speechDiv.className = 'speech';
	speechDiv.id        = 'speechDialog';
	
	speechDiv.innerHTML  = html;
	speechDiv.style.left = left+'px';
	speechDiv.style.top  = top+'px';
	
	document.body.appendChild(speechDiv);
	
	loadDictionary(dictionary);
}

function loadDictionaryObservers(){
	
	var dictionaryList = document.getElementsByClassName('dictionary');
	for(var i=0; i < dictionaryList.length; i++)
		Event.observe(dictionaryList[i], 'click', showDictionary);
}

Event.observe(window, 'load', loadDictionaryObservers, false);