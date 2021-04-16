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
                             Reports
                        @else
                            التقارير
                        @endif
                    </h4>
                    <form method="post" action="{{ route('all_report_post') }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="validationCustom03">{{ __('dashboard.store_users') }}</label>
                                    <select name="user_id" class="form-control select2" id="validationCustom03">
                                        <option selected disabled hidden value="">---- {{ __('dashboard.store_users') }} ----</option>
                                        <?php
                                        $users = \App\User::all();
                                        ?>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="validationCustom03">{{ __('dashboard.city') }}</label>
                                    <select name="country_id" class="form-control select2" id="validationCustom03">
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
                            <th>#</th>
                            <th>{{ __('dashboard.user') }}</th>
                            <th>{{ __('dashboard.paid') }}</th>
                            <th>{{ __('dashboard.shipping_status') }}</th>
                            <th>{{ __('dashboard.new_order') }}</th>
                            <th>{{ __('dashboard.order_no') }}</th>
                            <th>{{ __('dashboard.order_time') }}</th>
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
                                        @if(app()->getLocale() == 'en')
                                            Yes
                                        @else
                                            نعم
                                        @endif
                                    @else
                                        @if(app()->getLocale() == 'en')
                                            No
                                        @else
                                            لا
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    {{ $order->order_no }}
                                </td>
                                <td>
                                    {{ $order->date }} / {{ $order->time }}
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

    <script src="{{ asset('backend') }}/mine.js"></script>
@endsection