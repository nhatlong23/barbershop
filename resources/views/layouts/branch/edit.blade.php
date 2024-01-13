@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('branch.update', ['branch' => $edit_branch->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h1>Cập nhật chi nhánh</h1>
            <div class="from-group">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tên chi nhánh</label>
                    <input type="text" class="form-control" name="branch_name"
                        id="exampleFormControlInput1" value="{{$edit_branch->branch_name}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Số điện thoại chi
                        nhánh</label>
                    <input type="number" class="form-control" name="branch_phone"
                        id="exampleFormControlInput1" value="{{$edit_branch->branch_phone}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email chi nhánh</label>
                    <input type="email" class="form-control" name="branch_email"
                        id="exampleFormControlInput1" value="{{$edit_branch->branch_email}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Địa chỉ chi nhánh</label>
                    <input type="text" class="form-control" name="branch_address"
                        id="exampleFormControlInput1"
                        value="{{$edit_branch->branch_address}}">
                </div>
                <div class="mb-3">
                    <label for="openingHoursSelect" class="form-label">Trạng thái chi nhánh:</label>
                    <select class="form-select" name="branch_status" id="openingHoursSelect">
                        <option value="1">Hiển thị chi nhánh</option>
                        <option value="0">Ẩn chi nhánh</option>
                    </select>
                </div>
                <button type="submit" name="themdichvu" class="btn btn-info">Cập nhật</button>
            </div>
        </form>
    </div>
@endsection
