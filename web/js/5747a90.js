/**********************************
 * 
 * nav fixed
 */

var navTop= $('#nav-fixed').offset().top;
            $(window).scroll(function(){
                if ($(window).scrollTop() > navTop ) {
                    // fixed
                    $('#nav-wrapper').addClass("navbar-fixed-top", 400, "swing" );
                    $('#nav-fixed').addClass("navbar-fixed-top", 400, "swing" );
                } else {
                    // relative
                    $('#nav-wrapper').removeClass("navbar-fixed-top", 400, "swing");
                    $('#nav-fixed').removeClass("navbar-fixed-top", 400, "swing");
                }
            });
            
/***********************************
 * nav responsive
 */

//(function($) {
//    $('#navbar-responsive').click(function(){ 
//        $('#nav-wrapper').toggle("slow", function() {
//            $('#nav-wrapper').addClass("open");
//        });
//    });
//   
//})(jQuery); // End of use strict


// Closes the Responsive Menu on Menu Item Click
    $('.topnav ul li a').click(function(){ 
            $('.navbar-toggle:visible').click();
    });
    
    
    
// Toggle User

$(".user-profil").click(function(){
    $(".connect").toggle('slow');
});