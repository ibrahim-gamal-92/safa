var app = angular.module('safa', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[{');
    $interpolateProvider.endSymbol('}]');
});

app.directive('paginator', function ($parse) {
    return {
        require: 'ngModel',
        scope: {
            'paginator': '=',
            'ngModel': '='
        },
        link: function (scope, el, attrs, ctrl) {
            var dtStartDate;
            scope.$watch('ngModel', function (nVal) {
                if (nVal != undefined && nVal != '') {
                    dtStartDate = nVal;
                    showPaginator();
                } else {
                    if ($('.paginator').length) {
                        $('.paginator').datepaginator('remove');
                    }
                }
                //el.val(nVal);
            });

            function showPaginator() {
                var myClass = 'paginator';
                el.addClass(myClass);
                var myClass = 'paginator';
                el.addClass(myClass);
                $('.paginator').datepaginator()
                var options = {
                    selectedDate: dtStartDate,
                    textSelected: 'YYYY-MM-DD',
                    text: 'DD',
                    size: 'small',
                    hint: 'YYYY-MM-DD',
                    squareEdges: true,
                    onSelectedDateChanged: function (event, date) {
                        var Day = date._d.getDate();
                        Day = (Day.length == 1) ? '0' + Day : Day;
                        var Month = date._d.getMonth() + 1;
                        Month = (Month.length == 1) ? '0' + Month : Month;
                        var Year = date._d.getFullYear();
                        dtStartDate = Year + '-' + Month + '-' + Day;
                        /*AlertError(dtStartDate);
                        scope.paginator = dtStartDate;
                        x = el;
                        v = attrs;*/
                        $('.paginator').datepaginator('setSelectedDate', dtStartDate);


                        ctrl.$setViewValue(dtStartDate);
                        ctrl.$render();
                        //el.preventDefault();
                        scope.$apply(); // needed if other parts of the app need to be updated
                    }
                };
                $('.paginator').datepaginator(options);
            }
        }
    };
});



app.filter('capitalize', function() {
    return function(input) {
        return (!!input) ? input.charAt(0).toUpperCase() + input.substr(1).toLowerCase() : '';
    }
});

app.filter('newlines', function() {
    return function(text) {
        if(text != null && text != ""){
            return text.split(/\n/g);
        }
    };
});

app.filter('prettyJSON', function () {
    function prettyPrintJson(json) {
        return JSON ? JSON.stringify(json, null, '  ') : 'your browser doesn\'t support JSON so cant pretty print';
    }
    return prettyPrintJson;
});


app.filter('datetime', function () {
    return function (data, format) {
        if (data == null || data == '' || format == undefined) {
            return data
        } else {
            if (navigator.userAgent.indexOf("Firefox") != -1) {
                if (data.indexOf(' ') == -1 && data.indexOf(':') != -1) {
                    data = 'T' + data; // only on Firefox
                } else {
                    data = data.replace(' ', 'T');
                }
            }
            var dtFullDate = new Date(data);
            var intYear = dtFullDate.getFullYear();
            var intMonth = dtFullDate.getMonth();
            if (isNaN(intYear) || isNaN(intMonth)) {
                // means data sent is time not date
                var dtCurrentDate = dateFormat(new Date(), 'yyyy-mm-dd');
                dtFullDate = new Date(dtCurrentDate + ' ' + data);
                if (dtFullDate == 'Invalid Date') {
                    // means data sent neither date nor time
                    return '';
                }
            }
            return dateFormat(dtFullDate, format);

        }
    }
});


app.service('SrvItem', ['$http', function ($http) {
    var service = {
        List: function (objPagination) {
            var strUrl = objConfig.root + 'items';
            if(objPagination.inPageNo){
                strUrl += '?page='+objPagination.inPageNo;
            }
            if(objPagination.intPageSize){
                strUrl += '&size='+objPagination.intPageSize;
            }
            return $http.get(strUrl);
        }


    };
    return service;
}]);

app.service('SrvCart', ['$http', function ($http) {
    var service = {
        List: function () {
            var strUrl = objConfig.root + 'carts';
            return $http.get(strUrl);
        },
        Add: function (item_id) {
            var strUrl = objConfig.root + 'cart';
            return $http.post(strUrl, {'item_id':item_id});
        },
        Update: function (cart) {
            var strUrl = objConfig.root + 'cart/' + cart.id;
            return $http.put(strUrl, cart);
        },
        Remove: function (id) {
            var strUrl = objConfig.root + 'cart/' + id;
            return $http.delete(strUrl);
        },
    };
    return service;
}]);

app.service('SrvOrder', ['$http', function ($http) {
    var service = {
        Add: function (obj) {
            var strUrl = objConfig.root + 'order';
            return $http.post(strUrl, obj);
        },
    };
    return service;
}]);

function indexBy(data, key) {
    var result = {};
    angular.forEach(data, function (row) {
        result[row[key]] = row;
    });
    return result;
}