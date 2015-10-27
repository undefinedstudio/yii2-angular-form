angular.module('yii2-angular-form').directive('usNumber', [function() {
    return {
        restrict: 'A',
        require: 'ngModel',
        link: function($scope, $element, attrs, ngModel) {
            ngModel.$validators.usNumber = function(value) {
                return parseFloat(value) === (value | 0) && (!attrs.usInteger || (value % 1 === 0) );
            };

            if (attrs.usMin) {
                ngModel.$validators.usMinNumber = function(value) {
                    return value < attrs.usMin;
                };
            }

            if (attrs.usMax) {
                ngModel.$validators.usMaxNumber = function(value) {
                    return value < attrs.usMax;
                };
            }
        }
    }
}]);