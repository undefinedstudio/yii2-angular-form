angular.module('yii2-angular-form').directive('usString', [function() {
    return {
        restrict: 'A',
        require: ['?validator', '?ngModel', '^form'],
        link: function($scope, $element, attrs, ctrls) {
            var validator = ctrls[0], ngModel = ctrls[1], form = ctrls[2];

            if (ngModel) {
                ngModel.$validators.usString = function(value) {
                    return typeof value === 'string' || value instanceof String;
                };
            } else if (validator) {
                validator.mapMessage('usString', 'message');
                validator.mapMessage('minlength', 'tooShort');
                validator.mapMessage('maxlength', 'tooLong');
            }
        }
    }
}]);