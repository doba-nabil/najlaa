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
                    <h4 class="card-title">{{ __('dashboard.shown_orders') }}</h4>
                    <div style="display: flex;justify-content: space-between;">
                        <a class="btn btn-danger mb-2  delete-all text-white" onclick="return false;"
                           delete_url="/delete_old_orders/"><i class="mdi mdi-trash-can-outline mr-2"></i>
                            {{ __('dashboard.delete_all') }}
                        </a>
                    </div>
                    <hr>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('dashboard.user') }}</th>
                            <th>{{ __('dashboard.paid') }}</th>
                            <th>{{ __('dashboard.shipping_status') }}</th>
                            <th>{{ __('dashboard.order_time') }}</th>
                            <th>{{ __('dashboard.order_no') }}</th>
                            <th>{{ __('dashboard.options') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->getPaidType() }}</td>
                                <td style="background:
                                    @if($order->status == 0)
                                        #33AFFF
                                    @elseif($order->status == 1)
                                        #9333FF
                                    @elseif($order->status == 2)
                                        #FF33FC
                                    @elseif($order->status == 3)
                                        #FF3352
                                    @elseif($order->status == 4)
                                        #33FF3C
                                    @endif"
                                >
                                    @if($order->status == 0)
                                        {{ __('dashboard.signed') }}
                                    @elseif($order->status == 1)
                                        {{ __('dashboard.processed') }}
                                    @elseif($order->status == 2)
                                        {{ __('dashboard.shipped') }}
                                    @elseif($order->status == 3)
                                        {{ __('dashboard.out_to_delivery') }}
                                    @elseif($order->status == 4)
                                        {{ __('dashboard.delivered') }}
                                    @endif
                                </td>
                                <td>
                                    {{ $order->date }} / {{ $order->time }}
                                </td>
                                <td>
                                    {{ $order->order_no }}
                                </td>
                                <td>
                                    <a href="{{ route('orders.show' , $order->order_no) }}"
                                       class="mr-3 text-primary"><i class="mdi mdi-pencil font-size-18"></i></a>
                                    <a title="" onclick="return false;" object_id="{{ $order->id }}"
                                       delete_url="/orders/" class="text-danger remove-alert" href="#"><i
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
    <script src="{{ asset('backend') }}/custom-sweetalert.js"></script>
    <script src="{{ asset('backend') }}/mine.js"></script>
@endsection