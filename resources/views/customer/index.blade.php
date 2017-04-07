@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Customer</h3></div>

                <div class="panel-body">
                    <div class="row">
                        <label for="menu_name" class="col-md-2 control-label">Search Customer</label>
                        <div class="col-md-10">
                            <input id="menu_name" type="text" class="form-control" name="menu_name" onkeydown="validate(event)" autocomplete="off">
                        </div>
                    </div>
                    <br>

                    <div class="col-md-4">
                        <h4>Add New Customer</h4>
                        <form class="form-horizontal" role="form" method="POST" action="{{action('CustomerController@addCustomer')}}">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>                            
                            <div class=form-group>
                                <label for="name" class="col-md-2">Name</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="name" />
                                </div>
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif

                            <div class=form-group>
                                <label for="stock" class="col-md-2">Email</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="email" name="email" />
                                </div>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif

                            <div class=form-group>
                                <label for="name" class="col-md-2">Address</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" name="address" />
                                </div>
                            </div>
                            @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                            <input type=submit class="btn btn-primary" value="Add Customer"/>
                        </form>
                    </div>  

                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-3">
                                <b>Name</b>
                            </div>
                            <div class="col-md-3"> 
                                <b>Email</b>
                            </div>
                            <div class="col-md-4"> 
                                <b>Address</b>
                            </div>
                        </div>
                    @foreach ($customers as $customer)
                        <div class="row customer-card" >
                            <div class="col-md-3">
                                {{$customer->name}}
                            </div>
                            <div class="col-md-3"> 
                                {{$customer->email}}
                            </div>
                            <div class="col-md-4"> 
                                {{$customer->address}}
                            </div>
                            <div class="col-md-1">
                                @include('customer.edit_customer',[
                                    "id" => $customer->id,
                                    "name" => $customer->name,
                                    "email" => $customer->email,
                                    "address" => $customer->address,
                                ])
                            </div>
                           <div class="col-md-1">
                                <i class="fa fa-trash-o" style="color:red" aria-hidden="true"></i>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>

                <div class="panel-body">

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function validate(e) {
        if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
            var search_term = e.target.value.toLowerCase()

            console.log('Searching: '+search_term)
            $(".customer-card").each(function(index) {
                var customer_name = $( this ).text().toLowerCase()
                if(customer_name.includes(search_term)) {
                    $(this).show()
                }
                else {
                    $(this).hide()   
                }
            });
        }
    }
</script>
@endsection

