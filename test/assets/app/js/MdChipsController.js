app.controller('MdChipsController', function($scope, $resource) {
    $scope.MdChipsForm = {
        words: [],
        vegetables: []
    };

    var Vegetable = $resource('site/vegetables');
    $scope.searchVegetable = function(searchText) {
        return Vegetable.query().$promise;
    };

    $scope.submit = function(data) {
        console.log(data);
    };
});