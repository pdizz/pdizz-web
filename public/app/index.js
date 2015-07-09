'use strict';

var pdizzApp = angular.module('pdizzApp', [
    'ngRoute',
    'blogModule'
]);

pdizzApp.config(['$routeProvider', function ($routeProvider) {
    $routeProvider
        .when('/page/home', {
            templateUrl: 'app/page/view/home.html'
        })
        .when('/page/about', {
            templateUrl: 'app/page/view/about.html'
        })
        .when('/page/cv', {
            templateUrl: 'app/page/view/cv.html'
        })
        .when('/blog', {
            templateUrl: 'app/blog/view/blog-list.html',
            controller: 'BlogListController'
        })
        .when('/blog/:postId', {
            templateUrl: 'app/blog/view/blog-detail.html',
            controller: 'BlogDetailController'
        })
        .otherwise({
            redirectTo: '/page/home'
        })
}]);