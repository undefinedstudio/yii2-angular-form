//TODO: find a way to make directiveName constant dependent
angular.module('yii2-angular-form').directive('usServer', [function(serverValidator) {
    return {
        restrict: 'A',
        require: 'ngModel',
        link: function($scope, $element, attrs, ngModel) {
            var ngMessages = ngModel.$$parentForm.$name + '.' + ngModel.$name + '.' + '$error';

            ngModel.$validators[serverValidator] = function() {
                var $parentForm = $element.closest('form, ng-form');
                $parentForm.find('[ng-messages="'+ ngMessages +'"] [ng-message='+ serverValidator +']').html('');
                return true;
            }
        }
    }
}]);