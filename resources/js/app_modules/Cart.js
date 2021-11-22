const $addToCart = function (cart, product_info) {
    let product_number = product_info.product_number;

    if (product_info.quantity <= 0) return false;

    let quantity = cart[product_number]?.quantity || 0;

    cart[product_number] = {
        quantity,
        product_number,
        id: product_info.id,
        name: product_info.name,
        demand: product_info.quantity,
        total_amount: product_info.total_amount * 100,
    };

    return cart[product_number];
};

const $getCart = function (props) {
    let user_cart = props.user?.cart;
    let session_cart = props.session_cart?.cart;

    if (user_cart) {
        user_cart.cart =
            typeof user_cart.cart == "string"
                ? JSON.parse(user_cart.cart)
                : user_cart.cart || {};
        return user_cart;
    }
    if (session_cart) {
        session_cart.cart =
            session_cart.cart instanceof Array
                ? Object.fromEntries(session_cart.cart)
                : session_cart.cart;
        return session_cart;
    }
    return {cart: {}};
};

const Cart = {
    $addToCart,
    $getCart,
};

export default Cart;
