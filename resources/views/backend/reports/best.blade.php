@extends('backend.layout.master')
@section('backend-head')
    <link href="{{ asset('backend') }}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend') }}/assets/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css"
          rel="stylesheet" type="text/css"/>

@endsection
@section('backend-main')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        @if(app()->getLocale() == 'en')
                            Best selling
                        @else
                            الافضل مبيعا
                        @endif
                    </h4>
                    <form method="post" action="{{ route('best_selling_post') }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="validationCustom03">{{ __('dashboard.city') }}</label>
                                    <select name="city_id" class="form-control select2" id="validationCustom03">
                                        <option selected disabled hidden value="">---- {{ __('dashboard.city') }} ----</option>
                                        <?php
                                        $cities = \App\Models\City::all();
                                        ?>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city['name_'.app()->getLocale()] }}</option>
                                        @endforeach
                                    </select>
                                    @error('city_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_from">
                                        @if(app()->getLocale() == 'en')
                                            date from
                                        @else
                                            التاريخ من
                                        @endif
                                    </label>
                                    <input type="date" name="date_from" class="form-control" id="date_from" placeholder="
                                         @if(app()->getLocale() == 'en')
                                            date from
                                        @else
                                            التاريخ من
                                        @endif
                                            " value="{{ old('date_from') }}" required>
                                    @error('date_from')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_to">
                                        @if(app()->getLocale() == 'en')
                                            date to
                                        @else
                                            التاريخ الى
                                        @endif
                                    </label>
                                    <input type="date" name="date_to" class="form-control" id="date_to" placeholder="
                                         @if(app()->getLocale() == 'en')
                                            date to
                                        @else
                                            التاريخ الى
                                        @endif
                                            " value="{{ old('date_to') }}" required>
                                    @error('date_to')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">
                            @if(app()->getLocale() == 'en')
                                Send
                            @else
                                ارسال
                            @endif
                        </button>
                    </form>
                    <hr>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th style="width: 28px;" >#</th>
                            <th>{{ __('dashboard.image') }}</th>
                            <th>{{ __('dashboard.name') }}</th>
                            <th>
                                @if(app()->getLocale() == 'en')
                                    times of sale for colors
                                @else
                                    مرات البيع بالنسبة للالوان
                                @endif
                            </th>
                            <th>
                                @if(app()->getLocale() == 'en')
                                   total times of sale
                                @else
                                     مجمل مرات البيع
                                @endif
                            </th>
                            <th>{{ __('dashboard.active') }}</th>
                            <th>{{ __('dashboard.options') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td width="100" height="100">
                                    @if(isset($product->mainImage))
                                        <img style="width: 100%;border-radius: 10px" src="{{ asset('pictures/products/' . $product->mainImage->image) }}"/>
                                    @else
                                        <img style="width: 100%;border-radius: 10px" src="{{ asset('backend/assets/images/empty.jpg') }}"/>
                                    @endif
                                </td>
                                <td>{{ $product['name_'.app()->getLocale()] }}</td>
                                <td>
                                    <div>
                                        @foreach($product->colors as $color)
                                            <div style="height: auto;width: auto;text-align: center;background:{{ $color->color->color }};display: inline-block;border-radius: 3px;margin: 0 5px;padding: 5px;border: 1px solid">
                                                <span style="vertical-align: sub;color: white;text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black">{{ __('dashboard.size') }} : {{ $color->size->code }}</span>
                                                <br>
                                                <?php
                                                    $pays = \App\Models\Pay::where('size_id' , $color->size_id)->where('color_id',$color->color_id)->where('product_id' , $product->id)->get();
                                                ?>
                                                <span style="vertical-align: sub;color: white;text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black">
                                                    @if(app()->getLocale() == 'en')
                                                        times of sale
                                                    @else
                                                        مرات البيع
                                                    @endif
                                                    : {{ $pays->count() }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <?php
                                        $pays = \App\Models\Pay::where('product_id', $product->id)->get();
                                    ?>
                                    {{ $pays->count() }}
                                </td>
                                <td>{{ $product->getActive() }}</td>
                                <td>
                                    <a style="cursor: pointer" title="information" class="mr-3 text-warning" data-toggle="modal" data-target="#exampleModalCenter{{ $loop->index }}">
                                        <i class="fas fa-info-circle font-size-18"></i>
                                    </a>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter{{ $loop->index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">{{ $product->name_en }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Descreption :
                                            {{ $product->body_en }}
                                            <hr>
                                            Price :
                                            @if(!empty($product->discount_price))
                                                <span style="text-decoration: line-through;font-weight: bolder;color: #919191">{{ $product->price }}
                                                    QAR</span> /
                                                <span style="font-weight: bolder;color:#9c8663">{{ $product->discount_price }}
                                                    QAR</span> /
                                                <span style="font-weight: bolder;color: #c20101;border: 1px solid #c6bba9;padding:2px">- {{ $product->percentage_discount }}</span>
                                            @else
                                                <h6 style="font-weight: bolder;color:#9c8663">{{ $product->price }}
                                                    QAR</h6>
                                            @endif
                                            <hr>
                                            Colors & Sizes :
                                            @foreach($product->colors as $color)
                                                <div style="height: auto;width: auto;text-align: center;background:{{ $color->color->color }};display: inline-block;border-radius: 3px;margin: 0 5px;padding: 5px">
                                                    <span style="vertical-align: sub;color: white;text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black">size : {{ $color->size->code }}</span>
                                                    <br>
                                                    <span style="vertical-align: sub;color: white;text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black">qty : {{ $color->stock_qty }}</span>
                                                </div>
                                            @endforeach

                                            <hr>
                                            {{--Brand :--}}
                                            {{--{{ $product->brand->name_en }}--}}
                                            {{--<hr>--}}
                                            Material :
                                            {{ $product->material->name_en }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
@section('backend-footer')
    <script src="{{ asset('backend') }}/assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/pages/sweet-alerts.init.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/jszip/jszip.min.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/pages/datatables.init.js"></script>

    <script src="{{ asset('backend') }}/mine.js"></script>
@endsection