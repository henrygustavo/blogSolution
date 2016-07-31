angular.module("applicationModule").controller('blogEntriesController', function (headerUrl, $scope, blogEntriesRepository, tagRepository, helperService, $state) {

    $scope.model = {};
    $scope.post = {};
    $scope.comments = {};
    $scope.tagsList = [];

    $scope.renderHtml = function (html_code) {
        return helperService.renderHtml(html_code);
    };

    $scope.searchTags = function (searchTag) {

        $state.go('searchTags', {searchTag: searchTag});
    };

    $scope.addComment = function (model) {
        model.blog_entries_id = $scope.post.id;
        model.state = '1';
        blogEntriesRepository.addComment(model).then(
                function (response) {
                    helperService.showAlert(response, "success");
                    getBlogEntriesComments($scope.post.id);
                    $scope.model = {};
                    $scope.form.$setPristine();
                },
                function (response) {
                    helperService.handlerError(response);
                }
        );
    };

    var getModel = function (headerUrl) {
        blogEntriesRepository.getBlogEntries(headerUrl).then(
                function (response) {
                    $scope.post = response;
                    getBlogEntriesComments(response.id);
                    getTagsByBlogEntriesId(response.id);
                },
                function (response) {
                    helperService.handlerError(response);
                }
        );
    };

    var getBlogEntriesComments = function (id) {
        blogEntriesRepository.getBlogEntriesComments(id).then(
                function (response) {
                    $scope.comments = response;
                },
                function (response) {
                    helperService.handlerError(response);
                }
        );
    };

    var getTagsByBlogEntriesId = function (id) {

        tagRepository.getTagsByBlogEntriesId(id).then(
                function (response) {

                    $scope.tagsList = response;
                },
                function (response) {
                    helperService.handlerError(response);
                }
        );
    };

    var initialLoad = function () {

        getModel(headerUrl);
    };

    initialLoad();

});
