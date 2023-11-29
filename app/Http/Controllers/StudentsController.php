<?php

namespace App\Http\Controllers;

use App\Models\Students;
use domain\Facades\StudentsFacade;
use Illuminate\Http\Request;
use Inertia\Inertia;


class StudentsController extends ParentController
{

    public function index(){
        $response['students'] = StudentsFacade::all();
        return Inertia::render('Students/index',$response);
    }


    public function store(Request $request){
        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }

        StudentsFacade::store($data);
        $response = StudentsFacade::all();
        return response()->json($response);
    }




    public function edit(Request $request){
        $response['student'] = StudentsFacade::get($request['student_id']);
        return view('pages.students.edit')->with($response);
    }


    public function update(Request $request,$student_id){
        StudentsFacade::update($request->all(),$student_id);
        return redirect()->back();
    }




    public function delete($student_id){
        StudentsFacade::delete($student_id);
        return redirect()->back();
    }

    public function active($student_id){
        StudentsFacade::active($student_id);
        return redirect()->back();
    }

}
