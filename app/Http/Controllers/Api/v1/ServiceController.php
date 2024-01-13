<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Carbon\Carbon;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $service_list = Service::all();

            return response()->json([
                'status' => 200,
                'message' => 'Get data successfully',
                'data' => $service_list
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
                'service_name' => 'required',
                'service_description' => 'required',
                'service_price' => 'required|numeric',
                'service_images' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'service_status' => 'required|in:0,1',
            ]);

            $service = new Service();
            $service->service_name = $request->service_name;
            $service->service_description = $request->service_description;
            $service->service_price = $request->service_price;
            $service->service_status = $request->service_status;
            $service->created_at = now('Asia/Ho_Chi_Minh');

            $get_image = $request->file('service_images');
            if ($get_image) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = pathinfo($get_name_image, PATHINFO_FILENAME);
                $new_image = $name_image . '_' . time() . '.' . $get_image->getClientOriginalExtension();
                $get_image->move(public_path('images/logo/'), $new_image);

                if ($service->service_images && file_exists(public_path('images/logo/') . $service->service_images)) {
                    unlink(public_path('images/logo/') . $service->service_images);
                }

                $service->service_images = $new_image;
            }

            $service->save();

            toastr()->success('Tạo dịch vụ thành công.', 'Thành công');
            return redirect()->route('home');
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
        $edit_service = Service::find($id);
        return view('layouts.service.edit', compact('edit_service'));
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
                'service_name' => 'required',
                'service_description' => 'required',
                'service_price' => 'required|numeric',
                'service_images' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'service_status' => 'required|in:0,1',
            ]);

            $service = Service::find($id);
            $service->service_name = $request->service_name;
            $service->service_description = $request->service_description;
            $service->service_price = $request->service_price;
            $service->service_status = $request->service_status;
            $service->updated_at = now('Asia/Ho_Chi_Minh');

            $get_image = $request->file('service_images');
            if ($get_image) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = pathinfo($get_name_image, PATHINFO_FILENAME);
                $new_image = $name_image . '_' . time() . '.' . $get_image->getClientOriginalExtension();
                $get_image->move(public_path('images/logo/'), $new_image);

                if ($service->service_images && file_exists(public_path('images/logo/') . $service->service_images)) {
                    unlink(public_path('images/logo/') . $service->service_images);
                }

                $service->service_images = $new_image;
            }

            $service->save();

            toastr()->success('Dịch vụ đã được cập nhật thành công!', 'Thành công');
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
            $service = Service::find($id);
            $service->delete();
            toastr()->success('Dịch vụ đã được xoá thành công!', 'Thành công');
            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
