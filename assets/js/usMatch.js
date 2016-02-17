angular.module('yii2-angular-form').directive('usMatch', [function() {
    return {
        restrict: 'A',
        require: 'ngModel',
        link: function($scope, $element, $attrs, ngModel) {
            var pattern = new RegExp($attrs.usPattern);
            var not = angular.isDefined($attrs.usNot);

            ngModel.$validators.usMatch = function(value) {
                var match = value.match(pattern) !== null;
                return !value || (not ? !match : match);
            }
        }
    }
}]);