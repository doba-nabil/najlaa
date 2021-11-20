<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:page-list|page-create|page-edit|page-delete', ['only' => ['index','show']]);
        $this->middleware('permission:page-list', ['only' => ['index','show']]);
        $this->middleware('permission:page-create', ['only' => ['create','store']]);
        $this->middleware('permission:page-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:page-delete', ['only' => ['destroy' , 'delete_pages']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $pages = Page::orderBy('id', 'desc')->get();
            return view('backend.pages.index',compact('pages'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('backend.pages.create');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        try {
            $page = new Page();
            $page->name_ar = $request->name_ar;
            $page->name_en = $request->name_en;
            $page->body_ar = $request->body_ar;
            $page->body_en = $request->body_en;
            if($request->active){
                $page->active = 1;
            }else{
                $page->active = 0;
            }
            $page->save();
            return redirect()->route('pages.index')->with('done', 'Added Successfully ....');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $page = Page::where('slug', $slug)->first();
        if (isset($page)) {
            return view('backend.pages.edit', compact('page'));
        } else {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, $id)
    {
        try {
            $page = Page::find($id);
            $page->name_ar = $request->name_ar;
            $page->name_en = $request->name_en;
            $page->body_ar = $request->body_ar;
            $page->body_en = $request->body_en;
            if($request->active){
                $page->active = 1;
            }else{
                $page->active = 0;
            }
            $page->save();
            return redirect()->route('pages.index')->with('done', 'Edited Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $page = Page::find($id);
            if($page->id > 3){
                $page->delete();
            }else{
                return redirect()->back()->with('error', 'you can\'t delete this pages');
            }

            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }

    }

    public function delete_pages()
    {
        try {
            $pages = Page::where('id' , '>' , 3)->get();
            if (count($pages) > 0) {
                foreach ($pages as $page) {
                    $page->delete();
                }
                return response()->json([
                    'success' => 'Record deleted successfully!'
                ]);
            } else {
                return response()->json([
                    'error' => 'NO EVENTS TO DELETE'
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error Try Again !!');
        }
    }
}
