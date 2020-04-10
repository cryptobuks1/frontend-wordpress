/***************************************************************************
* Available JS variables:
*  current:		(DOM Selector) points to each of the automatically created divs
*  shortcode:	(String) name of the shortcode
*  resourcesUrl:(String) resources files URL
*  content:		(String) shortcode content
*  atts:		(Array)  of shortcode atts  
*  ajaxurl:		(String) the url for admin-ajax.php
*  ajaxdata:	(Object) for data parameters in jQuery ajax. Including:
*						 param security (with the ajaxNonce)
*						 param action (needed for hook in the admin-ajax.php) 
*						 param shortcode (needed to redirect to the shortcode specific cmb-ajax-handler.php)*						 
*						 param content (with the var content value)
*						 param atts (with the var atts value)
****************************************************************************/
$(current).append('<button>Click Me</button>');
$(current).on("click", "button", function(event) {
	alert('JS Code working successfully');
});