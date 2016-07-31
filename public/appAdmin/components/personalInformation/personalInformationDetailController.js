angular.module("applicationAdminModule").controller("personalInformationDetailController", function (id, $scope, helperService, personalInformationRepository) {
    
    helperService.activateView('personalInformation');
    
    $scope.model = {};
    $scope.model.id = id;

    var getModel = function (modelId) {

        personalInformationRepository.getModel(modelId).then(
                function (response) {
                    $scope.model = response;
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