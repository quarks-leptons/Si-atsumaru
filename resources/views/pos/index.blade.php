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
                            <div class="col-md-3 menu-card">
                                <img id="menu1" src="https://placehold.it/100x100" alt="Iced Tea" class="img-thumbnail" 
                                style="cursor:pointer;" onclick="selectMenu(id)">
                                <br/>
                                <span>Iced Tea</span>
                            </div>
                            <div class="col-md-3 menu-card">
                                <img id="menu2" src="https://placehold.it/100x100" alt="Cireng" class="img-thumbnail" 
                                style="cursor:pointer;" onclick="selectMenu(id)">
                                <br/>
                                <span>Cireng</span>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div id="form-select-menu-2"  style="display: none; max-height:500px; min-height:500px; overflow-y: scroll;">
                    <div class="panel-body row">
                        <div class="col-md-12">
                            <p id="Back" onclick="selectMenu(id)" style="cursor: pointer;">Back</p>
                        </div>

                        <div class="col-md-4">
                            <img id="imgMenuSelected" class="img-thumbnail">
                        </div>      

                        <div class="col-md-8">
                            <h3 id="menuSelected"></h3>
                            <p>Price: Rp10.000,00</p>
                            <p>Stock: 10 buah</p>
                        </div>                  

                        <div class="col-md-12">
                            <label for="quantity" class="col-md-12 control-label">Quantity</label>
                            <div class="col-md-12">
                                <input id="quantity" type="text" class="form-control" name="quantity" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="col-md-12 control-label">Discount</label>
                            <div class="col-md-5 col-md-offset-1">
                                <div class="checkbox">
                                    <input type="checkbox"> Discount 1
                                </div>
                            </div>
                            <div class="col-md-5 col-md-offset-1">
                                <div class="checkbox">
                                    <input type="checkbox"> Discount 1
                                </div>
                            </div>
                            <div class="col-md-5 col-md-offset-1">
                                <div class="checkbox">
                                    <input type="checkbox"> Discount 1
                                </div>
                            </div>                        
                        </div>

                        <div class="col-md-12">
                            <label for="description" class="col-md-12 control-label">Description</label>
                            <div class="col-md-12">
                                <textarea id="description" name="description" rows="5" cols="50"></textarea>
                            </div>  
                        </div>

                        <div class="col-md-offset-9 col-md-3">
                            <br />
                            <button class="btn btn-default">Add to Order</button>
                        </div>
                    </div> <!-- End of Form Select Menu 2 -->
                </div>          
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function selectMenu(menuId) {
        $("#form-select-menu-1").toggle();
        $("#form-select-menu-2").toggle();
        if(menuId != "Back") {
            alt = $("#"+menuId).attr("alt")
            src = $("#"+menuId).attr("src")
            console.log(alt)
            console.log(src)
            $("#menuSelected").text(alt)
            $("#imgMenuSelected").attr("src",src)
        }
    }


    function validate(e) {
        if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
            var search_term = e.target.value.toLowerCase()

            console.log('Searching: '+search_term)
            $(".menu-card").each(function(index) {
                var menu_name = $( this ).text().toLowerCase()
                console.log('Menu: '+menu_name)
                if(menu_name.includes(search_term)) {
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
