angular.module('yii2-angular-form').directive('usModelData', [function() {
    return {
        restrict: 'E',
        require: 'ngModel',
        link: function($scope, $element, $attrs, ngModel) {
            ngModel.$parsers.push(function parseView(data) {
                return data;
            });

            ngModel.$setViewValue(JSON.parse($element.text()));
            $element.remove();
        }
    };
}]);