var config = {
    config: {
        mixins: {
            'Magento_Checkout/js/view/summary/cart-items': {
                'Caraque_CheckoutMessages/js/view/summary/cart-items-mixin': true
            }
        }
    },
    map: {
        '*': {
            'Magento_Checkout/template/sidebar': 'Caraque_CheckoutMessages/template/sidebar'
        }
    }
}
