// console.log("in main js");

function addToCart(productId) {
    var addToCartBtn = document.getElementById("addToCartBtn"+productId);
    // var body = new FormData;

    /*body.append('productId', productId);
    body.append('price', addToCartBtn.dataset.price);
    body.append('quantity', addToCartBtn.dataset.quantity);
    body.append('image', addToCartBtn.dataset.image);*/

    let data = {
        "productId": productId,
        "price": addToCartBtn.dataset.price,
        "quantity": addToCartBtn.dataset.quantity,
        "image": addToCartBtn.dataset.image
    };

    $.ajax({
        type: "POST",
        url: "http://localhost/cart/add",
        data: data
    }).then((response) => {
        var data = JSON.parse(response);
        // var data = response.json();
        console.log(response, data);

    /*fetch('http://localhost/cart/add', {
        method: "POST",
        // headers: { 'Content-Type': 'application/json' },
        body: body
        // body: JSON.stringify(body)
    })
    .then((res) => res.json()) // response
    .then((data) => { // data
        console.log(data);*/

        if (data.success) {
            // show success message above the table
            $("#successMessage").text('Product successfully added to Cart.');

            // update the badge in header MyCart
            $("#cartBadge").text(data.cartItemsNb);

            // update total price in header sidebar cart
            $("#headerTotalPrice").text(data.totalPrice);

            if (data.new_item) {
                $(".no-items").remove();
                // add new li in sidebar cart header
                $list_item = $('<li id="sideCart'+data.item.id+'" class="cart-item-header"><a href="/product/detail/'+data.item.slug+'" class="photo"><img src="../..'+data.item.image+'" class="cart-thumb" alt=""></a><h6><a href="/product/detail/'+data.item.slug+'">'+data.item.name+'</a></h6><p><span id="itemQty'+data.item.id+'">'+data.item.quantity+'</span>x - <span class="price">$'+data.item.price+'</span></p></li>');
                $list_item.insertBefore($("#cart-list-header .total"));
            } else {
                // update quantity in sidebar cart header
                $("#itemQty"+data.item.id).text(data.item.quantity);
            }
        }
    });
}