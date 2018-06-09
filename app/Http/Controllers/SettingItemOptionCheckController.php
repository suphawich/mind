<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Setting_item_option_check;
use App\Items_option_check;
use App\Setting_item;

class SettingItemOptionCheckController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sioc = new Setting_item_option_check;
        $sioc->setting_item_id = $request->input('setting_item_id');
        $sioc->name = $request->input('name');
        $sioc->save();

        $this->storeItemsOptionCheck($request->input('setting_item_id'));

        return redirect('/setting');
    }

    private function storeItemsOptionCheck($setting_item_id) {
        $setting_item = Setting_item::where('id', $setting_item_id)->first();
        $user = $setting_item->user()->first();
        $items = $user->items()->get();
        foreach ($items as $item) {
            $ioc = new Items_option_check;
            $ioc->item_id = $item->id;
            $ioc->setting_item_option_check_id = $sioc->id;
            $ioc->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $sioc = Setting_item_option_check::where('id', $request->input('option_id'))->first();
        $sioc->delete();

        $this->destroyItemsOptionCheck($sioc);
        
        return redirect('/setting');
    }

    private function destroyItemsOptionCheck($sioc) {
        $setting_item = $sioc->setting_item()->first();
        $user = $setting_item->user()->first();
        $items = $user->items()->get();
        foreach ($items as $item) {
            $ioc = Items_option_check::where([
                'item_id' => $item->id,
                'setting_item_option_check_id' => $sioc->id
            ])->first();
            $ioc->delete();
        }
    }
}
