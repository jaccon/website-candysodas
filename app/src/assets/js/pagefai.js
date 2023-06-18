
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


window.addEventListener('DOMContentLoaded', function() {
  var overlay = document.querySelector('.overlay');

  function closeModal() {
    overlay.style.display = 'none';
  }

  overlay.addEventListener('click', closeModal);

  var modal = document.querySelector('.modal');
  modal.addEventListener('click', function(event) {
    event.stopPropagation();
  });

  var form = document.getElementById('subscribe-form');
  form.addEventListener('submit', function(event) {
    event.preventDefault();
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    // Handle form submission here (e.g., send data to server)
    console.log('Name:', name);
    console.log('Email:', email);
    closeModal();
  });
});

// START Wishlist
function wishlist(id) {
  var wishlistArray = JSON.parse(getCookie('wishlist') || '[]');
  wishlistArray.push(id);
  setCookie('wishlist', JSON.stringify(wishlistArray));
  console.log(id + ' added to wishlist');
  alert('Item adicionado aos favoritos')
}

function getCookie(name) {
  var cookieName = name + "=";
  var cookieArray = document.cookie.split(';');
  for (var i = 0; i < cookieArray.length; i++) {
    var cookie = cookieArray[i].trim();
    if (cookie.indexOf(cookieName) === 0) {
      return cookie.substring(cookieName.length, cookie.length);
    }
  }
  return null;
}

function setCookie(name, value) {
  var cookie = name + "=" + value + ";path=/";
  document.cookie = cookie;
}
// END Wishlist

