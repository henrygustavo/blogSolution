angular.module("applicationAdminModule").controller("blogEntriesEditController", function (id, $scope, $state, helperService, blogEntriesRepository, commonRepository, tagRepository, Lightbox) {

    helperService.activateView('blogEntries');
    
    $scope.model = {};
    $scope.model.id = id;
    $scope.model.author = "admin";
    $scope.model.tags = [];
    $scope.tagsList = [];
    $scope.currentImageFolder = '';
    $scope.currentFileFolder = '';

    $scope.isActive = function (headerName, type) {

        switch (type) {
            case "I":
                return $scope.currentImageFolder == headerName;
                break;
            case "F":
                return $scope.currentFileFolder == headerName;
                break;
        }
    }

    $scope.loadTags = function (query) {

        return $scope.tagsList.filter(function (tag) {
            return tag.text.toLowerCase().indexOf(query.toLowerCase()) != -1;
        });
    };

    $scope.openLightboxModal = function (imagenes, index) {
        Lightbox.openModal(imagenes, index);
    };

    $scope.save = function (model) {

        blogEntriesRepository.save(model).then(
                function (response) {
                    helperService.showAlert(response, "success");
                    $state.go('blogEntriesList');
                },
                function (response) {
                    helperService.handlerError(response);
                }
        );
    };

    $scope.getFiles = function (idFolder) {
        $scope.currentFileFolder = idFolder;
        commonRepository.getFiles(idFolder).then(
                function (response) {

                    $scope.files = response;
                },
                function (response) {
                    helperService.handlerError(response);
                }
        );
    };

    $scope.getImages = function (idFolder) {
        $scope.currentImageFolder = idFolder;
        commonRepository.getImages(idFolder).then(
                function (response) {

                    $scope.images = response;
                },
                function (response) {
                    helperService.handlerError(response);
                }
        );
    };

    var getImageFolders = function () {

        commonRepository.getImageFolders().then(
                function (response) {

                    $scope.imageFolders = response;
                },
                function (response) {
                    helperService.handlerError(response);
                }
        );
    };

    var getFileFolders = function () {

        commonRepository.getFileFolders().then(
                function (response) {

                    $scope.fileFolders = response;
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

    var getModel = function (modelId) {
        blogEntriesRepository.getModel(modelId).then(
                function (response) {
                    $scope.model = response;
                    getStates(response.state.toString());
                    getTagsByBlogEntriesId($scope.model.id);
                },
                function (response) {
                    helperService.handlerError(response);
                }
        );
    };

    var getTags = function () {

        tagRepository.getTags().then(
                function (response) {

                    $scope.tagsList = response;
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
    };

    var initialLoad = function () {

        getTags();
        if (id != 0) {
            getModel(id);
        } else {
            getStates("0");

        }

        getImageFolders();
        getFileFolders();
    };

    initialLoad();
});