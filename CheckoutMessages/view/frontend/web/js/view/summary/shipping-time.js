define(['uiComponent'], function (Component) {
    'use strict';

    return Component.extend({
        defaults: {
            tracks: {
                countryId: true
            },
            listens: {
                'checkoutProvider:shippingAddress.region_id': 'handleRegionChange'
            },
            imports: {
                countryId: 'checkoutProvider:shippingAddress.country_id'
            }
        },
        showMessage: function () {
            return this.countryId === 'US';
        },
        handleRegionChange: function (newRegionId) {
            console.log('New Region ID ' + newRegionId);
        }
    });
});