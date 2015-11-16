(function() {
    function formDirective() {
        return {
            restrict: 'E',
            require: 'form',
            link: function($scope, $element, $attr, form) {
                form.addErrors = function(errors) {
                    $.each(errors, function (key, error) {
                        form[key].$error.input = error;
                    });
                };
            }
        };
    }

    angular.module('yii2-angular-form')
        .directive('form', formDirective)
        .directive('ngForm', formDirective);
})();