<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{ asset('assets/css/topic.css') }}" rel="stylesheet">
</head>
<style>
    .range {
        margin-top: 40px;
        text-align: center;
    }

    #ex6CurrentSliderValLabel {
        margin-bottom: 20px;
        text-align: center;
        font-size: 56px;
        font-weight: 600;
    }

    .slider.slider-horizontal {
        width: 100%;
    }

    .slider.slider-horizontal:before {}

    .subtract {
        cursor: pointer;
        margin-right: 6%;
    }

    .add {
        cursor: pointer;
        margin-left: 6%;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <i class="bi-back"></i>
                <span>Topic</span>
            </a>



            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="/talks">Browse Talks</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="/#section_2">How it works</a>
                    </li>



                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="/#section_4">Pricing</a>
                    </li>



                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="/#section_5">FAQs</a>
                    </li>

                    {{-- <li class="nav-item">
                        <a class="nav-link click-scroll" href="./chatpage.html">Conversation Page</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="./past-purchase.html">Past Purchase</a>
                    </li> --}}


                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="/realTimeChat">Live Chat</a>
                    </li>
                    @auth
                        <li class="nav-item dropdown d-none d-lg-block">
                            <a class="nav-link click-scroll dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Profile
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a class="nav-link click-scroll text-black m-0 ms-2" href="/profile">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link click-scroll text-black m-0 ms-2" href="/purchases">My Purchases</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link text-black m-0 ms-2" href="" data-bs-toggle="modal"
                                        data-bs-target="#addCoins"><i class="bi bi-c-circle"></i> Coins
                                        ({{ auth()->user()->minutes }})
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li class="d-block nav-item"><a href="{{ url('/logout') }}"
                                        class="nav-link click-scroll text-black m-0 ms-2">Logout</a></li>
                            </ul>
                        </li>

                        <li class="nav-item d-block d-lg-none">
                            <a class="nav-link click-scroll" href="/profile">Profile</a>
                        </li>
                        <li class="nav-item d-block d-lg-none">
                            <a class="nav-link click-scroll" href="/purchases">My Purchases</a>
                        </li>

                        <li class="nav-item d-block d-lg-none">
                            <a class="nav-link click-scroll" href="/realTimeChat">Live Chat</a>
                        </li>
                        <li class="nav-item d-block d-lg-none">
                            <a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#addCoins"><i
                                    class="bi bi-c-circle"></i> Coins
                                ({{ auth()->user()->minutes }})</a>
                        </li>
                        <li class=" nav-item d-block d-lg-none"><a href="{{ url('/logout') }}"
                                class="nav-link click-scroll">Logout</a></li>
                    @else
                        <li class="d-block nav-item"><a href="{{ url('/login') }}" class="nav-link click-scroll">Login</a>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>
    <div class="modal fade" id="addCoins" tabindex="-1" aria-labelledby="addCoinsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addCoinsLabel">Coins</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container py-4">
                        <div style="font-size: 18px; font-weight: bold;">Current available coins/mins : 100/10 mins
                        </div>
                        <div style="font-size: 16px; font-weight: bold;">1 min = 5 coins</div>
                        <div style="font-size: 16px; font-weight: bold;">1 ₹ = 1 coin</div>
                        <div class="mb-3" style="font-size: 16px;">Add coins to add minutes</div>
                        <div class="row">
                            <div class="mx-auto">
                                <form action="/createOrderMin" method="post" id="minForm">
                                    @csrf
                                    <div class="input-group" style="gap: 5px">
                                        <span class="input-group-prepend">
                                            <button type="button" class="btn btn-outline-secondary btn-number"
                                                disabled="disabled" data-type="minus" data-field="quant">
                                                <span><i class="bi bi-dash-lg"></i></span>
                                            </button>
                                        </span>

                                        <input type="text" name="quant" class="form-control input-number"
                                            value="1" min="1" max="100">
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary btn-number"
                                                data-type="plus" data-field="quant">
                                                <span><i class="bi bi-plus-lg"></i></span>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                                <div id="price"></div>
                            </div>
                        </div>
                        <div>
                            <button form="minForm" type="submit" class="btn btn-success mt-3 add-coin-btn"></button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{ $slot }}


    <footer class="site-footer section-padding bg-white">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-12 mb-4 pb-2">
                    <a class="navbar-brand mb-2" href="index.html">
                        <i class="bi-back"></i>
                        <span>Topic</span>
                    </a>
                </div>

                <div class="col-lg-3 col-md-4 col-6">
                    <h6 class="site-footer-title mb-3">Resources</h6>

                    <ul class="site-footer-links">
                        <li class="site-footer-link-item">
                            <a href="/#section_1" class="site-footer-link">Home</a>
                        </li>

                        <li class="site-footer-link-item">
                            <a href="/#section_2" class="site-footer-link">How it works</a>
                        </li>

                        <li class="site-footer-link-item">
                            <a href="/#section_5" class="site-footer-link">FAQs</a>
                        </li>

                        <!--<li class="site-footer-link-item">
                            <a href="#" class="site-footer-link">Contact</a>
                        </li>-->
                    </ul>
                </div>

                <div class="col-lg-3 col-md-4 col-6 mb-4 mb-lg-0">
                    <h6 class="site-footer-title mb-3">Information</h6>

                    <p class="text-white d-flex mb-1">
                        <a href="tel: 305-240-9671" class="site-footer-link">
                            305-240-9671
                        </a>
                    </p>

                    <p class="text-white d-flex">
                        <a href="mailto:info@company.com" class="site-footer-link">
                            info@company.com
                        </a>
                    </p>
                </div>

                <div class="col-lg-3 col-md-4 col-12 ms-auto">


                    <p class="copyright-text">Copyright © 2048 Topic Listing Center. All rights reserved.
                    </p>

                </div>

            </div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.sticky.js') }}"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    @if (Session::has('order'))
        <script>
            var options = {
                "key": "{{ env('RAZORPAY_KEY') }}", // Enter the Key ID generated from the Dashboard
                "name": "Acme Corp", //your business name
                "description": "{{ Session::get('talk')->title }}",
                "image": "https://example.com/your_logo",
                "order_id": "{{ Session::get('order')->order_id }}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                "callback_url": "/verifyOrder?_token={{ csrf_token() }}",
                "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
                    "name": "{{ auth()->user()->name }}", //your customer's name
                    "email": "{{ auth()->user()->email }}",
                },
                "notes": {
                    "address": "Razorpay Corporate Office"
                },
                "theme": {
                    "color": "#135b8f"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
        </script>
    @endif
    @if (Session::has('minOrder'))
        <script>
            var options = {
                "key": "{{ env('RAZORPAY_KEY') }}", // Enter the Key ID generated from the Dashboard
                "name": "Acme Corp", //your business name
                "description": "Paying for minutes",
                "image": "https://example.com/your_logo",
                "order_id": "{{ Session::get('minOrder')->order_id }}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                "callback_url": "/verifyOrderMin?_token={{ csrf_token() }}",
                "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
                    "name": "{{ auth()->user()->name }}", //your customer's name
                    "email": "{{ auth()->user()->email }}",
                },
                "notes": {
                    "address": "Razorpay Corporate Office"
                },
                "theme": {
                    "color": "#135b8f"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
        </script>
    @endif
    <script>
        var calculatedPrice = 5;
        var totalCoins = 1;
        $(document).ready(function() {
            $('#price').text("₹ " + calculatedPrice);
            $(".add-coin-btn").text("Add coins " + totalCoins)
        })
        $('.btn-number').click(function(e) {
            e.preventDefault();

            fieldName = $(this).attr('data-field');
            type = $(this).attr('data-type');
            var input = $("input[name='" + fieldName + "']");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if (type == 'minus') {

                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                        calculatedPrice = currentVal - 1 * 5;
                        $('#price').text((currentVal - 1) + " mins = " + "₹ " + calculatedPrice);
                        totalCoins = currentVal - 1;
                        $(".add-coin-btn").text("Add coins " + totalCoins)
                    }
                    if (parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if (type == 'plus') {

                    if (currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                        calculatedPrice = currentVal + 1;
                        $('#price').text((currentVal + 1) + " mins = " + "₹ " + calculatedPrice * 5);
                        totalCoins = currentVal + 1;
                        $(".add-coin-btn").text("Add coins " + totalCoins)
                    }
                    if (parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });
        $('.input-number').focusin(function() {
            $(this).data('oldValue', $(this).val());
        });
        $('.input-number').change(function() {

            minValue = parseInt($(this).attr('min'));
            maxValue = parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());

            name = $(this).attr('name');
            if (valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
                $('#price').text(valueCurrent + " mins = " + "₹ " + valueCurrent * 5);
                totalCoins = valueCurrent;
                $(".add-coin-btn").text("Add coins " + totalCoins)
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if (valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
                $('#price').text(valueCurrent + " mins = " + "₹ " + valueCurrent * 5);
                totalCoins = valueCurrent;
                $(".add-coin-btn").text("Add coins " + totalCoins)
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }
        });

        $(".input-number").keydown(function(e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    </script>
</body>

</html>
