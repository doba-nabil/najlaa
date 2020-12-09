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
                    <h4 class="card-title">Currencies</h4>
                    <div style="display: flex;justify-content: space-between;">
                        <a href="{{ route('currencies.create') }}" class="btn btn-success mb-2">
                            <i class="mdi mdi-plus mr-2"></i>
                            Add New</a>
                        <a class="btn btn-danger mb-2  delete-all text-white" onclick="return false;"
                           delete_url="/delete_currencies/"><i class="mdi mdi-trash-can-outline mr-2"></i>
                            Delete All
                        </a>
                    </div>
                    <hr>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Country</th>
                            <th>For the Qatar Riyal</th>
                            <th>Active</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($currencies as $currency)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $currency->name_ar }} / {{ $currency->name_en }}</td>
                                <td>{{ $currency->country->name_ar }} / {{ $currency->country->name_en }}</td>
                                <td>
                                    @if(!empty($currency->equal))
                                        {{ $currency->equal }}
                                    @else
                                        <?php
                                        $fromCurrency = $currency->code;
                                        $toCurrency = 'QAR';
                                        if($fromCurrency == $toCurrency){
                                            $result =  1;
                                            echo $result . ' QAR';
                                        }else{
                                            try{
                                                $url = "https://www.google.com/search?q=".$toCurrency."+to+".$fromCurrency;
                                                $get = file_get_contents($url);
                                                $data = preg_split('/\D\s(.*?)\s=\s/',$get);
                                                $exhangeRate = (float) substr($data[1],0,7);
                                                $result = round($exhangeRate , 3);
                                                echo $result . ' QAR';
                                            }catch (\Exception $e){
                                                echo 'Please add it manually';
                                            }
                                        }
                                        ?>
                                    @endif
                                </td>
                                <td>{{ $currency->getActive() }}</td>
                                <td>
                                    <a href="{{ route('currencies.edit' , $currency->id) }}"
                                       class="mr-3 text-primary"><i class="mdi mdi-pencil font-size-18"></i></a>
                                    <a title="" onclick="return false;" object_id="{{ $currency->id }}"
                                       delete_url="/currencies/" class="text-danger remove-alert" href="#"><i
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