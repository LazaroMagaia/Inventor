<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all();
        return response()->json($employee);
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
        $validataData = $request->validate([
            'name' => 'required|unique:employees|max:255',
            'email' => 'required|email',
            'phone' => 'numeric|required|unique:employees|min:9|max:999999999',
            'nuit' => 'numeric|required|unique:employees|min:9|max:9999999999',
            'sallery'=>'numeric|required',
        ]);
        if($request->photo)
        {
            $position = strpos($request->photo,';');
            $sub = substr($request->photo,0,$position);
            $ext = explode('/',$sub)[1];
            $name =time().".".$ext;
            $image = Image::make($request->photo)->resize(240,240);
            $uload_path = 'backend/employee/';
            $image_url =$uload_path.$name;
            $image->save($image_url);

            $employee = new Employee;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->sallery = $request->sallery;
            $employee->address = $request->address;
            $employee->nuit = $request->nuit;
            $employee->join_date = $request->join_date;
            $employee->photo = $image_url;
            $employee->save();
        }else{
            $employee = new Employee;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->sallery = $request->sallery;
            $employee->address = $request->address;
            $employee->nuit = $request->nuit;
            $employee->join_date = $request->join_date;
            $employee->save();
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
        $employee = DB::table('employees')->where('id',$id)->first();
        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['sallery'] = $request->sallery;
        $data['nuit'] = $request->nuit;
        $data['phone'] = $request->phone;
        $data['join_date'] = $request->join_date;
        $image = $request->newphoto;
        if($image)
        {
            $position = strpos($image,';');
            $sub = substr($image,0,$position);
            $ext = explode('/',$sub)[1];
            $name =time().".".$ext;
            $image = Image::make($image)->resize(240,240);
            $uload_path = 'backend/employee/';
            $image_url =$uload_path.$name;
            $success = $image->save($image_url);
            if($success)
            {
                $data['photo'] = $image_url;
                $img = DB::table('employees')->where('id',$id)->first();
                $image_path = $img->photo;
                $done = unlink($image_path);
                $user = DB::table('employees')->where('id',$id)->update($data);
            }
        }else
        {
            $oldphoto = $request->photo;
            $data['photo'] =$oldphoto;
            $user = DB::table('employees')->where('id',$id)->update($data);
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
        $employee = DB::table('employees')->where('id',$id)->first();
        $photo = $employee->photo;
        if($photo){
            unlink($photo);
            DB::table('employees')->where('id',$id)->delete();
        }else{
            DB::table('employees')->where('id',$id)->delete();
        }
    }
}
