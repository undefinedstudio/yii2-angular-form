angular.module('yii2-angular-form').directive('validator', [function() {
    return {
        restrict: 'AE',
        require: '^form',
        link: function($scope, $element, $attrs, form) {
            var field = form[$attrs.target];

            $scope.$watch(function() {
                return field.$error;
            }, function updateMessages(validators) {
                $element.find('message').addClass('ng-hide');
                angular.forEach(validators, function(valid, key) {
                    if (valid && field.$dirty) {
                        var $message = $element.find('message[validate=' + key + ']');
                        $message.removeClass('ng-hide');
                    }
                });
            }, true);
        }
    };
}]);