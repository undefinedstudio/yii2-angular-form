angular.module('yii2-angular-form').directive('usRequired', [function() {
    return {
        restrict: 'A',
        require: ['validator', '^form'],
        link: function($scope, $element, attrs, ctrls) {
            var validator = ctrls[0], form = ctrls[1];

            /*if (ngModel) {
                ngModel.$validators.usRequired = function(modelValue) {
                    return !ngModel.$isEmpty(modelValue);
                };
            }*/

            validator.mapMessage('required');
        }
    }
}]);