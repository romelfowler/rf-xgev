(function($){var controller=new slidebars();$(controller.events).on('init',function(){});$(controller.events).on('exit',function(){console.log('Exit event');});$(controller.events).on('css',function(){});$(controller.events).on('opening',function(event,id){});$(controller.events).on('opened',function(event,id){});$(controller.events).on('closing',function(event,id){});$(controller.events).on('closed',function(event,id){});controller.init();$('.js-toggle-mobile-slidebar').on('click',function(event){event.stopPropagation();controller.toggle('slidebar-5');});$('.js-open-slidebar-panel-left').on('click',function(event){event.preventDefault();event.stopPropagation();controller.toggle('slidebar-panel-left');});$('.js-open-left-slidebar').on('click',function(event){event.stopPropagation();controller.open('slidebar-1');});$('.js-close-left-slidebar').on('click',function(event){event.stopPropagation();controller.close('slidebar-1');});$('.js-toggle-left-slidebar').on('click',function(event){event.stopPropagation();controller.toggle('slidebar-1');});$('.js-open-right-slidebar').on('click',function(event){event.stopPropagation();controller.open('slidebar-2');});$('.js-close-right-slidebar').on('click',function(event){event.stopPropagation();controller.close('slidebar-2');});$('.js-toggle-right-slidebar').on('click',function(event){event.stopPropagation();controller.toggle('slidebar-2');});$('.js-open-top-slidebar').on('click',function(event){event.stopPropagation();controller.open('slidebar-3');});$('.js-close-top-slidebar').on('click',function(event){event.stopPropagation();controller.close('slidebar-3');});$('.js-toggle-top-slidebar').on('click',function(event){event.stopPropagation();controller.toggle('slidebar-3');});$('.js-open-bottom-slidebar').on('click',function(event){event.stopPropagation();controller.open('slidebar-4');});$('.js-close-bottom-slidebar').on('click',function(event){event.stopPropagation();controller.close('slidebar-4');});$('.js-toggle-bottom-slidebar').on('click',function(event){event.stopPropagation();controller.toggle('slidebar-4');});$(controller.events).on('opened',function(){$('[data-canvas="container"]').addClass('js-close-any-slidebar');$('.toggle-menu-button').addClass('is-open');});$(controller.events).on('closed',function(){$('[data-canvas="container"]').removeClass('js-close-any-slidebar');$('.toggle-menu-button').removeClass('is-open');});$('body').on('click','.js-close-any-slidebar',function(event){event.stopPropagation();controller.close();});$('.js-initialize-slidebars').on('click',function(event){event.stopPropagation();controller.init();});$('.js-exit-slidebars').on('click',function(event){event.stopPropagation();controller.exit();});$('.js-reset-slidebars-css').on('click',function(event){event.stopPropagation();controller.css();});$('.js-is-active').on('click',function(event){event.stopPropagation();});$('.js-is-active-slidebar').on('click',function(event){event.stopPropagation();var id=prompt('Enter a Slidebar id');});$('.js-get-active-slidebar').on('click',function(event){event.stopPropagation();});$('.js-get-all-slidebars').on('click',function(event){event.stopPropagation();});$('.js-get-slidebar').on('click',function(event){event.stopPropagation();var id=prompt('Enter a Slidebar id');});$('.js-init-callback').on('click',function(event){event.stopPropagation();controller.init(function(){});});$('.js-exit-callback').on('click',function(event){event.stopPropagation();controller.exit(function(){});});$('.js-css-callback').on('click',function(event){event.stopPropagation();controller.css(function(){});});$('.js-open-callback').on('click',function(event){event.stopPropagation();controller.open('slidebar-1',function(){});});$('.js-close-callback').on('click',function(event){event.stopPropagation();controller.close(function(){});});$('.js-toggle-callback').on('click',function(event){event.stopPropagation();controller.toggle('slidebar-1',function(){});});}(jQuery));