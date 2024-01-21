<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *    path="/api/v1/branch",
     *    summary="Get List Branch",
     *    operationId="getBranches",
     *    tags={"Branch"},
     *    @OA\Response(response=200, description="successful operation"),
     *    @OA\Response(response=500, description="An error occurred while Display a listing the branch.")
     * )
     */
    public function index()
    {
        try {
            $branch_list = Branch::all();

            return $branch_list;
        } catch (\Throwable $th) {
            Log::error($th);

            return response()->json(['message' => 'An error occurred while Display a listing the branch.'], 500);
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
     *
     * @OA\Post(
     *   path="/api/v1/branch",
     *   summary="Create Branch",
     *   operationId="createBranch",
     *   tags={"Branch"},
     *   @OA\RequestBody(
     *     required=true,
     *     description="Create Branch",
     *     @OA\JsonContent(
     *       required={"branch_name","branch_phone","branch_email","branch_address","branch_status"},
     *       @OA\Property(property="branch_name", type="string", format="text", example="Branch 1"),
     *       @OA\Property(property="branch_phone", type="string", format="text", example="0123456789"),
     *       @OA\Property(property="branch_email", type="string", format="text", example="example@example.com"),
     *       @OA\Property(property="branch_address", type="string", format="text", example="Address 1"),
     *       @OA\Property(property="branch_status", type="integer", format="int", example="1"),
     *     ),
     *   ),
     *   @OA\Response(response=200, description="Successful operation"),
     *   @OA\Response(response=500, description="An error occurred while creating the Branch.")
     * )
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'branch_name' => 'required',
                'branch_phone' => 'required',
                'branch_email' => 'required|email',
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

            return response()->json(['message' => 'Branch created successfully', 'branch' => $branch] , 200);
        } catch (\Throwable $th) {
            Log::error($th);

            return response()->json(['message' => 'An error occurred while creating the Branch.'], 500);
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
     *
     * @OA\Patch(
     *   path="/api/v1/branch/{id}",
     *   summary="Update Branch",
     *   description="Update Branch",
     *   operationId="updateBranch",
     *   tags={"Branch"},
     *   @OA\Parameter(
     *     description="ID of branch to return",
     *     in="path",
     *     name="id",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     description="Update Branch",
     *     @OA\JsonContent(
     *       required={"branch_name","branch_phone","branch_email","branch_address","branch_status"},
     *       @OA\Property(property="branch_name", type="string", format="text", example="Branch 1 updated"),
     *       @OA\Property(property="branch_phone", type="string", format="text", example="01234567899"),
     *       @OA\Property(property="branch_email", type="string", format="text", example="exampleupdate@example.com"),
     *       @OA\Property(property="branch_address", type="string", format="text", example="Address 1 updated"),
     *       @OA\Property(property="branch_status", type="integer", format="int", example="0"),
     *     ),
     *   ),
     *   @OA\Response(response=200, description="Successful operation"),
     *   @OA\Response(response=500, description="An error occurred while updating the Branch.")
     * )
     */
    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([

                'branch_name' => 'required',
                'branch_phone' => 'required',
                'branch_email' => 'required',
                'branch_address' => 'required',
                'branch_status' => 'required|in:0,1',
            ]);

            $branch = Branch::find($id);
            $branch->branch_name = $validatedData['branch_name'];
            $branch->branch_phone = $validatedData['branch_phone'];
            $branch->branch_email = $validatedData['branch_email'];
            $branch->branch_address = $validatedData['branch_address'];
            $branch->branch_status = $validatedData['branch_status'];
            $branch->updated_at = Carbon::now();
            $branch->save();

            return response()->json(['message' => 'Branch updated successfully', 'branch' => $branch] , 200);
        } catch (\Throwable $th) {
            Log::error($th);

            return response()->json(['message' => 'An error occurred while updating the Branch.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @OA\Delete(
     *   path="/api/v1/branch/{id}",
     *   summary="Delete Branch",
     *   description="Delete Branch",
     *   operationId="deleteBranch",
     *   tags={"Branch"},
     *   @OA\Parameter(
     *     description="ID of branch to return",
     *     in="path",
     *     name="id",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\Response(response=200, description="Branch deleted successfully"),
     *   @OA\Response(response=500, description="An error occurred while deleting the Branch.")
     * )
     */
    public function destroy($id)
    {
        try {
            $branch = Branch::find($id);
            $branch->delete();

            return response()->json(['message' => 'Branch deleted successfully'] , 200);
        } catch (\Throwable $th) {
            Log::error($th);

            return response()->json(['message' => 'An error occurred while deleting the Branch.'], 500);
        }
    }
}
