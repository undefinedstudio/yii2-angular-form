angular.module('yii2-angular-form').directive('validator', [function() {
    return {
        restrict: 'AE',
        require: 'ngModel',
        controller: ['$element', function($element) {
            function getMessage(name) {
                return name ? $element.find('message[name=' + name + ']') : $element.find('message');
            }

            this.showMessage = function (name) {
                getMessage(name).removeClass('ng-hide');
            };

            this.hideMessage = function (name) {
                getMessage(name).addClass('ng-hide');
            };
        }]
    }
}]);