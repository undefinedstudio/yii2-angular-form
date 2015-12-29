(function() {
    function formDirective() {
        return {
            restrict: 'E',
            require: 'form',
            link: function($scope, $element, $attr, form) {
                form.$addError = function(key, error, validator) {
                    form[key].$error[validator || 'usServer'] = error;
                };

                form.$addErrors = function(errors, validator) {
                    angular.forEach(errors, function(error, key) {
                        form.$addError(key, error, validator);
                    });
                };
            }
        };
    }

    angular.module('yii2-angular-form')
        .directive('form', formDirective)
        .directive('ngForm', formDirective);
})();