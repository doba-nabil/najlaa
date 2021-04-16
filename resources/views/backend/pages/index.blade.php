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
                    <h4 class="card-title">{{ __('dashboard.store_pages') }}</h4>
                    <div style="display: flex;justify-content: space-between;">
                        <a href="{{ route('pages.create') }}" class="btn btn-success mb-2"><i class="mdi mdi-plus mr-2"></i> {{ __('dashboard.add_new') }}</a>
                        <a class="btn btn-danger mb-2  delete-all text-white" onclick="return false;"
                           delete_url="/delete_pages/"><i class="mdi mdi-trash-can-outline mr-2"></i>{{ __('dashboard.delete_all') }}</a>
                    </div>
                    <hr>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('dashboard.name') }}</th>
                            <th>{{ __('dashboard.active') }}</th>
                            <th>{{ __('dashboard.options') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ __('dashboard.faqs') }}</td>
                            <td>{{ __('dashboard.active') }}</td>
                            <td>
                                <a href="{{ route('faqs.index') }}"
                                   class="mr-3 text-primary"><i class="mdi mdi-eye font-size-18"></i></a>
                            </td>
                        </tr>
                        @foreach($pages as $page)
                            <tr>
                                <td>{{ $loop->index + 2 }}</td>
                                <td>{{ $page['name_'.app()->getLocale()] }}</td>
                                <td>{{ $page->getActive() }}</td>
                                <td>
                                    <a href="{{ route('pages.edit' , $page->slug) }}"
                                       class="mr-3 text-primary"><i class="mdi mdi-pencil font-size-18"></i></a>
                                    @if($page->id > 3)
                                    <a title="" onclick="return false;" object_id="{{ $page->id }}"
                                       delete_url="/pages/" class="text-danger remove-alert" href="#"><i
                                                class="mdi mdi-trash-can font-size-18"></i></a>
                                    @endif
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