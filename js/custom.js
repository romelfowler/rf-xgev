(function($) {
    $(document).ready(function() {
        "use strict";
        var $preloader = $('#page-preloader'),
            $spinner = $preloader.find('.spinner-loader');
        $spinner.fadeOut();
        $preloader.delay(50).fadeOut('slow');
        $('#wpadminbar').addClass('wpadmin-opacity');
        $('.yamm li:has(ul)').doubleTapToGo();
        var windowHeight = $(window).height();
        var windowWidth = $(window).width();
        var tabletWidth = 767;
        var mobileWidth = 640;
        $('.wpb_map_wraper').click(function() {
            $('iframe').css("pointer-events", "auto");
        });
        if (windowWidth > tabletWidth) {
            var headerSticky = $(".layout-theme").data("header");
            var headerTop = $(".layout-theme").data("header-top");
            if (headerSticky.length) {
                $(window).on('scroll', function() {
                    var winH = $(window).scrollTop();
                    var $pageHeader = $('.header');
                    if (winH > headerTop) {
                        $('.header').addClass("animated");
                        $('header').addClass("animation-done");
                        $pageHeader.addClass('sticky');
                    } else {
                        $('.header').removeClass("bounce");
                        $('.header').removeClass("animated");
                        $('.header').removeClass("animation-done");
                        $pageHeader.removeClass('sticky');
                    }
                });
            }
        }

        function fullWidthSection() {
            var windowWidth = $(window).width();
            var widthContainer = $('.container').width();
            var sectionFW = $('.bg_inner');
            var fullWidth1 = windowWidth - widthContainer;
            var fullWidth2 = fullWidth1 / 2;
            sectionFW.css("width", windowWidth);
            sectionFW.css("margin-left", -fullWidth2);
        }
        fullWidthSection();
        $(window).resize(function() {
            fullWidthSection()
        });
        if ($('#slider-price').length > 0) {
            var slider = document.getElementById('slider-price');
            var min_price = document.getElementById('pix-min-price').value;
            var max_price = document.getElementById('pix-max-price').value;
            var max_slider_price = document.getElementById('pix-max-slider-price').value;
            min_price = min_price == '' ? 0 : min_price;
            max_price = max_price == '' ? max_slider_price : max_price;
            noUiSlider.create(slider, {
                start: [min_price, max_price],
                step: 1000,
                connect: true,
                range: {
                    'min': 0,
                    'max': Number(max_slider_price)
                },
                format: wNumb({
                    decimals: 0
                })
            });
            var pValues_price = [document.getElementById('slider-price_min'), document.getElementById('slider-price_max')];
            slider.noUiSlider.on('update', function(values, handle) {
                pValues_price[handle].value = values[handle];
            });
            slider.noUiSlider.on('change', function(values, handle) {
                $(pValues_price[handle]).trigger('change');
            });
        }
        if ($('#slider-year').length > 0) {
            var slider_year = document.getElementById('slider-year');
            var min_year = document.getElementById('pix-min-year').value;
            var max_year = document.getElementById('pix-max-year').value;
            var max_slider_year = document.getElementById('pix-max-slider-year').value;
            min_year = min_year == '' ? 1950 : min_year;
            max_year = max_year == '' ? max_slider_year : max_year;
            noUiSlider.create(slider_year, {
                start: [min_year, max_year],
                step: 1,
                connect: true,
                range: {
                    'min': 1950,
                    'max': Number(max_slider_year)
                },
                format: wNumb({
                    decimals: 0
                })
            });
            var pValues_year = [document.getElementById('slider-year_min'), document.getElementById('slider-year_max')];
            slider_year.noUiSlider.on('update', function(values, handle) {
                pValues_year[handle].value = values[handle];
            });
            slider_year.noUiSlider.on('change', function(values, handle) {
                $(pValues_year[handle]).trigger('change');
            });
        }
        if ($('#slider-mileage').length > 0) {
            var slider_mileage = document.getElementById('slider-mileage');
            var min_mileage = document.getElementById('pix-min-mileage').value;
            var max_mileage = document.getElementById('pix-max-mileage').value;
            var max_slider_mileage = document.getElementById('pix-max-slider-mileage').value;
            min_mileage = min_mileage == '' ? 0 : min_mileage;
            max_mileage = max_mileage == '' ? max_slider_mileage : max_mileage;
            noUiSlider.create(slider_mileage, {
                start: [min_mileage, max_mileage],
                step: 10000,
                connect: true,
                range: {
                    'min': 0,
                    'max': Number(max_slider_mileage)
                },
                format: wNumb({
                    decimals: 0
                })
            });
            var pValues_mileage = [document.getElementById('slider-mileage_min'), document.getElementById('slider-mileage_max')];
            slider_mileage.noUiSlider.on('update', function(values, handle) {
                pValues_mileage[handle].value = values[handle];
            });
            slider_mileage.noUiSlider.on('change', function(values, handle) {
                $(pValues_mileage[handle]).trigger('change');
            });
        }
        if ($('#slider-engine').length > 0) {
            var slider_engine = document.getElementById('slider-engine');
            var min_engine = document.getElementById('pix-min-engine').value;
            var max_engine = document.getElementById('pix-max-engine').value;
            var max_slider_engine = document.getElementById('pix-max-slider-engine').value;
            min_engine = min_engine == '' ? 0 : min_engine;
            max_engine = max_engine == '' ? max_slider_engine : max_engine;
            noUiSlider.create(slider_engine, {
                start: [min_engine, max_engine],
                step: 0.1,
                connect: true,
                range: {
                    'min': 0,
                    'max': Number(max_slider_engine)
                },
                format: wNumb({
                    decimals: 1
                })
            });
            var pValues_engine = [document.getElementById('slider-engine_min'), document.getElementById('slider-engine_max')];
            slider_engine.noUiSlider.on('update', function(values, handle) {
                pValues_engine[handle].value = values[handle];
            });
            slider_engine.noUiSlider.on('change', function(values, handle) {
                $(pValues_engine[handle]).trigger('change');
            });
        }
        if (windowWidth < mobileWidth) {
            $("body").removeClass("animated-css");
        }
        $('.animated-css .animated:not(.animation-done)').waypoint(function() {
            var animation = $(this).data('animation');
            $(this).addClass('animation-done').addClass(animation);
        }, {
            triggerOnce: true,
            offset: '90%'
        });
        if (windowWidth > 1200) {
            $(window).scroll(function() {
                $('.animatedEntrance').each(function() {
                    var imagePos = $(this).offset().top;
                    var topOfWindow = $(window).scrollTop();
                    if (imagePos < topOfWindow + 400) {
                        $(this).addClass("slideUp");
                    }
                });
            });
        }
        $(".btn-collapse").on('click', function() {
            $(this).parents('.panel-group').children('.panel').removeClass('panel-default');
            $(this).parents('.panel').addClass('panel-default');
            if ($(this).is(".collapsed")) {
                $('.panel-title').removeClass('panel-passive');
            } else {
                $(this).next().toggleClass('panel-passive');
            };
        });
        if ($('body').length) {
            $(window).on('scroll', function() {
                var winH = $(window).scrollTop();
                $('.list-progress').waypoint(function() {
                    $('.chart').each(function() {
                        CharsStart();
                    });
                }, {
                    offset: '80%'
                });
            });
        }

        function CharsStart() {
            $('.chart').easyPieChart({
                barColor: false,
                trackColor: false,
                scaleColor: false,
                scaleLength: false,
                lineCap: false,
                lineWidth: false,
                size: false,
                animate: 7000,
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });
        }
        $('.jelect').jelect();
        $(".slider-product a, .slider-gallery__link , .zoom ").prettyPhoto({
            animation_speed: 'normal',
            theme: 'light_square',
            slideshow: 3000
        });
        $("a[rel^='prettyPhoto']").prettyPhoto({
            animation_speed: 'normal',
            theme: 'light_square',
            slideshow: 3000
        });
        $(".btn-collapse").on('click', function() {
            $(this).parents('.panel-group').children('.panel').removeClass('panel-default');
            $(this).parents('.panel').addClass('panel-default');
            if ($(this).is(".collapsed")) {
                $('.panel-title').removeClass('panel-passive');
            } else {
                $(this).next().toggleClass('panel-passive');
            };
        });
        $('.js-filter').on('click', function() {
            $(this).prev('.wrap-filter').slideToggle('slow')
        });
        $('.js-filter').on('click', function() {
            $(this).toggleClass('filter-up filter-down')
        });
        if ($('#slider-product').length > 0) {
            $('#carousel-product').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                smoothHeight: true,
                itemWidth: 120,
                itemMargin: 8,
                asNavFor: '#slider-product'
            });
            $('#slider-product').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                smoothHeight: true,
                sync: "#carousel-product"
            });
        }
        $(document).on("click", ".footer__btn", function(event) {
            event.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, 300);
        });
        var Core = {
            initialized: false,
            initialize: function() {
                if (this.initialized) return;
                this.initialized = true;
                this.build();
            },
            build: function() {
                this.initOwlCarousel();
            },
            initOwlCarousel: function(options) {
                $(".enable-owl-carousel").each(function(i) {
                    var $owl = $(this);
                    var itemsData = $owl.data('items');
                    var navigationData = $owl.data('navigation');
                    var paginationData = $owl.data('pagination');
                    var singleItemData = $owl.data('single-item');
                    var autoPlayData = $owl.data('auto-play');
                    var transitionStyleData = $owl.data('transition-style');
                    var mainSliderData = $owl.data('main-text-animation');
                    var afterInitDelay = $owl.data('after-init-delay');
                    var stopOnHoverData = $owl.data('stop-on-hover');
                    var min480 = $owl.data('min480');
                    var min768 = $owl.data('min768');
                    var min992 = $owl.data('min992');
                    var min1200 = $owl.data('min1200');
                    $owl.owlCarousel({
                        navigation: navigationData,
                        pagination: paginationData,
                        singleItem: singleItemData,
                        autoPlay: autoPlayData,
                        transitionStyle: transitionStyleData,
                        stopOnHover: stopOnHoverData,
                        navigationText: ["<i></i>", "<i></i>"],
                        items: itemsData,
                        itemsCustom: [
                            [0, 1],
                            [465, min480],
                            [750, min768],
                            [975, min992],
                            [1185, min1200]
                        ],
                        afterInit: function(elem) {
                            if (mainSliderData) {
                                setTimeout(function() {
                                    $('.main-slider_zoomIn').css('visibility', 'visible').removeClass('zoomIn').addClass('zoomIn');
                                    $('.main-slider_fadeInLeft').css('visibility', 'visible').removeClass('fadeInLeft').addClass('fadeInLeft');
                                    $('.main-slider_fadeInLeftBig').css('visibility', 'visible').removeClass('fadeInLeftBig').addClass('fadeInLeftBig');
                                    $('.main-slider_fadeInRightBig').css('visibility', 'visible').removeClass('fadeInRightBig').addClass('fadeInRightBig');
                                }, afterInitDelay);
                            }
                        },
                        beforeMove: function(elem) {
                            if (mainSliderData) {
                                $('.main-slider_zoomIn').css('visibility', 'hidden').removeClass('zoomIn');
                                $('.main-slider_slideInUp').css('visibility', 'hidden').removeClass('slideInUp');
                                $('.main-slider_fadeInLeft').css('visibility', 'hidden').removeClass('fadeInLeft');
                                $('.main-slider_fadeInRight').css('visibility', 'hidden').removeClass('fadeInRight');
                                $('.main-slider_fadeInLeftBig').css('visibility', 'hidden').removeClass('fadeInLeftBig');
                                $('.main-slider_fadeInRightBig').css('visibility', 'hidden').removeClass('fadeInRightBig');
                            }
                        },
                        afterMove: sliderContentAnimate,
                        afterUpdate: sliderContentAnimate,
                    });
                });

                function sliderContentAnimate(elem) {
                    var $elem = elem;
                    var afterMoveDelay = $elem.data('after-move-delay');
                    var mainSliderData = $elem.data('main-text-animation');
                    if (mainSliderData) {
                        setTimeout(function() {
                            $('.main-slider_zoomIn').css('visibility', 'visible').addClass('zoomIn');
                            $('.main-slider_slideInUp').css('visibility', 'visible').addClass('slideInUp');
                            $('.main-slider_fadeInLeft').css('visibility', 'visible').addClass('fadeInLeft');
                            $('.main-slider_fadeInRight').css('visibility', 'visible').addClass('fadeInRight');
                            $('.main-slider_fadeInLeftBig').css('visibility', 'visible').addClass('fadeInLeftBig');
                            $('.main-slider_fadeInRightBig').css('visibility', 'visible').addClass('fadeInRightBig');
                        }, afterMoveDelay);
                    }
                }
            },
        };
        Core.initialize();

        // function resizeHeader() {
        //     const distanceHeight = document.documentElement.scrollTop || window.pageYOffset;
        //     var shrinkOn = 200;
        //     if (distanceHeight > shrinkOn) {
        //         $(".normal-logo").addClass("smaller");
        //     } else {
        //         $(".normal-logo").removeClass("smaller");
        //     },
        //     if (distanceHeight > shrinkOn) {
        //         $(".top-bar").addClass("smaller");
        //     } else {
        //         $(".top-bar").removeClass("smaller");
        //     },
        //     if (distanceHeight > shrinkOn) {
        //         $(".header-navibox-1").addClass("smaller");
        //     } else {
        //         $(".header-navibox-1").removeClass("smaller");
        //     },
        // }
        // window.addEventListener('scroll', resizeHeader);
    });
}(jQuery));
