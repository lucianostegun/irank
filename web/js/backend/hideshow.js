//  Andy Langton's show/hide/mini-accordion @ http://andylangton.co.uk/jquery-show-hide

// this tells jquery to run the function below once the DOM is ready
jQuery(document).ready(function() {

// choose text for the show/hide link - can contain HTML (e.g. an image)
var showText='Show';
var hideText='Hide';

// initialise the visibility check
var is_visible = false;

// append show/hide links to the element directly preceding the element with a class of "toggle"
jQuery('.toggle').prev().append(' <a href="#" class="toggleLink">'+hideText+'</a>');

// hide all of the elements with a class of 'toggle'
jQuery('.toggle').show();

// capture clicks on the toggle links
jQuery('a.toggleLink').click(function() {

// switch visibility
is_visible = !is_visible;

// change the link text depending on whether the element is shown or hidden
if (jQuery(this).text()==showText) {
	jQuery(this).text(hideText);
	jQuery(this).parent().next('.toggle').slideDown('slow');
}
else {
	jQuery(this).text(showText);
	jQuery(this).parent().next('.toggle').slideUp('slow');
}

// return false so any link destination is not followed
return false;

});
});