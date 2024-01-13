@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('hairdresser.update', ['hairdresser' => $edit_hairdresser->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <h1>Cập nhật thợ cắt tóc</h1>
            <div class="from-group">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tên thợ cắt tóc</label>
                    <input type="text" name="hairdresser_name" value="{{ $edit_hairdresser->hairdresser_name }}"
                        class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Số điện thoại thợ cắt
                        tóc</label>
                    <input type="number" class="form-control" name="hairdresser_phone" id="exampleFormControlInput1"
                        value="{{ $edit_hairdresser->hairdresser_phone }}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email thợ cắt tóc</label>
                    <input type="email" class="form-control" name="hairdresser_email" id="exampleFormControlInput1"
                        value="{{ $edit_hairdresser->hairdresser_email }}">
                </div>
                {{-- <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Hình ảnh thợ cắt tóc</label>
                    <input type="file" class="form-control" name="hairdresser_images" id="exampleFormControlInput1">
                </div> --}}
                <div class="picture-container hight">
                    <div class="picture">
                        <img src="{{ asset('images/logo/' . $edit_hairdresser->hairdresser_images) }}" class="picture-src"
                            id="wizardPicturePreview" title="" />
                        <input type="file" name="hairdresser_images" id="wizard-picture" aria-invalid="false"
                            class="valid" accept="image/*" />
                    </div>
                    <h5>Chọn hình ảnh</h5>
                </div>
                <div class="mb-3">
                    <label for="hairdresserStatusSelect" class="form-label">Trạng thái thợ cắt tóc:</label>
                    <select class="form-select" name="hairdresser_status" id="hairdresserStatusSelect">
                        <option value="1" {{ old('hairdresser_status', $edit_hairdresser->hairdresser_status) == '1' ? 'selected' : '' }}>
                            Hiển thị thợ cắt tóc
                        </option>
                        <option value="0" {{ old('hairdresser_status', $edit_hairdresser->hairdresser_status) == '0' ? 'selected' : '' }}>
                            Ẩn thợ cắt tóc
                        </option>
                    </select>
                </div>
                <button type="submit" name="themdichvu" class="btn btn-info">Cập nhật</button>
            </div>
        </form>
    </div>
@endsection
