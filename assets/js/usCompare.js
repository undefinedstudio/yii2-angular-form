angular.module('yii2-angular-form').directive('usCompare', function() {
    return {
        restrict: 'A',
        require: ['ngModel', '^form'],
        link: function($scope, $element, $attrs, ctrls) {
            var ngModel = ctrls[0];
            var form = ctrls[1];

            /** @var {string} $attrs.usCompareAttribute */
            var compareAttribute = $attrs.usCompareAttribute;

            ngModel.$validators.usCompare = function(value) {
                // Should be using $modelValue but it doesn't work
                return !value || (value == form[compareAttribute].$viewValue);
            };
        }
    }
});