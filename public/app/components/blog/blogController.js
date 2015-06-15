'use strict';

var pdizzApp = angular.module('pdizzApp', []);

pdizzApp.controller('BlogListController', function ($scope, $http) {
    $http.get('/api/blog/post').success(function (data) {
        $scope.posts = data._embedded.post;
    });
});