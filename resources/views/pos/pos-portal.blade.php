@extends('pos.layout.pos-app')
@section('content')
    <div class="container">
        <div class="row" style="margin-top: 30px;">

           @foreach($center_details as $center_details)
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow-sm p-3 mb-5 bg-white rounded">
                                    <div class="card-header" style="background: white">
                                        <h4 style="font-size: 18px;">{{ $center_details->center_name }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <div style="background: #ffebd7;border-radius: 9px;font-size: 11px;padding-top: 10px;padding-bottom: 10px;padding-left: 10px;padding-right: 10px;">
                                            <label>Address</label>
                                            <p>{{ $center_details->address }}</p>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div style="border-radius: 9px;font-size: 11px;margin-top: 10px;">
                                                    <label>Email</label>
                                                    <p>{{ $center_details->email }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div style="border-radius: 9px;font-size: 11px;margin-top: 10px;">
                                                    <label>Phone</label>
                                                    <p>{{ $center_details->phone }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="{{url('pos/'.$center_details->id)}}" type="button" class="btn btn-primary btn-sm">Select POS</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            @endforeach


        </div>
    </div>



@endsection
