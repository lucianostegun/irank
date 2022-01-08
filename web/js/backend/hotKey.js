var _CtrlKey  = false;
var _AltKey   = false;
var _ShiftKey = false;

var setKeyStatus = function( event ){
	
	var evt = (event?event:window.event);
	
	_CtrlKey  = evt.ctrlKey;
	_ShiftKey = evt.shiftKey;
}

document.onkeydown = setKeyStatus;
document.onkeyup   = setKeyStatus;