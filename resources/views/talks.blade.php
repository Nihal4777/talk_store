<x-primary-layout>


    <section class="explore-section bg-primary" id="section_3" style="padding-top: 100px">
        <div class="container">

            <div class="col-12 text-center">
                <h2 class="mb-4 text-white">Browse Topics</h1>
            </div>

        </div>
        </div>


        <form action="createOrder" method="POST" id="createOrder">
            @csrf
        </form>

        <div class="container">
            <div class="row mb-4" style="gap: 10px">
                <div class="d-flex">
                    <h4 class="p-3 text-white">
                        Choose category :
                    </h4>
                    <div class="p-3">
                        <select class="form-select" onchange="window.location.href=`?cat=${event.target.value}`">
                            <option selected value="">All</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{$category->id==app('request')->input('cat')?'selected':''}} >{{$category->name}}</option>    
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    @foreach ($talks as $talk)
                        <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-2">
                            <div class="custom-block bg-white shadow-lg">
                                <div class="d-flex">
                                    <div>
                                        <h5 class="mb-2">{{ $talk->title }}</h5>
                                        <p class="mb-0">{{ $talk->description }}</p>
                                        <p class="mb-0">₹{{ $talk->price }}</p>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success" name="talkId" value="{{ $talk->id }}"form="createOrder">Buy
                                    Now</button>
                                <img src="{{asset($talk->image)}}"
                                    class="custom-block-image img-fluid" alt="">
                            </div>
                        </div>
                    @endforeach
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
                    <img src="{{asset("assets/images/faq.png")}}" class="img-fluid" alt="FAQs">
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

                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
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
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Does it need to paid?
                                </button>
                            </h2>

                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
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
