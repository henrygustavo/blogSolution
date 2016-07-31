angular.module("applicationModule").directive('header', function () {
    return {
        restrict: 'A', //This menas that it will be used as an attribute and NOT as an element. I don't like creating custom HTML elements
        replace: true,
        templateUrl: "/app/shared/directives/header/headerView.html",
        controller: ['$scope', '$filter', 'personalInformationRepository', 'navigationUrlRepository', 'helperService', function ($scope, $filter, personalInformationRepository, navigationUrlRepository, helperService) {

                $scope.model = {};
                $scope.publicUrls = {};
                $scope.currentView = '';
                
                var activateView = function (viewName) {

                    $scope.currentView = viewName;
                };
                
                $scope.isActive = function (viewName) {

                    return $scope.currentView == viewName;
                };
                
                $scope.$on('activateViewEvent', function (event, args) {
                    activateView(args.view);
                });
                
                $scope.hasSocialNetwork = function () {

                    return $scope.model.faceBook != null || $scope.model.googlePlus != null || $scope.model.twitter != null;
                };

                var getPersonalInformation = function () {

                    personalInformationRepository.getPersonalInformation().then(
                            function (response) {

                                $scope.model = response;
                            },
                            function (response) {
                                helperService.handlerError(response);
                            }
                    );
                };

                var getPublicUrls = function () {
                    navigationUrlRepository.getPublicUrls().then(
                            function (response) {
                                $scope.publicUrls = response;
                            },
                            function (response) {

                                helperService.handlerError(response);
                            }
                    );
                };

                getPersonalInformation();
                getPublicUrls();
            }]
    };
});