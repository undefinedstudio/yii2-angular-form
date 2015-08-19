angular.module('yii2-angular-form').directive('validator', [function() {
    return {
        restrict: 'AE',
        require: ['validator', '^form'],
        controller: ['$scope', '$element', '$attrs', function($scope, $element, $attrs) {
            function getMessage(name) {
                return name ? $element.find('message[name=' + name + ']') : $element.find('message');
            }

            this.showMessage = function (name) {
                getMessage(name).removeClass('ng-hide');
            };

            this.hideMessage = function (name) {
                getMessage(name).addClass('ng-hide');
            };
        }],
        link: function($scope, $element, $attrs, ctrls) {
            var ctrl = ctrls[0], form = ctrls[1];

            ctrl.mapMessage = function(validatorName, messageName) {
                var field = form[$attrs.name];
                return $scope.$watch(function() {
                    return field.$error[validatorName];
                }, function(invalid) {
                    (invalid && field.$dirty) ? ctrl.showMessage(messageName) : ctrl.hideMessage(messageName);
                });
            };
        }
    }
}]);