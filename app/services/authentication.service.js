angular
    .module('app')
    .factory('AuthenticationService', ['$http', '$localStorage', AuthenticationService]);

/**
 * AuthenticationService
 *
 * A basic implementation of authentication using JWT.
 *
 * @author Ronald Lee
 */
function AuthenticationService($http, $localStorage) {
    
    var service = {};
    service.authenticate = authenticate;
    service.getCurrentUser = getCurrentUser;
    service.getToken = getToken;
    service.invalidate = invalidate;
    service.isAuthenticated = isAuthenticated;

    /**
     * Authenticates the user's credentials and sets the token into $localStorage
     * @param {*} credentials 
     * @param {*} successCallback 
     * @param {*} errorCallback 
     */
    function authenticate(credentials, successCallback, errorCallback) {
        $http.post('api/public/authentication', credentials).then(success, error);

        function success(response) {
            $localStorage.token = response.data.token;
            $localStorage.currentUser = service.getCurrentUser();
            successCallback(response);
        }

        function error(response) {
            errorCallback(response);
        }
    }

    /**
     * Getter for the token
     */
    function getToken() {
        return $localStorage.token || null;
    }

    /**
     * Getter for the current user
     */
    function getCurrentUser() {
        if (token = service.getToken()) {
            var encoded = token.split('.')[1];
            var base64 = encoded.replace('-', '+').replace('_', '/');
            var decoded = JSON.parse(window.atob(base64));
            return decoded.public.email;
        }
    }

    /**
     * Invalidates the current token and user
     */
    function invalidate() {
        $localStorage.token = null;
        $localStorage.currentUser = null;
    }

    /**
     * Checks to see if the user is authenticated
     */
    function isAuthenticated() {
        return service.getToken() !== null;
    }

    return service;
}