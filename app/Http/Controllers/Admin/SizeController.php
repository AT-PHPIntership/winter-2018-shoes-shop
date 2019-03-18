<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Services\SizeService;
use App\Models\Size;
use App\Http\Requests\Admin\PutSizeRequest;
use App\Http\Requests\Admin\PostSizeRequest;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = app(SizeService::class)->getSizeWithPaginate();
        return view('admin.size.list', compact('sizes'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('admin.size.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostSizeRequest $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostSizeRequest $request)
    {
        $data = $request->all();
        if (app(SizeService::class)->store($data)) {
            return redirect()->route('admin.sizes.index')->with('success', trans('common.message.create_success'));
        }
        return redirect()->route('admin.sizes.create')->with('error', trans('common.message.create_error'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param Size $size size
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
        return view('admin.size.edit', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PutSizeRequest $request request
     * @param Size           $size    size
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PutSizeRequest $request, Size $size)
    {
        $data = $request->all();
        if (app(SizeService::class)->update($data, $size)) {
            return redirect()->route('admin.sizes.index')->with('success', trans('common.message.edit_success'));
        }
        return redirect()->route('admin.sizes.edit', $size)->with('error', trans('common.message.edit_error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Size $size size
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        if (app(SizeService::class)->destroy($size)) {
            return redirect()->route('admin.sizes.index')->with('success', trans('common.message.delete_success'));
        }
        return redirect()->route('admin.sizes.index')->with('error', trans('common.message.delete_error'));
    }
}
