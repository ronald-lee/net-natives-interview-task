angular
    .module('app')
    .controller('HomeController', ['$state', 'contacts', HomeController]);

/**
 * HomeController
 * @author Ronald Lee <ronald@ronaldlee.co.uk>
 */
function HomeController($state, contacts) {

    var vm = this;
    vm.contacts = contacts;
    vm.places = [];

}