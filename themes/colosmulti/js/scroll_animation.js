
// jQuery(document).ready(function ($) {
//     function checkElementLocation() {
//         var $window = $(window);
//         var bottom_of_window = $window.scrollTop() + $window.height();

//         $('#IMAGE241').each(function (i) {
//             var $that = $(this);
//             var bottom_of_object = $that.position().top + $that.outerHeight();

//             //if element is in viewport, add the animate class
//             if (bottom_of_window > bottom_of_object) {
//                 $(this).addClass('ladi-animation');
//             }
//         });
//     }
//     // if in viewport, show the animation
//     checkElementLocation();

//     $(window).on('scroll', function () {
//         checkElementLocation();
//     });
// })