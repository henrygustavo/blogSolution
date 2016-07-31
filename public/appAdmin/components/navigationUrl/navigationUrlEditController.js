angular.module("applicationAdminModule").controller("navigationUrlEditController", function (id, $scope, $state, helperService, navigationUrlRepository, commonRepository) {

    helperService.activateView('navigationUrl');

    $scope.model = {};
    $scope.model.id = id;
    $scope.model.isAdmin = false;

    $scope.save = function (model) {

        navigationUrlRepository.save(model).then(
                function (response) {
                    helperService.showAlert(response, "success");
                    $state.go('navigationUrlList');
                },
                function (response) {
                    helperService.handlerError(response);
                }
        );
    };

    $scope.selectedIcon = function (selected) {
        if(selected!= undefined){
           $scope.model.icon = selected.title;
       }
    };

    var getModel = function (modelId) {
        navigationUrlRepository.getModel(modelId).then(
                function (response) {
                    $scope.model = response;
                    $scope.model.isAdmin = (response.isAdmin == "1");
                    getStates(response.state.toString());
                    getIcons(response.icon);
                },
                function (response) {
                    helperService.handlerError(response);
                }
        );
    };

    var getStates = function (value) {

        commonRepository.getStates().then(
                function (response) {
                    $scope.states = response;
                    $scope.model.state = value;
                },
                function (response) {

                    helperService.handlerError(response);
                }
        );
    };

    var getIcons = function (value) {

        commonRepository.getIcons().then(
                function (response) {
                    $scope.icons = response;
                    $scope.model.icon = value;
                },
                function (response) {

                    helperService.handlerError(response);
                }
        );
    };
    var initialLoad = function () {

        if (id != 0) {
            getModel(id);
        } else {
            getStates("0");
            getIcons("");
        }
    };

    initialLoad();
});