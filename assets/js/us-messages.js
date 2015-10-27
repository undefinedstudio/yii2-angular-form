/**
 * Automatically compute formName, so that is not required to change function signatures in PHP code
 */
angular.module('yii2-angular-form').directive('usMessages', ['$compile', function($compile) {
    return {
        restrict: 'AE',
        require: '^form',
        transclude: true,

        link: function($scope, $element, $attrs, $form, $transclude) {
            var addDot = $attrs.usMessages[0] != '[';
            $attrs.usMessages = $form.$name + (addDot ? '.' : '') + $attrs.usMessages;

            console.log($attrs.usMessages);

            // Get rid of useless wrapper
            // TODO: check if safe
            var $parent = $element.parent();
            $element.remove();

            $transclude(function(clone) {
                var ngMessages = $('<div></div>').attr('ng-messages', $attrs.usMessages).append(clone);
                $parent.append($compile(ngMessages)($scope));
            });
        }
    };
}]);