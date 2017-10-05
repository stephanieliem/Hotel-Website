$(document).ready(function () {
    $(document).on("scroll", onScroll);
    
    //smoothscroll
    $('a[href^="#"]').on('click', function (e) {
        e.preventDefault();
        $(document).off("scroll");
        
        $('a').each(function () {
            $(this).removeClass('active');
        })
        $(this).addClass('active');
      
        var target = this.hash,
            menu = target;
        $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top-100
        }, 500, 'swing', function () {
            $(document).on("scroll", onScroll);
        });
    });
});

function onScroll(event){
    var scrollPos = $(document).scrollTop();
    $('#menu-center a').each(function () {
        var currLink = $(this);
        var refElement = $(currLink.attr("href"));
        if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
            $('#menu-center ul li a').removeClass("active");
            currLink.addClass("active");
        }
        else{
            currLink.removeClass("active");
        }
    });
}

$(window).scroll(function() {    
    var scroll = $(window).scrollTop();
    if (scroll >= 300) {
        $(".clearNav").addClass("whiteNav");    
        $(".reserve").addClass("breserve");
        $(".signin").addClass("bsignin");
        $(".navbar-middle").addClass("bnavbar-middle");
    } else {
        $(".clearNav").removeClass("whiteNav");
        $(".reserve").removeClass("breserve");
        $(".signin").removeClass("bsignin"); 
        $(".navbar-middle").removeClass("bnavbar-middle");
    }
});
var distance = $('.navtop').offset().top,
    $window = $(window);

$window.scroll(function() {
    if ( $window.scrollTop() >= distance ) {
        alert("Oe");
    }
});

$('.parallax-window').parallax({imageSrc: 'images/background1.jpg'});