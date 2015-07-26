'use strict';

var blogModule = angular.module('blogModule', ['ngResource', 'ui.router']);

blogModule.factory('PostResource', ['$resource',
    function ($resource) {
        return $resource('api/blog/post/:postId', {}, {
            query: {method: 'GET', isArray: false},
            update: {method: 'PUT'}
        });
    }
]);

blogModule.controller('PostListController', ['$scope', '$state', 'PostResource',
    function ($scope, $state, PostResource) {
        PostResource.query({'is_visible': 1}, function (data) {
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
    }
]);

blogModule.controller('PostViewController', ['$scope', '$stateParams', 'PostResource',
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

blogModule.controller('PostCreateController', ['$scope', '$state', 'PostResource',
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

blogModule.controller('PostEditController', ['$scope', '$stateParams', 'PostResource',
    function ($scope, $stateParams, PostResource) {
        $scope.post = PostResource.get({postId: $stateParams.postId});
        $scope.updatePost = function () {
            $scope.post.$update({postId: $stateParams.postId});
        }
    }
]);