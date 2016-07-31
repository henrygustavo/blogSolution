angular.module("applicationAdminModule").controller("personalInformationEditController", function (id, $scope, $state, helperService, personalInformationRepository, commonRepository) {

    helperService.activateView('personalInformation');

    $scope.model = {};
    $scope.model.id = id;
    $scope.model.photoId ='';
    
    $scope.save = function (model) {

        personalInformationRepository.save(model).then(
                function (response) {
                    helperService.showAlert(response, "success");
                    $state.go('personalInformationList');
                },
                function (response) {
                    helperService.handlerError(response);
                }
        );
    };

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

 var getImageProfile = function () {

        commonRepository.getImageProfile().then(
                function (response) {

                    if(response != undefined && response.length > 0){  
                    $scope.model.photoId = response[0].path;
                    }
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
        }
        
        getImageProfile();
    };

    initialLoad();
});