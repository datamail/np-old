/*	
	Javascript & PHP Image Replacement 
	Created by Tab Atkins Jr.
*/
(function($){

$.fn.pir = function( options ) {

	return $(this).hide().each(function(){ $.pir(this,options); }).show();
};

$.pir = function( elem, options ) {
	//Settings
	var $e = $(elem),
		meta = ($.metadata)?$(elem).metadata():{},
		o = $.extend(
				{ size: $e.css("font-size"), color: $e.css("color"), casing: $e.css("text-transform"), text: $e.text().split("'").join("&#039;") },
				$.pir.options,
				meta,
				options),
		e = encodeURIComponent;
	

	
	$e.html(""); //clear out the current contents
	$.each( o.wrap ? o.text.split(" ") : [o.text], function() {
		if( $.trim(this) != "" ) {
			//have to manually tweak the vertical-align so that it works properly when inlined
			var $img = $("<img alt='" + this.replace("'", "&rsquo;") + "' src='" + o.php + "?text=" + e(this) + "&font=" + e(o.font) + "&size=" + e(o.size) + "&color=" + e(o.color) + "&casing=" + e(o.casing) + "'>")
					.css({"vertical-align":"bottom"});
			$e.append( $img );
			$e.append( " " );
		}
	});

	//this option *removes* the pir images when you print, returning to the original text, because images don't always look great when printed
	if( o.prettyPrint ) {
		$("img", $e).addClass("pir-prettyprint-image");
		$("<span>" + o.text + "</span>").addClass("pir-prettyprint-text").appendTo($e);
		$("<style type='text/css' media='print'></style>").text(".pir-prettyprint-image { display: none; }").appendTo("head");
		$("<style type='text/css' media='screen'></style>").text(".pir-prettyprint-text { display: none; }").appendTo("head");
	};
	return $e;
};

//Defaults
$.pir.options = {
	php: "/pir.php",
	font: "denmark.ttf",
	wrap: false,
	prettyPrint: false
};

//Version
$.pir.version = "0.1";

//Auto-run
$(function(){ $(".pir").pir(); });

})(jQuery);

