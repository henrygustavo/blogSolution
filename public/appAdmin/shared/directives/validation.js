angular.module("applicationAdminModule").directive("ngMatch", function () {
    return {
        require: "ngModel",
        scope: {
            otherModelValue: "=ngMatch"
        },
        link: function (scope, element, attributes, ngModel) {

            ngModel.$validators.ngMatch = function (modelValue) {
                return modelValue == scope.otherModelValue;
            };

            scope.$watch("otherModelValue", function () {
                ngModel.$validate();
            });
        }
    };
})
        .directive('ngNumbersOnly', function () {
            return {
                require: 'ngModel',
                link: function (scope, element, attr, ngModelCtrl) {
                    function fromUser(text) {
                        if (text) {
                            var transformedInput = text.replace(/[^0-9]/g, '');

                            if (transformedInput !== text) {
                                ngModelCtrl.$setViewValue(transformedInput);
                                ngModelCtrl.$render();
                                ngModelCtrl.$setValidity('ngNumbersOnly', false);
                            } else {
                                ngModelCtrl.$setValidity('ngNumbersOnly', true);

                            }
                            return transformedInput;
                        }
                        return undefined;
                    }
                    ngModelCtrl.$parsers.push(fromUser);
                }
            };
        })
        .directive('ngRequiredSelect', function () {
            return {
                require: 'ngModel',
                link: function (scope, elm, attr, ctrl) {

                    if (!ctrl)
                        return;
                    attr.requiredSelect = true; // force truthy in case we are on non input element

                    var validator = function (value) {
                        if (attr.requiredSelect && (ctrl.$isEmpty(value) || value == "0")) {
                            ctrl.$setValidity('ngRequiredSelect', false);
                            return value;
                        } else {
                            ctrl.$setValidity('ngRequiredSelect', true);
                            return value;
                        }
                    };

                    ctrl.$formatters.push(validator);
                    ctrl.$parsers.unshift(validator);

                    attr.$observe('ngRequiredSelect', function () {
                        validator(ctrl.$viewValue);
                    });
                }
            };
        })
        .directive('ngDirectiveIf', ['$compile', function ($compile) {

                // Error handling.
                var compileGuard = 0;
                // End of error handling.

                return {
                    // Set a high priority so we run before other directives.
                    priority: 100,
                    // Set terminal to true to stop other directives from running.
                    terminal: true,
                    compile: function () {
                        return {
                            pre: function (scope, element, attr) {

                                // Error handling.
                                // 
                                // Make sure we don't go into an infinite 
                                // compile loop if something goes wrong.
                                compileGuard++;
                                if (compileGuard >= 10) {
                                    console.log('ngDirectiveIf: infinite compile loop!');
                                    return;
                                }
                                // End of error handling.

                                // Get the set of directives to apply.
                                var directives = scope.$eval(attr.ngDirectiveIf);
                                angular.forEach(directives, function (expr, directive) {
                                    // Evaluate each directive expression and remove
                                    // the directive attribute if the expression evaluates
                                    // to `false`.
                                    var result = scope.$eval(expr);
                                    if (result === false) {
                                        // Set the attribute to `null` to remove the attribute.
                                        // 
                                        // See: https://docs.angularjs.org/api/ng/type/$compile.directive.Attributes#$set
                                        attr.$set(directive, null);
                                    }
                                });

                                // Remove our own directive before compiling
                                // to avoid infinite compile loops.
                                attr.$set('ngDirectiveIf', null);

                                // Recompile the element so the remaining directives
                                // can be invoked.
                                var result = $compile(element)(scope);

                                // Error handling.
                                // 
                                // Reset the compileGuard after compilation
                                // (otherwise we can't use this directive multiple times).
                                // 
                                // It should be safe to reset here because we will
                                // only reach this code *after* the `$compile()`
                                // call above has returned.
                                compileGuard = 0;
                            }
                        };

                    }
                };
            }]);
;