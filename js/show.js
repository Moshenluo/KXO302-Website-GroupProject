
(function($){
	$.fn.coolShow = function(options){
	
		var defaults = {
			imgSrc:'',
			speed:50
		};
		var action = {
			init:function(){
				$('#handBar').find('span').on('click',function(){
					$(this).stop();
					$('#coolShow b').remove();
				
					for (var i = 0;i<($("#coolShow").height()/10);i++) $('#coolShow').append('<b></b>');
				
					var psn = 0;
					var imgId = $(this).children().data('img');
					$('#coolShow b').each(function(){
						$(this).css({
							opacity:0,
							backgroundPosition:"0 "+psn+"px",
							backgroundImage:'url("'+options.imgSrc[imgId]+'")'
						});
						psn -= 10;
					});
					var time = 0;
					$('#coolShow b').each(function(){
						$(this).delay(time).animate({opacity:"1"},500);
						time += options.speed;
					});
				});
			}
		};
	
		return this.each(function(){
		
			options = (options)?$.extend(defaults,options):defaults;
	
			for (var i = 0;i<options.imgSrc.length;i++) $('#handBar').append('<span><img src = "'+options.imgSrc[i]+'" data-img = "'+i+'"/></span>');
		
			action.init();
		});
	};
})(jQuery);