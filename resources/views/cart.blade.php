@extends('layouts.app')

@section('title')
    Cart items
@endsection

@section('content')


    <section class="featured spad" ng-controller="Cart">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Cart
                            <a title="Items" href="/" class="btn btn-xs btn-dark">Items</a>
                        </h2>
                    </div>

                </div>
            </div>
            <div class="table">
                {{--@foreach($products as $product)--}}
                <table class="table-striped">
                    <thead class="">
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th></th>
                    </thead>
                    <tbody class="card-body">
                        <tr ng-repeat="cart in arrCartItems">
                            <td>[{cart.item.name}]</td>
                            <td>[{cart.quantity}]</td>
                            <td>[{cart.item.price * cart.quantity}] $</td>
                            <td><button title="add" ng-click="add(cart.item_id)" class="btn btn-xs btn-success">+</button>
                                <button title="remove" ng-click="remove(cart.item_id)" class="btn btn-xs btn-danger ">-</button></td>
                        </tr>
                    </tbody>
                    <tfoot class="card-footer">
                        <td></td>
                        <td></td>
                        <td ><b>[{getCartTotalPrice()}] $</b></td>
                        <td> <a title="Payment" href="/payment" class="btn btn-xs btn-info">Payment</a> </td>
                    </tfoot>
                </table>

                {{--@endforeach--}}
            </div>


        </div>
    </section>

@endsection


@section('scripts')
    <script src="{{ asset('js/cart.js') }}"></script>
@endsection