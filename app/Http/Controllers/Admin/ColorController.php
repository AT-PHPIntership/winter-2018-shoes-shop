<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Services\ColorService;
use App\Models\Color;
use App\Http\Requests\Admin\PutColorRequest;
use App\Http\Requests\Admin\PostColorRequest;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = app(ColorService::class)->getColorWithPaginate();
        return view('admin.color.list', compact('colors'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('admin.color.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostColorRequest $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostColorRequest $request)
    {
        $data = $request->all();
        if (app(ColorService::class)->store($data)) {
            return redirect()->route('admin.colors.index')->with('success', trans('common.message.create_success'));
        }
        return redirect()->route('admin.colors.create')->with('error', trans('common.message.create_error'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param Color $color color
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        return view('admin.color.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PutColorRequest $request request
     * @param Color           $color   color
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PutColorRequest $request, Color $color)
    {
        $data = $request->all();
        if (app(ColorService::class)->update($data, $color)) {
            return redirect()->route('admin.colors.index')->with('success', trans('common.message.edit_success'));
        }
        return redirect()->route('admin.colors.edit', $color)->with('error', trans('common.message.edit_error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Color $color color
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        if (app(ColorService::class)->destroy($color)) {
            return redirect()->route('admin.colors.index')->with('success', trans('common.message.delete_success'));
        }
        return redirect()->route('admin.colors.index')->with('error', trans('common.message.delete_error'));
    }
}
