<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Gbrock\Table\Facades\Table;
use Msieprawski\ResourceTable\ResourceTable;

use App\User;
use App\Item;
use App\Items_option_check;

class ItemController extends Controller
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
        $rows = Auth::user()->items()->sorted()->paginate(5);
        $table = Table::create($rows, false);
        $table->addColumn('image_path', 'Image', function($model) {
            return $model->rendered_image;
        })->addClass('w-25');
        $table->addColumn('name', 'Detail', function($model) {
            return $model->rendered_detail;
        });
        $table->setView('vendor.gbrock.tableItems');
        return view('pages.member.item.index', ['table' => $table]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.member.item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = $request->image->store('/public/images/items');
        $filename = basename($path);

        $item = new Item;
        $item->user_id = $request->input('user_id');
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->width = $request->input('width');
        $item->length = $request->input('length');
        $item->height = $request->input('height');
        $item->image_name = $filename;
        $item->save();

        $setting_item = Auth::user()->setting_item()->first();
        $sioc = $setting_item->item_option_checks()->get();
        foreach ($sioc as $option) {
            $ioc = new Items_option_check;
            $ioc->item_id = $item->id;
            $ioc->setting_item_option_check_id = $option->id;
            $ioc->save();
        }
        return redirect('/items');
    }

    public function getImageItem($filename) {
        $pathToFile = storage_path().'/app/public/images/items/'.$filename;
        return response()->file($pathToFile);
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
    public function edit(Item $item)
    {
        return view('pages.member.item.edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $item->name = $request->input('name');
        $item->description = $request->input('description');
        $item->width = $request->input('width');
        $item->length = $request->input('length');
        $item->height = $request->input('height');
        if ($request->has(['image'])) {
            Storage::delete('/public/images/items/'.$item->image_name);
            $item->image_name = $request->image->store('/public/images/items');
        }
        $item->save();
        return redirect('/items');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $item = Item::where('id', $request->input('item_id'))->first();
        $iocs = $item->item_option_checks()->get();
        foreach ($iocs as $ioc) {
            $ioc->delete();
        }
        $item->delete();
        return redirect('/items');
    }
}
