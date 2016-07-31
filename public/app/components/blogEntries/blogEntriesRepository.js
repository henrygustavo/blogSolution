angular.module("applicationModule").factory('blogEntriesRepository', function ($http, $q, GlobalInfo) {
    return {
        getAll: function (params) {
            var deferred = $q.defer();
            $http.get(GlobalInfo.apiUrl + '/blogEntries/', {params: params})
                    .success(function (response) {
                        deferred.resolve(response);
                    })
                    .error(function (response) {
                        deferred.reject(response);
                    });

            return deferred.promise;
        },
        getModel: function (id) {
            var deferred = $q.defer();

            $http.get(GlobalInfo.apiUrl + '/blogEntries/' + id)
                    .success(function (response) {
                        deferred.resolve(response);
                    })
                    .error(function (response) {
                        deferred.reject(response);
                    });

            return deferred.promise;
        },
        getBlogEntries: function (headerUrl) {
            var deferred = $q.defer();

            $http.get(GlobalInfo.apiUrl + '/getBlogEntries/' + headerUrl)
                    .success(function (response) {
                        deferred.resolve(response);
                    })
                    .error(function (response) {
                        deferred.reject(response);
                    });

            return deferred.promise;
        },
        addComment: function (model) {
            var deferred = $q.defer();

            $http.post(GlobalInfo.apiUrl + '/addBlogEntriesComment', model)
                    .success(function (response) {
                        deferred.resolve(response);
                    })
                    .error(function (response) {
                        deferred.reject(response);
                    });

            return deferred.promise;
        },
        getBlogEntriesComments: function (id) {
            var deferred = $q.defer();

            $http.get(GlobalInfo.apiUrl + '/getBlogEntriesComments/' + id)
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