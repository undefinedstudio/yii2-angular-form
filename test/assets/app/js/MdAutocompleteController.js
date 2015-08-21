app.controller('MdAutocompleteController', function($scope, $resource) {
    $scope.searchFruit = function(searchText) {
        return [
            {name: 'Banana', color: 'Yellow'},
            {name: 'Apple', color: 'Red, green or yellow'},
            {name: 'Strawberry', color: 'Red'},
            {name: 'Melon', color: 'Orange'}
        ];
    };

    var Vegetable = $resource('site/vegetables');
    $scope.searchVegetable = function(searchText) {
        return Vegetable.query().$promise;
    };

    $scope.submit = function(data) {
        console.log(data);
    };
});