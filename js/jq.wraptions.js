(function($){

$.fn.wraption = function(){
	var caption = this.attr('title');
	this.wrap('<div class="wraption-wrap"></div>').after('<span class="wraption-caption">' + caption + '</span>');
};

}(jQuery));