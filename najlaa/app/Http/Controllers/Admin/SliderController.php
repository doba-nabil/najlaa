<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use UploadTrait;
    function __construct()
    {
        $this->middleware('permission:slider-list|slider-create|slider-edit|slider-delete', ['only' => ['index','show']]);
        $this->middleware('permission:slider-list', ['only' => ['index','show']]);
        $this->middleware('permission:slider-create', ['only' => ['create','store']]);
        $this->middleware('permission:slider-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:slider-delete', ['only' => ['destroy' , 'delete_sliders']]);
    }
    public function index()
    {
        try {
            $sliders = Slider::orderBy('id', 'desc')->get();
            return view('backend.sliders.index', compact('sliders'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }
    public function create()
    {
        try {
            return view('backend.sliders.create');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }
    public function store(SliderRequest $request)
    {
        try {
            $slider = new Slider();
            $slider->title_ar = $request->title_ar;
            $slider->title_en = $request->title_en;
            $slider->subtitle_ar = $request->subtitle_ar;
            $slider->subtitle_en = $request->subtitle_en;
            $slider->link = $request->link;
            if ($request->active) {
                $slider->active = 1;
            } else {
                $slider->active = 0;
            }
            $slider->save();
            if ($request->hasFile('image')) {
                $this->saveimage($request->image, 'pictures/sliders', $slider->id , Slider::class, 'main');
            }
            return redirect()->route('sliders.index')->with('done', 'Added Successfully ....');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    public function edit($id)
    {
        $slider = Slider::find($id);
        if (isset($slider)) {
            return view('backend.sliders.edit', compact('slider'));
        } else {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    public function update(SliderRequest $request, $id)
    {
        try {
            $slider = Slider::find($id);
            $slider->title_ar = $request->title_ar;
            $slider->title_en = $request->title_en;
            $slider->subtitle_ar = $request->subtitle_ar;
            $slider->subtitle_en = $request->subtitle_en;
            $slider->link = $request->link;
            if ($request->active) {
                $slider->active = 1;
            } else {
                $slider->active = 0;
            }
            $slider->save();
            if ($request->hasFile('image')) {
                $this->editimage($request->image, 'pictures/sliders', $slider->id , Slider::class, 'main');
            }
            return redirect()->route('sliders.index')->with('done', 'Added Successfully ....');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    public function destroy($id)
    {
        try {
            $slider = Slider::find($id);
            $this->deleteimages($slider->id , 'pictures/sliders/' , Slider::class);
            $slider->delete();
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    public function delete_sliders()
    {
        try {
            $sliders = Slider::all();
            if (count($sliders) > 0) {
                foreach ($sliders as $slider) {
                    $this->deleteimages($slider->id , 'pictures/sliders/' , Slider::class);
                    $slider->delete();
                }
                return response()->json([
                    'success' => 'Record deleted successfully!'
                ]);
            } else {
                return response()->json([
                    'error' => 'NO Record TO DELETE'
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }
}
