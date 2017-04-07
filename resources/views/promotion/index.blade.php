@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Promotion</h3></div>

                <div class="panel-body">
                    <div class="row">
                        <label for="menu_name" class="col-md-2 control-label">Search Promotion</label>
                        <div class="col-md-10">
                            <input id="menu_name" type="text" class="form-control" name="menu_name" onkeydown="validate(event)" autocomplete="off">
                        </div>
                    </div>
                    <br>

                    <div class="col-md-4">
                        <h4>Add Promotion</h4>
                        <form class="form-horizontal" role="form" method="POST" action="{{action('PromotionController@addPromotion')}}">
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
                                <label for="discount" class="col-md-2">Discount</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="number" name="discount" />
                                </div>
                            </div>
                            @if ($errors->has('discount'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('discount') }}</strong>
                                </span>
                            @endif

                            <div class=form-group>
                                <label for="name" class="col-md-2">Valid Until</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="datetime-local" name="valid_until" value="<?php date_default_timezone_set("Asia/Jakarta");echo date("Y-m-d")." ".date("h:i"); ?>"/>
                                </div>
                            </div>
                            @if ($errors->has('valid_until'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('valid_until') }}</strong>
                                </span>
                            @endif
                            <input type=submit class="btn btn-primary" value="Add Promotion"/>
                        </form>
                    </div>  

                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-6">
                                <b>Name</b>
                            </div>
                            <div class="col-md-2"> 
                                <b>Discount</b>
                            </div>
                            <div class="col-md-2"> 
                                <b>Valid Until</b>
                            </div>
                        </div>
                    @foreach ($promotions as $promotion)
                        <div class="row promotion-card" >
                            <div class="col-md-6">
                                {{$promotion->name}}
                            </div>
                            <div class="col-md-2"> 
                                {{$promotion->discount}}
                            </div>
                            <div class="col-md-2"> 
                                {{$promotion->valid_until}}
                            </div>
                            <div class="col-md-1">
                                @include('promotion.edit_promotion',[
                                    "id" => $promotion->id,
                                    "name" => $promotion->name,
                                    "discount" => $promotion->discount,
                                    "valid_until" => $promotion->valid_until,
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
            $(".promotion-card").each(function(index) {
                var promotion_name = $( this ).text().toLowerCase()
                if(promotion_name.includes(search_term)) {
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

