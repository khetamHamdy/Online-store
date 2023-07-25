$(document).ready(function(){
    
    var rtl = false;
    
    if($("html").attr("lang") == 'ar'){
         rtl = true;
    }
    
    /*header-fixed*/
    $(window).scroll(function(){
            
        if ($(window).scrollTop() >= 100) {
            $('#header').addClass('fixed-header');
        }
        else {
            $('#header').removeClass('fixed-header');
        }
              
    });
    $('.scroll, .mmenu a').on('click', function () {
        $('html, body').animate({

            scrollTop: $('#' + $(this).data('value')).offset().top

        }, 1000);

        $("body,html").removeClass('menu-toggle');

        $(".hamburger").removeClass('active');
    });
    /*open menu*/
    
    $(".hamburger").click(function(){
        
        $(".main_menu").slideToggle();
        if($(this).hasClass('is-closed')) {
            $(this).removeClass('is-closed');
        }else{
            $('.hamburger').addClass('is-closed');
        }
    });
    $(".is-closed").click(function(){
        $(this).removeClass('is-closed');
    });
    
    
    /* Checked Adress */
    
    $(document).ready(function() {
        $("input:radio:checked").closest(".item--adress").addClass('checked-address');
    });
    
    $(document).on("click", '.radio-item input', function () {
        $(".item--adress").removeClass('checked-address');
         $(this).closest(".item--adress").addClass('checked-address');
    });
    
    $(".btnSt").click(function(e) {
        e.preventDefault();
    });
   
    /*page-scroll*/
    
    
    $('#slide-home').owlCarousel({
        loop: true,
        rtl: rtl,
        responsiveClass: true,
        items: 1,
        dots: true,
        nav: false,
        autoplay: false,
    });
    
    $("#categoris-slider").owlCarousel({
        loop: true,
        margin: 40,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                margin: 5,
                stagePadding: 50
            },
            992: {
                items: 4,
            },
            1199: {
                items: 6,
            }
        },
        dots: false,
        nav: true,
        navText:['<i class="fa-solid fa-angle-left"></i>','<i class="fa-solid fa-angle-right"></i>'],
        rtl: rtl,
        autoplay: false
    });
    
})

/*Decrease & Increase*/    

var minimum_quanitiy=$(".jsQuantityDecrease").attr("minimum"),
productQuantity=minimum_quanitiy;
$(document).on("click",".jsQuantityDecrease",function(){
    var quantity = $(this).parent().find('input[name="count-quat1"]').val();
    quantity = quantity * 1;
    var newQuantity = quantity - 1;
    $(this).parent().find('input[name="count-quat1"]').val(newQuantity);
    if (newQuantity <1) {
        $(this).parent().find(".jsQuantityDecrease").addClass("disabled");
    } else{
         $(this).parent().find(".jsQuantityDecrease").removeClass("disabled");
    }
}),

$(document).on("click",".jsQuantityIncrease",function(){
    var quantity = $(this).parent().find('input[name="count-quat1"]').val();
    quantity = quantity * 1;
    var newQuantity = quantity + 1;
    $(this).parent().find('input[name="count-quat1"]').val(newQuantity);
    if (newQuantity >=2) {
        $(this).parent().find(".jsQuantityDecrease").removeClass("disabled");
    } else{
         $(this).parent().find(".jsQuantityDecrease").addClass("disabled");
    }
    
})
