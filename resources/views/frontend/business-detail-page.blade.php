<!DOCTYPE html>
<html lang="en">
  <head>
    @include('components.frontend.head')
  </head>
  <body>

    @include('components.frontend.header')


    
    <section class="hero-banner-wrap breadcrumb-banner-text">
        <div class="">
            <div class="item">
                <div class="slider-card">
                    <img src="{{ asset('/uploads/business-details/' . $details->banner_image) }}" class="img-responsive">
                    <div class="slider-text">
                        <div class="banner-subsubtitle">
                            <h5>{{ $details->banner_label }}</h5>
                            <div class="logo-container-for-rsb-logo">
                                <img src="{{ asset('uploads/business-details/' . $details->logo) }}" alt="{{ $business->business_name }}">
                            </div>
                        </div>
                        <h2 data-aos="fade-up" data-aos-duration="1000" class="aos-init aos-animate">
                            {{ $details->banner_heading }}
                        </h2>
                        @if($details->year || $details->project_completed) 
                            <div class="counter-slider-card">
                                <div class="row">
                                    @if($details->year)
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="mil-counter-item mil-stl mil-mb30 mil-768-mb60 mil-up">
                                            <h4 class="mil-up">{{ $details->year }}<span class="mil-a2">+</span></h4>
                                            <div class="mil-counter-text">
                                                <h5 class="mil-head4 mil-m1 mil-up">Years</h5>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    @if($details->project_completed)
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="mil-counter-item mil-stl mil-mb30 mil-up">
                                            <h4 class="mil-up">{{ $details->project_completed }}<span class="mil-a2">+</span></h4>
                                            <div class="mil-counter-text">
                                                <h5 class="mil-head4 mil-m1 mil-up">Completed projects</h5>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        

                            <p>{{ $details->banner_description ?? 'No description available' }}</p>
                        @endif
                        <div class="breadcrumb-box">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="#">Business</a></li>
                                <li>{{ $business->business_name }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   


    <section class="industry-served-wrap">
        <div class="c_line">
            <img src="{{ asset('images/icons/c_line.png') }}">
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <div class="industry-item">
                        <img src="{{ asset('/uploads/business-details/' . $details->industry_image) }}" class="img-responsive">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="industry-served-carosol">
                        <div class="industies-list-wrap">
                            <div class="heading white-heading text-left">
                                <h2>{{ $details->industry_label }}</h2>
                                <h3>{{ $details->industry_heading }}</h3>
                            </div>
                            <div class="industies-list">
                                <ul>
                                    @php
                                        $industryImages = json_decode($details->industry_images, true) ?? [];
                                        $industryDescriptions = json_decode($details->industry_descriptions, true) ?? [];
                                    @endphp
                                    
                                    @foreach($industryImages as $index => $image)
                                        <li>
                                            <img src="{{ asset('/uploads/business-details/' . $image) }}" alt="Industry Image">
                                            <h2>{{ $industryDescriptions[$index] ?? 'Industry' }}</h2>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <div class="pattern-box-two">
      <div class="horizontal-line"></div>
    </div>

    <section class="rsb-product-wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading white-heading text-center">
                        <h2>Services</h2>
                        <h3>{{ $details->service_heading ?? 'We Provide You The Best Experience' }}</h3>
                    </div>
                </div>

                @php
                    $serviceImages = json_decode($details->service_images, true) ?? [];
                    $serviceDescriptions = json_decode($details->service_descriptions, true) ?? [];
                    $colSizes = [7, 5, 3, 5, 4]; // Define column sizes for dynamic display
                @endphp

                @foreach($serviceImages as $index => $image)
                    <div class="col-md-{{ $colSizes[$index % count($colSizes)] }} col-sm-{{ $colSizes[$index % count($colSizes)] }}">
                        <div class="single-io-box">
                            <div class="io-img">
                                <img src="{{ asset('/uploads/business-details/' . $image) }}" class="img-responsive">
                            </div>
                            <div class="bg-voice-card-overlay"></div>
                            <div class="io-text">
                                <h3>{{ $serviceDescriptions[$index] ?? 'Service' }}</h3>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>


    <section class="rsb-linkto-main">
      <div class="container-fluid-custom">
        <div class="row">
          <div class="col-md-9 col-sm-12">
            <h2>For more information,</h2>
          <div class="cta-box-email-phone">
            <div class="contact-single-box">
              <i class="fa fa-phone"></i>
              <a href="tel:+91 81088 70099">+91 81088 70099</a>
            </div>
            <div class="contact-single-box">
              <i class="fa fa-envelope"></i>
              <a href="mailto:shailesh.bade@oke.co.in">shailesh.bade@oke.co.in</a>
            </div>
          </div>
          </div>
          <div class="col-md-3 col-sm-12">
            <a href="https://www.rsbruce.com/" target="_blank">
            <button class="btn-primary">
              <span>Read More</span>
              <span class="btn-primary-inner">
                <img src="images/icons/btn.svg">
              </span>
            </button>
            </a>
          </div>
        </div>
      </div>
    </section>

    
    @include('components.frontend.footer')
    @include('components.frontend.main-js')

</body>
</html>