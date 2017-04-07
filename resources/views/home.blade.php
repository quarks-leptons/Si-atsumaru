@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Dashboard</h3></div>

                <div class="panel-body">
                    <div class="col-md-6">
                        <a href="/img/chartExample.jpg" target=_blank><img src="/img/chartExample.jpg" class="resize"></a>
                    </div>
                    <div class="col-md-6">
                        <a href="/img/PieChartExample.png" target=_blank><img src="/img/PieChartExample.png" class="resize"></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <label class="col-md-4 control-label" name="activity"><h3>Latest Activities</h3></label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row col-md-offset-1">
                                <div class="col-md-5">
                                    <b>Menu</b>
                                </div>
                                <div class="col-md-2"> 
                                    <b>Quantity</b>
                                </div>
                                <div class="col-md-3"> 
                                    <b>Time</b>
                                </div>
                            </div>  
                            <div class="row col-md-offset-1">
                                <div class="col-md-5">
                                    Iced Tea
                                </div>
                                <div class="col-md-2"> 
                                    5
                                </div>
                                <div class="col-md-4"> 
                                    2017-04-07 03:31
                                </div>
                            </div>
                            <div class="row col-md-offset-1">
                                <div class="col-md-5">
                                    Cappucino
                                </div>
                                <div class="col-md-2"> 
                                    2
                                </div>
                                <div class="col-md-4"> 
                                    2017-04-07 02:20                                    
                                </div>
                            </div>
                            <div class="row col-md-offset-1">
                                <div class="col-md-5">
                                    Espresso
                                </div>
                                <div class="col-md-2"> 
                                    1
                                </div>
                                <div class="col-md-4"> 
                                    2017-04-07 01:45                                    
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="row">
                        <label class="col-md-4 control-label" name="inventory"><h3>Inventories</h3></label>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row col-md-offset-1">
                                <div class="col-md-5">
                                    <b>Menu</b>
                                </div>
                                <div class="col-md-2"> 
                                    <b>Stock</b>
                                </div>
                            </div>  
                            @foreach ($inventories as $inventory)
                            <div class="row col-md-offset-1">
                                <div class="col-md-5">
                                    {{$inventory->name}}
                                </div>
                                <div class="col-md-2"> 
                                    <font color="red"> {{$inventory->stock}}  </font>
                                </div>
                            </div>
                            @endforeach
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

