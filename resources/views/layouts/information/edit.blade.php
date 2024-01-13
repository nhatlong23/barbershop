@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('information.update', ['information' => $edit_information->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <h1>Sửa thông tin website barbershop</h1>
            <div class="from-control">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tên shop</label>
                    <input type="text" class="form-control" name="information_name"
                        id="exampleFormControlInput1" value="{{$edit_information->information_name}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tiêu đề shop</label>
                    <input type="text" class="form-control" name="information_title"
                        id="exampleFormControlInput1" value="{{$edit_information->information_title}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Số điện thoại shop</label>
                    <input type="phone" class="form-control" name="information_phone"
                        placeholder="Mobile 010-020-0340"
                        {{-- pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" --}}
                        id="exampleFormControlInput1" value="{{$edit_information->information_phone}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email shop</label>
                    <input type="email" class="form-control" name="information_email"
                        id="exampleFormControlInput1" value="{{$edit_information->information_email}}">
                </div>

                <div class="mb-3">
                    <label for="openingHoursSelect" class="form-label">Chọn trạng thái cửa hàng:</label>
                    <select class="form-select" name="information_status" id="openingHoursSelect">
                        <option value="0" @if(old('information_status', $edit_information->information_status) == '0') selected @endif>
                            Khoá cửa
                        </option>
                        <option value="1" @if(old('information_status', $edit_information->information_status) == '1') selected @endif>
                            Mở cửa
                        </option>
                    </select>
                </div>

                <div id="openingHours">
                    <div class="mb-3">
                        <label for="openingTime" class="form-label">Giờ mở cửa:</label>
                        <input type="time" class="form-control" name="information_opening_time" id="openingTime" value="{{ old('information_opening_time', $edit_information->information_opening_time) }}">
                    </div>

                    <div class="mb-3">
                        <label for="closingTime" class="form-label">Giờ đóng cửa:</label>
                        <input type="time" class="form-control" name="information_closing_time" id="closingTime" value="{{ old('information_closing_time', $edit_information->information_closing_time) }}">
                    </div>
                </div>
                {{-- <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Hình ảnh shop</label>
                    <input type="file" class="form-control" name="information_images"
                        id="exampleFormControlInput1">
                </div> --}}
                <div class="picture-container hight">
                    <div class="picture">
                        <img src="{{ asset('images/logo/' . $edit_information->information_images) }}" class="picture-src" id="wizardPicturePreview" title="" />
                        <input type="file" name="information_images" id="wizard-picture" aria-invalid="false" class="valid"
                            accept="image/*" />
                    </div>
                    <h5>Chọn hình ảnh</h5>
                </div>
                <div class="mb-3">
                    <label for="validationTextarea" class="form-label">Mô tả shop</label>
                    <textarea class="form-control" name="information_description" id="editor2">{{$edit_information->information_description}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="validationTextarea" class="form-label">Sứ mệnh shop</label>
                    <textarea class="form-control" name="information_mission" id="editor3">{{$edit_information->information_mission}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="validationTextarea" class="form-label">Địa chỉ map shop</label>
                    <textarea class="form-control" name="information_maps">{{$edit_information->information_maps}}</textarea>
                </div>
                <input type="submit" name="themthongtinwebsite" class="btn btn-primary" value="Sửa">
            </div>
        </form>
    </div>
@endsection
