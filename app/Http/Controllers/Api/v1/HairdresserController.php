<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hairdresser;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class HairdresserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *   path="/api/v1/hairdresser",
     *   summary="Get List Hairdresser",
     *   operationId="getHairdressers",
     *   tags={"Hairdresser"},
     *   @OA\Response(response=200, description="successful operation"),
     *   @OA\Response(response=500, description="An error occurred while Display a listing the hairdresser.")
     * )
     */
    public function index()
    {
        try {
            $hairdresser_list = Hairdresser::all();

            return $hairdresser_list;
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['message' => 'An error occurred while Display a listing the hairdresser.'], 500);
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
     *   path="/api/v1/hairdresser",
     *   summary="Create Hairdresser",
     *   operationId="createHairdresser",
     *   tags={"Hairdresser"},
     *   @OA\RequestBody(
     *     required=true,
     *     description="Create Hairdresser",
     *     @OA\JsonContent(
     *       required={"hairdresser_name","hairdresser_phone","hairdresser_email","hairdresser_images","hairdresser_status"},
     *       @OA\Property(property="hairdresser_name", type="string", example="Nguyen Van A"),
     *       @OA\Property(property="hairdresser_phone", type="string", example="0123456789"),
     *       @OA\Property(property="hairdresser_email", type="string", example="example@email.com"),
     *       @OA\Property(property="hairdresser_images", type="string", format="binary", example=""),
     *       @OA\Property(property="hairdresser_status", type="integer", format="int64", example="1"),
     *     ),
     *   ),
     *   @OA\Response(response=200, description="successful operation"),
     *   @OA\Response(response=422, description="Invalid input"),
     *   @OA\Response(response=500, description="An error occurred while creating the Hairdresser.")
     * )
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'hairdresser_name' => 'required',
                'hairdresser_phone' => 'required',
                'hairdresser_email' => 'required',
                'hairdresser_images' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'hairdresser_status' => 'required|in:0,1',
            ]);

            $hairdresser = new Hairdresser();
            $hairdresser->hairdresser_name = $validatedData['hairdresser_name'];
            $hairdresser->hairdresser_phone = $validatedData['hairdresser_phone'];
            $hairdresser->hairdresser_email = $validatedData['hairdresser_email'];
            $hairdresser->hairdresser_status = $validatedData['hairdresser_status'];
            $hairdresser->created_at = Carbon::now('Asia/Ho_Chi_Minh');

            $get_image = $request->file('hairdresser_images');

            if ($get_image) {
                if ($get_image->isValid()) {
                    $original_name = $get_image->getClientOriginalName();
                    $file_extension = $get_image->getClientOriginalExtension();

                    $random_suffix = rand(1000, 9999);

                    $new_image = pathinfo($original_name, PATHINFO_FILENAME) . '_' . $random_suffix . '.' . $file_extension;

                    $get_image->storeAs('images/hairdresser', $new_image, 'public');

                    if ($hairdresser->hairdresser_images) {
                        Storage::disk('public')->delete($hairdresser->hairdresser_images);
                    }

                    $hairdresser->hairdresser_images = $new_image;
                } else {
                    return response()->json(['message' => 'Invalid file.'], 422);
                }
            }

            $hairdresser->save();

            return response()->json(['message' => 'Hairdresser created successfully', 'hairdresser' => $hairdresser], 200);
        } catch (\Throwable $th) {
            Log::error($th);

            return response()->json(['message' => 'An error occurred while creating the Hairdresser.'], 500);
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
        $edit_hairdresser = Hairdresser::find($id);
        return view('layouts.hairdresser.edit', compact('edit_hairdresser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @OA\Patch(
     *   path="/api/v1/hairdresser/{id}",
     *   summary="Update Hairdresser",
     *   operationId="updateHairdresser",
     *   tags={"Hairdresser"},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of hairdresser that needs to be updated",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\RequestBody(
     *     required=true,
     *     description="Update Hairdresser",
     *     @OA\JsonContent(
     *       required={"hairdresser_name","hairdresser_phone","hairdresser_email","hairdresser_images","hairdresser_status"},
     *       @OA\Property(property="hairdresser_name", type="string", example="Nguyen Van A"),
     *       @OA\Property(property="hairdresser_phone", type="string", example="0123456789"),
     *       @OA\Property(property="hairdresser_email", type="string", example="example@email.com"),
     *       @OA\Property(property="hairdresser_images", type="string", format="binary", example=""),
     *       @OA\Property(property="hairdresser_status", type="integer", format="int64", example="1"),
     *     ),
     *   ),
     *   @OA\Response(response=200, description="Successful operation"),
     *   @OA\Response(response=422, description="Invalid input"),
     *   @OA\Response(response=500, description="An error occurred while updating the hairdresser.")
     * )
     */
    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'hairdresser_name' => 'required',
                'hairdresser_phone' => 'required',
                'hairdresser_email' => 'required',
                'hairdresser_images' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'hairdresser_status' => 'required|in:0,1',
            ]);

            $hairdresser = hairdresser::find($id);
            $hairdresser->hairdresser_name = $validatedData['hairdresser_name'];
            $hairdresser->hairdresser_phone = $validatedData['hairdresser_phone'];
            $hairdresser->hairdresser_email = $validatedData['hairdresser_email'];
            $hairdresser->hairdresser_status = $validatedData['hairdresser_status'];
            $hairdresser->created_at = Carbon::now('Asia/Ho_Chi_Minh');

            $get_image = $request->file('hairdresser_images');

            if ($get_image) {
                if ($get_image->isValid()) {
                    $original_name = $get_image->getClientOriginalName();
                    $file_extension = $get_image->getClientOriginalExtension();

                    $random_suffix = rand(1000, 9999);

                    $new_image = pathinfo($original_name, PATHINFO_FILENAME) . '_' . $random_suffix . '.' . $file_extension;

                    $get_image->storeAs('images/hairdresser', $new_image, 'public');

                    if ($hairdresser->hairdresser_images) {
                        Storage::disk('public')->delete($hairdresser->hairdresser_images);
                    }

                    $hairdresser->hairdresser_images = $new_image;
                } else {
                    return response()->json(['message' => 'Invalid file.'], 422);
                }
            }

            $hairdresser->save();

            return response()->json(['message' => 'Hairdresser created successfully', 'hairdresser' => $hairdresser], 200);
        } catch (\Throwable $th) {
            Log::error($th);

            return response()->json(['message' => 'An error occurred while update the hairdresser.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @OA\Delete(
     *   path="/api/v1/hairdresser/{id}",
     *   summary="Delete Hairdresser",
     *   description="Delete Hairdresser",
     *   operationId="deleteHairdresser",
     *   tags={"Hairdresser"},
     *   @OA\Parameter(
     *     description="ID of hairdresser to return",
     *     in="path",
     *     name="id",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\Response(response=200, description="Hairdresser deleted successfully"),
     *   @OA\Response(response=500, description="An error occurred while deleting the hairdresser.")
     * )
     */
    public function destroy($id)
    {
        try {
            $hairdresser = Hairdresser::find($id);

            if ($hairdresser->hairdresser_images) {
                Storage::disk('public')->delete('images/hairdresser/' . $hairdresser->hairdresser_images);
            }

            $hairdresser->delete();

            return response()->json(['message' => 'Hairdresser deleted successfully', 'hairdresser' => $hairdresser], 200);
        } catch (\Throwable $th) {
            Log::error($th);

            return response()->json(['message' => 'An error occurred while delete the hairdresser.'], 500);
        }
    }
}
