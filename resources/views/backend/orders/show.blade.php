@extends('backend.layout.master')
@section('backend-head')
    <link href="{{ asset('backend') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <style>
        #map-canvas {
            width: 100%;
            height: 350px;
        }
        #pac-input {
            z-index: 0 !important;
            position: absolute !important;
            top: 0px !important;
            left: 0 !important;
            width: 100% !important;
            height: 40px !important;
            padding: 0 6px !important;
            border: 2px solid #ce8483 !important;
            border-radius: 3px!important;
        }
    </style>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAbukNOXKPE1M-2Duze7aLXcRLguKXbJQ&libraries=places&sensor=false"></script>
@endsection
@section('backend-main')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Order No {{ $order->order_no }}</h4>
                    <p class="card-title-desc"></p>
                    <hr>
                    <div class="table-responsive">
                        <h4>
                            Order Main Informations
                        </h4>
                        <table class="table table-nowrap mb-0">
                            <tbody>
                            <tr>
                                <th scope="row" style="width: 400px;">User Name</th>
                                <td>{{ $order->user->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">City</th>
                                <td>{{ $order->city->name_ar }} / {{ $order->city->name_en }}</td>
                            </tr>
                            <tr>
                                <th scope="row">FullName</th>
                                <td>{{ $order->fullname }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Street Address</th>
                                <td>{{ $order->street_address }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Building no</th>
                                <td>{{ $order->building_no }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Area</th>
                                <td>{{ $order->area }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Phone</th>
                                <td>{{ $order->phone }}</td>
                            </tr>
                            @if($order->status == 0 || $order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4)
                                <tr>
                                    <th scope="row">signed</th>
                                    <td>{{ \Carbon\Carbon::parse($order->date)->format('d M Y') }} / {{ \Carbon\Carbon::parse($order->time)->format('h:i A') }}</td>
                                </tr>
                            @endif
                            @if($order->status == 1 || $order->status == 2 || $order->status == 3 || $order->status == 4)
                                <tr>
                                    <th scope="row">processed</th>
                                    <td>{{ \Carbon\Carbon::parse($order->processed)->format('d M Y') }} / {{ \Carbon\Carbon::parse($order->processed)->format('h:i A') }}</td>
                                </tr>
                            @endif
                            @if($order->status == 2 || $order->status == 3 || $order->status == 4)
                                <tr>
                                    <th scope="row">shipped</th>
                                    <td>{{ \Carbon\Carbon::parse($order->shipped)->format('d M Y') }} / {{ \Carbon\Carbon::parse($order->shipped)->format('h:i A') }}</td>
                                </tr>
                            @endif
                            @if($order->status == 3 || $order->status == 4)
                                <tr>
                                    <th scope="row">out to delivery</th>
                                    <td>{{ \Carbon\Carbon::parse($order->out_to_delivery)->format('d M Y') }} / {{ \Carbon\Carbon::parse($order->out_to_delivery)->format('h:i A') }}</td>
                                </tr>
                            @endif
                            @if($order->status == 4)
                                <tr>
                                    <th scope="row">signed</th>
                                    <td>{{ \Carbon\Carbon::parse($order->delivered)->format('d M Y') }} / {{ \Carbon\Carbon::parse($order->delivered)->format('h:i A') }}</td>
                                </tr>
                            @endif
                            <tr>
                                <th class="text-danger" scope="row">Total Price</th>
                                <td class="text-danger">{{ $order->total_price }} QAR</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <h4>
                            Order Products
                        </h4>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Count</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->pays as $pay)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td width="100" height="100">
                                        @if(isset($pay->product->mainImage))
                                            <img style="width: 100%;border-radius: 10px" src="{{ asset('pictures/products/' . $pay->product->mainImage->image) }}"/>
                                        @else
                                            <img style="width: 100%;border-radius: 10px" src="{{ asset('backend/assets/images/empty.jpg') }}"/>
                                        @endif
                                    </td>
                                    <td>{{ $pay->product->name_ar }} <br> {{ $pay->product->name_en }}</td>
                                    <td>{{ $pay->product->code }}</td>
                                    <td style="background: {{ $pay->color->color }}">{{ $pay->color->name_ar }} <br> {{ $pay->color->name_en }}</td>
                                    <td>
                                        {{ $pay->size->code }}
                                    </td>
                                    <td>
                                        {{ $pay->count }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <?php
                            $address = \App\Models\Address::where('user_id' , $order->user_id)->where('building_no',$order->building_no)->where('street_address',$order->street_address)->first();
                        ?>
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Location</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if(isset($address))
                                            <div id="map-canvas"></div>
                                            <input id="pac-input"  type="text" placeholder="Search here....">
                                            <input type="hidden" id="lat" name="lat" value="{{ $address->lat }}" required>
                                            <input type="hidden" id="lng" name="lng" value="{{ $address->lng }}" required>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                    <hr>
                    <form method="post" action="{{ route('orders.update' , $order->id) }}" class="needs-validation" novalidate>
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="row">
                            <div class="col-md-12 ml-auto">
                                <div class="mt-4 mt-lg-0">
                                    <h5 class="font-size-14 mb-4">Trucking Status</h5>
                                    <div class="custom-control custom-radio mb-3">
                                        <input @if($order->status == 0) checked @endif type="radio" id="customRadio1" name="status" value="0" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio1">signed</label>
                                    </div>
                                    <div class="custom-control custom-radio mb-3">
                                        <input @if($order->status == 1) checked @endif type="radio" id="customRadio2" name="status" value="1" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio2">processed</label>
                                    </div>
                                    <div class="custom-control custom-radio mb-3">
                                        <input @if($order->status == 2) checked @endif type="radio" id="customRadio3" name="status" value="2" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio3">shipped</label>
                                    </div>
                                    <div class="custom-control custom-radio mb-3">
                                        <input @if($order->status == 3) checked @endif type="radio" id="customRadio4" name="status" value="3" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio4">out to delivery</label>
                                    </div>
                                    <div class="custom-control custom-radio mb-3">
                                        <input @if($order->status == 4) checked @endif type="radio" id="customRadio5" name="status" value="4" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio5">delivered</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="delivery_id">Delivery Captain</label>
                                    <select name="delivery_id" class="form-control" id="delivery_id" required>
                                        <option value="" disabled="" hidden @if(empty($order->delivery_id)) selected @endif>Choose delivery</option>
                                        @foreach($dels as $del)
                                            <option
                                                    @if($del->id == $order->delivery_id) selected @endif
                                            value="{{ $del->id }}">{{ $del->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('delivery_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Save</button>
                        <a style="float: right" href="{{ route('orders.index') }}" class="btn btn-warning" type="submit">Back</a>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection
@section('backend-footer')
    <script src="{{ asset('backend') }}/assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/pages/form-validation.init.js"></script>
    <script src="{{ asset('backend') }}/mine.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/select2/js/select2.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/pages/form-advanced.init.js"></script>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.2.0/firebase-app.js"></script>

    <script src="https://www.gstatic.com/firebasejs/8.2.0/firebase-analytics.js"></script>
    <script>
        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        var firebaseConfig = {
            apiKey: "AIzaSyDq86Bkx3Y2zaZbAQCNSc6FeeJ_8A_fwzo",
            authDomain: "najlaboutique2021.firebaseapp.com",
            databaseURL: "https://najlaboutique2021.firebaseio.com",
            projectId: "najlaboutique2021",
            storageBucket: "najlaboutique2021.appspot.com",
            messagingSenderId: "134240189270",
            appId: "1:134240189270:web:b2caa55ba1151926e634f7",
            measurementId: "G-WVYRCNK7DK"
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        firebase.analytics();
    </script>
    @if(isset($address))
    <script>
        var map = new google.maps.Map(document.getElementById('map-canvas'),{
            center:{
                lat: {{ $address->lat }},
                lng: {{ $address->lng }},
            },
            zoom:15
        });
        var marker = new google.maps.Marker({
            position: {
                lat: {{ $address->lat }},
                lng: {{ $address->lng }},
            },
            map: map,
            draggable: true
        });
        var searchBox = new google.maps.places.SearchBox(document.getElementById('pac-input'));
        google.maps.event.addListener(searchBox,'places_changed',function(){
            var places = searchBox.getPlaces();
            var bounds = new google.maps.LatLngBounds();
            var i, place;
            for(i=0; place=places[i];i++){
                bounds.extend(place.geometry.location);
                marker.setPosition(place.geometry.location); //set marker position new...
            }
            map.fitBounds(bounds);
            map.setZoom(15);
        });
        google.maps.event.addListener(marker,'position_changed',function(){
            var lat = marker.getPosition().lat();
            var lng = marker.getPosition().lng();
            $('#lat').val(lat);
            $('#lng').val(lng);
        });
    </script>
    @endif
@endsection
