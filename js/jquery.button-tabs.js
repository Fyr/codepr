(function($){
 
	var methods = {
		init: function(options) {
			options = $.extend({ // default options
				title: 'Choose options'
			}, options);
			return this.each(function(){
				// check if plugin is already applied
				if (!$(this).hasClass('button-tabs-applied')) {
					$(this).wrapInner('<div class="button-tabs-inner"/>');
					$(this).wrapInner('<div class="button-tabs-line"/>');
					$('.button-tabs-line', this).prepend('<button class="button-tabs-main-btn">' + options.title + '</button>');
					$('.button-tabs-line', this).prepend('<a class="button-tabs-close" href="javascript: void(0)" style="display: none;">&times;</a>');
					
					$(this).buttonTabs('show', 0);
					
					// Event handlers
					var $self = $(this);
					$('.button-tabs-links > a', this).each(function(n){
						$(this).click(function(){
							$self.buttonTabs('show', n);
						});
					});
					$('.button-tabs-main-btn', this).click(function(){
						// show tabs
						$(this).hide();
						$('.button-tabs-inner', $self).show();
						$('.button-tabs-close', $self).show();
					});
					$('.button-tabs-close', this).click(function(){
						// hide tabs
						$('.button-tabs-main-btn', $self).show();
						$('.button-tabs-inner', $self).hide();
						$('.button-tabs-close', $self).hide();
					});
					$(this).addClass('button-tabs-applied');
				}
			});
		},
		show: function(n) {
			this.each(function(){
				$('.button-tabs-links > a', this).removeClass('button-tabs-link-active');
				$('.button-tabs-content', this).hide();
				var $a = $('.button-tabs-links > a:eq(' + n + ')', this);
				var $div = $('.button-tabs-content:eq(' + n + ')', this);
				if ($a.length && $div.length) { // check number of tabs and its content
					$a.addClass('button-tabs-link-active');
					$div.show();
				}
			});
			
		}
	};
	
	$.fn.buttonTabs = function(method) {
		if (methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if (typeof(method) === 'object' || !method) {
			return methods.init.apply( this, arguments );
		} else {
			$.error('Method ' +  method + ' does not exist on!');
		}   
	};
 
})(jQuery);