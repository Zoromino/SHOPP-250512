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
        // document.getElementById('cart-count').innerText = data.cartCount
        updateCartCount(data.cartCount);

        if(document.getElementById('cart-total-price')){
            document.getElementById('cart-total-price').innerText = data.totalPrice
        }
        // document.getElementById('show-total-price').innerText = data.totalPrice

        const quantitySpan = document.getElementById(`quantityDecre${productId}`);
        if (quantitySpan) {
            quantitySpan.innerText = data.cart.find(item => item.productId === productId).quantity;
        }
        const quantityShow = document.getElementById(`quantityDecreShow${productId}`);
        if (quantityShow) {
            quantityShow.innerText = data.cart.find(item => item.productId === productId).quantity;
        }
        const rowPriceSpan = document.getElementById(`total-row-price${productId}`);
        if (rowPriceSpan) {
            const item = data.cart.find(item => item.productId === productId);
            if (item){
                rowPriceSpan.innerText = item.rowPrice;
            }
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
        const rowPriceSpan = document.getElementById(`total-row-price${productId}`);
        if (rowPriceSpan) {
            const item = data.cart.find(item => item.productId === productId);
            if (item){
                rowPriceSpan.innerText = item.rowPrice;
            }
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

//#region cart-count
// göm cart-counten!
document.addEventListener("DOMContentLoaded", function () {
    const cartCount = document.getElementById("cart-count");
    if(cartCount && parseInt(cartCount.textContent) === 0){
        cartCount.style.display = "none";
    }
});

// visa cart-counten!
function updateCartCount(newCount){
    const cartCount = document.getElementById("cart-count");
    if(newCount > 0){
        cartCount.textContent = newCount;
        cartCount.style.display = "inline-block";
    } else {
        cartCount.style.display = "none";
    }
}

// koppla till klick-eventen
document.querySelectorAll(".addToCart").forEach(addToCartBtn => {
    addToCartBtn.addEventListener("click", function (){
        const cartCount = document.getElementById("cart-count");
        let currentCount = parseInt(cartCount.textContent) || 0;

        let newCount = currentCount + 1;

        updateCartCount(newCount);
    });
});

//#endregion cart-count
