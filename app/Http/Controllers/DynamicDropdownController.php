<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DynamicDropdownController extends Controller
{
    public function index(){

        $countries = DB::table('country_state_city')
                    ->groupBy('country')
                    ->get();

        return view('dynamic_dropdown', compact('countries'));
    } // End method

    public function fetch(Request $request){
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');

        $data = DB::table('country_state_city')
                ->where($select, $value)
                ->groupBy($dependent)
                ->get();

        $output = '<option>--Select '.ucfirst($dependent).'--</option>';
        foreach($data as $row)
        {
            $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
        }

        echo $output;
    } // End method
}
