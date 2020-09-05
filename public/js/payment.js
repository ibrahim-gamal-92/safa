var controllers = {};
controllers.Payment  = ['$scope','SrvCart','SrvOrder',function($scope,SrvCart,SrvOrder){

    $scope.mode = 1;
    $scope.order = {address:'', telephone:''};

    $scope.canSubmit = function(){
        if(!$scope.order.address || !$scope.order.telephone){
            return false;
        }
        return true;
    };

    $scope.pay = function () {
        SrvOrder.Add($scope.order).then(function (response) {
            $scope.mode = 2;
            $scope.message = response.data.message;
        });
    }


    function init() {
        SrvCart.List().then(function (response) {
            if(!response.data.length){
                window.location.href = "/";
            }
        });
    }

    init();


}];

app.controller(controllers);