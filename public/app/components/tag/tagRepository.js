angular.module("applicationModule").factory('tagRepository', function ($http, $q, GlobalInfo) {
    return {
        getTags: function () {
            var deferred = $q.defer();

            $http.get(GlobalInfo.apiUrl + '/tag')
                .success(function (response) {
                    deferred.resolve(response);
                })
                .error(function (response) {
                    deferred.reject(response);
                });

            return deferred.promise;
        },
        getTagsByBlogEntriesId: function (id) {
            var deferred = $q.defer();

            $http.get(GlobalInfo.apiUrl + '/getTagsByBlogEntriesId/'+id)
                .success(function (response) {
                    deferred.resolve(response);
                })
                .error(function (response) {
                    deferred.reject(response);
                });

            return deferred.promise;
        }
    };
});