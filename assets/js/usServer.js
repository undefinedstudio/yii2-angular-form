//TODO: find a way to make directiveName constant dependent
angular.module('yii2-angular-form').directive('usServer', function(serverValidator) {
    return {
        restrict: 'A',
        require: 'ngModel',
        link: function($scope, $element, attrs, ngModel) {
            console.log(serverValidator);
            ngModel.$validators[serverValidator] = function() {
                return true;
            }
        }
    }
});