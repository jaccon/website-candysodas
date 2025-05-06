
$(document).ready(function() {

  // Function Add To Cart Function
  $('#addToCart').click(function() {

    const productId = $('#addToCart').data('id');

    // quantity
    var quantity = $("#quantity").val();
    var price = $('#addToCart').attr('data-price');
    var title = $('#addToCart').attr('data-title');

    let basketItems = ($.cookie('basket') || '');

    if (basketItems !== '') {
        basketItems += ',';
    }

    basketItems += productId+':'+quantity+':'+price+':'+title;

    const expirationDate = new Date();
    expirationDate.setDate(expirationDate.getDate() + 30);
    $.cookie('basket', basketItems, { expires: expirationDate, path: '/' });
    // console.log(productId);
    alert('Produto adicionado a sacola: ' + productId);
    window.location.reload();

  });

  // Function Favorites
  $('#addToFavorite').click(function() {

    const productId = $('#addToFavorite').data('id');

    // quantity
    let favoritesItems = ($.cookie('favorites') || '');

    if (favoritesItems !== '') {
      favoritesItems += ',';
    }

    favoritesItems += productId;

    const expirationDate = new Date();
    expirationDate.setDate(expirationDate.getDate() + 30);
    $.cookie('favorites', favoritesItems, { expires: expirationDate, path: '/' });
    console.log('Add favorite:'+ productId);

    alert('Adicionado aos favoritos ');

  });

  // Remove item in basket
  
  // 

  // Save in Cookie
  var select = $('#pVariations');
  var button = $('button');
  select.on('change', function() {
    var selectedValue = $(this).val();
    console.log(selectedValue);
    button.attr('data-id', selectedValue);
    window.location.replace('/p/'+selectedValue+'.html');
  });
   
  


});


