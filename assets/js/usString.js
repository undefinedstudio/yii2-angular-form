angular.module('yii2-angular-form').directive('usString', [function() {
    return {
        restrict: 'A',
        require: 'ngModel',
        link: function($scope, $element, attrs, ngModel) {
            ngModel.$validators.usString = function(value) {
                return typeof value === 'string' || value instanceof String;
            }
        }
    }
}]);