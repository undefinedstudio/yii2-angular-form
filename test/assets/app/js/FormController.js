app.controller('FormController', function($scope, $http) {
    /** @var {Object} $scope.TestForm */
    /** @var {Object} $scope.TestForm.values */

    $scope.submit = function() {
        console.log($scope.TestForm.data);
        $http.post('/widgets/form', $scope.TestForm.data).then(function(response) {
            console.log('Success: ', response.data);
        }, function(response) {
            console.log('Error: ', response.data);
            $scope.TestForm.addErrors(response.data.errors);
        });


    };
});