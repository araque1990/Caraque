define([
    "uiComponent",
    "Magento_Customer/js/customer-data",
    'underscore',
    'knockout'
    // "ko"
], function (
    Component,
    customerData,
    _,
    ko
    //ko
) {
    "use strict";

    return Component.extend({
        defaults: {
            //subtotal: ko.observable(33.00),
            freeShippingThreshold: 100,
            subtotal: 0.00,
            template: 'Caraque_FreeShippingPromo/free-shipping-banner',
            tracks: {
                subtotal: true,
            }
        },
        initialize: function () {
            this._super();
            var self = this;
            var cart = customerData.get('cart');
            customerData.getInitCustomerData().done(function () {
                if (!_.isEmpty(cart()) && !_.isUndefined(cart().subtotalAmount)) {
                    self.subtotal = parseFloat(cart().subtotalAmount);
                }
            });

            cart.subscribe(function (cart) {
                if (!_.isEmpty(cart) && !_.isUndefined(cart.subtotalAmount)) {
                    self.subtotal = parseFloat(cart.subtotalAmount);
                }
            });
            self.message = ko.computed(function () {
                // subtotal = 0, return messageDefault
                if (_.isUndefined(self.subtotal) || self.subtotal === 0) {
                    return self.messageDefault;
                }
                // subtotal >0 and < 100, return messageItemsInCart
                else if (self.subtotal > 0 && self.subtotal < self.freeShippingThreshold) {
                    let subtotalRemaining = self.freeShippingThreshold - self.subtotal;
                    let formatSubtotalRemaining = self.formatCurrency(subtotalRemaining);
                    return self.messageItemsInCart.replace('$XX.XX', formatSubtotalRemaining);
                }
                // subtotal >= 100, return messageFreeShipping
                if (self.subtotal >= self.freeShippingThreshold) {
                    return self.messageFreeShipping;
                }
            });
        },
        formatCurrency: function (value) {
            // return '$' + value().toFixed(2);
            return '$' + value.toFixed(2);
        }
    });
});
