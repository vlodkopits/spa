var app = angular.module ('eventApp', [] );

app.directive("eventNav", function() { 
    return {
      restrict: 'E',
      templateUrl: "template/event-nav.html",
      controller: function() {
          this.link = 1;

          this.isLink = function(checkLink) {
            return this.link === checkLink;
          };

          this.setLink = function(activeLink) {
            this.link = activeLink;
          };
        },
        controllerAs: "link"
    };
  });

app.directive("eventMap", function() {
    return {
      restrict: 'E',
      templateUrl: "template/event-map.html"
    };
  });

app.directive("eventList", function() {
    return {
      restrict: 'E',
      templateUrl: "template/event-list.html"
    };
  });

app.directive("eventAdd", function() {
    return {
      restrict: 'E',
      templateUrl: "template/event-add.html"
    };
  });

app.directive("eventFind", function() {
    return {
      restrict: 'E',
      templateUrl: "template/event-find.html"
    };
  });

app.controller('EventController', ['$http',function($http){
    var eventlist = this;
    eventlist.events = [];
    $http.get('data/events.json').success(function(data){
    eventlist.events = data;
  });
  }]);

  /* event add start */

  /* event add end */



