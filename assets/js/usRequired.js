angular.module('yii2-angular-form').directive('usRequired', [function() {
    return {
        restrict: 'A',
        require: ['validator', 'ngModel'],
        link: function($scope, $element, attrs, ctrls) {
            var validator = ctrls[0], ngModel = ctrls[1];

            ngModel.$validators.usRequired = function(modelValue) {
                var valid = !ngModel.$isEmpty(modelValue);

                valid ? validator.hideMessage() : validator.showMessage();
                return valid;
            };
        }
    }
}]);