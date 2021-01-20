// console.log("in main js");

function addToCart(productId) {
    var body = new FormData;
    var nbCartItems = 0;
    var addToCartBtn = document.getElementById("addToCartBtn"+productId);

    body.append('productId', productId);
    body.append('price', addToCartBtn.dataset.price);
    body.append('quantity', addToCartBtn.dataset.quantity);
    body.append('image', addToCartBtn.dataset.image);

    fetch('http://localhost/cart/add', {
        method: "POST",
        body: body
    })
    .then((res) => res.json()) // response
    .then((data) => { // data
        console.log(data);

        if (data.success) {
            // show success message above the table
            $("#successMessage").text('Product successfully added to Cart.');

            // update the badge in header MyCart
            $("#cartBadge").text(data.cartItemsNb);

            // update total price in header sidebar cart
            $("#headerTotalPrice").text(data.totalPrice);

            if (data.new_item) {
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