var app = angular.module ('eventApp', [] );

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