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
                    <h4 class="card-title">{{ __('dashboard.city') }} ({{ $city['name_'.app()->getLocale()] }}) - {{ __('dashboard.orders') }}</h4>
                    <hr>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('dashboard.name') }}</th>
                            <th>{{ __('dashboard.paid') }}</th>
                            <th>{{ __('dashboard.shipping_status') }}</th>
                            <th>{{ __('dashboard.new_order') }}</th>
                            <th>{{ __('dashboard.order_no') }}</th>
                            <th>{{ __('dashboard.order_time') }}</th>
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
                                    @if($order->new == 1)
                                        <i class="fa fa-check text-success"></i>
                                    @else
                                        <i class="fa fa-times text-danger"></i>
                                    @endif
                                </td>
                                <td>
                                    {{ $order->order_no }}
                                </td>
                                <td>
                                    {{ $order->date }} / {{ $order->time }}
                                </td>
                                <td>
                                    <a href="{{ route('orders.show' , $order->id) }}"
                                       class="mr-3 text-primary"><i class="mdi mdi-pencil font-size-18"></i></a>
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