@extends('layouts.app')

@section('content')
    <style>
        .content-section {
            display: none;
        }

        .active-content {
            display: block;
        }

        .hidden {
            display: none;
        }
    </style>
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#trangchu" onclick="toggleContent('trangchu')">Trang chủ</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#dichvu"
                                        onclick="toggleContent('dichvu')">Dịch vụ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#thotoc" onclick="toggleContent('thotoc')">Thợ cắt tóc</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#chinhanh" onclick="toggleContent('chinhanh')">Tổng chi
                                        nhanh</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#info" onclick="toggleContent('info')">Thông tin trang
                                        web</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                {{-- Content for Trang chủ --}}
                <div id="trangchu-content" class="content-section active-content">
                    {{-- Lịch khách hàng đặt --}}
                    <div class="card">
                        <div class="card-header">
                            Lịch khách hàng đặt
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Tên khách hàng</th>
                                        <th scope="col">Số lượng khách</th>
                                        <th scope="col">Số điện thoại</th>
                                        <th scope="col">Dịch vụ</th>
                                        <th scope="col">Thợ cắt tóc</th>
                                        <th scope="col">Chi nhánh</th>
                                        <th scope="col">Thời gian đặt</th>
                                        <th scope="col">Ngày đặt</th>
                                        <th scope="col">Ghi chú</th>
                                        <th scope="col">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($booking_list as $booking)
                                        <tr>
                                            <td>{{ $booking->booking_name }}</td>
                                            <td>{{ $booking->booking_quantity }} Khách hàng</td>
                                            <td>{{ $booking->booking_phone }}</td>
                                            <td>{{ $booking->service->service_name }}</td>
                                            <td>{{ $booking->hairdresser->hairdresser_name }}</td>
                                            <td>{{ $booking->branch->branch_name }}</td>
                                            <td>{{ $booking->booking_times }}</td>
                                            <td>{{ $booking->booking_days }}</td>
                                            <td>
                                                @if ($booking->booking_comment == null)
                                                    Không có ghi chú
                                                @else
                                                    {{ $booking->booking_comment }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('booking.edit', ['booking' => $booking->id]) }}"
                                                    class="btn btn-primary">Duyệt</a>
                                                <form method="post"
                                                    action="{{ route('booking.destroy', ['booking' => $booking->id]) }}"
                                                    onsubmit="return confirm('Bạn có muốn xoá không')">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Xoá</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- Content for Dịch vụ --}}
                <div id="dichvu-content" class="content-section">
                    <h1>Danh sách dịch vụ</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Tên dịch vụ</th>
                                <th scope="col">Giá dịch vụ</th>
                                <th scope="col">Mô tả dịch vụ</th>
                                <th scope="col">Hình ảnh dịch vụ</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($service_list as $service)
                                <tr>
                                    <td>{{ $service->service_name }}</td>
                                    <td>{{ $service->service_price }}</td>
                                    <td>{!! $service->service_description !!}</td>
                                    <td> <img src="images/logo/{{ $service->service_images }}" height="100"
                                            width="100">
                                    <td>
                                        @if ($service->service_status == 1)
                                            Hiển thị dịch vụ
                                        @else
                                            Ẩn dịch vụ
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('service.edit', ['service' => $service->id]) }}"
                                            class="btn btn-primary">Sửa</a>
                                        <form method="post"
                                            action="{{ route('service.destroy', ['service' => $service->id]) }}"
                                            onsubmit="return confirm('Bạn có muốn xoá không')">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Xoá</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <form method="POST" autocomplete="off" action="{{ route('service.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <h1>Thêm dịch vụ</h1>
                        <div class="from-group">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tên dịch vụ</label>
                                <input type="text" name="service_name" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Cắt tóc">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Giá dịch vụ</label>
                                <input type="text" class="form-control" name="service_price"
                                    id="exampleFormControlInput1" placeholder="50.000">
                            </div>
                            <div class="mb-3">
                                <label for="validationTextarea" class="form-label">Mô tả dịch vụ</label>
                                <textarea class="form-control" name="service_description" id="editor" placeholder="Nhập mô tả dịch vụ"></textarea>
                            </div>
                            <div class="picture-container hight">
                                <div class="picture">
                                    <img src="{{ $service->service_images }}" class="picture-src"
                                        id="wizardPicturePreview" title="" />
                                    <input type="file" name="service_images" id="wizard-picture" aria-invalid="false"
                                        class="valid" accept="image/*" />
                                </div>
                                <h5>Chọn hình ảnh</h5>
                            </div>
                            <div class="mb-3">
                                <label for="openingHoursSelect" class="form-label">Trạng thái dịch vụ:</label>
                                <select class="form-select" name="service_status" id="openingHoursSelect">
                                    <option value="1">Hiển thị dịch vụ</option>
                                    <option value="0">Ẩn dịch vụ</option>
                                </select>
                            </div>
                            <input type="submit" name="themdichvu" class="btn btn-primary" value="Thêm">
                        </div>
                    </form>
                </div>
                {{-- Content for Thợ tóc --}}
                <div id="thotoc-content" class="content-section">
                    <h1>Danh sách thợ cắt tóc</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Tên thợ cắt tóc</th>
                                <th scope="col">Số điện thoại thợ cắt tóc</th>
                                <th scope="col">Email thợ cắt tóc</th>
                                <th scope="col">Hình ảnh thợ cắt tóc</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hairdresser_list as $hairdresser)
                                <tr>
                                    <td>{{ $hairdresser->hairdresser_name }}</td>
                                    <td>{{ $hairdresser->hairdresser_phone }}</td>
                                    <td>{{ $hairdresser->hairdresser_email }}</td>
                                    <td> <img src="images/logo/{{ $hairdresser->hairdresser_images }}" height="100"
                                            width="100">
                                    <td>
                                        @if ($hairdresser->hairdresser_status == 1)
                                            Hiển thị thợ cắt tóc
                                        @else
                                            Ẩn thợ cắt tóc
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('hairdresser.edit', ['hairdresser' => $hairdresser->id]) }}"
                                            class="btn btn-primary">Sửa</a>
                                        <form method="post"
                                            action="{{ route('hairdresser.destroy', ['hairdresser' => $hairdresser->id]) }}"
                                            onsubmit="return confirm('Bạn có muốn xoá thợ này không')">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Xoá</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <form method="post" action="{{ route('hairdresser.store') }}" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        <h1>Thêm thợ cắt tóc</h1>
                        <div class="from-group">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tên thợ cắt tóc</label>
                                <input type="text" class="form-control" name="hairdresser_name"
                                    id="exampleFormControlInput1" placeholder="Nguyễn Văn A">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Số điện thoại thợ cắt
                                    tóc</label>
                                <input type="number" class="form-control" name="hairdresser_phone"
                                    id="exampleFormControlInput1" placeholder="0899244850">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email thợ cắt tóc</label>
                                <input type="email" class="form-control" name="hairdresser_email"
                                    id="exampleFormControlInput1" placeholder="nguyenvana@gmail.com">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Hình ảnh thợ cắt tóc</label>
                                <input type="file" class="form-control" name="hairdresser_images"
                                    id="exampleFormControlInput1">
                            </div>
                            <div class="mb-3">
                                <label for="openingHoursSelect" class="form-label">Trạng thái thợ cắt tóc:</label>
                                <select class="form-select" name="hairdresser_status" id="openingHoursSelect">
                                    <option value="1">Hiển thị thợ cắt tóc</option>
                                    <option value="0">Ẩn thợ cắt tóc</option>
                                </select>
                            </div>
                            <input type="submit" name="themthocattoc" class="btn btn-primary" value="Thêm">
                        </div>
                    </form>

                </div>
                {{-- Content for Chi nhánh --}}
                <div id="chinhanh-content" class="content-section">
                    <h1>Danh sách chi nhánh</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Tên chi nhánh</th>
                                <th scope="col">Số điện thoại chi nhánh</th>
                                <th scope="col">Email chi nhánh</th>
                                <th scope="col">Địa chỉ chi nhánh</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($branch_list as $branch)
                                <tr>
                                    <td>{{ $branch->branch_name }}</td>
                                    <td>{{ $branch->branch_phone }}</td>
                                    <td>{{ $branch->branch_email }}</td>
                                    <td>{{ $branch->branch_address }}</td>
                                    <td>
                                        <a href="{{ route('branch.edit', ['branch' => $branch->id]) }}"
                                            class="btn btn-primary">Sửa</a>
                                        <form method="post"
                                            action="{{ route('branch.destroy', ['branch' => $branch->id]) }}"
                                            onsubmit="return confirm('Bạn có muốn xoá chi nhánh này không')">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Xoá</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <form method="post" action="{{ route('branch.store') }}" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        <h1>Thêm chi nhánh</h1>
                        <div class="from-group">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tên chi nhánh</label>
                                <input type="text" class="form-control" name="branch_name"
                                    id="exampleFormControlInput1" placeholder="BarberLongNguyen">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Số điện thoại chi
                                    nhánh</label>
                                <input type="phone" class="form-control" name="branch_phone"
                                    id="exampleFormControlInput1" placeholder="0899244850">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email chi nhánh</label>
                                <input type="email" class="form-control" name="branch_email"
                                    id="exampleFormControlInput1" placeholder="nhatlong2356@gmail.com">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Địa chỉ chi nhánh</label>
                                <input type="text" class="form-control" name="branch_address"
                                    id="exampleFormControlInput1"
                                    placeholder="Số 1, đường 1, phường 1, quận 1, thành phố Hồ Chí Minh">
                            </div>
                            <div class="mb-3">
                                <label for="openingHoursSelect" class="form-label">Trạng thái chi nhánh:</label>
                                <select class="form-select" name="branch_status" id="openingHoursSelect">
                                    <option value="1">Hiển thị chi nhánh</option>
                                    <option value="0">Ẩn chi nhánh</option>
                                </select>
                            </div>
                            <input type="submit" name="themchinhanh" class="btn btn-primary" value="Thêm">
                        </div>
                    </form>
                </div>
                {{-- Content for Thông tin trang web --}}
                <div id="info-content" class="content-section">
                    <h1>Thông tin website</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Tên shop</th>
                                <th scope="col">Tiêu đề shop</th>
                                <th scope="col">Số điện thoại shop</th>
                                <th scope="col">Email shop</th>
                                <th scope="col">Trạng thái cửa hàng</th>
                                <th scope="col">Giờ mở cửa</th>
                                <th scope="col">Giờ đóng cửa</th>
                                <th scope="col">Hình ảnh shop</th>
                                <th scope="col">Mô tả shop</th>
                                <th scope="col">Sứ mệnh shop</th>
                                <th scope="col">Địa chỉ map shop</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($information_list as $information)
                                <tr>
                                    <td>{{ $information->information_name }}</td>
                                    <td>{{ $information->information_title }}</td>
                                    <td>{{ $information->information_phone }}</td>
                                    <td>{{ $information->information_email }}</td>
                                    <td>
                                        @if ($information->information_status == 1)
                                            Mở cửa
                                        @else
                                            Khoá cửa
                                        @endif
                                    </td>
                                    <td>{{ $information->information_opening_time }}</td>
                                    <td>{{ $information->information_closing_time }}</td>
                                    <td> <img src="images/logo/{{ $information->information_images }}" height="100"
                                            width="100">
                                    <td>{!! $information->information_description !!}</td>
                                    <td>{!! $information->information_mission !!}</td>
                                    <td>{!! $information->information_maps !!}</td>
                                    <td>
                                        <a href="{{ route('information.edit', ['information' => $information->id]) }}"
                                            class="btn btn-primary">Sửa</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleContent(sectionId) {
            document.querySelectorAll('.content-section').forEach(function(element) {
                element.classList.remove('active-content');
            });

            document.getElementById(sectionId + '-content').classList.add('active-content');
        }
    </script>
@endsection
