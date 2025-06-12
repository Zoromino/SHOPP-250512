//#region addToCart / removeFromCart / removeCompletely
//addToCart
function addToCart(productId){
    console.log(`Product ${productId} added to cart`);

    fetch(`/api/addToCart?productId=${productId}`,{
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
    }).then(response => {
        if(response.ok) {
            return response.json();
        } else {
            throw new Error('Network response was not ok');
        }
    }).then(data => {
        console.log('Product added to cart:', data);
        document.getElementById('cart-count').innerText = data.cartCount

        document.getElementById('cart-total-price').innerText = data.totalPrice
        // document.getElementById('show-total-price').innerText = data.totalPrice

        const quantitySpan = document.getElementById(`quantityDecre${productId}`);
        if (quantitySpan) {
            quantitySpan.innerText = data.cart.find(item => item.productId === productId).quantity;
        }
        const quantityShow = document.getElementById(`quantityDecreShow${productId}`);
        if (quantityShow) {
            quantityShow.innerText = data.cart.find(item => item.productId === productId).quantity;
        }


    }).catch(error => {
        console.error('There was a problem', error);
    })

}

//removeFromCart
function removeFromCart(productId){
    console.log(`Product ${productId} removed from cart`);

    fetch(`/api/removeFromCart?productId=${productId}`,{
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
    }).then(response => {
        if(response.ok) {
            return response.json();
        } else {
            throw new Error('Network response was not ok');
        }
    }).then(data => {
        console.log('Product removed from cart:', data);
        // Uppdatera count/totalprise
        document.getElementById('cart-count').innerText = data.cartCount
        document.getElementById('cart-total-price').innerText = data.totalPrice
        // document.getElementById('show-total-price').innerText = data.totalPrice

        const quantitySpan = document.getElementById(`quantityDecre${productId}`);
        if (quantitySpan) {
            quantitySpan.innerText = data.cart.find(item => item.productId === productId).quantity;
        }
        const quantityShow = document.getElementById(`quantityDecreShow${productId}`);
        if (quantityShow) {
            quantityShow.innerText = data.cart.find(item => item.productId === productId).quantity;
        }

    }).catch(error => {
        console.error('There was a problem', error);
    })
}

//removeCompletely
function removeCompletely(productId){
    console.log(`Product ${productId} removeCompletely from cart`);

    fetch(`/api/removeCompletely?productId=${productId}`,{
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
    }).then(response => {
        if(response.ok) {
            return response.json();
        } else {
            throw new Error('Network response was not ok');
        }
    }).then(data => {
        console.log('Product removeCompletely from cart:', data);
        // Uppdatera count/totalprise
        document.getElementById('cart-count').innerText = data.cartCount
        document.getElementById('cart-total-price').innerText = data.totalPrice
        // document.getElementById('show-total-price').innerText = data.totalPrice

        const quantitySpan = document.getElementById(`quantityDecre${productId}`);
        if (quantitySpan) {
            quantitySpan.innerText = data.cart.find(item => item.productId === productId).quantity;
        }
        const quantityShow = document.getElementById(`quantityDecreShow${productId}`);
        if (quantityShow) {
            quantityShow.innerText = data.cart.find(item => item.productId === productId).quantity;
        }

    }).catch(error => {
        console.error('There was a problem', error);
    })
}
//#endregion addToCart / removeFromCart / removeCompletely
