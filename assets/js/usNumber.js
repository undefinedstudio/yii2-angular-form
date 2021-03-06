angular.module('yii2-angular-form').directive('usNumber', [function() {
    return {
        restrict: 'A',
        require: 'ngModel',
        link: function($scope, $element, attrs, ngModel) {

            /** @var {string} attrs.usInteger */
            ngModel.$validators.usNumber = function(value) {
                var isNumber = parseFloat(value) === (value | 0) && (!attrs.usInteger || (value % 1 === 0) );
                return !value || isNumber;
            };

            /** @var {string} attrs.usMin */
            if (attrs.usMin) {
                ngModel.$validators.usMinNumber = function(value) {
                    return !value || value >= attrs.usMin;
                };
            }

            /** @var {string} attrs.usMax */
            if (attrs.usMax) {
                ngModel.$validators.usMaxNumber = function(value) {
                    return !value || value <= attrs.usMax;
                };
            }
        }
    }
}]);