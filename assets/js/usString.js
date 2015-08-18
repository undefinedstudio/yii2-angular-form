angular.module('yii2-angular-form').directive('usString', [function() {
    return {
        restrict: 'A',
        require: ['validator', 'ngModel'],
        link: function($scope, $element, attrs, ctrls) {
            var validator = ctrls[0], ngModel = ctrls[1];

            var min = attrs.min ? Number(attrs.min) : 0;
            var max = attrs.max ? Number(attrs.max) : Number.MAX_VALUE;

            ngModel.$validators.usString = function(modelValue) {
                var isString = typeof modelValue === 'string' || modelValue instanceof String;
                var tooShort = isString && modelValue.length < min;
                var tooLong = isString && modelValue.length > max;

                isString ? validator.hideMessage('message') : validator.showMessage('message');
                tooShort ? validator.showMessage('tooShort') : validator.hideMessage('tooShort');
                tooLong ? validator.showMessage('tooLong') : validator.hideMessage('tooLong');
                return isString && !tooSmall && !tooBig;
            };

            console.log(ngModel);
        }
    }
}]);