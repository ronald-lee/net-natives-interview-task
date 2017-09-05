angular
    .module('app')
    .controller('ContactsController', ['$scope', 'ContactsService', 'contacts', ContactsController])

/**
 * ContactsController
 * @author Ronald Lee <ronald@ronaldlee.co.uk>
 * @param {*} $scope
 * @param {*} ContactsService 
 * @param {*} contacts 
 */
function ContactsController($scope, ContactsService, contacts) {

    // Define the controller methods
    $scope.delete = remove;

    // Define the view model
    var vm = this;
    vm.contacts = contacts;

    /**
     * Removes the specified contact from the server
     */
    function remove(contact) {
        contact.$delete({ id: contact.id }, function (data) {
            vm.contacts = ContactsService.query();
        });
    };
}

