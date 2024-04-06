<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{asset("assets/css/bootstrap.min.css")}}" rel="stylesheet">
    <link href="{{asset("assets/css/bootstrap-icons.css")}}" rel="stylesheet">
    <link href="{{asset("assets/css/topic.css")}}" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <i class="bi-back"></i>
                <span>Topic</span>
            </a>

            <div class="d-lg-none ms-auto me-4">
                <a href="#top" class="navbar-icon bi-person smoothscroll"></a>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="#section_1">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="#section_2">How it works</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="#section_3">Browse Categories</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="#section_4">Pricing</a>
                    </li>



                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="#section_5">FAQs</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="./chatpage.html">Conversation Page</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link click-scroll" href="./past-purchase.html">Past Purchase</a>
                    </li>
                    
                    @auth
                    <li class="d-none d-lg-block nav-item"><a href="{{ url('/logout') }}" class="nav-link click-scroll">Logout</a></li>
                    @else 
                    <li class="d-none d-lg-block nav-item"><a href="{{ url('/login') }}" class="nav-link click-scroll">Login</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

   

   {{$slot}}


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
                            <a href="#" class="site-footer-link">Home</a>
                        </li>

                        <li class="site-footer-link-item">
                            <a href="#" class="site-footer-link">How it works</a>
                        </li>

                        <li class="site-footer-link-item">
                            <a href="#" class="site-footer-link">FAQs</a>
                        </li>

                        <li class="site-footer-link-item">
                            <a href="#" class="site-footer-link">Contact</a>
                        </li>
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

                <div class="col-lg-3 col-md-4 col-12 mt-4 mt-lg-0 ms-auto">


                    <p class="copyright-text mt-lg-5 mt-4">Copyright © 2048 Topic Listing Center. All rights reserved.
                        <br><br>Design: <a rel="nofollow" href="https://templatemo.com"
                            target="_blank">TemplateMo</a> Distribution <a
                            href="https://themewagon.com">ThemeWagon</a>
                    </p>

                </div>

            </div>
        </div>
    </footer>
    <script src="{{asset("assets/js/jquery.sticky.js")}}"></script>
    <script src="{{asset("assets/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{asset("assets/js/jquery.sticky.js")}}"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="{{asset("assets/js/custom.js")}}"></script>

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
</body>

</html>
