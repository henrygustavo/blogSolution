angular.module("applicationAdminModule").controller("navigationUrlListController", function ($scope, navigationUrlService,helperService) {

    helperService.activateView('navigationUrl');

    navigationUrlService.iniData();
    navigationUrlService.find();
    $scope.data = navigationUrlService.data;

    $scope.search = function (model) {


    };

    $scope.$watch('data.sortOptions.fields', function (newVal, oldVal) {

        if (newVal.length > 0 && newVal != oldVal) {
            $scope.data.pagingOptions.currentPage = 1;
            navigationUrlService.find();
        }
    }, true);

    $scope.$watch('data.sortOptions.directions', function (newVal, oldVal) {

        if (newVal.length > 0 && newVal != oldVal) {
            $scope.data.pagingOptions.currentPage = 1;
            navigationUrlService.find();
        }
    }, true);

    $scope.$watch('data.pagingOptions', function (newVal, oldVal) {
        if (newVal != oldVal) {
            navigationUrlService.find();
        }
    }, true);

    var rowTemplate = '<div class="ngCellText" style="text-align:center"><a href="#/navigationUrl/edit/{{row.entity.id}}" class="btn btn-xs btn-info" style="font-size:15px;margin-right:10px"><i class="glyphicon glyphicon-pencil"></i></a><a href="#/navigationUrl/detail/{{row.entity.id}}" class="btn btn-xs btn-warning" style="font-size:15px"><i class="glyphicon glyphicon-eye-open"></i></a></div>';

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
            {field: 'name', displayName: 'Name', width: '600'},
            {field: 'edit', displayName: '', width: '120', sortable: false, cellTemplate: rowTemplate}
        ]
    };
});