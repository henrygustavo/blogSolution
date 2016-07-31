angular.module("applicationAdminModule").controller('homeController', function ($location, $state, homeRepository,helperService) {

    helperService.activateView('home'); 
});
