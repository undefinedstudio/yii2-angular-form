var app = angular.module('yii2-angular-form-test', [
    'yii2-angular-form',
    'ngResource',
    'ngMaterial'
]);

app.config(function($httpProvider) {

    // Fix to prevent div from highlighting with ngModel
    /*$ariaProvider.config({
        tabindex: false
    });*/

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