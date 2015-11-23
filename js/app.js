var eventApp = angular.module ('eventApp', ['ngRoute','ngLocale','ngSanitize','ngFileUpload'] );

angular.module("ngLocale", [], ["$provide", function($provide) {
var PLURAL_CATEGORY = {ZERO: "zero", ONE: "one", TWO: "two", FEW: "few", MANY: "many", OTHER: "other"};
function getDecimals(n) {
  n = n + '';
  var i = n.indexOf('.');
  return (i == -1) ? 0 : n.length - i - 1;
}

function getVF(n, opt_precision) {
  var v = opt_precision;

  if (undefined === v) {
    v = Math.min(getDecimals(n), 3);
  }

  var base = Math.pow(10, v);
  var f = ((n * base) | 0) % base;
  return {v: v, f: f};
}

$provide.value("$locale", {
  "DATETIME_FORMATS": {
    "AMPMS": [
      "\u0434\u043f",
      "\u043f\u043f"
    ],
    "DAY": [
      "\u043d\u0435\u0434\u0456\u043b\u044f",
      "\u043f\u043e\u043d\u0435\u0434\u0456\u043b\u043e\u043a",
      "\u0432\u0456\u0432\u0442\u043e\u0440\u043e\u043a",
      "\u0441\u0435\u0440\u0435\u0434\u0430",
      "\u0447\u0435\u0442\u0432\u0435\u0440",
      "\u043f\u02bc\u044f\u0442\u043d\u0438\u0446\u044f",
      "\u0441\u0443\u0431\u043e\u0442\u0430"
    ],
    "ERANAMES": [
      "\u0434\u043e \u043d\u0430\u0448\u043e\u0457 \u0435\u0440\u0438",
      "\u043d\u0430\u0448\u043e\u0457 \u0435\u0440\u0438"
    ],
    "ERAS": [
      "\u0434\u043e \u043d.\u0435.",
      "\u043d.\u0435."
    ],
    "FIRSTDAYOFWEEK": 0,
    "MONTH": [
      "\u0441\u0456\u0447\u043d\u044f",
      "\u043b\u044e\u0442\u043e\u0433\u043e",
      "\u0431\u0435\u0440\u0435\u0437\u043d\u044f",
      "\u043a\u0432\u0456\u0442\u043d\u044f",
      "\u0442\u0440\u0430\u0432\u043d\u044f",
      "\u0447\u0435\u0440\u0432\u043d\u044f",
      "\u043b\u0438\u043f\u043d\u044f",
      "\u0441\u0435\u0440\u043f\u043d\u044f",
      "\u0432\u0435\u0440\u0435\u0441\u043d\u044f",
      "\u0436\u043e\u0432\u0442\u043d\u044f",
      "\u043b\u0438\u0441\u0442\u043e\u043f\u0430\u0434\u0430",
      "\u0433\u0440\u0443\u0434\u043d\u044f"
    ],
    "SHORTDAY": [
      "\u041d\u0434",
      "\u041f\u043d",
      "\u0412\u0442",
      "\u0421\u0440",
      "\u0427\u0442",
      "\u041f\u0442",
      "\u0421\u0431"
    ],
    "SHORTMONTH": [
      "\u0441\u0456\u0447.",
      "\u043b\u044e\u0442.",
      "\u0431\u0435\u0440.",
      "\u043a\u0432\u0456\u0442.",
      "\u0442\u0440\u0430\u0432.",
      "\u0447\u0435\u0440\u0432.",
      "\u043b\u0438\u043f.",
      "\u0441\u0435\u0440\u043f.",
      "\u0432\u0435\u0440.",
      "\u0436\u043e\u0432\u0442.",
      "\u043b\u0438\u0441\u0442.",
      "\u0433\u0440\u0443\u0434."
    ],
    "WEEKENDRANGE": [
      5,
      6
    ],
    "fullDate": "EEEE, d MMMM y '\u0440'.",
    "longDate": "d MMMM y '\u0440'.",
    "medium": "d MMM y '\u0440'. HH:mm:ss",
    "mediumDate": "d MMM y '\u0440'.",
    "mediumTime": "HH:mm:ss",
    "short": "dd.MM.yy HH:mm",
    "shortDate": "dd.MM.yy",
    "shortTime": "HH:mm"
  },
  "NUMBER_FORMATS": {
    "CURRENCY_SYM": "\u20b4",
    "DECIMAL_SEP": ",",
    "GROUP_SEP": "\u00a0",
    "PATTERNS": [
      {
        "gSize": 3,
        "lgSize": 3,
        "maxFrac": 3,
        "minFrac": 0,
        "minInt": 1,
        "negPre": "-",
        "negSuf": "",
        "posPre": "",
        "posSuf": ""
      },
      {
        "gSize": 3,
        "lgSize": 3,
        "maxFrac": 2,
        "minFrac": 2,
        "minInt": 1,
        "negPre": "-",
        "negSuf": "\u00a0\u00a4",
        "posPre": "",
        "posSuf": "\u00a0\u00a4"
      }
    ]
  },
  "id": "uk-ua",
  "pluralCat": function(n, opt_precision) {  var i = n | 0;  var vf = getVF(n, opt_precision);  if (vf.v == 0 && i % 10 == 1 && i % 100 != 11) {    return PLURAL_CATEGORY.ONE;  }  if (vf.v == 0 && i % 10 >= 2 && i % 10 <= 4 && (i % 100 < 12 || i % 100 > 14)) {    return PLURAL_CATEGORY.FEW;  }  if (vf.v == 0 && i % 10 == 0 || vf.v == 0 && i % 10 >= 5 && i % 10 <= 9 || vf.v == 0 && i % 100 >= 11 && i % 100 <= 14) {    return PLURAL_CATEGORY.MANY;  }  return PLURAL_CATEGORY.OTHER;}
});
}]);


// get enable event from db
var eventData = (function () {
    var json = null;
    $.ajax({
        'async': false,
        'global': false,
        'cache':false,
        'url': 'adm/eventslist.php',
        //'url': 'data/events.json',
        'dataType': "json",
        'success': function (data) {
            json = data;
        }
    });
    return json;
})(); 

// get current date
var currDate = new Date();

// get actual event list
var actualEvents = (function(){
    var eventsAll = [];
    var eventsAll = eventData;
    var events = [];
    currDate = moment(currDate).format("YYYY-MM-DD");

    for (var i=0; i<eventsAll.length; i++){
      for (var b=0; b<eventsAll[i].dates.length; b++){
          var compareDate = eventsAll[i].dates[b].date >= currDate; 
          
          if(compareDate==true){
              
              if(events.length==0){

                events.push(eventsAll[i]);

              } else if (events.length>0){
                  
                for (var j=0; j<events.length; j++){

                  var isEvent = (events[j].id) == (eventsAll[i].id);
                  
                  if(isEvent==true){
                      
                  }
                  else {
                    events.push(eventsAll[i]);
                  }
                }                
              }
          }
      }
    }
    // remove dublicate id
    var arr = events;
    arr.sort( function( a, b){ return a.id - b.id; } );

    // delete all duplicates from the array
    for( var i=0; i<arr.length-1; i++ ) {
      if ( arr[i].id == arr[i+1].id ) {
        delete arr[i];
      }
    }

    // remove the "undefined entries"
    arr = arr.filter( function( el ){ return (typeof el !== "undefined"); } );
    events = arr;
    return events;
})();

// configure our routes
eventApp.config(function($routeProvider) {

    $routeProvider
        // route for the map page
        .when('/', {
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
        })

        // route for the single page
        .when('/iadmin', {
            templateUrl : 'template/event-adm.html',
            controller  : 'AdminEventCtrl'
        })

        .otherwise({
            redirectTo: '/'
        });

});

// event nav 
eventApp.controller('EventNav', function ($scope, $location) {
    $scope.isActive = function (viewLocation) { 
        return viewLocation === $location.path();
    };
});

// event list 
eventApp.controller('EventListCtrl', function ($scope) {
    $scope.events = [];
    $scope.events = actualEvents;
    $scope.currDate = moment(currDate).format("YYYY-MM-DD");

    $(function(){

      $(".filter_cat_all").click(function(){      
        $("button.btn").removeClass("active disabled");
        $(this).addClass("active disabled");
        $(".link_cat_all").show();
      });

      function FilterCat(i) {
        $(".filter_cat_" + i).click(function(){
          $("button.btn").removeClass("active disabled");
          $(this).addClass("active disabled");
            $(".link_cat_all").hide();
            $(".link_cat_" + i).show();
        });
      }

      cat_1 = new FilterCat(1);
      cat_2 = new FilterCat(2);
      cat_3 = new FilterCat(3);
      cat_4 = new FilterCat(4);
      cat_5 = new FilterCat(5);
      cat_6 = new FilterCat(6);
      cat_7 = new FilterCat(7);
    });
});

// event single 
eventApp.controller('SingleEventCtrl', ['$scope', '$routeParams', '$filter',
  function($scope, $routeParams, $filter) {
    $scope.currDate = currDate;
    $scope.eventId = $routeParams.eventId;
    $scope.event_single = $filter('filter')(eventData, function (d) {return d.id === $routeParams.eventId;})[0];

    var Latlng = new google.maps.LatLng($scope.event_single.lat, $scope.event_single.lng);
    var mapOptions = {
        zoom: 16,
        center: Latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    $scope.map = new google.maps.Map(document.getElementById('eventmap'), mapOptions);
    
    var marker = new google.maps.Marker({
        position: Latlng,
        map: $scope.map,
        title: $scope.event_single.location,
        icon: 'images/map_'+$scope.event_single.category+'.png'
    });    

}]);


//add event
eventApp.controller('AddEventCtrl', ['$scope', 'Upload', '$timeout', function ($scope, Upload, $timeout) {
    // location map 
   $(function (){
        $("#geocomplete").geocomplete({
          map: "#event-map",
          details: "form",
          mapOptions: {
            zoom: 16
          },
          markerOptions: {
            draggable: true
          }
        });
        
        $("#geocomplete").bind("geocode:dragged", function(event, latLng){
          $("input[name=lat]").val(latLng.lat());
          $("input[name=lng]").val(latLng.lng());
          $("#reset").show();
        });
             
        $("#reset").click(function(){
          $("#geocomplete").geocomplete("resetMarker");
          $("#reset").hide();
          return false;
        });
        
        $("#find").click(function(){
          $("#geocomplete").trigger("geocode");
        }).click();
  });

  // dates 
  $(function(){
      $("#event_date" ).datepicker({
        'dateFormat':'DD, d MM, yy',
        'minDate': new Date()
      });
      $("#event_timefrom").timepicker({ 'timeFormat': 'H:i','step': 15, 'disableTextInput': true });
      $("#event_timetill").timepicker({ 'timeFormat': 'H:i','step': 15, 'disableTextInput': true });

        
      $("#btn_add_date").click(function(){
        var selectDate =  $( "#event_date").datepicker( "getDate" );
        var date = moment(selectDate).format("YYYY-MM-DD");
        $("#event_dates_list").append('<div class="select_date"><div class="col-lg-6 mr10 date" id="'+date+'" data-val="'+date+'">'+ $("#event_date").val() +'</div><div class="col-lg-2 mr10 timefrom" >'+ $("#event_timefrom").val() +'</div><div class="col-lg-2 mr10 timetill" >'+ $("#event_timetill").val() +'</div><i class="fa fa-times fa-2x" id="date_del"></i></div><div class="clr"></div>');
        $("#event_date").val("").removeClass("ng-dirty ng-valid-parse ng-valid ng-valid-required").addClass("ng-invalid ng-invalid-required");
        $("#event_timefrom").val("");
        $("#event_timetill").val("");     
      });
        

      $(document).on("click", "#date_del", function(){
         $(this).parent('.select_date').remove();
      });

      // collect dates
        $('#event_submit').click(function(){
          $dates = $('#event_dates_list .select_date').map(function () { 
            var date = $($(this).find('.date')).attr('id'),
                timeFrom = $($(this).find('.timefrom')).text(),
                timeTill = $($(this).find('.timetill')).text(),
                result = {
                    date: date,
                    timefrom: timeFrom,
                    timetill: timeTill
                };

            return JSON.stringify(result);
        }).get().join(", ");
        $('#event_dates').val($.makeArray($dates))
      });
    });

    $scope.uploadPic = function(file) {
    file.upload = Upload.upload({
      url: 'adm/add.php',
      file: file,
      sendFieldsAs: 'form',
      fields: {
        title: $scope.title, 
        category: $scope.category,
        elocation: $scope.elocation, 
        locationaddr: $('#geocomplete').val(), 
        lat: $('#lat').val(), 
        lng: $('#lng').val(), 
        dates: $('#event_dates').val(), 
        tickets: $scope.tickets,  
        web: $scope.web, 
        email: $scope.email, 
        phone: $scope.phone, 
        description: $scope.description
      }
    }).success(function(data) {
        $(".form-success").append('<p class="bg-success text-center text-success"><br/>Дякуємо! Подію додано. Після перевірки вона з\'явиться на сайті<br/><br/></p>');
        $("#eventForm").remove();
      });

    file.upload.then(function (response) {
      $timeout(function () {
        file.result = response.data;
      });
    }, function (response) {
      if (response.status > 0)
        $scope.errorMsg = response.status + ': ' + response.data;
    }, function (evt) {
      // Math.min is to fix IE which reports 200% sometimes
      file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
    });
    }


}]);

// big map with events 
eventApp.controller ('EventMapCtrl',function ($scope){
  var mapOptions = {
        zoom: 14,
        center: new google.maps.LatLng(49.832, 24.012),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }

  $scope.map = new google.maps.Map(document.getElementById('events-gmap'), mapOptions);
  var oms = new OverlappingMarkerSpiderfier($scope.map,{keepSpiderfied:true});  
  var myPos = navigator.geolocation.getCurrentPosition(function(position) {
      
    var geolocate = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    var man = '/images/mypos.png';
    var infowindow = new google.maps.InfoWindow({
        map: $scope.map,
        position: geolocate,
        zIndex: 1,
        content:
            'ти тут'
    });
   
    // Add circle overlay and bind to marker
    var circle = new google.maps.Circle({
      map: $scope.map,
      radius: 2000,    // metres
      strokeColor: '#024478',
      strokeOpacity: 0.6,
      strokeWeight: 1,
      fillOpacity:0.2,
      fillColor: '#2196f3'
    });
    circle.bindTo('center', infowindow, 'position');

    $scope.map.setCenter(geolocate);            
  });

    $scope.markers = [];
    
    var infoWindows = [];
    function closeInfoWindows(){
        var i = infoWindows.length;
        while(i--){
            infoWindows[i].close();
        }
    }
    
    var createMarker = function (map,info,osm){
        var mapIcon = 'images/map_'+info.category+'.png';
        var marker = new google.maps.Marker({
            map: $scope.map,
            position: new google.maps.LatLng(info.lat, info.lng),
            title: info.title,
            icon: mapIcon
        });
        oms.addMarker(marker);
        var infoContent = { content:'<h2><a href="#event/'+ info.id +'">' + marker.title + '</a></h2><div class="infoWindowContent"><img src="'+ info.image +'" alt="" class="img-responsive" style="max-width: 200px;" /></div>'}
        var infoWindow = new google.maps.InfoWindow(infoContent);
        infoWindows.push(infoWindow);
        google.maps.event.addListener(marker, 'click', function(){
            closeInfoWindows();
            infoWindow.open($scope.map, marker);
        });
        
    }  

    for (i = 0; i < actualEvents.length; i++){
        //createMarker(actualEvents[i]);
       $scope.markers.push(createMarker($scope.map, actualEvents[i], oms));
    }

    
    $scope.openInfoWindow = function(e, selectedMarker){
        e.preventDefault();
        google.maps.event.trigger(selectedMarker, 'click');
    }
});

// admin events
eventApp.controller('AdminEventCtrl', function ($scope) {
    // get all event from db
    var eventDataAll = (function () {
        var json = null;
        $.ajax({
            'async': false,
            'global': false,
            'cache':false,
            'url': 'adm/alleventslist.php',
            'dataType': "json",
            'success': function (data) {
                json = data;
            }
        });
        return json;
    })(); 

    $scope.events = [];
    $scope.events = eventDataAll;
    $scope.currDate = moment(currDate).format("YYYY-MM-DD");
});