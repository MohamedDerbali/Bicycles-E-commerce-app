$(document).ready(function () {

    
        
    jQuery('img.svg').each(function(){
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');
    
        jQuery.get(imgURL, function(data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');
    
            // Add replaced image's ID to the new SVG
            if(typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if(typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass+' replaced-svg');
            }
    
            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');
            
            // Check if the viewport is set, else we gonna set it if we can.
            if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
            }
    
            // Replace image with new SVG
            $img.replaceWith($svg);
    
        }, 'xml');
    
    });


});


 /* loader */
$(document).ready(function(){
    var o = $('#page-preloader');
    if (o.length > 0) {
        $(window).on('load', function() {
            $('#page-preloader').removeClass('visible');
        });
    }
});

//go to top
$(document).ready(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('#scroll').fadeIn();
        } else {
            $('#scroll').fadeOut();
        }
    });
    $('#scroll').click(function () {
        $("html, body").animate({scrollTop: 0}, 600);
        return false;
    });
});


/* responsive menu */
 function openNav() {
    $('body').addClass("active");
    document.getElementById("mySidenav").style.width = "250px";
    jquery('#mySidenav').addCss("display","block");
}
function closeNav() {
    $('body').removeClass("active");
    document.getElementById("mySidenav").style.width = "0";
    jquery('#mySidenav').removeCss("display","none");
}

$(window).scroll(function(){
    $("#common-home").parent().addClass("index-page");
    if ($(window).scrollTop() >= 300) {
       $('.hsticky').addClass('fixed-header fadeIn Down');
    }
    else {
       $('.hsticky').removeClass('fixed-header');
    }
});

$(document).ready(function () {

    $('button.test').on("click", function(e)  {
        $(this).next('ul').toggle();
        e.stopPropagation();
        e.preventDefault();
    });

});

$(document).ready(function(){
$("#pro-review, #pro-writereview").click(function() {
    $('html, body').animate({ scrollTop: $("#tab-review").offset().top }, 1000);
});
});

// function openSearch() {
//     $('body').addClass("active-search");
//     document.getElementById("search").style.height = "auto";
//     $('#search').addClass("sideb");
//     $('.search_query').attr('autofocus', 'autofocus').focus();
// }
// function closeSearch() {
//     $('body').removeClass("active-search");
//     document.getElementById("search").style.height = "0";
//     $('#search').addClass("siden");
//     $('.search_query').attr('autofocus', 'autofocus').focus();
// }

$(document).ready(function () {
    if ($(window).width() <= 767) {
    $('.xsac').appendTo('.xs-ac');
    $('.curlan').appendTo('.acdrop');  
}
});



