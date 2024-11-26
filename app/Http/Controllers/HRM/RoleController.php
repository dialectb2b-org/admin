<?php

namespace App\Http\Controllers\HRM;

use App\Http\Controllers\Controller;
use App\Http\Requests\HRM\RoleRequest;
use Illuminate\Http\Request;
use App\Models\Role;
use DB;

class RoleController extends Controller
{

    public function index(Request $request)
    {
        $query = Role::query();
        if(!is_null($request->keyword)){
            $query->where('name','like',$request->keyword.'%');
        }
        $roles = $query->oldest()->paginate(10);
        return view('hrm.roles.index',compact('roles'));
    }

    public function create()
    {
        return view('hrm.roles.create');
    }

    public function store(RoleRequest $request)
    {
        DB::beginTransaction();
        try{
            $role = Role::create(['name' => $request->get('name')]);
            DB::commit();
            return redirect()->route('role.index')->with('success','Role created successfully');
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }
    }

    public function show($id)
    {
        $role = Role::find($id);
        return view('hrm.roles.show', compact('role'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        return view('hrm.roles.edit', compact('role'));
    }

    public function update(RoleRequest $request, $id)
    {
        DB::beginTransaction();
        try{
            $role = Role::find($id);
            $role->update($request->only('name'));
            DB::commit();
            return redirect()->route('role.index')->with('success','Role updated successfully');
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $role = Role::find($id);
            $role->delete();
            DB::commit();
            return redirect()->route('role.index')->with('success','Role deleted successfully');
        }
        catch (Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('warning','Something Went Wrong! Try Again');
        }
    }
}
