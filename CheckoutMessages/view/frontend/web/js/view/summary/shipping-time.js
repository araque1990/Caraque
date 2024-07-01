define(['uiComponent'], function (Component) {
    'use strict';

    return Component.extend({
        defaults: {
            '${ $.name }shippingAddressProvider': '${ $.name }AddressProvider',
            tracks: {
                countryId: true
            },
            listens: {
                '${ $.shippingAddressProvider}.region_id': 'handleRegionChange'
            },
            imports: {
                countryId: '${ $.shippingAddressProvider}.country_id'
            },
        },
        initialize: function () {
            this._super();
            console.log(this.name + ' is initialized.');
        },
        showMessage: function () {
            return this.countryId === 'US';
        },
        handleRegionChange: function (newRegionId) {
            console.log('New Region ID ' + newRegionId);
        }
    });
});
