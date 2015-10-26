angular.module('yii2-angular-form').directive('usArray', [function() {
    return {
        restrict: 'A',
        require: 'ngModel',
        link: function($scope, $element, $attrs, ngModel) {
            var minSize = Number($attrs.usArrayMin) || 0;
            var maxSize = Number($attrs.usArrayMax) || Number.MAX_VALUE;

            ngModel.$validators.usArray = function(value) {
                return value instanceof Array;
            };

            ngModel.$validators.usArrayMin = function(value) {
                return value instanceof Array && value.length >= minSize;
            };

            ngModel.$validators.usArrayMax = function(value) {
                return value instanceof Array && value.length <= maxSize;
            };
        }
    }
}]);