function showDictionary(evt){
	
	var clientX = evt.clientX;
	var clientY = evt.clientY;
	
	var speechDiv = document.createElement('div');
	speechDiv.className = 'speech';
	
	speechDiv.innerHTML  = '<span class="header">'+this.innerHTML+'</span>';
	speechDiv.innerHTML += '<span class="content">'+this.innerHTML+'</span>';
	speechDiv.style.left = clientX+'px';
	speechDiv.style.top  = clientY+'px';
	
	document.body.appendChild(speechDiv);
}

function loadDictionaryObservers(){
	
	var dictionaryList = document.getElementsByClassName('dictionary');
	for(var i=0; i < dictionaryList.length; i++)
		Event.observe(dictionaryList[i], 'click', showDictionary);
}

Event.observe(window, 'load', loadDictionaryObservers, false);