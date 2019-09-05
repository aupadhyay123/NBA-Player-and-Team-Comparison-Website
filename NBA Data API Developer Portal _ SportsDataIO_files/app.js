(function () {
    var app = angular
        .module('fantasydata', ['kendo.directives', 'matchMedia', 'dibari.angular-ellipsis'])
        .config(['$locationProvider', function ($locationProvider) {
            $locationProvider.html5Mode(false);
            $locationProvider.hashPrefix('');
            //$locationProvider.hashPrefix('');
        }]);
}());