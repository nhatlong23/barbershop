@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('service.update', ['service' => $edit_service->id]) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h1>Cập nhật dịch vụ</h1>
            <div class="from-group">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tên dịch vụ</label>
                    <input type="text" name="service_name" value="{{ $edit_service->service_name }}" class="form-control"
                        id="exampleFormControlInput1">
                </div>
                <div class="mb-3">
                    <label for="validationTextarea" class="form-label">Mô tả dịch vụ</label>
                    <textarea class="form-control" id="editor1" name="service_description">{{ $edit_service->service_description }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Giá dịch vụ</label>
                    <input type="text" class="form-control" name="service_price" id="exampleFormControlInput1"
                        value="{{ $edit_service->service_price }}">
                </div>
                {{-- <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Hình ảnh dịch vụ</label>
                    <input type="file" class="form-control" name="service_images" id="exampleFormControlInput1">
                    <img src="{{ asset('images/logo/' . $edit_service->service_images) }}" height="100" width="100">
                </div> --}}
                <div class="picture-container hight">
                    <div class="picture">
                        <img src="{{ asset('images/logo/' . $edit_service->service_images) }}" class="picture-src" id="wizardPicturePreview" title="" />
                        <input type="file" name="service_images" id="wizard-picture" aria-invalid="false" class="valid"
                            accept="image/*" />
                    </div>
                    <h5>Chọn hình ảnh</h5>
                </div>
                <div class="mb-3">
                    <label for="serviceStatusSelect" class="form-label">Trạng thái dịch vụ:</label>
                    <select class="form-select" name="service_status" id="serviceStatusSelect">
                        <option value="1" {{ old('service_status', $edit_service->service_status) == '1' ? 'selected' : '' }}>
                            Hiển thị dịch vụ
                        </option>
                        <option value="0" {{ old('service_status', $edit_service->service_status) == '0' ? 'selected' : '' }}>
                            Ẩn dịch vụ
                        </option>
                    </select>
                </div>
                <button type="submit" name="themdichvu" class="btn btn-info">Cập nhật</button>
            </div>
        </form>
    </div>
@endsection
