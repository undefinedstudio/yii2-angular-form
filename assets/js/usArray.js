angular.module('yii2-angular-form').directive('usArray', [function() {
    return {
        restrict: 'A',
        require: 'ngModel',
        link: function($scope, $element, $attrs, ngModel) {
            var minSize = Number($attrs.usArrayMin) || 0;
            var maxSize = Number($attrs.usArrayMax) || Number.MAX_VALUE;

            ngModel.$validators.usArray = function(value) {
                return angular.isUndefined(value) || value instanceof Array;
            };

            ngModel.$validators.usArrayMin = function(value) {
                var aboveMin = value instanceof Array && value.length >= minSize;
                return angular.isUndefined(value) || aboveMin;
            };

            ngModel.$validators.usArrayMax = function(value) {
                var belowMax = value instanceof Array && value.length <= maxSize;
                return angular.isUndefined(value) || belowMax;
            };
        }
    }
}]);