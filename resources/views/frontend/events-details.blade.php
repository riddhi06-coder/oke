<!DOCTYPE html>
<html lang="en">
  <head>
    @include('components.frontend.head')
  </head>
  <body>

    @include('components.frontend.header')



    <section class="breadcrumb-wrap blog-breadcrumb11" style="background-image: url('{{ asset('uploads/events/' . $event_details->banner_image) }}');">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-offset-1 col-md-10">
            <div class="breadcrumb-box">
              <h1>{{ $event_details->events_title }}</h1>

              <h3>{{ $event_details->banner_title }}</h3>
              <ul>
                <li><a href="{{ route('home.page') }}">Home</a></li>
                <li><a href="{{ route('events.exhibition') }}">Events & Exhibitions</a></li>
                <li>{{ $event_details->events_title }}</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="events-detail-page-wrap">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="info">
                <p>
                    <img src="{{ asset('frontend/assets/images/icons/date.png') }}">
                    <span>{{ \Carbon\Carbon::parse($event_details->event_date)->format('M d, Y') }}</span>
                </p>
                <p>
                    <img src="{{ asset('frontend/assets/images/icons/location.png') }}">
                    <span>{{ $event_details->event_loaction }}</span>
                </p>
            </div>

            <p>{!! $event_details->description !!}</p>
          </div>
        </div>
      </div>
    </section>


    @if($event_details->event_images)
        @php
            $galleryImages = json_decode($event_details->event_images);
        @endphp

        <div class="event-gallery">
        <div class="container-fluid">
            <div class="row">
            @foreach($galleryImages as $image)
                <div class="col-md-4">
                <div class="image-container">
                    <a data-fancybox="gallery" href="{{ asset('uploads/events/' . $image) }}">
                    <img class="img-responsive" src="{{ asset('uploads/events/' . $image) }}" alt="Event Image"/>
                    <div class="overlay">
                        <span class="icon">+</span>
                    </div>
                    </a>
                </div>
                </div>
            @endforeach
            </div>
        </div>
        </div>
    @endif

    <div class="pattern-box-three">
      <div class="horizontal-line"></div>
    </div>


    <div class="cta-wrap">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-8 col-sm-12">
            <div class="cta-text">
              <h6>Contact Us</h6>
              <h3>{{ $event_details->contact_heading }}</h3>
              <p>{{ $event_details->contact_title }}</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-12">
            <div class="cta-btn">
                <a href="{{ route('contact.us') }}">
                    <button class="btn-primary">
                        <span>Know More</span>
                        <span class="btn-primary-inner">
                            <img src="{{ asset('frontend/assets/images/icons/btn.svg') }}">
                        </span>
                    </button>
                </a>
            </div>
          </div>
        </div>
      </div>
    </div>




    @include('components.frontend.footer')
    @include('components.frontend.main-js')

</body>
</html>