<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $booking_list = Booking::all();

            return response()->json([
                'status' => 200,
                'message' => 'Get data successfully',
                'data' => $booking_list
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
            $booking = new Booking();
            $booking->booking_name = $request->booking_name;
            $booking->booking_phone = $request->booking_phone;
            $booking->booking_times = $request->booking_times;
            $booking->booking_days = $request->booking_days;
            $booking->booking_service = $request->booking_service;
            $booking->booking_branch = $request->booking_branch;
            $booking->booking_hairdresser = $request->booking_hairdresser;
            $booking->booking_quantity = $request->booking_quantity;
            $booking->booking_comment = $request->booking_comment;
            $booking->booking_status = 1;
            $booking->created_at = now();
            $booking->save();

            toastr()->success('Đặt lịch cắt tóc thành công.', 'Thành công');
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
        //
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
        //
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
