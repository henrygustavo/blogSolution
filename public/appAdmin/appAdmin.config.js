var localHostUrl = window.location.origin || window.location.protocol + '//' + window.location.host;

var applicationModule = angular.module("applicationAdminModule", ['ui.router', 'ngMessages', 'satellizer', 'permission', 'ngRoute', 'blockUI', 'ui.bootstrap', 'ngGrid', 'textAngular', 'bootstrapLightbox', 'ngTagsInput','ui.mask', 'fcsa-number','angucomplete-alt']);

applicationModule.config(function ($urlRouterProvider, $stateProvider, $authProvider, blockUIConfig) {

    blockUIConfig.templateUrl = '/appAdmin/shared/html/block-ui-overlay.html';
    // Satellizer configuration that specifies which API
    // route the JWT should be retrieved from
    $authProvider.loginUrl = '/api/authenticate';

    $urlRouterProvider.otherwise('/');

    $stateProvider
            .state('home', {
                url: '/',
                templateUrl: '/appAdmin/components/home/homeView.html',
                controller: 'homeController',
                data: {
                    permissions: {
                        only: ['login'],
                        redirectTo: 'login'
                    }
                }
            })
            .state('login', {
                url: '/login',
                templateUrl: '/appAdmin/components/account/accountLoginView.html',
                controller: 'accountController'
            })
            .state('blogEntriesList', {
                url: '/blogEntries',
                templateUrl: '/appAdmin/components/blogEntries/blogEntriesListView.html',
                controller: 'blogEntriesListController',
                resolve: {
                    id: function ($stateParams) {
                        return $stateParams.id;
                    }
                },
                data: {
                    permissions: {
                        only: ['admin'],
                        redirectTo: 'login'
                    }
                }
            })
            .state('blogEntriesEdit', {
                url: '/blogEntries/edit/:id',
                templateUrl: '/appAdmin/components/blogEntries/blogEntriesEditView.html',
                controller: 'blogEntriesEditController',
                resolve: {
                    id: function ($stateParams) {
                        return $stateParams.id;
                    }
                },
                data: {
                    permissions: {
                        only: ['admin'],
                        redirectTo: 'login'
                    }
                }
            })
            .state('blogEntriesDetail', {
                url: '/blogEntries/detail/:id',
                templateUrl: '/appAdmin/components/blogEntries/blogEntriesDetailView.html',
                controller: 'blogEntriesDetailController',
                resolve: {
                    id: function ($stateParams) {
                        return $stateParams.id;
                    }
                },
                data: {
                    permissions: {
                        only: ['admin'],
                        redirectTo: 'login'
                    }
                }
            })
            .state('personalInformationList', {
                url: '/personalInformation',
                templateUrl: '/appAdmin/components/personalInformation/personalInformationListView.html',
                controller: 'personalInformationListController',
                resolve: {
                    id: function ($stateParams) {
                        return $stateParams.id;
                    }
                },
                data: {
                    permissions: {
                        only: ['admin'],
                        redirectTo: 'login'
                    }
                }
            })
            .state('personalInformationEdit', {
                url: '/personalInformation/edit/:id',
                templateUrl: '/appAdmin/components/personalInformation/personalInformationEditView.html',
                controller: 'personalInformationEditController',
                resolve: {
                    id: function ($stateParams) {
                        return $stateParams.id;
                    }
                },
                data: {
                    permissions: {
                        only: ['admin'],
                        redirectTo: 'login'
                    }
                }
            })
            .state('personalInformationDetail', {
                url: '/personalInformation/detail/:id',
                templateUrl: '/appAdmin/components/personalInformation/personalInformationDetailView.html',
                controller: 'personalInformationDetailController',
                resolve: {
                    id: function ($stateParams) {
                        return $stateParams.id;
                    }
                },
                data: {
                    permissions: {
                        only: ['admin'],
                        redirectTo: 'login'
                    }
                }
            })
            .state('navigationUrlList', {
                url: '/navigationUrl',
                templateUrl: '/appAdmin/components/navigationUrl/navigationUrlListView.html',
                controller: 'navigationUrlListController',
                resolve: {
                    id: function ($stateParams) {
                        return $stateParams.id;
                    }
                },
                data: {
                    permissions: {
                        only: ['admin'],
                        redirectTo: 'login'
                    }
                }
            })
            .state('navigationUrlEdit', {
                url: '/navigationUrl/edit/:id',
                templateUrl: '/appAdmin/components/navigationUrl/navigationUrlEditView.html',
                controller: 'navigationUrlEditController',
                resolve: {
                    id: function ($stateParams) {
                        return $stateParams.id;
                    }
                },
                data: {
                    permissions: {
                        only: ['admin'],
                        redirectTo: 'login'
                    }
                }
            })
            .state('navigationUrlDetail', {
                url: '/navigationUrl/detail/:id',
                templateUrl: '/appAdmin/components/navigationUrl/navigationUrlDetailView.html',
                controller: 'navigationUrlDetailController',
                resolve: {
                    id: function ($stateParams) {
                        return $stateParams.id;
                    }
                },
                data: {
                    permissions: {
                        only: ['admin'],
                        redirectTo: 'login'
                    }
                }
            })
            ;

    blockUIConfig.message = 'Please wait!';

})
        .constant('GlobalInfo',
                {
                    apiUrl: '/api',
                    localHostUrl: localHostUrl
                }
        )
        .run(function (Permission, authManager) {
            // Define anonymous role
            Permission.defineRole('admin', function (stateParams) {
                return authManager.isInRole("admin");
            });

            Permission.defineRole('anonymous', function (stateParams) {
                return authManager.isAnonymous();
            });

            Permission.defineRole('login', function (stateParams) {
                return !authManager.isAnonymous();
            });
        });