define(['vue', 'jquery', 'Caraque_JsFun/js/jquery-log'], function (Vue, $) {
    'use strict'

    $.log('Testing output to the console')

    return function (config, element) {
        return new Vue({
            el: '#' + element.id,
            data: {
                // message: 'This is a test'
                message: config.message
            }
        })
    }


})
