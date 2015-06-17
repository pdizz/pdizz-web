'use strict';

var pdizzApp = angular.module('pdizzApp', [
    'ngRoute',
    'blogControllers'
]);

pdizzApp.config(['$routeProvider', function ($routeProvider) {
    $routeProvider
        .when('/blog', {
            templateUrl: 'app/blog/view/blog-list.html',
            controller: 'BlogListController'
        })
        .when('/blog/:postId', {
            templateUrl: 'app/blog/view/blog-detail.html',
            controller: 'BlogDetailController'
        })
        .otherwise({
            redirectTo: '/blog'
        })
}]);