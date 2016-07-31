angular.module("applicationModule").factory('navigationUrlRepository', function ($http, $q, GlobalInfo) {
    return {
       
        getPublicUrls: function () {
            var deferred = $q.defer();

            $http.get(GlobalInfo.apiUrl + '/getPublicUrls')
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