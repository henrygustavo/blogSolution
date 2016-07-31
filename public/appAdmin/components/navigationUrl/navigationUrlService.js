angular.module("applicationAdminModule").factory('navigationUrlService', function (navigationUrlRepository, helperService) {

    var service = {
        iniData: function () {
            var data = {
                currententity: {},
                entities: [],
                selected: [],
                totalPages: 0,
                filterOptions: {
                    filterText: {},
                    externalFilter: '',
                    useExternalFilter: true
                },
                sortOptions: {
                    fields: ["id"],
                    directions: ["desc"]
                },
                pagingOptions: {
                    pageSizes: [10, 20, 50, 100],
                    pageSize: "10",
                    currentPage: 1
                }
            };

            service.data = data;
        },
        find: function () {
            var params = {
                filterObj: JSON.stringify(service.data.filterOptions.filterText),
                page: service.data.pagingOptions.currentPage,
                pageSize: service.data.pagingOptions.pageSize,
                sortBy: service.data.sortOptions.fields[0],
                sortDirection: service.data.sortOptions.directions[0]
            };

            navigationUrlRepository.getAll(params).then(
                    function (response) {
                        service.data.entities = response;
                    },
                    function (response) {

                        helperService.handlerError(response);
                    }
            );
        }
    };
    return service;

});