angular.module("applicationModule").controller('homeController', function (searchText,searchTag, $scope, blogEntriesRepository, helperService) {

    helperService.activateView('home');

    $scope.filter = {};

    $scope.model = {};
    $scope.model.content = [];
    $scope.model.totalRecords = "0";
    $scope.model.currentPage = "1";
    $scope.model.totalPages = "0";

    $scope.renderHtml = function (html_code) {
        return helperService.renderHtml(html_code);
    };

    var getAllBlogEntries = function (filter) {

        $scope.filter.page = (filter.page == undefined) ? "1" : filter.page;
        $scope.filter.pageSize = (filter.pageSize == undefined) ? "5" : filter.pageSize;
        $scope.filter.sortBy = (filter.sortBy == undefined) ? "created_at" : filter.sortBy;
        $scope.filter.sortDirection = (filter.sortDirection == undefined) ? "desc" : filter.sortDirection;
        $scope.filter.searchText = (filter.searchText == undefined) ? "" : filter.searchText;
        $scope.filter.searchTag = (filter.searchTag == undefined) ? "" : filter.searchTag;
        
        $scope.filter.filterObj = (filter.filterObj == undefined) ? 
        
        [   {"Field": "state", "Value": "1", "Sign": "="},
            {"Field": "content", "Value": $scope.filter.searchText, "Sign": "like"},
            {"Field": "tags", "Value": $scope.filter.searchTag, "Sign": "like"}
        ]
        : filter.filterObj;

        var params = {
            page: $scope.filter.page,
            pageSize: $scope.filter.pageSize,
            sortBy: $scope.filter.sortBy,
            sortDirection: $scope.filter.sortDirection,
            filterObj: JSON.stringify($scope.filter.filterObj)
        };

        blogEntriesRepository.getAll(params).then(
                function (response) {

                    $scope.model = response;
                },
                function (response) {
                    helperService.handlerError(response);
                }
        );
    };

    $scope.newerPage = function (movPrevious) {

        $scope.filter.page = movPrevious;
        getAllBlogEntries($scope.filter);
    };

    $scope.olderPage = function (movNext) {
        $scope.filter.page = movNext;

        getAllBlogEntries($scope.filter);
    };

    getAllBlogEntries({page: "1", searchText: searchText,searchTag:searchTag});
});
