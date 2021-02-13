// console.log("in main js");

function addToCart(productId) {
    var addToCartBtn = document.getElementById("addToCartBtn"+productId);
    // var body = new FormData;

    /*body.append('productId', productId);
    body.append('slug', addToCartBtn.dataset.slug);
    body.append('quantity', addToCartBtn.dataset.quantity);
    body.append('image', addToCartBtn.dataset.image);*/

    let data = {
        "productId": productId,
        "slug": addToCartBtn.dataset.slug,
        // "price": addToCartBtn.dataset.price,
        "quantity": addToCartBtn.dataset.quantity,
        "image": addToCartBtn.dataset.image
    };

    $.ajax({
        type: "POST",
        url: "http://localhost/cart/add",
        // url: "http://freshshop-mvc-php.great-site.net/cart/add", // prod
        data: data
    }).then((response) => {
        var data = JSON.parse(response);
        // var data = response.json();
        console.log(response, data);

    /*fetch('http://localhost/cart/add', {
    /*fetch('http://freshshop-mvc-php.great-site.net/cart/add', { // prod
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

            if (data.new_item) { // if item doesn't exist in shopping cart
                $(".no-items").remove();

                // add new li in sidebar cart header
                $list_item = $('<li id="sideCart'+data.item.id+'" class="cart-item-header"></li>');
                $li_a = $('<a href="/product/detail/'+data.item.slug+'" class="photo"></a>'); // a in li
                $li_img = $('<img src="../..'+data.item.image+'" class="cart-thumb" alt="">'); // img in a
                $li_h6 = $('<h6><a href="/product/detail/'+data.item.slug+'">'+data.item.name+'</a></h6>'); // h6 in li
                $li_p = $('<p><span id="itemQty'+data.item.id+'">'+data.item.quantity+'</span>x - <span class="price">$'+data.item.price+'</span></p>'); // p in li        

                $li_img.appendTo($li_a);
                $li_a.appendTo($list_item);
                $li_h6.appendTo($list_item);
                $li_p.appendTo($list_item);

                $list_item.insertBefore($("#cart-list-header .total"));
            } else {
                // update quantity in sidebar cart header
                $("#itemQty"+data.item.id).text(data.item.quantity);
            }
        }
    });
}