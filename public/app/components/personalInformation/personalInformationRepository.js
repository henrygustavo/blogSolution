angular.module("applicationModule").factory('personalInformationRepository', function ($http, $q, GlobalInfo) {
    return {
        getPersonalInformation: function () {
            var deferred = $q.defer();

            $http.get(GlobalInfo.apiUrl + '/getPersonalInformation')
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