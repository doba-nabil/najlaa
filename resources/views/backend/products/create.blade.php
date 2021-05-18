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
                    <h4 class="card-title">{{ __('dashboard.add_new') }}</h4>
                    <p class="card-title-desc"></p>
                    <form method="post" action="{{ route('products.store') }}" class="needs-validation" novalidate
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validationCustom01">{{ __('dashboard.name_ar') }}</label>
                                    <input type="text" name="name_ar" class="form-control" id="validationCustom01"
                                           placeholder="{{ __('dashboard.name_ar') }}" value="{{ old('name_ar') }}"
                                           required>
                                    @error('name_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="validationCustom02">{{ __('dashboard.name_en') }}</label>
                                    <input type="text" name="name_en" class="form-control" id="validationCustom02"
                                           placeholder="{{ __('dashboard.name_en') }}" value="{{ old('name_en') }}"
                                           required>
                                    @error('name_en')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="code">{{ __('dashboard.code') }}</label>
                                    <input type="text" name="code" class="form-control" id="code"
                                           placeholder="{{ __('dashboard.code') }}" value="{{ old('code') }}" required>
                                    @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">{{ __('dashboard.price') }}</label>
                                    <input min="0" step="0.1" type="number" name="price" class="form-control" id="price"
                                           placeholder="{{ __('dashboard.price') }}" value="{{ old('price') }}"
                                           required>
                                    @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discount_price">{{ __('dashboard.percent') }} </label>
                                    <input style="width: 95%;display: inline-block;" min="0" max="100" type="number" name="percentage_discount" class="form-control save-sale"
                                           id="percentage_discount" placeholder="{{ __('dashboard.percent') }}"
                                           value="{{ old('percentage_discount') }}"> %
                                    @error('percentage_discount')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="body_ar">{{ __('dashboard.desc_ar') }}</label>
                                    <textarea rows="10" type="text" name="body_ar" class="form-control summernote"
                                              id="body_ar" placeholder="{{ __('dashboard.desc_ar') }}"
                                              required>{{ old('body_ar') }}</textarea>
                                    @error('body_ar')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="body_en">{{ __('dashboard.desc_en') }}</label>
                                    <textarea rows="10" type="text" name="body_en" class="form-control summernote"
                                              id="body_en" placeholder="{{ __('dashboard.desc_en') }}"
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
                                    <label class="control-label">{{ __('dashboard.select_cat') }}</label>
                                    <select name="category_id" class="form-control select2" id="category_id">
                                        <option>{{ __('dashboard.select_cat') }}</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name_en }}
                                                / {{ $category->name_ar }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">{{ __('dashboard.select_subcat') }}</label>
                                    <select name="subcategory_id" class="form-control select2" id="subcategory_id">
                                        <option>{{ __('dashboard.select_cat_first') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">{{ __('dashboard.material') }}</label>
                                    <select name="material_id" class="form-control select2">
                                        <option hidden selected value="">{{ __('dashboard.select_material') }}</option>
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
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{ __('dashboard.main_image') }}</label>
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="customFile"
                                               onchange="readURL(this);" required>
                                        <label class="custom-file-label"
                                               for="customFile">{{ __('dashboard.image') }}</label>
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
                                    <label class="control-label">{{ __('dashboard.sub_images') }}</label>
                                    <span class="btn btn-success fileinput-button">
                                <span>{{ __('dashboard.sub_images') }}</span>
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">{{ __('dashboard.sizes_image') }}</label>
                                    <div class="custom-file">
                                        <input type="file" name="size_image" class="custom-file-input" id="customFile2"
                                               onchange="readURL2(this);" required>
                                        <label class="custom-file-label"
                                               for="customFile2">{{ __('dashboard.sizes_image') }}</label>
                                        @error('size_image')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="text-center">
                                        <img id="blah2" class="blah_create mt-3" src=""/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row ">
                            <div class="col-md-12">
                                <label class="control-label">{{ __('dashboard.colors') }}
                                    & {{ __('dashboard.sizes') }}</label>
                                <div id="parent">
                                    <div style="border: 1px solid grey;" class="row pt-2">
                                        <div class="form-group col-md-12 col-xs-12">
                                            <label for="colors[0][color]">
                                                {{ __('dashboard.color') }}
                                            </label>
                                            <?php
                                            $colors = \App\Models\Color::active()->get();
                                            ?>
                                            <div class=" text-center">
                                                @foreach($colors as $color)
                                                    <input value="{{ $color->id }}" id="checkboxidcolor[0]{{ $loop->index }}" name="colors[0][color_id]" type="radio"
                                                           class="css-checkbox">
                                                    <label style="background: {{ $color->color }}"
                                                           for="checkboxidcolor[0]{{ $loop->index }}" class="css-label"></label>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-xs-12">
                                            <label for="colors[0][qty]">
                                                {{ __('dashboard.in_stock') }}
                                            </label>
                                            <input type="number" min="0" placeholder="{{ __('dashboard.in_stock') }}"
                                                   class="form-control" name="colors[0][qty]" required>
                                        </div>
                                        <div class="form-group col-md-6 col-xs-12">
                                            <label for="size[0]">
                                                {{ __('dashboard.size') }}
                                            </label>
                                            <select name="colors[0][size_id]" class="form-control">
                                                <option hidden selected value="">{{ __('dashboard.sizes') }}</option>
                                                <?php
                                                $sizes = \App\Models\Size::active()->get();
                                                ?>
                                                @foreach($sizes as $size)
                                                    <option value="{{ $size->id }}">
                                                        {{ $size->code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">

                                    <div style="display: flex;justify-content:space-between"
                                         class="col-md-12 mt-2">
                                        <a type="submit" onclick="addChild();"
                                           class="btn btn-success text-white">@lang('dashboard.add_more')</a>
                                        <a id="removePrice"
                                           class="btn btn-danger text-white">@lang('dashboard.remove_last')</a>
                                    </div>
                                    @error('colors')
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
                                           checked="" value="1">
                                    <label class="custom-control-label"
                                           for="customCheck2">{{ __('dashboard.chosen') }}</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row notify">
                            <div class="col-md-4">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" name="chosen" class="custom-control-input" id="customCheck3"
                                           checked="" value="1">
                                    <label class="custom-control-label"
                                           for="customCheck3">{{ __('dashboard.notify') }}</label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button class="btn btn-primary" type="submit">{{ __('dashboard.submit') }}</button>
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


    <script>
        var childNumber = 1;
        var max_fields = '10';

        function addChild() {

            @if(app()->getLocale() == 'en')
            if (childNumber == max_fields) {
                alert('Max Fields Number');
            }
            @else
            if (childNumber == max_fields) {
                alert('تم الوصول الى الحد الاقصى من الحقول');
            }
            @endif
            if (childNumber < max_fields) {
                var parent = document.getElementById('parent');
                var newChild = `
            <div style="border: 1px solid grey;" class="row mt-2 pt-2">
            <div class="form-group col-md-12 col-xs-12">
                     <label for="colors[` + childNumber + `][color]">
                                                {{ __('dashboard.color') }}
                    </label>

                    <div class=" text-center">
                            @foreach($colors as $color)
                    <input value="{{ $color->id }}" id="checkboxidcolor[` + childNumber + `]{{ $loop->index }}" name="colors[` + childNumber + `][color_id]" type="radio"
                                                           class="css-checkbox">
                                                    <label style="background: {{ $color->color }}"
                                                           for="checkboxidcolor[` + childNumber + `]{{ $loop->index }}" class="css-label"></label>
                                                @endforeach
                    </div>
                </div>
     <div class="form-group col-md-6 col-xs-12">
      <label for="colors[` + childNumber + `][qty]">
                                                {{ __('dashboard.in_stock') }}
                    </label>
                <input type="number" min="0" placeholder="{{ __('dashboard.in_stock') }}" class="form-control" name="colors[` + childNumber + `][qty]" required>

            </div>
            <div class="form-group col-md-6 col-xs-12">
             <label for="size[` + childNumber + `]">
                                                {{ __('dashboard.size') }}
                    </label>
                    <select name="colors[` + childNumber + `][size_id]" class="form-control select2">
                        <option hidden selected value="">{{ __('dashboard.sizes') }}</option>
                        @foreach($sizes as $size)
                    <option value="{{ $size->id }}">
                               {{ $size->code }}
                    </option>
                    @endforeach
                    </select>
            </div>

            </div>
            `;
                parent.insertAdjacentHTML('beforeend', newChild);
                childNumber++;
                $('select').niceSelect();
            }
        }

        $("#removePrice").on("click", function () {
            if (childNumber > 1) {
                $("#parent").children().last().remove();
                childNumber--;
            }
        });

        $('.save-sale').on('change', function() {
            if ($(".save-sale").val() == 0) {
                $(".notify").hide();
            }else if($(".save-sale").val() > 0){
                $(".notify").show();
            }else if($(".save-sale").val() == ''){
                $(".notify").hide();
            }
        });
        if ($(".save-sale").val() == 0) {
            $(".notify").hide();
        }else if($(".save-sale").val() > 0){
            $(".notify").show();
        }else if($(".save-sale").val() == ''){
            $(".notify").hide();
        }
    </script>
@endsection
