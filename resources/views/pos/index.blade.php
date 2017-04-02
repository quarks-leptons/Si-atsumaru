@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading">NEW ORDER</div>

                <div class="panel-body" style="max-height:500px; min-height:500px">
                    <!-- Form New Order -->
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('customer_name') ? ' has-error' : '' }}">
                            <label for="customer_name" class="col-md-4 control-label">Customer</label>

                            <div class="col-md-6">
                                <select id="customer_name" name="customer_name" class="form-control" required autofocus>
                                    <option>Andi</option>
                                    <option>Budi</option>
                                </select>

                                @if ($errors->has('customer_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('customer_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <h4>Purchases</h4>
                            <div id="purchases">
                                <span>Empty</span>
                            </div>

                        <div class="form-group" style="position: absolute; bottom: 20px;">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    Save Order
                                </button>
                            </div>
                        </div>

                    </form> <!-- End of Form New Order -->
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading">Select Menu</div>

                <div class="panel-body">
                    <!-- Form Select Menu -->
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('menu_name') ? ' has-error' : '' }}">
                            <label for="menu_name" class="col-md-4 control-label">Search Menu</label>

                            <div class="col-md-6">
                                <input id="menu_name" type="text" class="form-control" name="menu_name" value="{{ old('menu_name') }}" required>

                                @if ($errors->has('menu_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('menu_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr />
                        <div id="menus" style="max-height:400px; min-height:400px; overflow-y: scroll;">
                            <div class="col-md-3">
                                <img src="https://placehold.it/100x100" alt="menu" class="img-thumbnail">
                                <br/>
                                <span>Menu</span>
                            </div>
                            <div class="col-md-3">
                                <img src="https://placehold.it/100x100" alt="menu" class="img-thumbnail">
                                <br/>
                                <span>Menu</span>
                            </div>
                            <div class="col-md-3">
                                <img src="https://placehold.it/100x100" alt="menu" class="img-thumbnail">
                                <br/>
                                <span>Menu</span>
                            </div>
                            <div class="col-md-3">
                                <img src="https://placehold.it/100x100" alt="menu" class="img-thumbnail">
                                <br/>
                                <span>Menu</span>
                            </div>
                            <div class="col-md-3">
                                <img src="https://placehold.it/100x100" alt="menu" class="img-thumbnail">
                                <br/>
                                <span>Menu</span>
                            </div>
                            <div class="col-md-3">
                                <img src="https://placehold.it/100x100" alt="menu" class="img-thumbnail">
                                <br/>
                                <span>Menu</span>
                            </div>
                            <div class="col-md-3">
                                <img src="https://placehold.it/100x100" alt="menu" class="img-thumbnail">
                                <br/>
                                <span>Menu</span>
                            </div>
                            <div class="col-md-3">
                                <img src="https://placehold.it/100x100" alt="menu" class="img-thumbnail">
                                <br/>
                                <span>Menu</span>
                            </div>
                            <div class="col-md-3">
                                <img src="https://placehold.it/100x100" alt="menu" class="img-thumbnail">
                                <br/>
                                <span>Menu</span>
                            </div>
                            <div class="col-md-3">
                                <img src="https://placehold.it/100x100" alt="menu" class="img-thumbnail">
                                <br/>
                                <span>Menu</span>
                            </div>
                            <div class="col-md-3">
                                <img src="https://placehold.it/100x100" alt="menu" class="img-thumbnail">
                                <br/>
                                <span>Menu</span>
                            </div>
                            <div class="col-md-3">
                                <img src="https://placehold.it/100x100" alt="menu" class="img-thumbnail">
                                <br/>
                                <span>Menu</span>
                            </div>
                            <div class="col-md-3">
                                <img src="https://placehold.it/100x100" alt="menu" class="img-thumbnail">
                                <br/>
                                <span>Menu</span>
                            </div>
                        </div>
                    </form> <!-- End of Form Select Menu -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
