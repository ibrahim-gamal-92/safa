@extends('layouts.app')

@section('title')
    Payment
@endsection

@section('content')


    <section class="featured spad" ng-controller="Payment">
        <div class="container" ng-if="mode == 1">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Payment

                        </h2>
                    </div>

                </div>
            </div>
            <div class="table">
                {{--@foreach($products as $product)--}}
                <table class="table-bordered">

                    <tr>
                        <th>Address</th>
                        <td><textarea ng-model="order.address"></textarea></td>
                    </tr>
                    <tr>
                        <th>Telephone Number</th>
                        <td><input type="text" ng-model="order.telephone"></td>
                    </tr>

                    <tfoot>
                        <td></td>
                        <td>
                            <button data-ng-disabled="!canSubmit()" title="add" ng-click="pay()" class="btn btn-xs btn-info">Complete Action</button>
                            <a title="Shopping Cart" href="/cart" class="btn btn-xs btn-danger">Shopping Cart</a>
                        </td>
                    </tfoot>

                </table>

                {{--@endforeach--}}
            </div>


        </div>

        <div class="container" ng-if="mode == 2">
            <h2 class="text-center">[{message}]</h2>
        </div>
    </section>

@endsection


@section('scripts')
    <script src="{{ asset('js/payment.js') }}"></script>
@endsection