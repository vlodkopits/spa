var app = angular.module ('eventApp', ['ui.bootstrap.datetimepicker'] );


var eventData = (function () {
    var json = null;
    $.ajax({
        'async': false,
        'global': false,
        'url': 'data/events.json',
        'dataType': "json",
        'success': function (data) {
            json = data;
        }
    });
    return json;
})(); 

app.directive("eventNav", function() { 
    return {
      restrict: 'E',
      templateUrl: "template/event-nav.html",
      controller: function() {
          this.link = 3;

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

app.controller ('EventMapCtrl',function ($scope){
  var mapOptions = {
        zoom: 13,
        center: new google.maps.LatLng(49.832, 24.012),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    $scope.map = new google.maps.Map(document.getElementById('events-gmap'), mapOptions);

    $scope.markers = [];
    
    var infoWindow = new google.maps.InfoWindow();
    
    var createMarker = function (info){
        
        var marker = new google.maps.Marker({
            map: $scope.map,
            position: new google.maps.LatLng(info.lat, info.lng),
            title: info.title
        });
        marker.content = '<div class="infoWindowContent">' + info.title + info.description + '</div>';
        
        google.maps.event.addListener(marker, 'click', function(){
            infoWindow.setContent('<h2>' + marker.title + '</h2>' + marker.content);
            infoWindow.open($scope.map, marker);
        });
        
        $scope.markers.push(marker);
        
    }  
    
    for (i = 0; i < eventData.length; i++){
        createMarker(eventData[i]);
    }

    $scope.openInfoWindow = function(e, selectedMarker){
        e.preventDefault();
        google.maps.event.trigger(selectedMarker, 'click');
    }
});

  /* event add start 

  /* event add end */