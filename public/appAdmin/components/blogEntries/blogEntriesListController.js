angular.module("applicationAdminModule").controller("blogEntriesListController", function ($scope, blogEntriesService,helperService) {

    helperService.activateView('blogEntries');
    
    blogEntriesService.iniData();
    blogEntriesService.find();
    $scope.data = blogEntriesService.data;

    $scope.search = function (model) {

        var header = (model != undefined) ? model.searchHeader : '';

        var filterObj = (model != undefined) ? [{"Field": "header", "Value": header, "Sign": "LIKE"}] : '';

        blogEntriesService.data.filterOptions.filterText = filterObj;

        blogEntriesService.find();
    };

    $scope.$watch('data.sortOptions.fields', function (newVal, oldVal) {

        if (newVal.length > 0 && newVal != oldVal) {
            $scope.data.pagingOptions.currentPage = 1;
            blogEntriesService.find();
        }
    }, true);

    $scope.$watch('data.sortOptions.directions', function (newVal, oldVal) {

        if (newVal.length > 0 && newVal != oldVal) {
            $scope.data.pagingOptions.currentPage = 1;
            blogEntriesService.find();
        }
    }, true);

    $scope.$watch('data.pagingOptions', function (newVal, oldVal) {
        if (newVal != oldVal) {
            blogEntriesService.find();
        }
    }, true);

    var rowTemplate = '<div class="ngCellText" style="text-align:center"><a href="#/blogEntries/edit/{{row.entity.id}}" class="btn btn-xs btn-info" style="font-size:15px;margin-right:10px"><i class="glyphicon glyphicon-pencil"></i></a><a href="#/blogEntries/detail/{{row.entity.id}}" class="btn btn-xs btn-warning" style="font-size:15px"><i class="glyphicon glyphicon-eye-open"></i></a></div>';

    $scope.ngGridView = {
        data: 'data.entities.content',
        showFilter: false,
        multiSelect: false,
        enablePaging: true,
        showFooter: true,
        totalServerItems: 'data.entities.totalRecords',
        pagingOptions: $scope.data.pagingOptions,
        filterOptions: $scope.data.filterOptions,
        useExternalSorting: true,
        enableHighlighting: true,
        sortInfo: $scope.data.sortOptions,
        rowHeight: 50,
        columnDefs: [
            {field: '', displayName: '', width: '70', sortable: false, cellTemplate: '<div class="ngCellText">{{row.rowIndex + 1}}</div>'},
            {field: 'header', displayName: 'Header', width: '600'},
            {field: 'stateName', displayName: 'State', width: '100'},
            {field: 'countComments', displayName: 'Comments', width: '100'},
            {field: 'tags', displayName: 'Tags', width: '100'},
            {field: 'created_at', displayName: 'Date', width: '200', cellFilter: "cmdate:'dd/MM/yyyy'"},
            {field: 'edit', displayName: '', width: '120', sortable: false, cellTemplate: rowTemplate}
        ]
    };
});