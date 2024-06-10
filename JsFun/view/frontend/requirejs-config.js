var config = {
    "map": {
        "*": {
            "fadeInElement": "Caraque_JsFun/js/fade-in-element",
            "Magento_Review/js/submit-review": "Caraque_JsFun/js/submit-review"
        }
    },
    "paths": {
        "vue": [
            "https://cdn.jsdelivr.net/npm/vue@2/dist/vue",
            "Caraque_JsFun/js/vue"
        ]
    },
    "shim": {
        "Caraque_JsFun/js/jquery-log": ["jquery"]
    },
    "deps": ["Caraque_JsFun/js/every-page"],
    "config": {
        "mixins": {
            "Magento_Ui/js/view/messages": {
                "Caraque_JsFun/js/messages-mixin": true
            }
        }
    }
}
