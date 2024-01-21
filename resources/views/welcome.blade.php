<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gentlemen's Barber Shop - HTML CSS Template</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300;500&display=swap" rel="stylesheet">

    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('frontend/css/bootstrap-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('frontend/css/templatemo-barber-shop.css') }}" rel="stylesheet">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <nav id="sidebarMenu" class="col-md-4 col-lg-3 d-md-block sidebar collapse p-0">

                <div
                    class="position-sticky sidebar-sticky d-flex flex-column justify-content-center align-items-center">
                    <a class="navbar-brand" href="{{ route('homepage') }}">
                        <img src="images/templatemo-barber-logo.png" class="logo-image img-fluid" align="">
                    </a>

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_1">Trang chủ</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_2">Sứ mệnh</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_3">Dịch vụ</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_4">Bảng giá</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_5">Liên hệ</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="col-md-8 ms-sm-auto col-lg-9 p-0">
                <section class="hero-section d-flex justify-content-center align-items-center" id="section_1">

                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-12">
                                <h1 class="text-white mb-lg-3 mb-4"><strong>Barber <em>Shop</em></strong></h1>
                                <p class="text-black">{{ $information['information_title'] }}</p>
                                <br>
                                <a class="btn custom-btn custom-border-btn custom-btn-bg-white smoothscroll me-2 mb-2"
                                    href="#section_2">Về chúng tôi</a>

                                <a class="btn custom-btn smoothscroll mb-2" href="#section_3">Chúng tôi làm gì</a>
                            </div>
                        </div>
                    </div>

                    <div class="custom-block d-lg-flex flex-column justify-content-center align-items-center">
                        <img src="{{ asset('images/vintage-chair-barbershop.jpg') }}"
                            class="custom-block-image img-fluid" alt="">

                        <h4><strong class="text-white">Nhanh lên! Nhận giá cắt tóc tốt.</strong></h4>

                        <a href="#booking-section" class="smoothscroll btn custom-btn custom-btn-italic mt-3">Đặt chổ
                            ngay</a>
                    </div>
                </section>

                <section class="about-section section-padding" id="section_2">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-12 col-12 mx-auto">
                                <h2 class="mb-4">Sứ mệnh của chúng tôi</h2>

                                <div class="border-bottom pb-3 mb-5">
                                    {!! $information['information_mission'] !!}
                                </div>
                            </div>

                            <h6 class="mb-5">Gặp gỡ các thợ cắt tóc</h6>

                            @foreach ($hairdresserStatusTrue as $hairdresser)
                                <div class="col-lg-5 col-12 custom-block-bg-overlay-wrap me-lg-5 mb-5 mb-lg-0">
                                    <img src="{{ asset('images/logo/' . $hairdresser['hairdresser_images']) }}"
                                        class="custom-block-bg-overlay-image img-fluid" alt="">

                                    <div class="team-info d-flex align-items-center flex-wrap">
                                        <p class="mb-0">{{ $hairdresser['hairdresser_name'] }}</p>

                                        <ul class="social-icon ms-auto">
                                            <li class="social-icon-item">
                                                <a href="#" class="social-icon-link bi-facebook">
                                                </a>
                                            </li>

                                            <li class="social-icon-item">
                                                <a href="#" class="social-icon-link bi-instagram">
                                                </a>
                                            </li>

                                            {{-- <li class="social-icon-item">
                                                <a href="#" class="social-icon-link bi-whatsapp">
                                                </a>
                                            </li> --}}
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                            {{-- <div class="col-lg-5 col-12 custom-block-bg-overlay-wrap mt-4 mt-lg-0 mb-5 mb-lg-0">
                                <img src="images/barber/portrait-mid-adult-bearded-male-barber-with-folded-arms.jpg"
                                    class="custom-block-bg-overlay-image img-fluid" alt="">

                                <div class="team-info d-flex align-items-center flex-wrap">
                                    <p class="mb-0">Sam</p>

                                    <ul class="social-icon ms-auto">
                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-facebook">
                                            </a>
                                        </li>

                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-instagram">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div> --}}

                        </div>
                    </div>
                </section>

                <section class="featured-section section-padding">
                    <div class="section-overlay"></div>

                    <div class="container">
                        <div class="row">

                            <div class="col-lg-10 col-12 mx-auto">
                                <h2 class="mb-3">Get 32% Discount</h2>

                                <p>on every second week of the month</p>

                                <strong>Promo Code: BarBerMo</strong>
                            </div>

                        </div>
                    </div>
                </section>


                <section class="services-section section-padding" id="section_3">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-12 col-12">
                                <h2 class="mb-5">Dịch vụ</h2>
                            </div>
                            <div class="row">
                                @foreach ($serviceStatusTrue as $service)
                                    <div class="col-lg-6 col-12 mb-4">
                                        <div class="services-thumb">
                                            <img src="{{ asset('images/logo/' . $service['service_images']) }}"
                                                 class="services-image img-fluid" alt="{{ $service['service_name'] }}">

                                            <div class="services-info d-flex align-items-end">
                                                <h4 class="mb-0">{{ $service['service_name'] }}</h4>
                                                <strong class="services-thumb-price">{{ $service['service_price'] }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>

                <section class="booking-section section-padding" id="booking-section">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-10 col-12 mx-auto">
                                <form action="{{ route('booking.store') }}" method="POST"
                                    class="custom-form booking-form" id="bb-booking-form" role="form"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="text-center mb-5">
                                        <h2 class="mb-1">Đặt chổ ngay</h2>

                                        <p>Vui lòng điền vào biểu mẫu và chúng tôi sẽ liên hệ lại với bạn</p>
                                    </div>

                                    <div class="booking-form-body">
                                        <div class="row">

                                            <div class="col-lg-6 col-12">
                                                <input type="text" name="booking_name" id="booking_name"
                                                    class="form-control" placeholder="Họ và tên" required>
                                            </div>

                                            <div class="col-lg-6 col-12">
                                                <input type="tel" class="form-control" name="booking_phone"
                                                    placeholder="Số điện thoại 0899244***"
                                                    pattern="[0-9]{3}[0-9]{3}[0-9]{4}" required="">
                                            </div>

                                            <div class="col-lg-6 col-12">
                                                <input class="form-control" type="time" name="booking_times"
                                                    value="18:30" />
                                            </div>

                                            <div class="col-lg-6 col-12">
                                                <select class="form-select form-control" name="booking_branch_id"
                                                    id="booking_branch_id" aria-label="Default select example">
                                                    <option value="" selected disabled>-------Chọn chi
                                                        nhánh--------</option>
                                                    @foreach ($branchStatusTrue as $branch_booking)
                                                        <option value="{{ $branch_booking['id'] }}">
                                                            {{ $branch_booking['branch_name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-lg-6 col-12">
                                                <select class="form-select form-control" name="booking_service_id"
                                                    id="booking_service_id" aria-label="Default select example">
                                                    <option value="" selected disabled>-------Chọn dịch
                                                        vụ--------</option>
                                                    @foreach ($serviceStatusTrue as $service_booking)
                                                        <option value="{{ $service_booking['id'] }}">
                                                            {{ $service_booking['service_name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-lg-6 col-12">
                                                <select class="form-select form-control" name="booking_hairdresser_id"
                                                    id="booking_hairdresser_id" aria-label="Default select example">
                                                    <option value="" selected disabled>-------Chọn thợ cắt
                                                        tóc--------</option>
                                                    @foreach ($hairdresserStatusTrue as $hairdresser_booking)
                                                        <option value="{{ $hairdresser_booking['id'] }}">
                                                            MR. {{ $hairdresser_booking['hairdresser_name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-lg-6 col-12">
                                                <input type="date" name="booking_days" id="booking_days"
                                                    class="form-control" placeholder="Date" required>
                                            </div>

                                            <div class="col-lg-6 col-12">
                                                <input type="number" min="1" name="booking_quantity"
                                                    id="booking_quantity" class="form-control"
                                                    placeholder="Số khách lượng đặt" required>
                                            </div>
                                        </div>

                                        <textarea name="booking_comment" rows="3" class="form-control" id="bb-message"
                                            placeholder="Ghi chú (Tùy chọn)"></textarea>

                                        <div class="col-lg-4 col-md-10 col-8 mx-auto">
                                            <input type="submit" name="gui" class="form-control"
                                                value="Gửi">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                </section>


                <section class="price-list-section section-padding" id="section_4">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-8 col-12">
                                <div class="price-list-thumb-wrap">
                                    <div class="mb-4">
                                        <h2 class="mb-2">Bảng giá</h2>

                                        <strong>Giá bắt đầu từ {{ $minPrice }} VNĐ</strong>
                                    </div>
                                    @foreach ($serviceStatusTrue as $service)
                                        <div class="price-list-thumb">
                                            <h6 class="d-flex">
                                                {{ $service['service_name'] }}
                                                <span class="price-list-thumb-divider"></span>

                                                <strong>{{ $service['service_price'] }} VNĐ</strong>
                                            </h6>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div
                                class="col-lg-4 col-12 custom-block-bg-overlay-wrap mt-5 mb-5 mb-lg-0 mt-lg-0 pt-3 pt-lg-0">
                                <img src="{{ asset('images/vintage-chair-barbershop.jpg') }}"
                                    class="custom-block-bg-overlay-image img-fluid" alt="">
                            </div>

                        </div>
                    </div>
                </section>


                <section class="contact-section" id="section_5">
                    <div class="section-padding section-bg">
                        <div class="container">
                            <div class="row">

                                <div class="col-lg-8 col-12 mx-auto">
                                    <h2 class="text-center">{!! $information['information_description'] !!}</h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="section-padding">
                        <div class="container">
                            <div class="row">

                                <div class="col-lg-6 col-12">
                                    <h5 class="mb-3"><strong>Thông tin</strong> Liên lạc</h5>

                                    <p class="text-white d-flex mb-1">
                                        <a href="tel: {{ $information['information_phone'] }}"
                                            class="site-footer-link">
                                            {{ $information['information_phone'] }}
                                        </a>
                                    </p>

                                    <p class="text-white d-flex">
                                        <a href="mailto:info@yourgmail.com" class="site-footer-link">
                                            {{ $information['information_email'] }}
                                        </a>
                                    </p>

                                    <ul class="social-icon">
                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-facebook">
                                            </a>
                                        </li>

                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-twitter">
                                            </a>
                                        </li>

                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-instagram">
                                            </a>
                                        </li>

                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-youtube">
                                            </a>
                                        </li>

                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-whatsapp">
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-lg-5 col-12 contact-block-wrap mt-5 mt-lg-0 pt-4 pt-lg-0 mx-auto">
                                    <div class="contact-block">
                                        <h6 class="mb-0">
                                            <i class="custom-icon bi-shop me-3"></i>

                                            <strong>
                                                @if ($information['information_status'] == 1)
                                                    Đang mở cửa
                                                @else
                                                    Đã đóng cửa
                                                @endif
                                            </strong>
                                            <span class="ms-auto">{{ $information['information_opening_time'] }} -
                                                {{ $information['information_closing_time'] }}</span>
                                        </h6>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-12 mx-auto mt-5 pt-5">
                                    {!! $information['information_maps'] !!}
                                </div>

                            </div>
                        </div>
                    </div>
                </section>

                <footer class="site-footer">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-12 col-12">
                                <h4 class="site-footer-title mb-4">Chi nhánh của chúng tôi</h4>
                            </div>
                            @foreach ($branchStatusTrue as $branch)
                                <div class="col-lg-4 col-md-6 col-11">
                                    <div class="site-footer-thumb">
                                        <strong class="mb-1">{{ $branch['branch_name'] }}</strong>

                                        <p>{{ $branch['branch_address'] }}</p>
                                    </div>
                                </div>
                            @endforeach

                            {{-- <div class="col-lg-4 col-md-6 col-11">
                                <div class="site-footer-thumb">
                                    <strong class="mb-1">Behrenstraße</strong>

                                    <p>Behrenstraße 27, 10117 Berlin, Germany</p>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-11">
                                <strong class="mb-1">Weinbergsweg</strong>

                                <p>Weinbergsweg 23, 10119 Berlin, Germany</p>
                            </div> --}}
                        </div>
                    </div>

                    <div class="site-footer-bottom">
                        <div class="container">
                            <div class="row align-items-center">

                                <div class="col-lg-8 col-12 mt-4">
                                    <p class="copyright-text mb-0">Copyright © 2036 Barber Shop
                                        - Design: <a href="https://templatemo.com" rel="nofollow"
                                            target="_blank">TemplateMo</a></p>
                                </div>

                                <div class="col-lg-2 col-md-3 col-3 mt-lg-4 ms-auto">
                                    <a href="#section_1" class="back-top-icon smoothscroll" title="Back Top">
                                        <i class="bi-arrow-up-circle"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </footer>
            </div>

            <!-- JAVASCRIPT FILES -->
            <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
            <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
            <script src="{{ asset('frontend/js/click-scroll.js') }}"></script>
            <script src="{{ asset('frontend/js/custom.js') }}"></script>
        </div>
        {{-- <script>
            $(document).ready(function() {
                const servicesContainer = $('#services-container');

                $.get('https://barbershop.local/api/v1/service', function(services) {
                    // Iterate through the services and append them to the container
                    services.forEach(function(service) {
                        const serviceHtml = `
                            <div class="col-lg-6 col-12 mb-4">
                                <div class="services-thumb">
                                    <img src="images/logo/${service.service_images}" class="services-image img-fluid" alt="${service.service_name}">
                                    <div class="services-info d-flex align-items-end">
                                        <h4 class="mb-0">${service.service_name}</h4>
                                        <strong class="services-thumb-price">${service.service_price}</strong>
                                    </div>
                                </div>
                            </div>
                        `;
                        servicesContainer.append(serviceHtml);
                    });
                });
            });
        </script> --}}

</body>

</html>
