angular
    .module('app')
    .controller('ApplicationController', ['$scope', '$state', '$stateParams', '$http', '$localStorage', 'AuthenticationService', 'ContactsService', ApplicationController]);

function ApplicationController($scope, $state, $stateParams, $http, $localStorage, AuthenticationService, ContactsService) {
    
    $localStorage.currentUser = $localStorage.currentUser || null;
    $localStorage.token = $localStorage.token || null;

    $scope.$localStorage = $localStorage;
    $scope.$state = $state;
    $scope.$stateParams = $stateParams;
    $scope.reset = reset;
    $scope.search = search;

    function reset() {
        $http.post('api/public/artisan/db-seed').then(success, error);
        function success(response) {
            $state.reload();
        }
        function error(response) {
            //
        }
    }

    function search() {
        $state.go($state.current.name, $scope.$stateParams);
    }

}