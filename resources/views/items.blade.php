@extends('layouts.app')

@section('title')
    All store items
@endsection

@section('content')


    <section class="featured spad" ng-controller="Item">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Products
                            <a ng-if="hasItems()" title="Cart" href="/cart" class="btn btn-xs btn-info">Cart</a>
                        </h2>
                    </div>

                </div>
            </div>
            <div class="row">
                {{--@foreach($products as $product)--}}
                    <div class="col-md-3" ng-repeat="cart in arrItems">
                        <div class="card" >
                            <div class="card-header">
                                <h3 class="box-title">[{ cart.name }]
                                    <span ng-if="arrCartItems[cart.id]"> ([{arrCartItems[cart.id].quantity}]) </span>
                                    <div class="btn-group pull-right">
                                        <button title="add" ng-click="add(cart.id)" class="btn btn-xs btn-success">+</button>
                                        <button title="remove" ng-click="remove(cart.id)" class="btn btn-xs btn-danger ">-</button>
                                        {{--@can('is_admin')
                                            <a title="Edit" class="btn btn-xs btn-info " href="/products/{{$product->id}}/edit">Edit</a>
                                            <form method="POST" action="/products/{{$product->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <button title="Delete" class="btn btn-xs btn-danger " type="submit">Delete</button>
                                            </form>
                                        @endif--}}


                                    </div>
                                </h3>

                            </div>
                            <div class="card-body">
                                <h5>Price : [{ cart.price }]</h5>
                                <h6>[{ cart.description }]</h6>
                            </div>

                        </div>
                    </div>
                {{--@endforeach--}}
            </div>


        </div>
    </section>

@endsection


@section('scripts')
    <script src="{{ asset('js/item.js') }}"></script>
@endsection