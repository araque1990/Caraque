define([
    "uiComponent",
    "Magento_Customer/js/customer-data"
    // "ko"
], function (
    Component,
    customerData
    //ko
) {
    "use strict";

    return Component.extend({
        defaults: {
            //subtotal: ko.observable(33.00),
            subtotal: 33.00,
            template: 'Caraque_FreeShippingPromo/free-shipping-banner',
            tracks: {
                subtotal: true
            }
        },
        initialize: function () {
            this._super();
            var self = this;

            window.setTimeout(function () {
                // self.subtotal(35.00);
                self.subtotal = 35.00;
            }, 2000);

            console.log(this.message);
            console.log(this.message_xml);
        },
        formatCurrency: function (value) {
            // return '$' + value().toFixed(2);
            return '$' + value.toFixed(2);
        }
    });
});
