@extends('backend.layout.master')
@section('backend-head')
@endsection
@section('backend-main')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Sub Category " {{ $subcategory->name_en }} "</h4>
                    <p class="card-title-desc"></p>
                    <form method="post" action="{{ route('subcategories.update' , $category->id) }}"
                          class="needs-validation" novalidate
                          enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validationCustom01">Name in Arabic</label>
                                    <input type="text" name="name_ar" class="form-control" id="validationCustom01"
                                           placeholder="Name in Arabic" value="{{ $category->name_ar }}" required>
                                    @error('name_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validationCustom02">Name in English</label>
                                    <input type="text" name="name_en" class="form-control" id="validationCustom02"
                                           placeholder="Name in English" value="{{ $category->name_en }}" required>
                                    @error('name_en')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="validationCustom02">Parent Category</label>
                                    <select name="parent_id" class="form-control" required>
                                        @foreach($parents as $parent)
                                            <option
                                                    @if($parent->id == $category->parent_id) selected @endif
                                            value="{{ $parent->id }}">{{ $parent->name_ar }}
                                                / {{ $parent->name_en }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox"
                                           @if($category->active == 1) checked="" @endif
                                           name="active" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Active</label>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection
@section('backend-footer')
    <script src="{{ asset('backend') }}/assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/pages/form-validation.init.js"></script>
    <script src="{{ asset('backend') }}/mine.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/pages/form-element.init.js"></script>
@endsection
