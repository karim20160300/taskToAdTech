<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use Illuminate\Support\Facades\Validator;
class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sections = Section::get();
        if($sections->count() == 0){
            return response(['msg' => 'No Sections Yet!']);
        }else{
            return response(['sections' => $sections], 200);
        }
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
        $data = [
            'name' => $request['name'],
        ];
    
            $rules = [
                'name' => 'required',
            ];
    
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return  response()->json(["message" => $validator->errors()->first()],400);
            }
    
    
            $section = Section::Create($data);
            return response(['section' => $section]);
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
        $section = Section::find($id);
        if($section != null){
            return response(['section' => $section], 200);
        }else{
            return response(['msg' => 'Not Found!'], 404);
        }
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
        $data = [
            'name' => $request['name'],
        ];
    
            $rules = [
                'name' => 'required',
            ];
    
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return  response()->json(["message" => $validator->errors()->first()],400);
            }

            $section = Section::find($id);
            if($section != null){
                if($section->update($data)){
                return response(['section' => $section],200);
            }else{
                return response(['msg', 'error on Update!']);
            }
        }else{
            return response(['msg', 'Section Not Found!']);
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
        $section = Section::find($id);
        if($section != null){
            $section->delete();
            return response(['msg' => 'Section Deleted Successfully!']);
        }else{
            return response(['msg' => 'Section Not Found!']);
        }
    }
}
