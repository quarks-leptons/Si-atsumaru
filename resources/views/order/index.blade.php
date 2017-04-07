@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <!-- <div class="panel-heading">Order</div> -->

                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#all_orders">All Orders</a></li>
                        <li><a data-toggle="tab" href="#ongoing">Ongoing</a></li>
                        <li><a data-toggle="tab" href="#completed">Completed</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="all_orders" class="tab-pane fade in active">
                            <h3>All Orders</h3>
                            <p>Some content.</p>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Customer</th>
                                            <th>Waktu Order</th>
                                            <th>Order</th>
                                            <th>Harga</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Majid</td>
                                            <td>10 April 2017</td>
                                            <td>Keju Enak</td>
                                            <td>10.000</td>
                                            <td>Ongoing</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Majid</td>
                                            <td>10 April 2017</td>
                                            <td>Ice Tea</td>
                                            <td>20.000</td>
                                            <td>Ongoing</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Hasan</td>
                                            <td>10 April 2017</td>
                                            <td>Lemon Tea</td>
                                            <td>20.000</td>
                                            <td>Ongoing</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="ongoing" class="tab-pane fade">
                            <h3>Ongoing Orders</h3>
                            <p>Some content in menu 1.</p>
                        </div>
                        <div id="completed" class="tab-pane fade">
                            <h3>Completed Orders</h3>
                            <p>Some content in menu 2.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
