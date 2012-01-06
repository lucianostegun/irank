var _LastNewsId = null;

function toggleNews(newsId){
	
	if( _LastNewsId )
		hideDiv('newsDescription'+_LastNewsId);
	
	if( newsId!=_LastNewsId ){
		
		showDiv('newsDescription'+newsId);
		_LastNewsId = newsId;
	}else{
		
		_LastNewsId = null;
	}
}