

function addToCart(el, price){
    let id = $('#quantity').attr('data-productId');
    let quantity = $('#quantity').val();
    let name = $('#productName').val();
    let data = {
        id: id,
        name: name,
        quantity: quantity,
        price: price
    };

    $.post(BASE_URL  + 'product/add_to_basket', data, function(data){
        $('#items-to-card').text(data);
        $('#items-to-card').closest('a').attr('href', BASE_URL  + 'cart');
        alertify['success']('Added to basket');
    });
}