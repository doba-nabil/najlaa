@extends('backend.layout.master')
@section('backend-head')
    <link href="{{ asset('backend') }}/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend') }}/assets/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend') }}/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css"/>
@endsection
@section('backend-main')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('dashboard.products') }}</h4>
                    <div style="display: flex;justify-content: space-between;">
                        <a href="{{ route('products.create') }}" class="btn btn-success mb-2"><i class="mdi mdi-plus mr-2"></i> {{ __('dashboard.add_new') }}</a>
                        <a class="btn btn-danger mb-2  deletee_all text-white" onclick="return false;"
                           data-url="{{ url('admin/delete_products') }}"><i class="mdi mdi-trash-can-outline mr-2"></i>{{ __('dashboard.delete_selected') }}</a>
                    </div>
                    <hr>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th style="width: 28px;" ><input type="checkbox" id="master"></th>
                            <th>{{ __('dashboard.image') }}</th>
                            <th>{{ __('dashboard.name') }}</th>
                            <th>{{ __('dashboard.active') }}</th>
                            <th>{{ __('dashboard.options') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td><input type="checkbox" class="sub_chk" data-id="{{$product->id}}"></td>
                                <td width="100" height="100">
                                    @if(isset($product->mainImage))
                                        <img style="width: 100%;border-radius: 10px" src="{{ asset('pictures/products/' . $product->mainImage->image) }}"/>
                                    @else
                                        <img style="width: 100%;border-radius: 10px" src="{{ asset('backend/assets/images/empty.jpg') }}"/>
                                    @endif
                                </td>
                                <td>{{ $product['name_'.app()->getLocale()] }}</td>
                                <td>{{ $product->getActive() }}</td>
                                <td>
                                    <a title="edit" href="{{ route('products.edit' , $product->slug) }}"
                                       class="mr-3 text-primary"><i class="mdi mdi-pencil font-size-18"></i></a>
                                    <a style="cursor: pointer" title="information" class="mr-3 text-warning" data-toggle="modal" data-target="#exampleModalCenter{{ $loop->index }}">
                                        <i class="fas fa-info-circle font-size-18"></i>
                                    </a>
                                    <a href="{{ route('products.show' , $product->slug) }}" title="mobile show" class="mr-3 text-success"><i class="fas fa-eye font-size-18"></i></a>
                                    <a title="delete" onclick="return false;" object_id="{{ $product->id }}"
                                       delete_url="/products/" class="text-danger remove-alert" href="#"><i
                                                class="mdi mdi-trash-can font-size-18"></i></a>
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
                                            Colors :
                                            @foreach($product->colors as $color)
                                                <div style="height: 40px;width: 40px;background:{{ $color->color->color }};display: inline-block;border-radius: 50%;margin: 0 5px"></div>
                                            @endforeach
                                            <hr>
                                            Sizes :
                                            @foreach($product->sizes as $size)
                                                <span class="mx-1 py-1 px-2" style="background: white;border-radius: 10px;border: 1px solid black;border-radius: 50%">{{ $size->size->code }}</span>
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