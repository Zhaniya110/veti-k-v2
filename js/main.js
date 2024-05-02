$(document).ready(function () {
    $('.burger-menu').on('click', function () {
        $('.menu-mobile').fadeIn(200);
    });

    $('.close-menu').on('click', function () {
        $('.menu-mobile').fadeOut(200);
    });

    $('.contact-form .wpcf7-form-control').focus(function () {
        $(this).parents('.item').find('label').addClass('active');
    });

    $('.contact-form .wpcf7-form-control').blur(function () {
        if($(this).val() === ''){
            $(this).parents('.item').find('label').removeClass('active');
        }
    });

    $("a.scroll").on('click', function() {
        $('.menu-mobile').fadeOut(200);

        var href = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(href).offset().top-59
        });
        return false;
    });

    $(".button-down").on('click', function() {
        var href = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(href).offset().top
        }, 1000);
        return false;
    });

    if ($(window).width() > 1024){
        let bg = document.querySelectorAll('.mouse-parallax');
        for (let i = 0; i < bg.length; i++){
            window.addEventListener('mousemove', function(e) {
                let x = e.clientX / window.innerWidth;
                let y = e.clientY / window.innerHeight;
                bg[i].style.transform = 'translate(-' + x * 30 + 'px, -' + y * 30 + 'px)';
            });
        }

        let bg2 = document.querySelectorAll('.mouse-parallax2');
        for (let i = 0; i < bg2.length; i++){
            window.addEventListener('mousemove', function(e) {
                let x = e.clientX / window.innerWidth;
                let y = e.clientY / window.innerHeight;
                bg2[i].style.transform = 'translate(' + x * 30 + 'px, ' + y * 30 + 'px)';
            });
        }
    }
});
