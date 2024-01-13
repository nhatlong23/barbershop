<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Information;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $information_list = Information::all();
        return response()->json([
            'status' => 200,
            'message' => 'Get data successfully',
            'data' => $information_list
        ]);
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
     */
    public function show($id)
    {
        $information = Information::find($id);
        return response()->json([
            'status' => 200,
            'message' => 'Get data successfully',
            'data' => $information
        ]);
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
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
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
            ]);

            $information = Information::find($id);

            if (!$information) {
                return response()->json(['error' => 'Information not found'], 404);
            }

            $this->updateInformationModel($information, $request);

            toastr()->success('Cập nhật thông tin website thành công.', 'Thành công');
            return redirect()->route('home');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    private function updateInformationModel(Information $information, Request $request)
    {
        $information->information_name = $request->information_name;
        $information->information_title = $request->information_title;
        $information->information_phone = $request->information_phone;
        $information->information_email = $request->information_email;
        $information->information_status = $request->information_status;
        $information->information_opening_time = $request->information_opening_time;
        $information->information_closing_time = $request->information_closing_time;
        $information->information_mission = $request->information_mission;
        $information->information_description = $request->information_description;
        $information->information_maps = $request->information_maps;

        $this->handleImageUpload($information, $request);

        $information->save();
    }

    private function handleImageUpload(Information $information, Request $request)
    {
        $get_image = $request->file('information_images');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = pathinfo($get_name_image, PATHINFO_FILENAME);
            $new_image = $name_image . '_' . time() . '.' . $get_image->getClientOriginalExtension();
            $get_image->move(public_path('images/logo/'), $new_image);

            if ($information->information_images && file_exists(public_path('images/logo/') . $information->information_images)) {
                unlink(public_path('images/logo/') . $information->information_images);
            }

            $information->information_images = $new_image;
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
