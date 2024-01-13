<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Carbon\Carbon;

use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $branch_list = Branch::all();

            return response()->json([
                'status' => 200,
                'message' => 'Get data successfully',
                'data' => $branch_list
            ]);
        } catch (\Throwable $th) {
            dd($th);
        }
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
        try {
            $request->validate([
                'branch_name' => 'required',
                'branch_phone' => 'required',
                'branch_email' => 'required',
                'branch_address' => 'required',
                'branch_status' => 'required|in:0,1',
            ]);

            $branch = new Branch();
            $branch->branch_name = $request->branch_name;
            $branch->branch_phone = $request->branch_phone;
            $branch->branch_email = $request->branch_email;
            $branch->branch_address = $request->branch_address;
            $branch->branch_status = $request->branch_status;
            $branch->created_at = Carbon::now();
            $branch->save();

            toastr()->success('Tạo chi nhánh thành công.', 'Thành công');
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th);
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
        $edit_branch = Branch::find($id);
        return view('layouts.branch.edit', compact('edit_branch'));
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
        try {
            $request->validate([

                'branch_name' => 'required',
                'branch_phone' => 'required',
                'branch_email' => 'required',
                'branch_address' => 'required',
                'branch_status' => 'required|in:0,1',
            ]);

            $branch = Branch::find($id);
            $branch->branch_name = $request->branch_name;
            $branch->branch_phone = $request->branch_phone;
            $branch->branch_email = $request->branch_email;
            $branch->branch_address = $request->branch_address;
            $branch->branch_status = $request->branch_status;
            $branch->updated_at = Carbon::now();
            $branch->save();

            toastr()->success('Chi nhánh cập nhật thành công.', 'Thành công');
            return redirect()->route('home');
        } catch (\Throwable $th) {
            dd($th);
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
        try {
            $branch = Branch::find($id);
            if (!$branch) {
                return redirect()->route('home')->with('error', 'Không tìm thấy chi nhánh.');
            }

            $branch->delete();
            toastr()->success('Chi nhánh xoá thành công.', 'Thành công');
            return redirect()->route('home')->with('success', 'chi nhánh đã được xóa thành công.');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
