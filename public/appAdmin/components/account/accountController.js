angular.module("applicationAdminModule").controller("accountController", function ($scope, $rootScope, $state, $auth, helperService, accountRepository, GlobalInfo, $location,authManager) {
    
    $scope.login = function (model) {

        $auth.login(model).then(function(data) {

                $state.go('home', {});
                helperService.activateMenu();
        }).catch(helperService.handlerError);
    };

    $scope.authenticate = function (provider) {

       
    };
    
    $scope.changePassowrd = function (model) {

  
    };

    $scope.forgotPassword = function (model) {

       
    };
});