var counter=0;
var totalprice = 0;

$(document).ready(function() {
  $('.add-to-cart').click(function(e) {
    var prodId = $(this).parents('li').attr('id');

    if ($(this).hasClass('selected')){
      e.preventDefault();
    }
    else{

      var selectedpro = $(this).parent('.products-box');
      $(this).parent('.products-box').attr('data-id', prodId);

      var selectclone = $(this).parent('.products-box').clone();               $(selectclone).appendTo('.cart-items');
      $('.cart').addClass('added');
      $(this).addClass('selected');
      var itemprice = parseInt($(this).parent('.products-box').find('.price i').html());
      totalprice = totalprice + itemprice;
      $('.cart-total span').html(totalprice);

      counter++;



    }



    var buttonCount = setTimeout(function(){
      $('.cart').attr('data-count', counter);
    }, 100);


    var removeClass = setTimeout(function(){
      $('.cart').removeClass('added');
    }, 100);

  });
  $('.cart').click(function() {
    // e.preventDefault();
    $('.cart-items').slideToggle();
  });


  $(document).on('click', '.close-btn',function(){
    var itemprice = parseInt($(this).parent('.products-box').find('.price i').html());
    totalprice = totalprice - itemprice;
    $('.cart-total span').html(totalprice);

    var removeid = $(this).parent('.products-box').attr('data-id');
    $('#'+removeid).find('.add-to-cart').removeClass('selected');
    $(this).parent('.products-box').remove();
    counter--;
    var buttonCount = setTimeout(function(){
      $('.cart').attr('data-count', counter);
    }, 200);
  });




});

