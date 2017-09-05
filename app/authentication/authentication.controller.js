angular
    .module('app')
    .controller('AuthenticationController', ['$scope', '$state', 'AuthenticationService', AuthenticationController]);

/**
 * AuthenticationController
 * @author Ronald Lee <ronald@ronaldlee.co.uk>
 * @param {*} $scope
 * @param {*} $state
 * @param {*} AuthenticationService
 */
function AuthenticationController($scope, $state, AuthenticationService) {

    // Define the view model
    var vm = this;
    vm.credentials = {};
    vm.credentials.email = 'test@example.com';
    vm.credentials.password = 'test';
    vm.submit = submit;

    // Always invalidate the current user if exists
    if (AuthenticationService.isAuthenticated() === true) {
        AuthenticationService.invalidate();
        $state.go('home');
    }
    
    /**
     * Submits the user credentials to the server for authentication.
     * TODO: Provide mechanism to redirect the user to a specified page, such as the original request that required the authentication.
     */
    function submit() {
        AuthenticationService.authenticate(vm.credentials, function (response) {
            $state.go('home');
        });
    }
}
