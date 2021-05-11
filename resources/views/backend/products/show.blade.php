@extends('backend.layout.master')
@section('backend-head')
    <style>

        /* The device with borders */
        .smartphone {
            position: relative;
            width: 400px;
            height: 850px;
            margin: auto;
            border: 16px black solid;
            border-top-width: 60px;
            border-bottom-width: 60px;
            border-radius: 36px;
        }

        .main-content .content {
            padding: 0;
            margin-top: 0;

        }

        /* The horizontal line on the top of the device */
        .smartphone:before {
            content: '';
            display: block;
            width: 60px;
            height: 5px;
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #333;
            border-radius: 10px;
        }

        /* The circle on the bottom of the device */
        .smartphone:after {
            content: '';
            display: block;
            width: 35px;
            height: 35px;
            position: absolute;
            left: 50%;
            bottom: -65px;
            transform: translate(-50%, -50%);
            background: #333;
            border-radius: 50%;
        }

        /* The screen (or content) of the device */
        .smartphone .content {
            background: #f5f6f8;
            height: 100%;
            overflow: hidden;
        }

        .carousel-indicators li {
            width: 10px;
            height: 10px;
            border-radius: 100%;
        }

        ol {
            margin-bottom: 0rem;
        }

        .nav-pills > li > a {
            font-weight: bolder;
            color: #727c8e;
        }

        .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
            color: #fff;
            background-color: transparent;
            color: #97805b;
            border: 1px solid #97805b;
            border-radius: 20px;
        }

        ul.nav {
            background: white;
        }

        h6 {
            margin: 0 10px;
            display: inline-block;
        }
    </style>
@endsection
@section('backend-main')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Show Product ( {{ $product->name_en }} ) before Post</h4>
                    <p class="card-title-desc"></p>
                    <div class="smartphone">
                        <div class="content">
                            <div style="width:100%;border:none;height:100%">
                                <img style="width: 100%" src="{{ asset('backend/assets/images/top-navigation.png') }}">
                                <div style="width: 100%;height: 250px" id="carouselExampleFade"
                                     class="carousel slide carousel-fade" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        @foreach($product->subImages as $key => $slider)
                                            <li data-target="#carouselExampleFade" data-slide-to="{{ $key }}"
                                                class="{{$key == 0 ? 'active' : '' }}"></li>
                                        @endforeach
                                    </ol>
                                    <div style="height: 250px" class="carousel-inner">
                                        @foreach($product->subImages as $key => $slider)
                                            <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                                                <img style="height: 250px;width: 100%" class="d-block img-fluid"
                                                     src="{{ asset('pictures/products/' . $slider->image) }}"
                                                     alt="{{ $product->name_en }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <ul class="nav nav-pills pb-3 justify-content-center pt-3" id="pills-tab"
                                        role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill"
                                               href="#pills-home" role="tab" aria-controls="pills-home"
                                               aria-selected="true">Product</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill"
                                               href="#pills-profile" role="tab" aria-controls="pills-profile"
                                               aria-selected="false">Details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill"
                                               href="#pills-contact" role="tab" aria-controls="pills-contact"
                                               aria-selected="false">Size guide</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                             aria-labelledby="pills-home-tab">
                                            <img style="width: 100%"
                                                 src="{{ asset('backend/assets/images/social.png') }}">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-12 mb-1">
                                                        <h5>{{ $product->name_en }}
                                                            - {{ $product->category->name_en }}</h5>
                                                        @if(!empty($product->discount_price))
                                                            <h6 style="text-decoration: line-through;font-weight: bolder;color: #919191">{{ $product->price }}
                                                                QAR</h6>
                                                            <h6 style="font-weight: bolder;color:#9c8663">{{ $product->discount_price }}
                                                                QAR</h6>
                                                            <span style="font-weight: bolder;color: #c20101;border: 1px solid #c6bba9;padding:2px">- {{ $product->percentage_discount }}</span>
                                                        @else
                                                            <h6 style="font-weight: bolder;color:#9c8663">{{ $product->price }}
                                                                QAR</h6>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <img style="width: 100%"
                                                 src="{{ asset('backend/assets/images/color.png') }}">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-12 mb-1">
                                                        <?php
                                                        $colors = \App\Models\ProductColor::whereIn('color_id' , $selected_colors)->where('product_id' , $product->id)->get();
                                                        $unique = $colors->unique('color_id');
                                                        ?>
                                                        @foreach($unique as $color)
                                                            <div style="height: 40px;width: 40px;background:{{ $color->color->color }};display: inline-block;border-radius: 50%;margin: 0 5px"></div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <img style="width: 100%"
                                                 src="{{ asset('backend/assets/images/size.png') }}">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-12 mb-1">
                                                        <?php
                                                            $sizes = \App\Models\ProductColor::whereIn('color_id' , $selected_colors)->where('product_id' , $product->id)->get();
                                                            $unique2 = $colors->unique('size_id');
                                                        ?>

                                                            @foreach($unique2 as $size)
                                                                <span class="mx-1 px-4 py-1"
                                                                      style="background: white;border-radius: 10px">{{ $size->size->code }}</span>
                                                            @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                             aria-labelledby="pills-profile-tab">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-sm-12 mt-5 mb-4">
                                                        {{ $product->body_en }}
                                                    </div>
                                                    {{--<div class="col-sm-6 mt-4">--}}
                                                    {{--BRAND--}}
                                                    {{--<br>--}}
                                                    {{--{{ $product->brand->name_en }}--}}
                                                    {{--</div>--}}
                                                    <div class="col-sm-6 mt-4 text-right">
                                                        SKU
                                                        <br>
                                                        {{ $product->code }}
                                                    </div>
                                                    <div class="col-sm-6 mt-4">
                                                        CONDITION
                                                        <br>
                                                        {{ $product->body_en }}
                                                    </div>
                                                    <div class="col-sm-6 mt-4 text-right">
                                                        Material
                                                        <br>
                                                        {{ $product->material->name_en }}
                                                    </div>
                                                    <div class="col-sm-6 mt-4">
                                                        CATEGORY
                                                        <br>
                                                        {{ $product->category->name_en }}
                                                    </div>
                                                    <div class="col-sm-6 mt-4 text-right">
                                                        FITTING
                                                        <br>
                                                        @foreach($product->colors->unique('size_id') as $color)
                                                            {{ $color->size->code }}
                                                            @if(!$loop->last) - @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                             aria-labelledby="pills-contact-tab">
                                            <img style="width: 100%;height: 330px"
                                                 src="{{ asset('pictures/products/' . $product->sizeImage->image) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="container">
                        <div class="row">
                            <div style="display:flex;justify-content: space-between;" class="col-md-12">
                                <a href="{{ route('products.edit' , $product->slug) }}"
                                   class="btn btn-warning text-white">Back To Edit</a>
                                @if($product->active == 0)
                                    <a href="{{ route('post_product' , $product->slug) }}"
                                       class="btn btn-success text-white">Post The Product</a>
                                @else
                                    <a href="{{ route('post_product' , $product->slug) }}"
                                       class="btn btn-danger text-white">Hide from Store</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection
@section('backend-footer')

@endsection
