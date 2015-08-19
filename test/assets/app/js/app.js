var app = angular.module('topdeck', [
    'yii2-angular-form'
]);

app.config(function($locationProvider, $ariaProvider, $httpProvider) {

    // Fix to prevent div from highlighting with ngModel
    $ariaProvider.config({
        tabindex: false
    });

    // Automatically injects csrf token in post requests
    $httpProvider.interceptors.push(function csrfTokenInjector() {
        return {
            request: function(config) {
                if (config.method == 'POST') {
                    config.data = config.data || {};
                    config.data[yii.getCsrfParam()] = yii.getCsrfToken();
                }
                return config;
            }
        };
    });

    //$locationProvider.html5Mode(true);
});