angular
    .module('app')
    .config(['$urlRouterProvider', '$httpProvider', '$stateProvider', function ($urlRouterProvider, $httpProvider, $stateProvider) {
        $urlRouterProvider.otherwise('/');
        $httpProvider.interceptors.push(['$q', '$state', '$localStorage', function ($q, $state, $localStorage) {
            return {
                request: function (config) {
                    config.headers = config.headers || {};
                    if ($localStorage.token !== null) {
                        // Add the JWT token to the Authorization header.
                        config.headers.Authorization = 'Bearer ' + $localStorage.token;
                    }
                    return config;
                },
                responseError: function (response) {
                    if (response.status === 401 || response.status == 403) {
                        // If the API server responds with 401 or 403 status, redirect the user to the login page.
                        $state.go('login');
                    }
                    return $q.reject(response);
                }
            }
        }]);
        $stateProvider
            // Home page
            .state('home', {
                url: '/?q',
                templateUrl: 'app/home/home.html',
                controller: 'HomeController as vm',
                resolve: {
                    contacts: ['$stateParams', 'ContactsService', function ($stateParams, ContactsService) {
                        return ContactsService.query($stateParams).$promise;
                    }]
                }
            })
            // Login page
            .state('login', {
                url: '/login',
                templateUrl: 'app/authentication/login.html',
                controller: 'AuthenticationController as vm',
            })
            // Logout page
            .state('logout', {
                url: '/logout',
                templateUrl: 'app/authentication/login.html',
                controller: 'AuthenticationController as vm',
            })
            // Contact page group
            .state('contact', {
                abstract: true,
                url: '/contact',
            })
            // Contact query and search page
            .state('contact.query', {
                url: 's?q',
                templateUrl: 'app/contacts/contacts.html',
                controller: 'ContactsController as vm',
                resolve: {
                    contacts: ['$stateParams', 'ContactsService', function ($stateParams, ContactsService) {
                        return ContactsService.query($stateParams).$promise;
                    }]
                }
            })
            // Contact detail page
            .state('contact.show', {
                url: '/{id:int}',
                templateUrl: 'app/contacts/contact-detail.html',
                controller: 'ContactDetailController as vm',
                resolve: {
                    contact: ['$state', '$stateParams', 'ContactsService', function ($state, $stateParams, ContactsService) {
                        return ContactsService.get($stateParams).$promise;
                    }]
                }
            })
            // New contact page
            .state('contact.new', {
                url: '/new',
                templateUrl: 'app/contacts/contact-detail.html',
                controller: 'ContactDetailController as vm',
                resolve: {
                    contact: ['ContactsService', function (ContactsService) {
                        return new ContactsService();
                    }]
                }
            });
    }])
