app.controller('FormController', function($scope, $http) {
    /** @var {Object} $scope.TestForm */
    /** @var {Object} $scope.TestForm.values */

    $scope.submit = function() {
        console.log($scope.TestForm.data);
        $http.post('/widgets/form', $scope.TestForm.data).then(function(response) {
            console.log('response', response);
        }, function(error) {
            console.log('error', error);
            /*$scope.TestForm.addErrors({
                name: 'Bestemmia.'
            });*/
        });


    };
});