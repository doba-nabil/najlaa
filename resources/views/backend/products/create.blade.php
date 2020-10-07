@extends('backend.layout.master')
@section('backend-head')
    <link href="{{ asset('backend') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('backend') }}/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css"
          rel="stylesheet"/>
@endsection
@section('backend-main')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add New Product</h4>
                    <p class="card-title-desc"></p>
                    <form method="post" action="{{ route('products.store') }}" class="needs-validation" novalidate
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validationCustom01">Name in Arabic</label>
                                    <input type="text" name="name_ar" class="form-control" id="validationCustom01"
                                           placeholder="Name in Arabic" value="{{ old('name_ar') }}" required>
                                    @error('name_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validationCustom02">Name in English</label>
                                    <input type="text" name="name_en" class="form-control" id="validationCustom02"
                                           placeholder="Name in English" value="{{ old('name_en') }}" required>
                                    @error('name_en')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="code">Code of Product</label>
                                    <input type="text" name="code" class="form-control" id="code"
                                           placeholder="Code of Product" value="{{ old('code') }}" required>
                                    @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Price "QAR"</label>
                                    <input min="0" step="0.1" type="number" name="price" class="form-control" id="price"
                                           placeholder="Price" value="{{ old('price') }}" required>
                                    @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discount_price">Price after Discount "QAR" ( Optional ) </label>
                                    <input min="0" step="0.1" type="number" name="discount_price" class="form-control"
                                           id="discount_price" placeholder="Price after Discount ( Optional )"
                                           value="{{ old('discount_price') }}">
                                    @error('discount_price')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="max_qty">Number of parts in stock</label>
                                    <input min="0" step="1" type="number" name="max_qty" class="form-control"
                                           id="max_qty" placeholder="Number of parts in stock"
                                           value="{{ old('max_qty') }}">
                                    @error('max_qty')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="min_qty">Minimum number of order</label>
                                    <input min="0" step="1" type="number" name="min_qty" class="form-control"
                                           id="min_qty" placeholder="Minimum number of order"
                                           value="{{ old('min_qty') }}" required>
                                    @error('min_qty')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="body_ar">Descreption in Arabic</label>
                                    <textarea rows="10" type="text" name="body_ar" class="form-control summernote"
                                              id="body_ar" placeholder="Descreption in Arabic"
                                              required>{{ old('body_ar') }}</textarea>
                                    @error('body_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="body_en">Descreption in English</label>
                                    <textarea rows="10" type="text" name="body_en" class="form-control summernote"
                                              id="body_en" placeholder="Descreption in English"
                                              required>{{ old('body_en') }}</textarea>
                                    @error('body_en')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Select Category</label>
                                    <select name="category_id" class="form-control select2" id="category_id">
                                        <option>Select</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name_en }}
                                                / {{ $category->name_ar }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Select Subcategory</label>
                                    <select name="subcategory_id" class="form-control select2" id="subcategory_id">
                                        <option>Select category first</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Select Material</label>
                                    <select name="material_id" class="form-control select2">
                                        <option>Select</option>
                                        @foreach($materials as $material)
                                            <option value="{{ $material->id }}">{{ $material->name_en }}
                                                / {{ $material->name_ar }}</option>
                                        @endforeach
                                    </select>
                                    @error('material_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Select Brand</label>
                                    <select name="brand_id" class="form-control select2">
                                        <option>Select</option>
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name_en }}
                                                / {{ $brand->name_ar }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Select Colors</label>
                                    <div>
                                        @foreach($colors as $color)
                                            <input value="{{ $color->id }}" id="checkboxid{{ $loop->index }}" name="colors[]" type="checkbox"
                                                   class="css-checkbox">
                                            <label style="background: {{ $color->color }}"
                                                   for="checkboxid{{ $loop->index }}" class="css-label"></label>
                                        @endforeach
                                    </div>
                                    @error('colors')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group color">
                                    <label class="control-label">Select Sizes</label>
                                    <div>
                                        @foreach($sizes as $size)
                                            <input value="{{ $size->id }}" id="checkid{{ $loop->index }}" type="checkbox" name="sizes[]"
                                                   class="css-checkbox">
                                            <label for="checkid{{ $loop->index }}" class="css-label">
                                                <h4>
                                                    {{ $size->code }}
                                                </h4>
                                            </label>
                                        @endforeach
                                    </div>
                                    @error('sizes')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Main Image</label>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="customFile"
                                               onchange="readURL(this);" required>
                                        <label class="custom-file-label" for="customFile">Main Image</label>
                                        @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <img id="blah" class="blah_create mt-3" src=""/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 images mt-3">
                                <div class="form-group">
                                    <label class="control-label">Sub Images</label>
                                    <span class="btn btn-success fileinput-button">
                                <span>Select Images</span>
                                <input type="file" name="images[]" id="files" multiple
                                       accept="image/jpeg, image/png, image/gif,"><br/>
                                </span>
                                    <br>
                                    <output class="mt-3" id="Filelist"></output>
                                    @error('images')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" name="chosen" class="custom-control-input" id="customCheck2"
                                           checked="">
                                    <label class="custom-control-label" for="customCheck2">Chosen</label>
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
    <script src="{{ asset('backend') }}/assets/libs/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/pages/form-element.init.js"></script>
    <script src="{{ asset('backend') }}/mine.js"></script>
    <script src="{{ asset('backend') }}/image_uploader.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/select2/js/select2.min.js"></script>
    <script src="{{ asset('backend') }}/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/pages/form-advanced.init.js"></script>
@endsection
