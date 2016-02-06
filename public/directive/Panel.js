/**
 * Created by thrynillan on 1/17/16.
 */
(function() {
    var module = angular.module('panel', []);
    module.controller('PanelController', function ($scope, $http) {
        $scope.posts = [];
        $scope.panelMapper =  function (data) {
            for(var i in data) {
                var post = data[i];
                if (post.content.hasOwnProperty('photos')) {
                    photos = post.content.photos;
                    for( var j in photos) {

                    }
                }
                data[i].pic = data[i].content['url-1280'];
                $scope.posts.push(data[i]);
                console.log(data[i]);
            }
        }
        var _this
        $http.get('data.json').success(function(data){
                console.log(data)

        });
    });
    module.directive('panel', function() {
        return {
            restrict        : 'E',
            controllerAs    : 'panel',
            templateUrl     : '/view/panel.html',
            controller      : 'PanelController'
        };
    });
})();