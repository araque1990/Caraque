define(["uiComponent"], function (Component) {
    "use strict";

    return Component.extend({
        defaults: {
            subtotal: 33.00,
            template: 'Caraque_FreeShippingPromo/free-shipping-banner'
        },
        initialize: function () {
            this._super();

            console.log(this.message);
            console.log(this.message_xml);
        },
        formatCurrency: function (value) {
            return '$' + value.toFixed(2);
        }
    });
});
