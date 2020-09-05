var controllers = {};
controllers.Cart  = ['$scope','SrvCart',function($scope,SrvCart){


    function init() {
        SrvCart.List().then(function (response) {
            $scope.arrCartItems = indexBy(response.data, 'item_id') ;
        });
    }

    $scope.getCartTotalPrice = function () {
        var price = 0;
        angular.forEach($scope.arrCartItems, function (cart) {
            price += (cart.item.price * cart.quantity);
        });
        return price;
    };

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

    init();


}];

app.controller(controllers);