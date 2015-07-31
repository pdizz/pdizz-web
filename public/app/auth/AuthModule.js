'use strict';

var AuthModule = angular.module('AuthModule', []);

AuthModule.controller('LoginController', ['$scope', '$rootScope', '$cookieStore', '$state',
    function ($scope, $rootScope, $cookieStore, $state) {
        $scope.login = function () {
            $rootScope.token = $scope.token;
            $cookieStore.put('token', $scope.token);
            $state.go('blog');
        };
    }
]);