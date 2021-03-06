'use strict';

var pdizzApp = angular.module('pdizzApp', [
    'ui.router',
    'hc.marked',
    'ngCookies',
    'BlogModule',
    'AuthModule'
]);

pdizzApp.config(['$stateProvider', '$urlRouterProvider', 'markedProvider',
    function ($stateProvider, $urlRouterProvider, markedProvider) {
        $urlRouterProvider
            // Default to
            .otherwise('/blog');

        $stateProvider
            .state('about', {
                url: '/about',
                templateUrl: 'app/page/view/about.html'
            })
            .state('code', {
                url: '/code',
                templateUrl: 'app/page/view/code.html'
            })
            .state('blog', {
                url: '/blog?page',
                templateUrl: 'app/blog/view/blog-list.html',
                controller: 'PostListController'
            })
            .state('blogView', {
                url: '/blog/post/{postId:int}',
                templateUrl: 'app/blog/view/blog-detail.html',
                controller: 'PostViewController'
            })
            .state('blogCreate', {
                url: '/blog/post/new',
                templateUrl: 'app/blog/view/blog-create.html',
                controller: 'PostCreateController'
            })
            .state('blogEdit', {
                url: '/blog/post/{postId:int}/edit',
                templateUrl: 'app/blog/view/blog-edit.html',
                controller: 'PostEditController'
            })

            .state('login', {
                url: '/login',
                templateUrl: 'app/auth/login.html',
                controller: 'LoginController'
            });

        markedProvider.setOptions({
            gfm: true,
            highlight: function (code) {
                return hljs.highlightAuto(code).value
            }
            //sanitize: true
        });
    }
]);