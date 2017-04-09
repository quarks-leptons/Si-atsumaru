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
                                <select id="customer_name" name="customer_name" class="" required autofocus>
                                    @if (count($customers) > 0)
                                        @foreach ($customers as $customer)
                                            <option>{{ $customer->name }}</option>
                                        @endforeach
                                    @endif
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
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    Save Order
                                </button>
                            </div>
                            <div class="col-md-6">
                                Total: Rp0,00
                            </div>
                        </div>

                    </form> <!-- End of Form New Order -->
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="panel panel-default">
                <div id="form-select-menu-1">
                    <div class="panel-heading"></div>

                    <div class="panel-body">
                        <!-- Form Select Menu 1 -->
                        <div class="row">
                            <div class="form-group">
                                <label for="menu_name" class="col-md-3 control-label">Search Menu</label>
                                <div class="col-md-9">
                                    <input id="menu_name" type="text" class="form-control" name="menu_name" onkeydown="validate(event)" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-12"><hr></div>
                        </div>

                        <div id="menus" style="max-height:400px; min-height:400px; overflow-y: scroll;" class="row">
                            @if (count($menus) > 0)
                                @foreach ($menus as $menu)
                                    <div class="col-md-3 menu-card">
                                        <img id="menu{{ $menu->id }}" src="data:image/png;base64,{{ $menu->image }}" alt="{{ $menu->name }}" class="img-thumbnail menu-image" style="cursor:pointer;" onclick="selectMenu({{ $menu->id }})" price="{{$menu->price}}">
                                        <br/>
                                        <span>{{ $menu->name }}</span>
                                        <span>{{ $menu->price }}</span>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-md-12">
                                    <p class="menu-helper">There are no menus in Atsumaru yet.
                                    Please add new menu <a href="{{ route('menu') }}">here</a></p>
                                </div>
                            @endif
                                                       
                        </div>
                    </div>
                </div>

                <div id="form-select-menu-2" style="display: none;">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <span onclick="selectMenu(id)" style="cursor: pointer;"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</span>
                                <button class="btn btn-default pull-right" onclick="addToOrder()">Add to Order</button>
                                <span class="pull-right menuTitle" id="menuSelected" style="margin-right: 10px; margin-top: 5px;"></span>
                                <hr />
                            </div>
                        </div>

                        <div id="menus" style="max-height:350px; min-height:350px; overflow-y: scroll;" class="row">
                            <div class="col-md-12">
                                <label for="price" class="col-md-12 control-label">Price: Rp <span id="priceMenuSelected"></span>,00</label>
                            </div>
                            <div class="col-md-12">
                                <label for="quantity" class="col-md-12 control-label">Quantity</label>
                                <div class="col-md-1">
                                    <span onclick="decrementQuantity()" style="cursor: pointer;">
                                        <i class="fa fa-minus" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <input id="quantity" type="text" class="form-control" name="quantity" autocomplete="off" value="1">
                                </div>
                                <div class="col-md-1">
                                    <span onclick="incrementQuantity()" style="cursor: pointer;">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="col-md-12 control-label">Discount</label>
                                @if (count($promotions) > 0)
                                    @foreach ($promotions as $promotion)
                                        <div class="col-md-5 col-md-offset-1">
                                            <div>
                                                <input class="promotion-checkbox" type="checkbox" id="promotion{{ $promotion->id }}" discount="{{ $promotion->discount }}" onclick="onClickPromotion()" /> {{ $promotion->name }} ({{ $promotion->discount }}%)
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md-12">
                                        <p class="menu-helper">There are no promotions in Atsumaru yet.
                                        To add new promotions click <a href="{{ route('promotion') }}">here</a></p>
                                    </div>
                                @endif                     
                            </div>

                            <div class="col-md-12">
                                <label for="description" class="col-md-12 control-label">Description</label>
                                <div class="col-md-12">
                                    <textarea style="resize:none;" id="description" name="description" rows="5" cols="50"></textarea>
                                </div>  
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                Total: Rp<span class="menuTitle" id="totalPrice"></span>,00
                            </div>                                
                        </div>
                    </div> <!-- End of Form Select Menu 2 -->
                </div>          
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    function selectMenu(menuId) {
        $("#form-select-menu-1").toggle();
        $("#form-select-menu-2").toggle();
        if(menuId != "Back") {
            alt = $("#menu"+menuId).attr("alt")
            src = $("#menu"+menuId).attr("src")
            price = $("#menu"+menuId).attr("price")
            // console.log(alt)
            // console.log(src)
            $("#menuSelected").text(alt)
            $("#imgMenuSelected").attr("src",src)
            $("#priceMenuSelected").text(price)
            $("#totalPrice").text(price)
        }
    }

    function onClickPromotion() {
        $(".promotion-checkbox").each(function(index) {
            var id = $( this ).attr('id')
            // console.log(id)
            total_discount = 0
            if(document.getElementById(id).checked) {
                var discount = $( this ).attr('discount')
                console.log('id: '+id+ ' | discount: '+discount)
                total_discount += discount
            }
            calculateTotalPrice(total_discount)
        });
    }

    function calculateTotalPrice(total_discount) {
        original_price = $("#priceMenuSelected").text()
        discounted_price = original_price - (original_price*total_discount/100)
        $("#totalPrice").text(discounted_price)
    }

    function addToOrder() {

    }


    function validate(e) {
        if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
            var search_term = e.target.value.toLowerCase()

            // console.log('Searching: '+search_term)
            $(".menu-card").each(function(index) {
                var menu_name = $( this ).text().toLowerCase()
                // console.log('Menu: '+menu_name)
                if(menu_name.includes(search_term)) {
                    $(this).show()
                }
                else {
                    $(this).hide()   
                }
            });
        }
    }

    function isInt(value) {
        return !isNaN(value) && 
            parseInt(Number(value)) == value && 
            !isNaN(parseInt(value, 10));
    }

    function incrementQuantity() {
        var quantity = $('#quantity')
        var value = quantity.val()
        // console.log(value)
        if(isInt(value)) {
            quantity.val(parseInt(value)+1)
        }
        else {

        }
    }

    function decrementQuantity() {
        var quantity = $('#quantity')
        var value = quantity.val()
        // console.log(value)
        if(isInt(value)) {
            if(parseInt(value) > 1) {
                quantity.val(parseInt(value)-1)
            }
        }
        else {

        }
    }
</script>

<script src="{{ asset('js/selectize.js') }}"></script>
<script>
    $('#customer_name').selectize({
        create: true,
        sortField: 'text'
    });
</script>
@endsection