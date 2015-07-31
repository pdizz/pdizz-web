'use strict';

var AuthModule = angular.module('AuthModule', []);

AuthModule.controller('LoginController', ['$scope', '$cookieStore', '$state',
    function ($scope, $cookieStore, $state) {
        $scope.login = function () {
            $cookieStore.put('token', $scope.token);
            $state.go('blog');
        };
    }
]);