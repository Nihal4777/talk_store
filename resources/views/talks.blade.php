<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/topic.css') }}" rel="stylesheet">
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
                <ul class="navbar-nav">
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


                </ul>

                <div class="d-none d-lg-block ms-4">
                    <a href="./login.html" class="navbar-icon bi-person smoothscroll"
                        style="display: flex; justify-content: center; align-items: center;">Login</a>
                </div>
            </div>
        </div>
    </nav>




    <section class="explore-section section-padding bg-white" id="section_3">
        <div class="container">

            <div class="col-12 text-center">
                <h2 class="mb-4">Browse Topics</h1>
            </div>

        </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="design-tab" data-bs-toggle="tab"
                            data-bs-target="#design-tab-pane" type="button" role="tab"
                            aria-controls="design-tab-pane" aria-selected="true">Design</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="marketing-tab" data-bs-toggle="tab"
                            data-bs-target="#marketing-tab-pane" type="button" role="tab"
                            aria-controls="marketing-tab-pane" aria-selected="false">Marketing</button>
                    </li>

                </ul>
            </div>
        </div>
        <form action="createOrder" method="POST" id="createOrder">
            @csrf
        </form>

        <div class="container">
            <div class="row">

                <div class="col-12">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="design-tab-pane" role="tabpanel"
                            aria-labelledby="design-tab" tabindex="0">
                            <div class="row">
                                @foreach ($talks as $talk)
                                    <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
                                        <div class="custom-block bg-white shadow-lg">
                                            <div class="d-flex">
                                                <div>
                                                    <h5 class="mb-2">{{ $talk->title }}</h5>

                                                    <p class="mb-0">{{ $talk->description }}</p>
                                                    <p class="mb-0">₹{{ $talk->price }}</p>
                                                </div>
                                                <span class="badge bg-design rounded-pill ms-auto">14</span>
                                            </div>
                                            <input type="hidden" name="talkId" value="{{ $talk->id }}"
                                                form="createOrder">
                                            <button type="submit" form="createOrder">Buy Now</button>

                                            <img src="images/topics/undraw_Remote_design_team_re_urdx.png"
                                                class="custom-block-image img-fluid" alt="">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="tab-pane fade" id="marketing-tab-pane" role="tabpanel"
                            aria-labelledby="marketing-tab" tabindex="0">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-3">
                                    <div class="custom-block bg-white shadow-lg">
                                        <a href="topics-detail.html">
                                            <div class="d-flex">
                                                <div>
                                                    <h5 class="mb-2">Advertising</h5>

                                                    <p class="mb-0">Lorem Ipsum dolor sit amet consectetur</p>
                                                </div>

                                                <span class="badge bg-advertising rounded-pill ms-auto">30</span>
                                            </div>

                                            <img src="images/topics/undraw_online_ad_re_ol62.png"
                                                class="custom-block-image img-fluid" alt="">
                                        </a>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-3">
                                    <div class="custom-block bg-white shadow-lg">
                                        <a href="topics-detail.html">
                                            <div class="d-flex">
                                                <div>
                                                    <h5 class="mb-2">Video Content</h5>

                                                    <p class="mb-0">Lorem Ipsum dolor sit amet consectetur</p>
                                                </div>

                                                <span class="badge bg-advertising rounded-pill ms-auto">65</span>
                                            </div>

                                            <img src="images/topics/undraw_Group_video_re_btu7.png"
                                                class="custom-block-image img-fluid" alt="">
                                        </a>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="custom-block bg-white shadow-lg">
                                        <a href="topics-detail.html">
                                            <div class="d-flex">
                                                <div>
                                                    <h5 class="mb-2">Viral Tweet</h5>

                                                    <p class="mb-0">Lorem Ipsum dolor sit amet consectetur</p>
                                                </div>

                                                <span class="badge bg-advertising rounded-pill ms-auto">50</span>
                                            </div>

                                            <img src="images/topics/undraw_viral_tweet_gndb.png"
                                                class="custom-block-image img-fluid" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>

                </div>
            </div>
    </section>


    <section class="faq-section section-padding bg-white" id="section_5">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-12">
                    <h2 class="mb-4">Frequently Asked Questions</h2>
                </div>

                <div class="clearfix"></div>

                <div class="col-lg-5 col-12">
                    <img src="images/faq_graphic.jpg" class="img-fluid" alt="FAQs">
                </div>

                <div class="col-lg-6 col-12 m-auto">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    What is Topic Listing?
                                </button>
                            </h2>

                            <div id="collapseOne" class="accordion-collapse collapse show"
                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Topic Listing is free Bootstrap 5 CSS template. <strong>You are not allowed to
                                        redistribute this template</strong> on any other template collection website
                                    without our permission. Please contact TemplateMo for more detail. Thank you.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    How to find a topic?
                                </button>
                            </h2>

                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    You can search on Google with <strong>keywords</strong> such as templatemo
                                    portfolio, templatemo one-page layouts, photography, digital marketing, etc.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false"
                                    aria-controls="collapseThree">
                                    Does it need to paid?
                                </button>
                            </h2>

                            <div id="collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    You can modify any of this with custom CSS or overriding our default variables. It's
                                    also worth noting that just about any HTML can go within the
                                    <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


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
    <script src="{{ asset('assets/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    @if (Session::has('order'))
    <script>
        var options = {
            "key": "{{ env('RAZORPAY_KEY') }}", // Enter the Key ID generated from the Dashboard
            "name": "Acme Corp", //your business name
            "description": "{{ Session::get('talk')->title }}",
            "image": "https://example.com/your_logo",
            "order_id": "{{ Session::get('order')->order_id }}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
            "callback_url": "https://eneqd3r9zrjok.x.pipedream.net/",
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
