<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Setting_item;
use App\Setting_item_option_check;

class SettingController extends Controller
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
        $unit = [
            'Centimeters' => 'cm',
            'Meters' => 'm',
        ];

        $setting = User::find(Auth::user()->id)->setting_item()->first();
        $options = $setting->item_option_checks()->get();
        $options = $this->addNoOption($options, 4);

        return view('pages.member.setting', [
            'units' => $unit,
            'setting' => $setting,
            'options' => $options
        ]);
    }

    private function addNoOption($options, $maximum) {
        if (count($options) < $maximum) {
            for ($i=count($options); $i < $maximum; $i++) {
                $options[$i] = false;
            }
        }
        return $options;
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
        //
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

    public function updateSettingItem(Request $request, Setting_item $setting_item)
    {
        $setting_item->unit = $request->input('unit');
        $setting_item->save();
        $allOptions = $setting_item->item_option_checks()->get();
        $this->updateSettingItemOptionChecks($allOptions, $request->input('options') ?? []);
        return redirect()->back();
    }

    private function updateSettingItemOptionChecks($allOptions, $options_id) {
        foreach ($allOptions as $option) {
            $option->status = 0;
            foreach ($options_id as $key => $value) {
                if ($value == $option->id) {
                    $option->status = 1;
                    break;
                }
            }
            $option->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
