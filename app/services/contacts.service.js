angular
    .module('app')
    .factory('ContactsService', ['$resource', ContactsService]);

/**
 * ContactsService
 * @author Ronald Lee <ronald@ronaldlee.co.uk>
 * @return $resource
*/
function ContactsService($resource) {
    // Wrap the API service calls using $resource from ngResource
    return $resource('api/public/contact/:id', { id: '@_id' }, {
        query: {
            method: 'GET',
            url: 'api/public/contacts',
        },
        update: {
            method: 'PUT'
        }
    });
}