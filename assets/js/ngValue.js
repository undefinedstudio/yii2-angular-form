angular.module('yii2-angular-form').directive('ngValue', [function() {
    return {
        restrict: 'A',
        require: '?ngModel',
        link: function($scope, $element, $attrs, ngModel) {
            // This extension should only work with ngModelController
            if (!ngModel) {
                return;
            }

            $scope.$watch($attrs.ngValue, function setDirty(value) {
                if (!ngModel.$isEmpty(value)) {
                    ngModel.$setDirty();
                }
            });
        }
    };
}]);