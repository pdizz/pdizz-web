'use strict';

var blogModule = angular.module('blogModule', ['ngResource']);

blogModule.factory('PostService', ['$resource',
    function ($resource) {
        return $resource('api/blog/post/:postId', {}, {
            get: {method: 'GET'},
            query: {method: 'GET', isArray: false}
        });
    }]);

blogModule.controller('BlogListController', ['$scope', 'PostService',
    function ($scope, PostService) {
        PostService.query({'is_visible': 1}, function(data) {
            $scope.posts = data._embedded.post
        });


        /**
         * Turn the string into a Date object
         * @param date
         * @returns {Date}
         */
        $scope.toDate = function(date) {
            return new Date(date);
        };
    }]);

blogModule.controller('BlogDetailController', ['$scope', '$routeParams', 'PostService',
    function ($scope, $routeParams, PostService) {
        PostService.get({postId: $routeParams.postId}, function(data) {
            $scope.post = data;
        });

        /**
         * Turn the string into a Date object
         * @param date
         * @returns {Date}
         */
        $scope.toDate = function(date) {
            return new Date(date);
        };
    }]);