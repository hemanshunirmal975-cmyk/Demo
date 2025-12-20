<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    //1. display all employees
    public function index(){
        $employees=Employee::all();
        return view('employees.index', compact('employees'));
    }

    //2. show create form
    public function create(){
        return view('employees.create');
    }

    //3. store employee
    public function store(Request $request){
        $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:employees',
        'phone' => 'required|regex:/^[6-9][0-9]{9}$/',
        'role' => 'required',
        'photo'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);
        $data = $request->only([
        'name',
        'email',
        'phone',
        'role',
        'photo'
    ]);

    if ($request->hasFile('photo')) {
        $data['photo'] = $request->photo->store('employees', 'public');
    }

    Employee::create($data);

    return redirect()->route('employees.index');
    }

    //4. show edit form

    public function edit(Employee $employee){
        return view('employees.edit',compact('employee'));
    }

    //5.update employee

    public function update(Request $request , Employee $employee){
        $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:employees',
        'phone' => 'required|regex:/^[6-9][0-9]{9}$/',
        'role' => 'required',
        'photo'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);
    $data = $request->only([
        'name',
        'email',
        'phone',
        'role',
        'photo'
    ]);

    if ($request->hasFile('photo')) {
        $data['photo'] = $request->photo->store('employees', 'public');
    }
        $employee->update($data);
        return redirect()->route('employees.index');
    }
    
    //6. delete employee
    public function destroy(Employee $employee){
        $employee->delete();
        return redirect()->route('employees.index');
    }
}
