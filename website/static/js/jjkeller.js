
$(document).ready(function (e) {

    //Adding active class to selected Menu
    var URLParam = window.location.pathname;
    $('.container-big').children('a').each(function () {
        var selectedMenu =  this.href.split('/');
        var selectedParam = selectedMenu[selectedMenu.length - 1];
        selectedParam = "/"+ selectedParam
        if(selectedParam==URLParam){
            $(this).addClass('active');
        }
    });

    $("#transportation-slider").owlCarousel({            
        items: 1,
        animateOut: 'fadeOut', /*lightSpeedIn|pulse|flash|swing|wobble|bounceOut|bounceOutLeft|fadeInDown|fadeInDownBig*/
        animateIn: 'fadeInDown',
        loop: true,
        nav:true,
        dots:false,
        margin: 0,
        autoplay: true,
    });
        
        var $owl =$("#manual-slider").owlCarousel({
            items: 1,
            loop: true,
            nav:true,
            dots:false,
            autoHeight:true,
            responsiveClass:true,
        });
        
        setInterval(function(){
            $owl.trigger('refresh.owl.carousel');    
        },15);

    if ($(window).width() > 760)
    {
        setInterval(function () {
            var max = -1;
            $('.publications .control-container').each(function () {

                var h = $(this).height();
                max = h > max ? h : max;
            });
            //alert(max);
            $('.publications .control-container').css('min-height', max);

        }, 5);
    }

    $(document).on('click', '.tabs span', function () {

        var target = $(this).attr('rel');
        $('.tab-active').removeClass('tab-active');
        $(target).addClass('tab-active');
        $(this).parent('li').siblings().children('span').removeClass('active');
        $(this).addClass('active');
    });

    $('.fancybox').fancybox();

    $(".various").fancybox({
        maxWidth: 800,
        maxHeight: 900,
        fitToView: false,
        width: '70%',
        height: '90%',
        autoSize: false,
        closeClick: false,
        closeBtn: false
    });



    $(document).on('click', '.more-info', function () {
        var target = $(this).attr('rel');        
        $(this).parent().find(target).toggleClass('on');        
        $(this).parent().toggleClass('on');
    });

    /******* button ******/
    /*$(document).on('mouseenter', ' .btn .fa-bg', function () {
     $(this).parents('.intro-highlights section').addClass('is-open');
     $(this).parents('.intro-highlights section').siblings().removeClass('is-open');
     });
     $(document).on('mouseout', ' .btn .button', function () {
     $(this).parents('.intro-highlights section').removeClass('is-open');
     });*/

    // Contact Us js
    //Jquery Validations on Conatct Us Page.

    jQuery.validator.addMethod("commentRequired", function (value, element) {
        value = value.trim();
        return value.length > 0;
    }, commentError);

    jQuery.validator.addMethod("nameRequired", function (value, element) {
        value = value.trim();
        return value.length > 0;
    }, nameError);



    var validator = $("#contact-us-form").validate({
        rules: {
            name: {
                nameRequired: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                number: true
            },
            comment: {
                commentRequired: true
            }
        },
        messages: {
            email: {
                required: emailError,
                email: emailPatternError
            },
            phone: {
                number: numberError,
            }
        },
        errorElement: 'div',
        errorLabelContainer: '.error-message'
    });

    //Code to send the ajax request from the Contact Us page.

    $("#contact-us-form").submit(function (e) {
        if ($("#contact-us-form").valid() === true) {
            $(".ajax-loader").show();
            var url = '?controller=home&action=contact-us';

            $.ajax({
                type: "POST",
                url: url,
                data: $("#contact-us-form").serialize(),
                success: function (data) {
                    $(".ajax-loader").hide();
                    var response = JSON.parse(data);
                    if (response.status == 1) {
                        $.fancybox(response.message);
                    } else {
                        $('.error-message').show();
                        $('.error-message').html(response.message);
                    }
                },
                error: function (xhr) {
                    $(".ajax-loader").hide();
                    $('.error-message').show();
                    $('.error-message').html(xhr.statusText);

                }
            });


        }

        e.preventDefault();
    });

    //applying selection of first li on compliance library pages
    if ($('ul.market-tabs').find('li span.active').length === 0) {
        $('ul.market-tabs').find('li:first span').addClass('active');
    }

    //Clear Contact Us form Data
    $(document).on('click', '.fancybox', function () {
        $("#contact-us-form").trigger('reset');
        //Clear Validations messages on Contact Us page.
        validator.resetForm();
        $('.error-message').text('');
    });

    //Close fancybox on click of Cancel button.
    $(document).on('click', '#cancel-button', function () {
        $.fancybox.close();
    });


    //applying selection of first li on compliance library pages
    if ($('ul.market-tabs').find('li span.active').length === 0) {
        $('ul.market-tabs').find('li:first span').addClass('active');
    }

    //Remove arrow sign if More Whitepaper link is not available
    $($(".article-highlights span.side-link-arrow")).each(function () {        
        if ($(this).find('a').length === 0) {            
            $(this).find('.fa-long-arrow-right').css('display', 'none');
        }
    });

    // adding class when applying proudct snippet in new template
    $(".side-text").parent('div.edit-border').addClass('col-4');
    
    
    var appSignupHref = $('.next-step-signup').attr('href');
    var appLoginHref = $('.next-step-login').attr('href');
    $("input[name='app-link']").attr('signup-link',appSignupHref);
    $("input[name='app-link']").attr('login-link',appLoginHref);

});

window.onload = function () {
    $(document).on('click', '#more-benefit', function () {
        var ele = $('.highlighted');
        $(ele).toggleClass('on');
    });

    $("#jjkeller-slider").owlCarousel({
        singleItem: true,
        autoPlay: true,
        pagination: true,
        navigation: false
    });

    replaceLearnMoreLink();

};

$(document).on('click', '.publication-next , .popup-try-product, .landing-next-step, .productCode', function () {
    var promoCode;
    var materialCode = 'abc';
    if($(this).hasClass("publication-next")){
        var materialCode = $("input[name='product_name']:checked").val();
        promoCode = $("input[name='publication_product_code']").attr('promo-code');
    }
    if($(this).hasClass("popup-try-product")){
        var materialCode = $(this).attr('product-code');
        promoCode = $("input[name='publication_product_code']").attr('promo-code');
    }
    if($(this).hasClass("landing-next-step")){
        var materialCode = $(".landing-product-code").val();
        promoCode = $(".landing-promo-code").val();
    }
    
    if($(this).hasClass("productCode")){
        var materialCode = $(this).attr('productCode');
        promoCode = $(".landing-promo-code").val(); 
    }
    if(materialCode === undefined) {
        materialCode = '';
    }
    
        var defaultSignupHref = $("input[name='app-link']").attr('signup-link');
        var defaultLoginHref  = $("input[name='app-link']").attr('login-link');
        
        defaultSignupHref = defaultSignupHref +"?promoCode=" + promoCode + "&materialCode=" + materialCode;
        defaultLoginHref = defaultLoginHref +"?promoCode=" + promoCode + "&materialCode=" + materialCode;
        $('.next-step-login').attr('href',defaultLoginHref);
        $('.next-step-signup').attr('href',defaultSignupHref);

});

function replaceLearnMoreLink() {
    var w = $(window).width();
    if (w <= 580) {
        var freetrial = document.querySelector('.free_trial_link');
        if (freetrial !== null) {
            var href = $(freetrial).attr('href');
            $('.learnMoreLink').text($(freetrial).text());
            $('.learnMoreLink').attr('href', href);
            $('.learnMoreLink').addClass('tangerine');
        }
    }
}
