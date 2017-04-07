@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Inventory</h3></div>

                <div class="panel-body">
                    <div class="col-md-4">
                        <div class="page-header" style="margin-top: 20px;">
                             <h4>Add New Inventory</h4>
                        </div>
                        <form class="form-horizontal" role="form" method="POST" action="{{action('InventoryController@addInventory')}}">
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
                                <label for="stock" class="col-md-2">Stock</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="number" name="stock" />
                                </div>
                            </div>
                            @if ($errors->has('stock'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('stock') }}</strong>
                                </span>
                            @endif

                            <div class=form-group>
                                <label for="name" class="col-md-2">Price</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="number" name="price" />
                                </div>
                            </div>
                            @if ($errors->has('price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                            @endif
                            <input type=submit class="btn btn-primary" value="Add Inventory"/>
                        </form>
                    </div>  

                    <div class="col-md-8">
                        <div class="page-header" style="margin-top: 20px;">
                                 <h4>List of Inventory</h4>
                        </div>
                        <div class="col-md-12">
                            <label for="menu_name" class="col-md-2 control-label">Search Menu</label>
                            <div class="col-md-10">
                                <input id="menu_name" type="text" class="form-control" name="menu_name" onkeydown="validate(event)" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-12 data_table">
                            <table class="table table-condensed">
                                <tr>
                                    <th>Name</th>
                                    <th>Stock</th> 
                                    <th>Price</th>
                                    <th></th>
                                </tr>
                                @foreach ($inventories as $inventory)
                                <tr class="inventory-card">
                                    <td>{{$inventory->name}}</td>
                                    <td>{{$inventory->stock}}</td> 
                                    <td>{{$inventory->price}}</td>
                                    <td>
                                         <div class="col-md-offset-4 col-md-4">
                                            @include('inventory.edit_inventory',[
                                                "id" => $inventory->id,
                                                "name" => $inventory->name,
                                                "stock" => $inventory->stock,
                                                "price" => $inventory->price,
                                            ])
                                        </div>
                                       <div class="col-md-4">
                                            <i class="fa fa-trash-o" style="color:red" aria-hidden="true"></i>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
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
            $(".inventory-card").each(function(index) {
                var inventory_name = $( this ).text().toLowerCase()
                if(inventory_name.includes(search_term)) {
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

