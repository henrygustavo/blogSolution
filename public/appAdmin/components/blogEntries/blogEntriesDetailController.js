angular.module("applicationAdminModule").controller("blogEntriesDetailController", function (id, $scope, helperService, blogEntriesRepository, commonRepository, tagRepository) {

    helperService.activateView('blogEntries');
    
    $scope.model = {};
    $scope.model.id = id;
    $scope.model.tags = [];

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
    var getModel = function (modelId) {

        blogEntriesRepository.getModel(modelId).then(
                function (response) {
                    $scope.model = response;
                    getConfiguration(response.state);
                    getTagsByBlogEntriesId(response.id);
                },
                function (response) {
                    helperService.handlerError(response);
                }
        );
    };

    var getTagsByBlogEntriesId = function (modelId) {

        tagRepository.getTagsByBlogEntriesId(modelId).then(
                function (response) {

                    $scope.model.tags = response;

                },
                function (response) {
                    helperService.handlerError(response);
                }
        );
    }

    var initialLoad = function () {
        getModel(id);
    };

    initialLoad();
});