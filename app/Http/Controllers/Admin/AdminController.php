<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Contact;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $admins = Admin::where('id', '!=', Auth('admin')->id())->get();
        return view('admin.adminCrud.index', compact('admins')); // send data to view named index.blade.php in admin folder in views folder
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View ('admin.adminCrud.create'); // send data to view named create.blade.php in admin folder in views folder
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate admin data

        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:admins,code',
            'password' => 'required'
            ,
        ]

    );
    // $messages = [
    //     'name.required' => 'يرجي ارسال اسم المشرف',
    //     'code.required' => 'يرجي ارسال كود المشرف',
    //     'code.unique' => 'كود المشرف موجود بالفعل',
    //     'password.required' => 'يرجي ارسال كلمة المرور',

    // ];
        $password = Hash::make($request->password);
        Admin::create([
            'name' => $request->name,
            'code' => $request->code,
            'password' => $password

        ]);

        return redirect()->route('admin.index')->with('success', 'تم اضافة المشرف بنجاح');

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
        $id = decrypt($id);
        $admin = Admin::findOrFail($id);
        return view('admin.adminCrud.edit', compact('admin'));

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

        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:admins,code,'.$id,
        ]);

        if ($request->has('password') && $request->password != null) {
            $password = Hash::make($request->password);
            Admin::findOrFail($id)->update([
                'name' => $request->name,
                'code' => $request->code,
                'password' => $request->password
            ]);
            return redirect()->route('admin.index')->with('success', 'تم تعديل المشرف بنجاح');
        } else {
            Admin::findOrFail($id)->update([
                'name' => $request->name,
                'code' => $request->code,
            ]);
            return redirect()->route('admin.index')->with('success', 'تم تعديل المشرف بنجاح');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

         Admin::findOrFail($request->id)->delete();
         return redirect()->route('admin.index')->with('successDelete', 'تم حذف المشرف بنجاح');


    }
    public function contact()
    {
        $contacts = Contact::all();
        return view('admin.contact', compact('contacts'));
    }
}
