/*jslint white: true, browser: true, undef: true, nomen: true, eqeqeq: true, plusplus: false, bitwise: true, regexp: true, strict: true, newcap: true, immed: true, maxerr: 14 */
/*global window: false, REDIPS: true */

/* enable strict mode */
"use strict";

// define redips_init variable
var redips_init;

// redips initialization
redips_init = function () {
	
	if( $('drag')==null )
		return;

	// reference to the REDIPS.drag library and message line
	var	rd = REDIPS.drag,
		msg;
	// initialization
	rd.init();
	// set hover color for TD and TR
	rd.hover.color_td = '#FFCFAE';
	rd.hover.color_tr = '#9BB3DA';
	// set hover border for current TD and TR
	rd.hover.border_td = '1px solid #32568E';
	rd.hover.border_tr = '1px solid #32568E';
	// row was clicked - event handler
	rd.myhandler_row_clicked = function () {
		// set current element (this is clicked TR)
		var el = rd.obj;
		// find parent table
		el = rd.find_parent('TABLE', el);
		// every table has only one SPAN element to display messages
//		msg = el.getElementsByTagName('span')[0];
		// display message
//		msg.innerHTML = 'Clicked';
	};
	// row was moved - event handler
	rd.myhandler_row_moved = function () {
		// set opacity for moved row
		// rd.obj is reference of cloned row (mini table)
		rd.row_opacity(rd.obj, 85);
		// set opacity for source row and change source row background color
		// obj.obj_old is reference of source row
		rd.row_opacity(rd.obj_old, 20, 'White');
		// display message
//		debug('Moved');
	};
	// row was not moved - event handler
	rd.myhandler_row_notmoved = function () {
//		debug('Not moved');
	};
	// row was dropped - event handler
	rd.myhandler_row_dropped = function () {
		// display message

		var pos = rd.get_position();
		// display current table and current row
		
		var trList = document.getElementsByClassName('resultEventPlayerRow');
		
		var players       = getSelectedResultPlayers();
		var eventPosition = 0;
		for(var rowIndex=0; rowIndex < trList.length; rowIndex++){
			
			if( trList[rowIndex].style.display=='none' )
				continue;
			
			eventPosition++;
			var peopleId = trList[rowIndex].id.replace(/[^0-9]/gi, '');
			$('eventEventPosition'+peopleId).value    = eventPosition;
			
			$('eventBuyin'+peopleId).tabIndex         = eventPosition;
			$('eventEventPosition'+peopleId).tabIndex = players+eventPosition;
			$('eventRebuy'+peopleId).tabIndex         = rowIndex+1+players*2;
			$('eventAddon'+peopleId).tabIndex         = rowIndex+1+players*3;
			$('eventPrize'+peopleId).tabIndex         = rowIndex+1+players*4;
			
			toggleBuyin(peopleId);
			checkBuyin(peopleId);
		}
	};
	// row was dropped to the source - event handler
	// mini table (cloned row) will be removed and source row should return to original state
	rd.myhandler_row_dropped_source = function () {
		// make source row completely visible (no opacity)
		rd.row_opacity(rd.obj_old, 100);
		// display message
//		debug('Dropped to the source');
	};
	/*
	// how to cancel row drop to the table
	rd.myhandler_row_dropped_before = function () {
		//
		// JS logic
		//
		// return source row to its original state
		rd.row_opacity(rd.obj_old, 100);
		// cancel row drop
		return false;
	}
	*/
	// row position was changed - event handler
	rd.myhandler_row_changed = function () {
		// get target and source position (method returns positions as array)
		var pos = rd.get_position();
		// display current table and current row
//		debug('Changed: ' + pos[0] + ' ' + pos[1]);
	};
};

// add onload event listener
if (window.addEventListener) {
	window.addEventListener('load', redips_init, false);
}
else if (window.attachEvent) {
	window.attachEvent('onload', redips_init);
}