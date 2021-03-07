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
                    <h4 class="card-title">{{ __('dashboard.coupons') }}</h4>
                    <div style="display: flex;justify-content: space-between;">
                        <a href="{{ route('coupons.create') }}" class="btn btn-success mb-2"><i class="mdi mdi-plus mr-2"></i> {{ __('dashboard.add_new') }}</a>
                        <a class="btn btn-danger mb-2  delete-all text-white" onclick="return false;"
                           delete_url="/delete_coupons/"><i class="mdi mdi-trash-can-outline mr-2"></i>{{ __('dashboard.delete_all') }}</a>
                    </div>
                    <hr>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('dashboard.coupon_code') }}</th>
                            <th>{{ __('dashboard.perc') }}</th>
                            <th>{{ __('dashboard.active') }}</th>
                            <th>{{ __('dashboard.coupon_date') }}</th>
                            <th>{{ __('dashboard.used_count') }}</th>
                            <th>{{ __('dashboard.used') }}</th>
                            <th>{{ __('dashboard.options') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cobones as $cobone)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $cobone->code }}</td>
                                <td>{{ $cobone->value }} %</td>
                                <td>{{ $cobone->getActive() }}</td>
                                <td>{{ $cobone->end_date }}</td>
                                <td>{{ $cobone->used_count }}</td>
                                <td>{{ $cobone->uses->count() }}</td>
                                <td>
                                    <a href="{{ route('coupons.edit' , $cobone->id) }}"
                                       class="mr-3 text-primary"><i class="mdi mdi-pencil font-size-18"></i></a>
                                    <a title="" onclick="return false;" object_id="{{ $cobone->id }}"
                                       delete_url="/coupons/" class="text-danger remove-alert" href="#"><i
                                                class="mdi mdi-trash-can font-size-18"></i></a>
                                </td>
                            </tr>
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
@endsection