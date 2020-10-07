@extends('backend.layout.master')
@section('backend-head')
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/vendors/css/vendors-rtl.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/colors.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/components.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/themes/semi-dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/plugins/file-uploaders/dropzone.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/pages/data-list-view.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/app-assets/css-rtl/custom-rtl.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/assets/css/style-rtl.css">
@endsection
@section('backend-main')
    <!-- BEGIN: Content-->
    <div class="content-body">
        <!-- Data list view starts -->
        <div class="col-12">
            @include('common.done')
        </div>
        <button class="btn btn-success" id="click">ملف Excel</button>
        <section id="data-thumb-view" class="data-thumb-view-header">
            <div class="action-btns d-none">
                <div class="btn-dropdown mr-1 mb-1">
                    <div class="btn-group dropdown actions-dropodown">
                        <button type="button" class="btn btn-white px-1 py-1 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            خيارات
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item delete-all" onclick="return false;" delete_url="/delete_contacts/">
                            حذف الكل</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- dataTable starts -->
            <div class="table-responsive">
                <table id="studtable" class="table data-thumb-view">
                    <thead>
                    <tr>
                        <th hidden></th>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>البريد</th>
                        <th>العنوان</th>
                        <th>نوع</th>
                        <th>حالة الرسالة</th>
                        <th>وقت الارسال</th>
                        <th>تصفح</th>
                        <th>خيارات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contacts as $contact)
                        <tr class="delete-all-cats">
                            <td hidden></td>
                            <td>
                                {{ $loop->index + 1 }}
                            </td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->title }}</td>
                            <td>{{ $contact->kind }}</td>
                            <td>{{ $contact->getRead() }}</td>
                            <td>{{ $contact->created_at }}</td>
                            <td>
                                <a title="تصفح" href="{{ route('contacts.show' , $contact->id) }}">
                                    <i class="fa fa-eye fa-2x"></i>
                                </a>
                            </td>
                            <td class="product-action">
                                <a title="" onclick="return false;" object_id="{{ $contact->id }}"
                                   delete_url="/contacts/" class="edit-btn-table remove-alert" href="#">
                                    <i class="feather icon-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- dataTable ends -->
        </section>
        <!-- Data list view end -->
    </div>
    <!-- END: Content-->
@endsection
@section('backend-footer')
    <script src="{{ asset('backend') }}/app-assets/vendors/js/vendors.min.js"></script>
    <script src="{{ asset('backend') }}/app-assets/vendors/js/extensions/dropzone.min.js"></script>
    <script src="{{ asset('backend') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ asset('backend') }}/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="{{ asset('backend') }}/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="{{ asset('backend') }}/app-assets/vendors/js/tables/datatable/dataTables.select.min.js"></script>
    <script src="{{ asset('backend') }}/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="{{ asset('backend') }}/app-assets/js/core/app-menu.js"></script>
    <script src="{{ asset('backend') }}/app-assets/js/core/app.js"></script>
    <script src="{{ asset('backend') }}/app-assets/js/scripts/components.js"></script>
    <script src="{{ asset('backend') }}/custom-sweetalert.js"></script>
    <script src=
            "//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js">
    </script>
    <script>
        $('#click').click(function () {
            $("#studtable").table2excel({
                filename: "contacts.xls"
            });
        });
    </script>
@endsection