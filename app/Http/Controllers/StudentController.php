<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Illuminate\Support\Facades\Validator;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $students = Student::get();
        if($students->count() == 0){
            return response(['msg' => 'No Students Yet!']);
        }else{
            return response(['students' => $students]);
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
            'section_id' => $request['section_id'],
        ];
    
            $rules = [
                'name' => 'required',
                'section_id' => 'required',
            ];
    
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return  response()->json(["message" => $validator->errors()->first()],400);
            }

            
             
               Student::create($data);
                return response(['msg' => $studnet]);
               
            
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
        $student = Student::find($id);
        if($student != null){
            return response(['student' => $student], 200);
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
            'section_id' => $request['section_id'],
        ];
    
            $rules = [
                'name' => 'required',
                'section_id' => 'required',
            ];
    
    
            $validator = Validator::make($request->all(), $rules);
    
            if ($validator->fails()) {
                return  response()->json(["message" => $validator->errors()->first()],400);
            }

            $student = Student::find($id);
            if($student != null){
                if($student->update($data)){
                return response(['student' => $student],200);
            }else{
                return response(['msg', 'error on Update!']);
            }
        }else{
            return response(['msg', 'Student Not Found!']);
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
        $student = Student::find($id);
        if($student != null){
            $student->delete();
            return response(['msg' => 'student Deleted Successfully!']);
        }else{
            return response(['msg' => 'student Not Found!']);
        }
    }
}
