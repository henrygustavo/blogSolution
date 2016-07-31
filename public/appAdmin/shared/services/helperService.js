angular.module("applicationAdminModule").factory('helperService', function ($rootScope, $timeout, $sce) {
    toastr.options = {"positionClass": "toast-top-center"};

    var activateViewFn = function (view) {

        $rootScope.$broadcast('activateViewEvent', {view: view});
    };
    
    var activateMenuFn = function () {

        $rootScope.$broadcast('activateMenuEvent', {});
    };

    var getErrorMessages = function (errorResponse) {

        if (errorResponse === null)
            return "error";

        var errorMessage = '';

        if (errorResponse.statusText !== undefined)
            errorMessage += errorResponse.statusText + "<br/>";

        if (errorResponse.message !== undefined)
            errorMessage += errorResponse.message + "<br/>";

        if (errorResponse.exceptionMessage !== undefined)
            errorMessage += errorResponse.exceptionMessage + "<br/>";

        if (errorResponse.error !== undefined)
            errorMessage += errorResponse.error + "<br/>";

        if (errorResponse.validationError !== undefined) {

            for (var keymodel in errorResponse.validationError) {
                for (var j = 0; j < errorResponse.validationError[keymodel].length; j++) {
                    errorMessage += errorResponse.validationError[keymodel][j] + "<br/>";
                }
            }
        }

        if (errorResponse.data !== undefined) {

            if (errorResponse.data.validationError !== undefined)
                for (var keymodel in errorResponse.data.validationError) {
                    for (var j = 0; j < errorResponse.data.validationError[keymodel].length; j++) {
                        errorMessage += errorResponse.data.validationError[keymodel][j] + "<br/>";
                    }
                }
        }

        if (errorMessage === "") {

            if (errorResponse.length > 0) {
                errorMessage = errorResponse;
            } else {
                errorMessage = "Please,try again later...";
            }
        }

        return errorMessage;
    };

    return {
        handlerError: function (err) {
            toastr.error(getErrorMessages(err));
        },
        showAlert: function (message, className) {

            switch (className.toLowerCase()) {
                case "error":
                    toastr.error(message);
                    break;
                case "success":
                    toastr.success(message);
                    break;
                case "info":
                    toastr.info(message);
                    break;
                case "warning":
                    toastr.warning(message);
                    break;
            }
        },
        activateView: function (view) {

            $timeout(function () {
                activateViewFn(view);
            }, 300);
        },
        activateMenu: function () {

            $timeout(function () {
                activateMenuFn();
            }, 300);
        },
        renderHtml: function (html_code) {
            return $sce.trustAsHtml(html_code);
        }
    };
});