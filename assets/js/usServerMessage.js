/**
 * @description
 * Manages server-side validation messages
 */
angular.module('yii2-angular-form').directive('usServerMessage', function() {
    return {
        restrict: 'A',
        require: '^^ngMessages',
        link: function($scope, $element) {
            var ngMessages = $element.closest('[ng-messages]').attr('ng-messages');

            // This directive works only with ngMessages applied to form controls
            var splitted = ngMessages.split('.$error');
            if (splitted == ngMessages) {
                return;
            }

            var formControl = splitted[0];
            $scope.$watchCollection(formControl + '.$serverError', function(serverError) {
                $element.html(serverError || null);
            });
        }
    };
});