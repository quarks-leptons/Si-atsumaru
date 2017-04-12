@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-6">
            <div class="panel panel-default">
                <div class="panel-heading">NEW ORDER</div>

                <div class="panel-body" style="max-height:500px; min-height:500px">
                    <!-- Form New Order -->
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('addOrder') }}" id="addOrderForm">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('customer_name') ? ' has-error' : '' }}">
                            <label for="customer_name" class="col-md-4 control-label">Customer</label>

                            <div class="col-md-6">
                                <select id="customer_name" name="customer_name" class="" required autofocus>
                                    @if (count($customers) > 0)
                                        @foreach ($customers as $customer)
                                            <option class="old_customer" value="{{ $customer->id }}">{{ $customer->name }}</option>
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
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Menu</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Description</th>
                                        <th></th> <!-- Edit Button -->
                                        <th></th> <!-- Delete Button -->
                                    </tr>
                                </thead>
                                <tbody id="purchases">
                                </tbody>
                            </table>
                            <input type="hidden" name="count_menu" id="count_menu" value="0">

                    </form> <!-- End of Form New Order -->
                    <div class="form-group" style="position: absolute; bottom: 20px;">
                        <div class="col-md-6">
                            <button class="btn btn-primary" id="save_order" onclick="saveOrder()">
                                Save Order
                            </button>
                        </div>
                        <div class="col-md-6">
                            Total: Rp<span id="totalOrderPrice">0</span>,00
                        </div>
                    </div>
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
                                <span id="menu_id"></span>
                                <button id="add_to_order" class="btn btn-default pull-right" onclick="addToOrder()">Add to Order</button>
                                <button id="save_changes" class="btn btn-success pull-right" onclick="saveChanges()">Save Changes</button>
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
                                                <input class="promotion-checkbox" type="checkbox" id="promotion{{ $promotion->id }}" discount="{{ $promotion->discount }}" onclick="updateTotalPrice()" /> {{ $promotion->name }} ({{ $promotion->discount }}%)
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
                                <span class="menuTitle">
                                    Total: Rp<span id="totalPrice"></span>,00
                                </span>
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
    // 'Getters'
    function getTotalDiscount() {
        total_discount = 0
        $(".promotion-checkbox").each(function(index) {
            var id = $( this ).attr('id')
            // console.log(id)
            if(document.getElementById(id).checked) {
                var discount = parseInt($( this ).attr('discount'))
                // console.log('id: '+id+ ' | discount: '+discount)
                total_discount += discount
            }
        });
        console.log(total_discount)
        return total_discount
    }

    function getQuantity() {
        return $("#quantity").val()
    }

    function getTotalPrice() {
        return $("#totalPrice").text()
    }

    function getDescription() {
        return $("#description").val()   
    }

    function getMenuName() {
        return $("#menuSelected").text()
    }

    function getOriginalPrice() {
        return $("#priceMenuSelected").text()   
    }

    function getPromotions() {
        var discounts = []
        $(".promotion-checkbox").each(function(index) {
            var id = $( this ).attr('id')
            // console.log(id)
            if(document.getElementById(id).checked) {
                id = id.slice(9)
                console.log('id: '+id)
                discounts.push(id)
            }
        });
        return discounts
    }

    function countNewItems() {
        count = 0
        $(".new-item").each(function(index) {
            count++
        });
        return count
    }

    // 'Setters'
    function setMenuName(menu_name) {
        $("#menuSelected").text(menu_name)
    }

    function setMenuImgSrc(src) {
        $("#imgMenuSelected").attr("src",src)
    }

    function setOriginalPrice(price) {
        $("#priceMenuSelected").text(price)
    }

    function setTotalPrice(total_price) {
        $("#totalPrice").text(total_price)
    }

    function setDescription(description) {
        $("#description").val(description)
    }

    function setTotalOrderPrice(price) {
        $("#totalOrderPrice").text(price)
    }




    function toggleForm() {
        $("#form-select-menu-1").toggle();
        $("#form-select-menu-2").toggle();
    }


    function selectMenu(menuId) {
        toggleForm()
        // console.log(menuId)

        if(menuId != "") {
            $('#save_changes').hide()
            $('#add_to_order').show()
            alt = $("#menu"+menuId).attr("alt")
            src = $("#menu"+menuId).attr("src")
            price = $("#menu"+menuId).attr("price")
            // console.log(alt)
            // console.log(src)
            $('#menu_id').attr('value', menuId)
            setMenuName(alt)
            setMenuImgSrc(src)
            setOriginalPrice(price)
            setTotalPrice(price)
            setDescription("")
            // Uncheck all promotions checkboxs
            $(".promotion-checkbox").each(function(index) {
                $(this).prop('checked', false)
            });
            // Reset quantity to 1
            $("#quantity").val(1)
        }
        else {
            // Back button is pressed
            resetColorTableRow()
            showAllButtons()
            $('#save_order').removeClass('disabled')
            var selectize = $select[0].selectize;
            selectize.enable()
        }
    }

    function saveOrder() {
        customer_name = $('#customer_name')
        // console.log(customer_name)
        if(customer_name.val() == "") {
            console.log("Customer name empty")
        }
        else {
            count = 0
            $(".new-item").each(function(index) {
                count++
            });
            if(count == 0) {
                console.log("Order is empty")
            }
            else {
                $('#addOrderForm').submit();
                // if(customer_name.hasClass('old_customer')) {
                //     console.log("Old customer")
                // }
                // else {
                //     console.log("New customer")   
                // }
            }
        }
    }

    // Source: http://stackoverflow.com/questions/2901102/how-to-print-a-number-with-commas-as-thousands-separators-in-javascript
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function updateTotalPrice() {
        total_discount = getTotalDiscount()
        quantity = getQuantity()
        calculateTotalPrice(total_discount, quantity)
    }

    function updateTotalOrderPrice() {
        sum = 0;
        $(".new-item").each(function(index) {
            price = $(this).children().eq(4)
            sum += parseInt(price.text())
        });
        setTotalOrderPrice(sum)
    }

    function calculateTotalPrice(total_discount, quantity) {
        original_price = getOriginalPrice()
        price_quantity = original_price * quantity
        discounted_price = price_quantity - (price_quantity*total_discount/100)
        $("#totalPrice").text(discounted_price)
    }

    function addToOrder() {
        menu_id = $('#menu_id').attr('value')
        menu_name = getMenuName()
        original_price = getOriginalPrice()
        quantity = getQuantity()
        total_price = getTotalPrice()
        promotions = getPromotions()
        description = getDescription()
        // console.log(quantity)
        // console.log(total_price)
        // console.log(description)
        addToList(menu_id, menu_name, original_price, quantity, total_price, description, promotions)
        updateTotalOrderPrice()
        toggleForm()
    }

    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    function addToList(menu_id, menu_name, original_price, quantity, total_price, description, promotions) {
        no = countNewItems() + 1
        $('#count_menu').val(no)
        id = getRandomInt(0,1000000)
        delete_button = '<span onclick="removeFromList(id)" id="'+id+'" style="cursor: pointer;"><i class="fa fa-trash" aria-hidden="true"></i></span>'
        edit_button = '<span onclick="editMenu(id)" id="'+id+'" style="cursor: pointer;"><i class="fa fa-pencil" aria-hidden="true"></i></span>'

        td_no = '<td>'+no+'</td>'
        td_menu = '<td>'+menu_name+'</td>'
        td_price = '<td>'+original_price+'</td>'
        td_quantity = '<td>'+quantity+'</td>'
        td_total = '<td>'+total_price+'</td>'
        td_description = '<td>'+description+'</td>'
        td_edit_button = '<td>'+edit_button+'</td>'
        td_delete_button = '<td>'+delete_button+'</td>'

        new_item = '<tr class="new-item">'
            +td_no
            +td_menu
            +td_price
            +td_quantity
            +td_total
            +td_description
            +td_edit_button
            +td_delete_button
            +'</tr>'

        $('#purchases').append(new_item)

        new_hidden = '<input type="hidden" name="menu'+no+'" id="menu'+no+'" value="'+menu_id+';'+quantity+';'+promotions.join()+';'+description+'"></input>'
        $('#purchases').append(new_hidden)
    }

    function removeFromList(id) {
        // console.log(id)
        row = $('#'+id).parent().parent()
        row.remove()
        rewriteTableNo()
        updateTotalOrderPrice()
    }

    function saveChanges() {
        // find item being changed
        $(".new-item").each(function(index) {
            if($(this).hasClass('info')) {
                changed_item = $(this)
            }
        });
        td_quantity = changed_item.children().eq(3)
        td_quantity.text(getQuantity())
        td_total_price = changed_item.children().eq(4)
        td_total_price.text(getTotalPrice())
        td_description = changed_item.children().eq(5)
        td_description.text(getDescription())
        toggleForm()
        resetColorTableRow()
        showAllButtons()
        $('#save_order').removeClass('disabled')
        var selectize = $select[0].selectize;
        selectize.enable()

        updateTotalOrderPrice()
    }

    function rewriteTableNo() {
        count = 1;
        $(".new-item").each(function(index) {
            $(this).children(':first').text(count)
            count++
        });
    }

    function colorBlueTableRow(id) {
        row = $('#'+id).parent().parent()
        row.addClass('info')
    }

    function resetColorTableRow() {
        $(".new-item").each(function(index) {
            $(this).removeClass('info')
        });
    }

    function hideAllButtons() {
        $(".new-item").each(function(index) {
            edit_button = $(this).children().eq(6).children().eq(0)
            // console.log(edit_button)
            edit_button.hide()
            delete_button = $(this).children().eq(7).children().eq(0)
            // console.log(delete_button)
            delete_button.hide()
        });
    }
    function showAllButtons() {
        $(".new-item").each(function(index) {
            edit_button = $(this).children().eq(6).children().eq(0)
            // console.log(edit_button)
            edit_button.show()
            delete_button = $(this).children().eq(7).children().eq(0)
            // console.log(delete_button)
            delete_button.show()
        });
    }

    function editMenu(id) {
        // console.log("editMenu: "+id)
        colorBlueTableRow(id)
        if($("#form-select-menu-1").is(":visible")) {
            toggleForm()
        }

        // Disable all other buttons
        hideAllButtons()
        $('#save_order').addClass('disabled')
        $('#save_order').addClass('disabled')
        var selectize = $select[0].selectize;
        selectize.disable()
        $('#save_changes').show()
        $('#add_to_order').hide()

        row = $('#'+id).parent().parent()        
        row.children().each(function(index) {
            if(index == 1) { // menu name
                menu_name = $(this).text()
            }
            else if(index == 2) { // original price
                original_price = $(this).text()
            }
            else if(index == 3) { // quantity
                quantity = $(this).text()
            }
            else if(index == 4) { // total_price
                total_price = $(this).text()
            }
            else if(index == 5) { // description
                description = $(this).text()
            } 
        })
        $('#menu_id').attr('value', menuId)
        setMenuName(menu_name)
        // setMenuImgSrc(src)
        setOriginalPrice(original_price)
        setTotalPrice(total_price)
        setDescription(description)
        // // Uncheck all promotions checkboxs
        // $(".promotion-checkbox").each(function(index) {
        //     $(this).prop('checked', false)
        // });
        $("#quantity").val(quantity)
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
            updateTotalPrice()
        }
    }

    function decrementQuantity() {
        var quantity = $('#quantity')
        var value = quantity.val()
        // console.log(value)
        if(isInt(value)) {
            if(parseInt(value) > 1) {
                quantity.val(parseInt(value)-1)
                updateTotalPrice()
            }
        }
    }
</script>

<script src="{{ asset('js/selectize.js') }}"></script>
<script>
    var $select = $('#customer_name').selectize({
        create: true,
        sortField: 'text'
    });
</script>
@endsection