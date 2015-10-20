var eventApp = angular.module ('eventApp', ['ngRoute'] );

// data from JSON file
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

// configure our routes
eventApp.config(function($routeProvider) {
    $routeProvider

        // route for the map page
        .when('/map', {
            templateUrl : 'template/event-map.html',
            controller  : 'EventMapCtrl'
        })

        // route for the list page
        .when('/list', {
            templateUrl : 'template/event-list.html',
            controller  : 'EventListCtrl'
        })

        // route for the add page
        .when('/add', {
            templateUrl : 'template/event-add.html',
            controller  : 'AddEventCtrl'
        })

        // route for the single page
        .when('/event/:eventId', {
            templateUrl : 'template/event-single.html',
            controller  : 'SingleEventCtrl'
        });
});

// event list 
eventApp.controller('EventListCtrl', function ($scope) {
    $scope.events = [];
    $scope.events = eventData;
  });

// event single 
eventApp.controller('SingleEventCtrl', function ($scope) {
    
  });

// big map with events 
eventApp.controller ('EventMapCtrl',function ($scope){
  var mapOptions = {
        zoom: 13,
        center: new google.maps.LatLng(49.832, 24.012),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    $scope.map = new google.maps.Map(document.getElementById('events-gmap'), mapOptions);
    
    navigator.geolocation.getCurrentPosition(function(position) {
        
            var geolocate = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            
            var infowindow = new google.maps.InfoWindow({
                map: $scope.map,
                position: geolocate,
                content:
                    'you are here'
            });
            
            $scope.map.setCenter(geolocate);            
        });

    $scope.markers = [];
    
    var infoWindow = new google.maps.InfoWindow();
    
    var createMarker = function (info){
        
        var marker = new google.maps.Marker({
            map: $scope.map,
            position: new google.maps.LatLng(info.lat, info.lng),
            title: info.title
        });
        marker.content = '<div class="infoWindowContent"><img src="'+ info.image +'" alt="" class="fl mr10 w100px" />' + info.title + info.description + '</div>';
        
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

// add event


