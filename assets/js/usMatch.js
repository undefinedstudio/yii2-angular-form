angular.module('yii2-angular-form').directive('usMatch', [function() {
    return {
        restrict: 'A',
        require: 'ngModel',
        link: function($scope, $element, $attrs, ngModel) {
            var pattern = new RegExp($attrs.usPattern);

            ngModel.$validators.usMatch = function(value) {
                return !value || value.match(pattern) !== null;
            }
        }
    }
}]);