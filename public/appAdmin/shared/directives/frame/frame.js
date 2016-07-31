angular.module("applicationAdminModule").directive('frame', function () {
    return {
        restrict: 'A', //This menas that it will be used as an attribute and NOT as an element. I don't like creating custom HTML elements
        replace: true,
        templateUrl: "/appAdmin/shared/directives/frame/frameView.html",
        controller: ['$scope', '$state', '$auth', 'navigationUrlRepository', 'helperService', function ($scope, $state, $auth, navigationUrlRepository, helperService) {

                $scope.currentView = '';

                $scope.logout = function () {
                    $auth.logout();
                    $state.go('login', {});
                };

                var activateView = function (viewName) {

                    $scope.currentView = viewName;
                };

                $scope.isActive = function (viewName) {

                    return $scope.currentView == viewName;
                };

                $scope.isAuthenticated = function () {

                    return $auth.isAuthenticated();
                };


                $scope.$on('activateViewEvent', function (event, args) {
                    activateView(args.view);
                });

                $scope.$on('activateMenuEvent', function (event, args) {
                    activateMenu();
                });

                var activateMenu = function () {
                    if ($auth.isAuthenticated()) {
                        getAdminUrls();
                    }
                };

                var getAdminUrls = function () {
                    navigationUrlRepository.getAdminUrls().then(
                            function (response) {
                                $scope.adminUrls = response;
                            },
                            function (response) {

                                helperService.handlerError(response);
                            }
                    );
                };
                
                activateMenu();
            }]
    };
});