<x-primary-layout>

    
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
                                            <button type="submit" name="talkId" value="{{ $talk->id }}"form="createOrder">Buy Now</button>

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

</x-primary-layout>