@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Menu</h3></div>


                <div class="panel-body">

                    <div class="col-md-12" style="overflow: hidden;">
                        <div class="page-header" style="margin-top: 20px;">
                         <h4>Add New Menu</h4>
                        </div>
                        
                        <form class="form-horizontal" role="form" method="POST" action="{{action('MenuController@addMenu')}}" onkeydown="validate_enter(event)">
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

                            <div class=form-group>
                                <label for="name" class="col-md-2">Inventories</label>
                                <div class="col-md-10">
                                <div class="col-md-12" style="border: 1px solid #ccd0d2; border-radius: 4px; padding:10px;">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input id="madeof_name" type="text" class="form-control input-sm" name="madeof_name" onkeydown="validate_madeof(event)" autocomplete="off">
                                            <span class="input-group-addon"><span class="fa fa-search" aria-hidden="true"></span></span>
                                        </div>
                                    </div>
                                    @foreach ($inventories as $inventori)
                                    <div class="inventori col-md-3" style="display: inline-block; position: relative; margin:10px;">
                                         <div class="input-group">
                                          <span class="input-group-addon">
                                                <input type="checkbox" aria-label="Checkbox for following text input"  onchange="inv_checked(event)" name="madeof" value="{{ $inventori->id }}" name="madeof[]">
                                          </span>
                                          <span class="input-group-addon">{{ $inventori->name }}</span>
                                          <input type="number" class="form-control" aria-label="Text input with checkbox" id="madeof_{{ $inventori->id }}" name="madeof_{{ $inventori->id }}" disabled="">
                                        </div>
                                                 
                                    </div>
                                    @endforeach
                                </div>
                                </div>
                            </div>
                            <input type=submit class="btn btn-primary" value="Add New Menu" style="float:right;"/>
                        </form>
                    </div>  

                
                    <div class="col-md-12 search_bar">
                     <div class="page-header" style="margin-top: 20px;">
                         <h4>List of Menu</h4>
                        </div>
                        <label for="menu_name" class="col-md-2 control-label">Search Menu</label>
                            <div class="col-md-10">
                                <input id="menu_name" type="text" class="form-control" name="menu_name" onkeydown="validate(event)" autocomplete="off">
                            </div>
                    </div>

                    <div class="col-md-12 data_table">
                        <table class="table table-condensed">
                            <tr>
                                <th>Name</th>
                                <th>Price</th> 
                                <th>Stock status</th>
                            </tr>
                            @foreach ($menus as $menu)
                            <tr class="menus-card">
                                <td>{{$menu->name}}</td>
                                <td>{{$menu->price}}</td> 
                                <td><span class="label label-success">in stock</span></td>
                            </tr>
                            @endforeach
                        </table>
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
            $(".menus-card").each(function(index) {
                var menu_name = $( this ).text().toLowerCase()
                if(menu_name.includes(search_term)) {
                    $(this).show()
                }
                else {
                    $(this).hide()   
                }
            });
        }
    }

    function validate_madeof(e) {
        if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
            var search_term = e.target.value.toLowerCase()

            console.log('Searching: '+search_term)
            $(".inventori").each(function(index) {
                var inv_name = $( this ).text().toLowerCase()
                if(inv_name.includes(search_term)) {
                    $(this).show()
                }
                else {
                    $(this).hide()   
                }
            });
        }
    }
     function validate_enter(e) {
        if(e.keyCode == 13) {
          e.preventDefault();
          return false;
        }
    }

    function inv_checked(e){
        var id = e.target.value.toLowerCase();
        $('#madeof_'+id).prop('disabled', !($(e.target).is(":checked")));
    }
</script>
@endsection
