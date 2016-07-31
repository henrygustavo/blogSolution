angular.module("applicationAdminModule").factory('commonRepository', function ($http, $q, GlobalInfo) {
    return {
        getStates: function () {
            var deferred = $q.defer();
            $http.get(GlobalInfo.apiUrl + '/common/getStates')
                    .success(function (response) {
                        deferred.resolve(response);
                    })
                    .error(function (response) {
                        deferred.reject(response);
                    });

            return deferred.promise;
        },
        getConfiguration: function (idConfiguration) {
            var deferred = $q.defer();
            $http.get(GlobalInfo.apiUrl + '/common/getConfiguration/' + idConfiguration)
                    .success(function (response) {
                        deferred.resolve(response);
                    })
                    .error(function (response) {
                        deferred.reject(response);
                    });

            return deferred.promise;
        },
        getImageFolders: function () {
            var deferred = $q.defer();
            $http.get(GlobalInfo.apiUrl + '/getImageFolders')
                    .success(function (response) {
                        deferred.resolve(response);
                    })
                    .error(function (response) {
                        deferred.reject(response);
                    });

            return deferred.promise;
        },
        getFileFolders: function () {
            var deferred = $q.defer();
            $http.get(GlobalInfo.apiUrl + '/getFileFolders')
                    .success(function (response) {
                        deferred.resolve(response);
                    })
                    .error(function (response) {
                        deferred.reject(response);
                    });

            return deferred.promise;
        },
        getFiles: function (folderId) {
            var deferred = $q.defer();
            $http.get(GlobalInfo.apiUrl + '/getFiles/' + folderId)
                    .success(function (response) {
                        deferred.resolve(response);
                    })
                    .error(function (response) {
                        deferred.reject(response);
                    });

            return deferred.promise;
        },
        getImages: function (folderId) {
            var deferred = $q.defer();
            $http.get(GlobalInfo.apiUrl + '/getImages/' + folderId)
                    .success(function (response) {
                        deferred.resolve(response);
                    })
                    .error(function (response) {
                        deferred.reject(response);
                    });

            return deferred.promise;
        },
         getImageProfile: function () {
            var deferred = $q.defer();
            $http.get(GlobalInfo.apiUrl + '/getImageProfile/')
                    .success(function (response) {
                        deferred.resolve(response);
                    })
                    .error(function (response) {
                        deferred.reject(response);
                    });

            return deferred.promise;
        },
        getIcons: function () {
            var deferred = $q.defer();
            $http.get('/appAdmin/shared/data/icons.json')
                    .success(function (response) {
                        deferred.resolve(response);
                    })
                    .error(function (response) {
                        deferred.reject(response);
                    });

            return deferred.promise;
        },
    };
});