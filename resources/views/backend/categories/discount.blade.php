@extends('backend.layout.master')
@section('backend-head')
    <link href="{{ asset('backend') }}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend') }}/assets/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend') }}/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css"/>
@endsection
@section('backend-main')
    <form method="post" action="{{ route('cat_pro_desc_form' , $category->slug) }}">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ __('dashboard.category') }} : {{ $category['name_'.app()->getLocale()] }} </h4>
                    </div>
                </div>
            </div> <!-- end col -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="discount_price">{{ __('dashboard.percent') }} </label>
                                    <input style="width: 95%;display: inline-block;" min="0" step="5" max="100"
                                           type="number" name="percentage_discount" class="form-control"
                                           id="percentage_discount" placeholder="{{ __('dashboard.percent') }}"
                                           value="{{ old('percentage_discount') }}"> %
                                    @error('percentage_discount')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">{{ __('dashboard.submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ __('dashboard.products') }} </h4>
                        <hr>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th style="width: 28px;"><input type="checkbox" id="master"></th>
                                <th>{{ __('dashboard.image') }}</th>
                                <th>{{ __('dashboard.name') }}</th>
                                <th>{{ __('dashboard.price') }}</th>
                                <th>{{ __('dashboard.after_discount') }}</th>
                                <th>{{ __('dashboard.after_percent') }}</th>
                                <th>{{ __('dashboard.active') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <?php
                                $selected_colors = DB::table('product_colors')->where('product_id', $product->id)
                                    ->select('color_id')
                                    ->distinct()
                                    ->pluck('color_id');
                                ?>
                                <tr>
                                    <td><input type="checkbox" class="sub_chk" name="ids[]" value="{{$product->id}}"></td>
                                    <td width="100" height="100">
                                        @if(isset($product->mainImage))
                                            <img style="width: 100%;border-radius: 10px"
                                                 src="{{ asset('pictures/products/' . $product->mainImage->image) }}"/>
                                        @else
                                            <img style="width: 100%;border-radius: 10px"
                                                 src="{{ asset('backend/assets/images/empty.jpg') }}"/>
                                        @endif
                                    </td>
                                    <td>{{ $product['name_'.app()->getLocale()] }}</td>
                                    <td>{{ $product['price'] ?? '----' }}</td>
                                    <td>{{ $product['discount_price']  ?? '----'}}</td>
                                    <td>{{ $product['percentage_discount'] ?? '----'}}</td>
                                    <td>{{ $product->getActive() }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </form>
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
    @if(app()->getLocale() == 'en')
        <script src="{{ asset('backend') }}/custom-sweetalert.js"></script>
    @else
        <script src="{{ asset('backend') }}/custom-sweetalert-ar.js"></script>
    @endif
    <script src="{{ asset('backend') }}/mine.js"></script>
    @if(app()->getLocale() == 'en')
        <script src="{{ asset('backend') }}/endelete_all.js"></script>
    @else
        <script src="{{ asset('backend') }}/ardelete_all.js"></script>
    @endif
@endsection