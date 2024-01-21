<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="API Service",
 *      description="API by for longnguyen",
 * )
 */
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Get(
     *    path="/api/v1/service",
     *    summary="Get List Service",
     *    operationId="getServices",
     *    tags={"Service"},
     *    @OA\Response(response=200, description="successful operation"),
     *    @OA\Response(response=500, description="An error occurred while Display a listing the service.")
     * )
     */
    public function index()
    {
        try {
            $service_list = Service::all();

            return $service_list;
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['message' => 'An error occurred while Display a listing the service.'], 500);
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
     *    path="/api/v1/service",
     *    summary="Create Service",
     *    operationId="storeService",
     *    tags={"Service"},
     *    @OA\RequestBody(
     *        required=true,
     *        description="Create Service",
     *        @OA\JsonContent(
     *            required={"service_name","service_description","service_price","service_status"},
     *            @OA\Property(property="service_name", type="string", example="Service Name"),
     *            @OA\Property(property="service_description", type="string", example="Service Description"),
     *            @OA\Property(property="service_price", type="number", example="100000"),
     *            @OA\Property(property="service_images", type="file", example=""),
     *            @OA\Property(property="service_status", type="number", example="0"),
     *        ),
     *    ),
     *    @OA\Response(response=200, description="Successful operation"),
     *    @OA\Response(response=422, description="Invalid file."),
     *    @OA\Response(response=500, description="An error occurred while creating the service."),
     * )
     *
    */

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'service_name' => 'required',
                'service_description' => 'required',
                'service_price' => 'required|numeric',
                'service_images' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'service_status' => 'required|in:0,1',
            ]);

            $service = new Service();
            $service->service_name = $validatedData['service_name'];
            $service->service_description = $validatedData['service_description'];
            $service->service_price = $validatedData['service_price'];
            $service->service_status = $validatedData['service_status'];
            $service->created_at = now('Asia/Ho_Chi_Minh');

            $get_image = $request->file('service_images');

            if ($get_image) {
                if ($get_image->isValid()) {
                    $original_name = $get_image->getClientOriginalName();
                    $file_extension = $get_image->getClientOriginalExtension();

                    $random_suffix = rand(1000, 9999);

                    $new_image = pathinfo($original_name, PATHINFO_FILENAME) . '_' . $random_suffix . '.' . $file_extension;

                    $get_image->storeAs('images/service', $new_image, 'public');

                    if ($service->service_images) {
                        Storage::disk('public')->delete($service->service_images);
                    }

                    $service->service_images = $new_image;
                } else {
                    return response()->json(['message' => 'Invalid file.'], 422);
                }
            }

            $service->save();

            return response()->json(['message' => 'Service created successfully', 'service' => $service] , 200);
        } catch (\Throwable $th) {
            Log::error($th);

            return response()->json(['message' => 'An error occurred while creating the service.'], 500);
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
        $edit_service = Service::find($id);
        return view('layouts.service.edit', compact('edit_service'));
    }

    /**
     * @OA\Patch(
     *  path="/api/v1/service/{id}",
     *  summary="Update Service",
     *  description="Update Service by ID",
     *  operationId="updateService",
     *  tags={"Service"},
     *  @OA\Parameter(
     *    description="ID of service to return",
     *    in="path",
     *    name="id",
     *    required=true,
     *    @OA\Schema(
     *      type="integer",
     *      format="int64"
     *    )
     *  ),
     *  @OA\RequestBody(
     *    required=true,
     *    description="Update Service",
     *    @OA\JsonContent(
     *      required={"service_name","service_description","service_images","service_status"},
     *      @OA\Property(property="service_name", type="string", example="Service Name"),
     *      @OA\Property(property="service_description", type="string", example="Service Description"),
     *      @OA\Property(property="service_price", type="number", example="20000"),
     *      @OA\Property(property="service_images", type="file", example="Service Images"),
     *      @OA\Property(property="service_status", type="number", example="0"),
     *    ),
     *  ),
     *  @OA\Response(response=200, description="Successful operation"),
     *  @OA\Response(response=404, description="Service not found"),
     *  @OA\Response(response=422, description="Invalid file."),
     *  @OA\Response(response=500, description="An error occurred while updating the service.")
     * )
     */
    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'service_name' => 'required',
                'service_description' => 'required',
                'service_price' => 'required|numeric',
                'service_images' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'service_status' => 'required|in:0,1',
            ]);

            $service = Service::find($id);

            if (!$service) {
                return response()->json(['message' => 'Service not found'], 404);
            }

            $service->service_name = $validatedData['service_name'];
            $service->service_description = $validatedData['service_description'];
            $service->service_price = $validatedData['service_price'];
            $service->service_status = $validatedData['service_status'];
            $service->updated_at = now(config('app.timezone'));

            $this->processAndStoreImage($request, $service);

            $service->save();

            return response()->json(['message' => 'Service updated successfully', 'service' => $service], 200);
        } catch (\Throwable $th) {
            Log::error($th);

            return response()->json(['message' => 'An error occurred while updating the service.'], 500);
        }
    }

    /**
     * Process and store the service image.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Service $service
     */
    private function processAndStoreImage(Request $request, Service $service)
    {
        $get_image = $request->file('service_images');

        if ($get_image) {
            if ($get_image->isValid()) {
                $original_name = $get_image->getClientOriginalName();
                $file_extension = $get_image->getClientOriginalExtension();

                $random_suffix = rand(1000, 9999);

                $new_image = pathinfo($original_name, PATHINFO_FILENAME) . '_' . $random_suffix . '.' . $file_extension;

                $get_image->storeAs('images/service', $new_image, 'public');

                if ($service->service_images && Storage::disk('public')->exists('images/service/' . $service->service_images)) {
                    Storage::disk('public')->delete('images/service/' . $service->service_images);
                }

                $service->service_images = $new_image;
            } else {
                throw new \Exception('Invalid file.', 422);
            }
        }
    }


    /**
     * @OA\Delete(
     *   path="/api/v1/service/{id}",
     *   summary="Delete Service",
     *   operationId="destroyService",
     *   tags={"Service"},
     *   @OA\Parameter(
     *     description="ID of service to return",
     *     in="path",
     *     name="id",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *       format="int64"
     *     )
     *   ),
     *   @OA\Response(response=200, description="Successful operation"),
     *   @OA\Response(response=404, description="Service not found"),
     *   @OA\Response(response=500, description="An error occurred while deleting the service.")
     * )
     */
    public function destroy($id)
    {
        try {
            $service = Service::find($id);

            if (!$service) {
                return response()->json(['message' => 'Service not found'], 404);
            }

            if ($service->service_images) {
                Storage::disk('public')->delete('images/service/' . $service->service_images);
            }

            $service->delete();

            return response()->json(['message' => 'Service deleted successfully', 'service' => $service], 200);
        } catch (\Throwable $th) {
            Log::error($th);

            return response()->json(['message' => 'An error occurred while deleting the service.'], 500);
        }
    }
}
