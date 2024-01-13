<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hairdresser;
use Carbon\Carbon;

class HairdresserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $hairdresser_list = Hairdresser::all();

            return response()->json([
                'status' => 200,
                'message' => 'Get data successfully',
                'data' => $hairdresser_list
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
                'hairdresser_name' => 'required',
                'hairdresser_phone' => 'required',
                'hairdresser_email' => 'required',
                'hairdresser_images' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'hairdresser_status' => 'required|in:0,1',
            ]);

            $hairdresser = new Hairdresser();
            $hairdresser->hairdresser_name = $request->hairdresser_name;
            $hairdresser->hairdresser_phone = $request->hairdresser_phone;
            $hairdresser->hairdresser_email = $request->hairdresser_email;
            $hairdresser->hairdresser_status = $request->hairdresser_status;
            $hairdresser->created_at = Carbon::now('Asia/Ho_Chi_Minh');

            $get_image = $request->file('hairdresser_images');
            if ($get_image) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = pathinfo($get_name_image, PATHINFO_FILENAME);
                $new_image = $name_image . '_' . time() . '.' . $get_image->getClientOriginalExtension();
                $get_image->move(public_path('images/logo/'), $new_image);

                if ($hairdresser->hairdresser_images) {
                    unlink(public_path('images/logo/') . $hairdresser->hairdresser_images);
                }

                $hairdresser->hairdresser_images = $new_image;
            }

            $hairdresser->save();
            toastr()->success('Tạo thợ cắt tóc thành công.', 'Thành công');

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
        $edit_hairdresser = Hairdresser::find($id);
        return view('layouts.hairdresser.edit', compact('edit_hairdresser'));
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
                'hairdresser_name' => 'required',
                'hairdresser_phone' => 'required',
                'hairdresser_email' => 'required',
                'hairdresser_images' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'hairdresser_status' => 'required|in:0,1',
            ]);

            $hairdresser = hairdresser::find($id);
            if (!$hairdresser) {
                return redirect()->route('home')->with('error', 'Không tìm thấy thợ cắt tóc.');
            }

            $hairdresser->hairdresser_name = $request->hairdresser_name;
            $hairdresser->hairdresser_phone = $request->hairdresser_phone;
            $hairdresser->hairdresser_email = $request->hairdresser_email;
            $hairdresser->hairdresser_status = $request->hairdresser_status;
            $hairdresser->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

            $get_image = $request->file('hairdresser_images');
            if ($get_image) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = pathinfo($get_name_image, PATHINFO_FILENAME);
                $new_image = $name_image . '_' . time() . '.' . $get_image->getClientOriginalExtension();
                $get_image->move(public_path('images/logo/'), $new_image);

                if ($hairdresser->hairdresser_images && file_exists(public_path('images/logo/') . $hairdresser->hairdresser_images)) {
                    unlink(public_path('images/logo/') . $hairdresser->hairdresser_images);
                }

                $hairdresser->hairdresser_images = $new_image;
            }

            $hairdresser->save();
            toastr()->success('Cập nhật thợ cắt tóc thành công.', 'Thành công');
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
            $hairdresser = Hairdresser::find($id);
            if (!$hairdresser) {
                return redirect()->route('home')->with('error', 'Không tìm thấy thợ cắt tóc.');
            }

            $hairdresser->delete();
            toastr()->success('Xoá thợ cắt tóc thành công.', 'Thành công');
            return redirect()->route('home');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
