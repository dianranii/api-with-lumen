<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller {
    
    function index(){
        $student = Student::all();

        return response()->json([
            'success' => true,
            'message' => 'Student Data',
            'data' => $student
        ], 200);
    }

    function create(Request $request) {
        $validator =Validator::make($request->all(), [
            'npm' => 'required',
            'nama' => 'required',
            'angkatan' => 'required',
            'ipk' => 'required',
        ]);

        if($validator -> fails()){
            return response()->json([
                'success' => false,
                'message' => 'All Data required',
                'data' => $validator->errors()
            ], 400);
        }
        else{
            $student = Student::create([
                'npm' => $request->input('npm'),
                'nama' => $request->input('nama'),
                'angkatan' => $request->input('angkatan'),
                'ipk' =>$request->input('ipk')
            ]);

            if ($student){
                return response()->json([
                    'success' => true,
                    'message' => 'Data created',
                    'data' => $student
                ], 200);
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => "Data not created",
                    'data' => 'Error'
                ], 500);
            }
        }
    }

    function read($id){
        $student = Student::find($id);

        if($student){
            return response()->json([
                'success' =>true,
                'message' => 'Student Data',
                'data' => $student
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Student Data Not Found',
                'data' => null
            ], 400);

        }
    }

    function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'npm' => 'required',
            'nama' => 'required',
            'angkatan' => 'required',
            'ipk' => 'required',            
        ]); 

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'All Data Required',
                'data' => $validator->errors()
            ], 400);
        }else{
            $student = Student::whereId($id)->update([
                'npm' => $request->input('npm'),
                'nama' => $request->input('nama'),
                'angkatan' => $request->input('angkatan'),
                'ipk' =>$request->input('ipk')
            ]);

            if ($student){
                $updatedStudent = Student::find($id);
                return response()->json([
                    'success' => true,
                    'message' => 'Data Updated',
                    'data' => $updatedStudent
                ], 200);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Update Error',
                    'data' => 'Error'
                ], 400);
            }
        }
    }

    function delete($id){
        $student = Student::whereId($id)->first();
        $student->delete();

        if ($student){
            return response()->json([
                'success' => true,
                'message'=> 'Data Deleted',
                'data' => 'deleted'
            ], 200);
        }
    }
}