/**
 * @description
 * Manages the auto-filling behaviour of usServer validators
 */
angular.module('yii2-angular-form').directive('ngMessage', function(serverValidator) {
    return {
        restrict: 'A',
        require: '^^ngMessages',
        link: function($scope, $element, $attrs) {
            /** @var {string} $attrs.ngMessage */
            if($attrs.ngMessage !== serverValidator) {
                return;
            }

            var ngMessages = $element.closest('[ng-messages]').attr('ng-messages');
            $scope.$watchCollection(ngMessages, function(value) {
                // Comment $element fix
                var $ngMessage = $element.siblings('[ng-message="' + serverValidator + '"]');

                $ngMessage.html(value ? value[serverValidator] : '');
                console.log($ngMessage, value);
            });
        }
    };
});