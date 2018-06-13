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
            'Centimetre' => 'cm',
            'Metre' => 'm',
            'Inch' => 'inch'
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
        $this->updateSizeItems($request->input('unit'), $setting_item);

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

    private function updateSizeItems($unit, $setting_item) {
        $items = Auth::user()->items()->get();
        if ($setting_item->unit != $unit) {
            foreach ($items as $item) {
                if ($setting_item->unit == 'cm') {
                    if ($unit == 'm') {
                        $item->width = bcdiv($item->width, 100, 4);
                        $item->length = bcdiv($item->length, 100, 4);
                        $item->height = bcdiv($item->height, 100, 4);
                    } else if ($unit == 'inch') {
                        $item->width = bcdiv($item->width, 2.54, 4);
                        $item->length = bcdiv($item->length, 2.54, 4);
                        $item->height = bcdiv($item->height, 2.54, 4);
                    }
                } else if ($setting_item->unit == 'm') {
                    if ($unit == 'cm') {
                        $item->width = $item->width*100;
                        $item->length = $item->length*100;
                        $item->height = $item->height*100;
                    } else if ($unit == 'inch') {
                        $item->width = $item->width*39.3701;
                        $item->length = $item->length*39.3701;
                        $item->height = $item->height*39.3701;
                    }
                } else if ($setting_item->unit == 'inch') {
                    if ($unit == 'cm') {
                        $item->width = $item->width*2.54;
                        $item->length = $item->length*2.54;
                        $item->height = $item->height*2.54;
                    } else if ($unit == 'm') {
                        $item->width = $item->width*0.0254;
                        $item->length = $item->length*0.0254;
                        $item->height = $item->height*0.0254;
                    }
                }
                $item->save();
            }
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
