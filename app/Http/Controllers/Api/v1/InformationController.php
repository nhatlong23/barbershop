<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Information;
use Illuminate\Support\Facades\Log;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *   path="/api/v1/information",
     *   summary="Get List Information",
     *   operationId="getInformation",
     *   tags={"Information"},
     *   @OA\Response(response=200, description="Successful operation"),
     *   @OA\Response(response=500, description="An error occurred while displaying a listing of the information.")
     * )
     */
    public function index()
    {
        try {
            $information_list = Information::all();
            return $information_list;
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['message' => 'An error occurred while Display a listing the information.'], 500);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *   path="/api/v1/information/{id}",
     *   summary="Get Information by ID",
     *   operationId="getInformationById",
     *   tags={"Information"},
     *   @OA\Parameter(
     *     description="ID of information to return",
     *     in="path",
     *     name="id",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\Response(response=200, description="Successful operation"),
     *   @OA\Response(response=404, description="Information not found"),
     *   @OA\Response(response=500, description="An error occurred while displaying the information.")
     * )
     */
    public function show($id)
    {
        try {
            $information = Information::findOrFail($id);
            return $information;
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['message' => 'An error occurred while Display a listing the information.'], 500);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_information = Information::find($id);
        return view('layouts.information.edit', compact('edit_information'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @OA\Patch(
     *   path="/api/v1/information/{id}",
     *   summary="Update Information",
     *   description="Update Information",
     *   operationId="updateInformation",
     *   tags={"Information"},
     *   @OA\Parameter(
     *     description="ID of information to return",
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
     *     description="Update Information",
     *     @OA\JsonContent(
     *       required={"information_name", "information_title", "information_phone", "information_email", "information_status", "information_opening_time", "information_closing_time", "information_mission", "information_description", "information_maps"},
     *       @OA\Property(property="information_name", type="string", example="Barbershop"),
     *       @OA\Property(property="information_title", type="string", example="Barbershop"),
     *       @OA\Property(property="information_phone", type="string", example="01234567899"),
     *       @OA\Property(property="information_email", type="string", example=""),
     *       @OA\Property(property="information_images", type="string", format="binary", example=""),
     *       @OA\Property(property="information_status", type="integer", example="1"),
     *       @OA\Property(property="information_opening_time", type="string", example="08:00:00"),
     *       @OA\Property(property="information_closing_time", type="string", example="17:00:00"),
     *       @OA\Property(property="information_mission", type="string", example="Barbershop"),
     *       @OA\Property(property="information_description", type="string", example="Barbershop"),
     *       @OA\Property(property="information_maps", type="string", example="Barbershop"),
     *     ),
     *   ),
     *   @OA\Response(response=200, description="Successful operation"),
     *   @OA\Response(response=404, description="Information not found"),
     *   @OA\Response(response=422, description="Invalid file."),
     *   @OA\Response(response=500, description="An error occurred while updating the information.")
     * )
     */
    public function update(Request $request, $id)
    {
        try {
            $information = Information::find($id);

            if (!$information) {
                return response()->json(['error' => 'Information not found'], 404);
            }

            $this->updateInformationModel($information, $request);

            return response()->json(['message' => 'Information updated successfully', 'information' => $information], 200);
        } catch (\Throwable $th) {
            Log::error($th);

            return response()->json(['message' => 'An error occurred while updating the information.'], 500);
        }
    }

    /**
     * Update the Information model with the validated data from the request.
     *
     * @param Information $information
     * @param Request $request
     */
    private function updateInformationModel(Information $information, Request $request)
    {
        $validatedData = $request->validate([
            'information_name' => 'required',
            'information_phone' => 'required',
            'information_email' => 'required',
            'information_images' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'information_status' => 'required|in:0,1',
            'information_opening_time' => 'required',
            'information_closing_time' => 'required',
            'information_mission' => 'required',
            'information_description' => 'required',
            'information_maps' => 'required',
            'information_title' => 'required',
        ]);

        $information->information_name = $validatedData['information_name'];
        $information->information_title = $validatedData['information_title'];
        $information->information_phone = $validatedData['information_phone'];
        $information->information_email = $validatedData['information_email'];
        $information->information_status = $validatedData['information_status'];
        $information->information_opening_time = $validatedData['information_opening_time'];
        $information->information_closing_time = $validatedData['information_closing_time'];
        $information->information_mission = $validatedData['information_mission'];
        $information->information_description = $validatedData['information_description'];
        $information->information_maps = $validatedData['information_maps'];

        $this->handleImageUpload($information, $validatedData);

        $information->save();
    }

    /**
     * Handle the upload of information images.
     *
     * @param Information $information
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|null
     */
    private function handleImageUpload(Information $information, Request $request)
    {
        $get_image = $request->file('information_images');

        if ($get_image) {
            if ($get_image->isValid()) {
                $original_name = $get_image->getClientOriginalName();
                $file_extension = $get_image->getClientOriginalExtension();

                $random_suffix = rand(1000, 9999);

                $new_image = pathinfo($original_name, PATHINFO_FILENAME) . '_' . $random_suffix . '.' . $file_extension;

                $get_image->storeAs('images/information', $new_image, 'public');

                if ($information->information_images) {
                    Storage::disk('public')->delete($information->information_images);
                }

                $information->information_images = $new_image;
            } else {
                return response()->json(['message' => 'Invalid file.'], 422);
            }
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
    }
}
