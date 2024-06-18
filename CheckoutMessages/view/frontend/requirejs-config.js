var config = {
    config: {
        "map": {
            "*": {
                "fadeInElement": "Caraque_JsFun/js/fade-in-element",
                "Magento_Review/js/submit-review": "Caraque_JsFun/js/submit-review"
            }
        },
        mixins: {
            'Magento_Checkout/js/view/summary/cart-items': {
                'Caraque_CheckoutMessages/js/view/summary/cart-items-mixin': true
            }
        }
    }
}
