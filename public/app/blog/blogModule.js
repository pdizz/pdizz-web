'use strict';

var blogModule = angular.module('blogModule', []);

blogModule.controller('BlogListController', ['$scope', '$http',
    function ($scope, $http) {
        $http.get('/api/blog/post').success(function (data) {
            $scope.posts = data._embedded.post;
        });

        /**
         * Turn the string into a Date object
         * @param date
         * @returns {Date}
         */
        $scope.toDate = function(date) {
            return new Date(date);
        }
    }]);

blogModule.controller('BlogDetailController', ['$scope', '$http', '$routeParams',
    function ($scope, $http, $routeParams) {
        $http.get('/api/blog/post/' + $routeParams.postId).success(function (data) {
            $scope.post = data;
        });

        /**
         * Turn the string into a Date object
         * @param date
         * @returns {Date}
         */
        $scope.toDate = function(date) {
            return new Date(date);
        }
    }]);