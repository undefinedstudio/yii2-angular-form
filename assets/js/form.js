(function() {
    function formDirective() {
        return {
            restrict: 'E',
            require: 'form',
            link: function($scope, $element, $attr, form) {
                form.$addError = function(key, error) {
                    form[key].$serverError = error;
                };

                form.$addErrors = function(errors) {
                    angular.forEach(errors, function(error, key) {
                        form.$addError(key, error);
                    });
                };

                form.$removeError = function(key) {
                    delete form[key].$serverError;
                };

                form.$clearErrors = function() {
                    var controls = getFormControls();
                    angular.forEach(controls, function(value, key) {
                        form.$removeError(key);
                    });
                };

                function getFormControls() {
                    var controls = {};
                    angular.forEach(form, function(property, key) {
                        if (property && property.hasOwnProperty('$modelValue')) {
                            controls[key] = property;
                        }
                    });
                    return controls;
                }
            }
        };
    }

    angular.module('yii2-angular-form')
        .directive('form', formDirective)
        .directive('ngForm', formDirective);
})();