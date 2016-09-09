/**
 * Created by pierreportejoie on 09/09/2016.
 */

function placePinsAtRandom() {
    $('.pin-img').each(function () {
        $(this).css("top", Math.random()*300);
        $(this).css("left", Math.random()*300*5);
        $(this).css("display", "block");
    });
}

$(document).ready(function(){
    placePinsAtRandom();
});

$(window).resize(function(){
    /** ahahahahahahahahahahaha no*/
    //placePinsAtRandom();
});