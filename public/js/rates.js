(function(){

    var app = angular.module('AntVel'); //references to AntVel module

    var rates = angular.module('store-rate', [ ]); //create the home page module

    app.requires.push('store-rate'); //then push a new requirement to AntVel modules

    /**
     * Controllers
     */
    //rates.controller('ProductsRate', ['$scope', function($scope)
    //{
    //    $scope.rateSeller = function(seller_id){
    //        alert('es un seller');
    //        return true;
    //    };
    //}]);

    app.filter('dateToISO', function() {
        return function(input) {
            input = new Date(input).toISOString();
            return input;
        };
    });

})();