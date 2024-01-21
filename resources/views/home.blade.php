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
                        <tbody id="service"></tbody>
                    </table>
                    <hr>
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
                        <tbody id="hairdresser"></tbody>
                    </table>
                    {{-- <hr>
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
                    </form> --}}

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
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody id="branch"></tbody>
                    </table>
                    {{-- <hr>
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
                    </form> --}}
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
                        <tbody id="information"></tbody>
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
    <script type="module">
        const serviceElement = document.getElementById('service');

        window.axios.get('/api/v1/service')
            .then(response => {
                const services = response.data;

                services.forEach((service, index) => {
                    const row = document.createElement('tr');
                    const serviceStatus = service.service_status == 1 ? 'Hiển thị dịch vụ' : 'Ẩn dịch vụ';
                    row.innerHTML = `
                        <td>${service.service_name}</td>
                        <td>${service.service_price}</td>
                        <td>${service.service_description}</td>
                        <td><img src="images/service/${service.service_images}" height="100" width="100"></td>
                        <td>${serviceStatus}</td>
                        <td>
                            <a href="v1/service/${service.id}/edit/" class="btn btn-primary">Sửa</a>
                            <form method="post" action="v1/service/${service.id}" onsubmit="return confirm('Bạn có muốn xoá không')">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Xoá</button>
                            </form>
                        </td>
                    `;
                    serviceElement.appendChild(row);
                });
            });
    </script>

    <script type="module">
        const serviceElement = document.getElementById('hairdresser');

        window.axios.get('/api/v1/hairdresser')
            .then(response => {
                const hairdresser = response.data;
                const serviceStatus = hairdresser.hairdresser_status == 1 ? 'Hiển thị thợ cắt tóc' : 'Ẩn thợ cắt tóc';

                hairdresser.forEach((hairdresser, index) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${hairdresser.hairdresser_name}</td>
                        <td>${hairdresser.hairdresser_phone}</td>
                        <td>${hairdresser.hairdresser_email}</td>
                        <td><img src="images/hairdresser/${hairdresser.hairdresser_images}" height="100" width="100"></td>
                        <td>${serviceStatus}</td>
                        <td>
                            <a href="v1/hairdresser/${hairdresser.id}/edit/" class="btn btn-primary">Sửa</a>
                        </td>
                    `;
                    serviceElement.appendChild(row);
                });
            });
    </script>

    <script type="module">
        const serviceElement = document.getElementById('branch');

        window.axios.get('/api/v1/branch')
            .then(response => {
                const branch = response.data;
                const branchStatus = branch.branch_status == 1 ? 'Hiển thị chi nhánh' : 'Ẩn chi nhánh';

                branch.forEach((branch, index) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${branch.branch_name}</td>
                        <td>${branch.branch_phone}</td>
                        <td>${branch.branch_email}</td>
                        <td>${branch.branch_address}</td>
                        <td>${branchStatus}</td>
                        <td>
                            <a href="v1/branch/${branch.id}/edit/" class="btn btn-primary">Sửa</a>
                        </td>
                    `;
                    serviceElement.appendChild(row);
                });
            });
    </script>

    <script type="module">
        const serviceElement = document.getElementById('information');

        window.axios.get('/api/v1/information')
            .then(response => {
                const information = response.data;
                const informationStatus = information.information_status == 1 ? 'Hiển thị cửa hàng' : 'Ẩn cửa hàng';

                information.forEach((information, index) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${information.information_name}</td>
                        <td>${information.information_title}</td>
                        <td>${information.information_phone}</td>
                        <td>${information.information_email}</td>
                        <td>${informationStatus}</td>
                        <td>${information.information_opening_time}</td>
                        <td>${information.information_closing_time}</td>
                        <td><img src="images/information/${information.information_images}" height="100" width="100"></td>
                        <td>${information.information_description}</td>
                        <td>${information.information_mission}</td>
                        <td>${information.information_maps}</td>
                        <td>
                            <a href="v1/information/${information.id}/edit/" class="btn btn-primary">Sửa</a>
                        </td>
                    `;
                    serviceElement.appendChild(row);
                });
            });
    </script>
@endsection
