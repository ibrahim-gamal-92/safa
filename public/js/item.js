var controllers = {};
controllers.Item  = ['$scope','SrvItem','SrvCart',function($scope,SrvItem,SrvCart){

    $scope.arrCartItems = {};

    $scope.hasItems = function () {
        if(Object.keys($scope.arrCartItems).length)
            return true;
        return false;
    }

    $scope.add = function (item_id) {
        if($scope.arrCartItems[item_id] == undefined){
            SrvCart.Add(item_id).then(function(response){
                if(response.data.result){
                    $scope.arrCartItems[item_id] = response.data.object;
                }
            });
        }else {
            $scope.arrCartItems[item_id].quantity++;
            update($scope.arrCartItems[item_id]);

        }
    }

    function update(cart) {
        SrvCart.Update(cart).then(function(response){
            if(response.data.result){
                cart = response.data.object;
            }
        });
    }

    $scope.remove = function (item_id) {
        if($scope.arrCartItems[item_id] == undefined){
            return;
        }
        if($scope.arrCartItems[item_id].quantity == 1){
            SrvCart.Remove($scope.arrCartItems[item_id].id).then(function (response) {
                if(response.data.result){
                    delete $scope.arrCartItems[item_id];
                }
            });
        }else{
            $scope.arrCartItems[item_id].quantity--;
            update($scope.arrCartItems[item_id]);
        }
    }

    $scope.objPagination = {
        inPageNo : 1,
        intPageSize:objConfig.intPageSize
    };

    $scope.list = function() {
        SrvItem.List($scope.objPagination).then(function(response){
            $scope.arrItems = response.data.object;
            $scope.intCount = response.data.count;
        });
    };

    function init() {
        $scope.list();

        SrvCart.List().then(function (response) {
            $scope.arrCartItems = indexBy(response.data, 'item_id');
        });
        indexBy()
    }

    init();


}];

app.controller(controllers);