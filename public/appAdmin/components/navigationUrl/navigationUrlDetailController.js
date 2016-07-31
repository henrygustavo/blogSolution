angular.module("applicationAdminModule").controller("navigationUrlDetailController", function (id, $scope, helperService, navigationUrlRepository, commonRepository, tagRepository) {

    helperService.activateView('navigationUrl');
    
    $scope.model = {};
    $scope.model.id = id;

    var getModel = function (modelId) {

        navigationUrlRepository.getModel(modelId).then(
                function (response) {
                    $scope.model = response;
                    $scope.model.isAdmin = (response.isAdmin == "1");
                    getConfiguration(response.state);
                },
                function (response) {
                    helperService.handlerError(response);
                }
        );
    };

    var getConfiguration = function (idConfiguration) {
        commonRepository.getConfiguration(idConfiguration).then(
                function (response) {
                    $scope.model.stateName = response.name;
                },
                function (response) {
                    helperService.handlerError(response);
                }
        );
    };
    
    var initialLoad = function () {
        getModel(id);
    };

    initialLoad();
});