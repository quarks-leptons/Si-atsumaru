@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Inventory {{$inventory_id}}</div>

                <div class="panel-body">
                    You are in Inventory {{$inventory_id}}!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
