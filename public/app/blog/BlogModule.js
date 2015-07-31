'use strict';

var BlogModule = angular.module('BlogModule', ['ngResource', 'ui.router']);

BlogModule.factory('PostResource', ['$resource', '$cookieStore',
    function ($resource, $cookieStore) {
        return $resource('api/blog/post/:postId', {}, {
            query: {method: 'GET', isArray: false},
            save: {
                method: 'POST',
                headers: {
                    'Api-Key': function () {
                        return $cookieStore.get('token');
                    }
                }
            },
            update: {
                method: 'PUT',
                headers: {
                    'Api-Key': function () {
                        return $cookieStore.get('token');
                    }
                }
            }
        });
    }
]);

// Cut string length on whitespace instead of mid word
BlogModule.filter('cut', function () {
    return function (value, wordwise, max) {
        if (!value) return '';

        max = parseInt(max, 10);
        if (!max) return value;
        if (value.length <= max) return value;

        value = value.substr(0, max);
        if (wordwise) {
            var lastspace = value.lastIndexOf(' ');
            if (lastspace != -1) {
                value = value.substr(0, lastspace);
            }
        }

        return value;
    };
});

BlogModule.controller('PostListController', ['$scope', '$state', '$stateParams', 'PostResource',
    function ($scope, $state, $stateParams, PostResource) {
        PostResource.query(
            {'is_visible': 1, 'page': $stateParams.page, 'page_size': 5},
            function (data) {
                $scope.posts     = data._embedded.post;
                $scope.page      = data.page;
                $scope.pageCount = data.page_count;
            });


        /**
         * Turn the string into a Date object
         * @param date
         * @returns {Date}
         */
        $scope.toDate = function(date) {
            return new Date(date);
        };
    }
]);

BlogModule.controller('PostViewController', ['$scope', '$stateParams', 'PostResource',
    function ($scope, $stateParams, PostResource) {
        $scope.post = PostResource.get({postId: $stateParams.postId});

        /**
         * Turn the string into a Date object
         * @param date
         * @returns {Date}
         */
        $scope.toDate = function(date) {
            return new Date(date);
        };
    }
]);

BlogModule.controller('PostCreateController', ['$scope', '$state', 'PostResource',
    function ($scope, $state, PostResource) {
        $scope.post = new PostResource();
        $scope.addPost = function () {
            $scope.post.$save(function (post) {
                // Continue editing post
                $state.go('blogEdit', {postId: post.id});
            });
        }
    }
]);

BlogModule.controller('PostEditController', ['$scope', '$stateParams', 'PostResource',
    function ($scope, $stateParams, PostResource) {
        $scope.post = PostResource.get({postId: $stateParams.postId});
        $scope.updatePost = function () {
            $scope.post.$update({postId: $stateParams.postId});
        }
    }
]);