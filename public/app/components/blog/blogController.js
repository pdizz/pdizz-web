'use strict';

var pdizzApp = angular.module('pdizzApp', []);

pdizzApp.controller('BlogListController', ['$scope', '$http',
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
            return new Date(Date.parse(date));
        }
    }]);