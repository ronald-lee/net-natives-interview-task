angular
    .module('app')
    .controller('ContactDetailController', ['$scope', '$state', 'ContactsService', 'contact', ContactDetailController]);

/**
 * ContactsDetailController
 * Controls the link between ContactsService and associated templates.
 * @author Ronald Lee <ronald@ronaldlee.co.uk>
 * @param {*} $scope
 * @param {*} $state
 * @param {*} ContactsService
 * @param {*} contact
 */
function ContactDetailController($scope, $state, ContactsService, contact) {

    // Define the view model
    var vm = this;
    vm.contact = contact;
    vm.delete = remove;
    vm.save = save;
    vm.update = update;

    /**
     * Removes the current contact from the server
     */
    function remove() {
        vm.contact.$remove({ id: vm.contact.id }, function (response) {
            $state.go('contact.query');
        })
    }

    /**
     * Saves the current or new contact information
     */
    function save() {
        if (vm.contact.id) {
            return vm.update();
        } else {
            vm.contact.$save(function (response) {
                $state.go('contact.query');
            });
        }
    }

    /**
     * Updates the current contact information
     */
    function update() {
        vm.contact.$update({ id: vm.contact.id }, function (response) {
            $state.go('contact.query');
        });
    }
}