<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Gbrock\Table\Facades\Table;
use Msieprawski\ResourceTable\ResourceTable;

use App\User;
use App\Item;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Item::sorted()->get();
        // $table = Table::create($rows, ['id']);
        $table = Table::create($rows, false);
        // $table->addColumn('full_name', 'Name');
        // $table->addColumn('email', 'E-mail', function($model) {
        //     return $model->rendered_detail;
        // });
        $table->addColumn('image_path', 'Image', function($model) {
            return $model->rendered_image;
        })->addClass('w-25');
        $table->addColumn('name', 'Detail', function($model) {
            return $model->rendered_detail;
        });
        if (Gate::allows('login')) {
            return view('pages.administrator.home');
        }
        return view('pages.member.home', ['table' => $table]);
    }
}
