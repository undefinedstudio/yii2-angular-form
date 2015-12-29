app.controller('FormController', function($scope, $http) {
    /** @var {Object} $scope.TestForm */
    /** @var {Object} $scope.TestForm.values */

    $scope.submit = function() {
        if (!$scope.TestForm.$valid) {
            return;
        }

        console.log('Sending', $scope.TestForm.$data);
        $http.post('form/form', $scope.TestForm.$data).then(function(response) {
            console.log('Success: ', response.data);
        }, function(response) {
            console.log('Error: ', response.data);
            $scope.TestForm.$addErrors(response.data.errors);
        });
    };
});