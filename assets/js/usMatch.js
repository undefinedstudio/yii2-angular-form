angular.module('yii2-angular-form').directive('usMatch', function() {
    return {
        restrict: 'A',
        require: 'ngModel',
        link: function($scope, $element, $attrs, ngModel) {
            /** @var {string} $attrs.usPattern */
            /** @var {boolean} $attrs.usNot */

            var pattern = new RegExp($attrs.usPattern);
            var not = angular.isDefined($attrs.usNot);

            ngModel.$validators.usMatch = function(value) {
                var isString = typeof value === 'string' || value instanceof String;
                var match = isString && value.match(pattern) !== null;
                return !value || (not ? !match : match);
            };
        }
    }
});