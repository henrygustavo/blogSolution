var localHostUrl = window.location.origin || window.location.protocol + '//' + window.location.host;

var applicationModule = angular.module("applicationModule", ['ui.router', 'ngResource', 'ngRoute', 'ngAnimate', 'ui.bootstrap', 'blockUI', 'uiGmapgoogle-maps', 'ngMessages']);

applicationModule.config(function ($urlRouterProvider, $stateProvider, $locationProvider, GlobalInfo, blockUIConfig, uiGmapGoogleMapApiProvider) {

    blockUIConfig.templateUrl = '/app/shared/html/block-ui-overlay.html';
    $urlRouterProvider.otherwise('/');

    $stateProvider
            .state('home', {
                url: '/',
                templateUrl: '/app/components/home/homeView.html',
                controller: 'homeController',
                resolve: {
                    searchText: function ($stateParams) {
                        return $stateParams.searchText;
                    },
                    searchTag: function ($stateParams) {
                        return $stateParams.searchTag;
                    }
                }
            })
            .state('contact', {
                url: '/contact',
                templateUrl: '/app/components/contact/contactView.html',
                controller: 'contactController'
            })
            .state('about', {
                url: '/about',
                templateUrl: '/app/components/about/aboutView.html',
                controller: 'aboutController'
            })
            .state('search', {
                url: '/search/:searchText',
                templateUrl: '/app/components/home/homeView.html',
                controller: 'homeController',
                resolve: {
                   searchText: function ($stateParams) {
                        return $stateParams.searchText;
                    },
                    searchTag: function ($stateParams) {
                        return $stateParams.searchTag;
                    }
                }
            })
            .state('searchTags', {
                url: '/searchTags/:searchTag',
                templateUrl: '/app/components/home/homeView.html',
                controller: 'homeController',
                resolve: {
                   searchText: function ($stateParams) {
                        return $stateParams.searchText;
                    },
                    searchTag: function ($stateParams) {
                        return $stateParams.searchTag;
                    }
                }
            })
            .state('blogEntries', {
                url: '/blogEntries/:headerUrl',
                templateUrl: '/app/components/blogEntries/blogEntriesView.html',
                controller: 'blogEntriesController',
                resolve: {
                    headerUrl: function ($stateParams) {
                        return $stateParams.headerUrl;
                    }
                }
            })
            ;

    uiGmapGoogleMapApiProvider.configure({
        key: 'AIzaSyCQJCm-gc4taHZiUfeCoHgY7EVOrVruzUw',
        v: '3.20',
        libraries: 'places'
    });
})
        .constant('GlobalInfo',
                {
                    apiUrl: '/api',
                    localHostUrl: localHostUrl
                });