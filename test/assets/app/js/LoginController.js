app.controller('LoginController', function($scope, $http) {
    /** @var {Object] $scope.LoginForm */
    /** @var {Object] $scope.LoginForm.$data */

    $scope.login = function() {
        console.log($scope.LoginForm.$data);
        $http.post('form/login', $scope.LoginForm.$data).then(function(response) {
            console.log('Login response: ', response.data);
        });
    };
});