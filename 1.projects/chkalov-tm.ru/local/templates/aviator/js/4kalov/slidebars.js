;(function($){$.slidebars=function(options){var settings=$.extend({siteClose:true,scrollLock:false,disableOver:false,hideControlClasses:false},options);var test=document.createElement('div').style,supportTransition=false,supportTransform=false;if(test.MozTransition===''||test.WebkitTransition===''||test.OTransition===''||test.transition==='')supportTransition=true;if(test.MozTransform===''||test.WebkitTransform===''||test.OTransform===''||test.transform==='')supportTransform=true;var ua=navigator.userAgent,android=false,iOS=false;if(/Android/.test(ua)){android=ua.substr(ua.indexOf('Android')+8,3);}else if(/(iPhone|iPod|iPad)/.test(ua)){iOS=ua.substr(ua.indexOf('OS ')+3,3).replace('_','.');}if(android&&android<3||iOS&&iOS<5)$('html').addClass('sb-static');var $site=$('#sb-site, .sb-site-container');if($('.sb-left').length){var $left=$('.sb-left'),leftActive=false;}if($('.sb-right').length){var $right=$('.sb-right'),rightActive=false;}var init=false,windowWidth=$(window).width(),$controls=$('.sb-toggle-left, .sb-toggle-right, .sb-open-left, .sb-open-right, .sb-close'),$slide=$('.sb-slide');function initialise(){if(!settings.disableOver||(typeof settings.disableOver==='number'&&settings.disableOver>=windowWidth)){init=true;$('html').addClass('sb-init');if(settings.hideControlClasses)$controls.removeClass('sb-hide');css();}else if(typeof settings.disableOver==='number'&&settings.disableOver<windowWidth){init=false;$('html').removeClass('sb-init');if(settings.hideControlClasses)$controls.addClass('sb-hide');$site.css('minHeight','');if(leftActive||rightActive)close();}}initialise();function css(){$site.css('minHeight','');var siteHeight=parseInt($site.css('height'),10),htmlHeight=parseInt($('html').css('height'),10);if(siteHeight<htmlHeight)$site.css('minHeight',$('html').css('height'));if($left&&$left.hasClass('sb-width-custom'))$left.css('width',$left.attr('data-sb-width'));if($right&&$right.hasClass('sb-width-custom'))$right.css('width',$right.attr('data-sb-width'));if($left&&($left.hasClass('sb-style-push')||$left.hasClass('sb-style-overlay')))$left.css('marginLeft','-'+$left.css('width'));if($right&&($right.hasClass('sb-style-push')||$right.hasClass('sb-style-overlay')))$right.css('marginRight','-'+$right.css('width'));if(settings.scrollLock)$('html').addClass('sb-scroll-lock');}$(window).resize(function(){var resizedWindowWidth=$(window).width();if(windowWidth!==resizedWindowWidth){windowWidth=resizedWindowWidth;initialise();if(leftActive)open('left');if(rightActive)open('right');}});var animation;if(supportTransition&&supportTransform){animation='translate';if(android&&android<4.4)animation='side';}else{animation='jQuery';}function animate(object,amount,side){var selector;if(object.hasClass('sb-style-push')){selector=$site.add(object).add($slide);}else if(object.hasClass('sb-style-overlay')){selector=object;}else{selector=$site.add($slide);}if(animation==='translate'){if(amount==='0px'){removeAnimation();}else{selector.css('transform','translate( '+amount+' )');}}else if(animation==='side'){if(amount==='0px'){removeAnimation();}else{if(amount[0]==='-')amount=amount.substr(1);selector.css(side,'0px');setTimeout(function(){selector.css(side,amount);},1);}}else if(animation==='jQuery'){if(amount[0]==='-')amount=amount.substr(1);var properties={};properties[side]=amount;selector.stop().animate(properties,400);}function removeAnimation(){selector.removeAttr('style');css();}}function open(side){if(side==='left'&&$left&&rightActive||side==='right'&&$right&&leftActive){close();setTimeout(proceed,400);}else{proceed();}function proceed(){if(init&&side==='left'&&$left){$('html').addClass('sb-active sb-active-left');$left.addClass('sb-active');animate($left,$left.css('width'),'left');setTimeout(function(){leftActive=true;},400);}else if(init&&side==='right'&&$right){$('html').addClass('sb-active sb-active-right');$right.addClass('sb-active');animate($right,'-'+$right.css('width'),'right');setTimeout(function(){rightActive=true;},400);}}}function close(url,target){if(leftActive||rightActive){if(leftActive){animate($left,'0px','left');leftActive=false;}if(rightActive){animate($right,'0px','right');rightActive=false;}setTimeout(function(){$('html').removeClass('sb-active sb-active-left sb-active-right');if($left)$left.removeClass('sb-active');if($right)$right.removeClass('sb-active');if(typeof url!=='undefined'){if(typeof target===undefined)target='_self';window.open(url,target);}},400);}}function toggle(side){if(side==='left'&&$left){if(!leftActive){open('left');}else{close();}}if(side==='right'&&$right){if(!rightActive){open('right');}else{close();}}}this.slidebars={open:open,close:close,toggle:toggle,init:function(){return init;},active:function(side){if(side==='left'&&$left)return leftActive;if(side==='right'&&$right)return rightActive;},destroy:function(side){if(side==='left'&&$left){if(leftActive)close();setTimeout(function(){$left.remove();$left=false;},400);}if(side==='right'&&$right){if(rightActive)close();setTimeout(function(){$right.remove();$right=false;},400);}}};function eventHandler(event,selector){event.stopPropagation();event.preventDefault();if(event.type==='touchend')selector.off('click');}$('.sb-toggle-left').on('touchend click',function(event){eventHandler(event,$(this));toggle('left');});$('.sb-toggle-right').on('touchend click',function(event){eventHandler(event,$(this));toggle('right');});$('.sb-open-left').on('touchend click',function(event){eventHandler(event,$(this));open('left');});$('.sb-open-right').on('touchend click',function(event){eventHandler(event,$(this));open('right');});$('.sb-close').on('touchend click',function(event){if($(this).is('a')||$(this).children().is('a')){if(event.type==='click'){event.stopPropagation();event.preventDefault();var link=($(this).is('a')?$(this):$(this).find('a')),url=link.attr('href'),target=(link.attr('target')?link.attr('target'):'_self');close(url,target);}}else{eventHandler(event,$(this));close();}});$site.on('touchend click',function(event){if(settings.siteClose&&(leftActive||rightActive)){eventHandler(event,$(this));close();}});};})(jQuery);