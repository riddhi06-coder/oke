<!DOCTYPE html>
<html lang="en">
  <head>
    @include('components.frontend.head')
  </head>
  <body>

    @include('components.frontend.header')


    <section class="breadcrumb-wrap event-breadcrumb1" style="background-image: url('{{ asset('uploads/events/' . $events->banner_image) }}');">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-offset-1 col-md-10">
            <div class="breadcrumb-box">
              <h1>{{ $events->banner_heading }}</h1>
              <h3>{{ $events->banner_title }}</h3>
              <ul>
                <li><a href="{{ route('home.page') }}">Home</a></li>
                <li>{{ $events->banner_heading }}</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="events-detail-wrap">
        <div class="container-fluid">
            <div class="row">
            @foreach($events_list as $event)
                <div class="col-md-4">
                <div class="event-item">
                    <div class="info">
                    <a href="#"><img src="{{ asset('frontend/assets/images/icons/date.png') }}" /><span>{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</span></a>
                    <a href="#"><img src="{{ asset('frontend/assets/images/icons/location.png') }}" /><span>{{ $event->event_loaction }}</span></a>
                    </div>
                    <div class="fit-img">
                    <a href="{{ route('events.details', $event->slug) }}" class="eve-img-sec">
                        <img src="{{ asset('uploads/events/' . $event->image) }}" alt="">
                    </a>
                    </div>
                    <div class="cont">
                    <h5><a href="{{ route('events.details', $event->slug) }}">{{ $event->events_title }}</a></h5>
                    <a href="{{ route('events.details', $event->slug) }}" class="butn-crev d-flex align-items-center mt-30">
                        <span class="hover-this">
                        <span class="circle">
                            <i class="fa fa-angle-right"></i>
                        </span>
                        </span>
                        <span class="text">Read more</span>
                    </a>
                    </div>
                </div>
                </div>
            @endforeach
            </div>
        </div>
    </section>

    <div class="pattern-box-three">
      <div class="horizontal-line"></div>
    </div>


    <div class="cta-wrap">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-8 col-sm-12">
            <div class="cta-text">
              <h6>Contact Us</h6>
              <h3>{{ $events->contact_heading }}</h3>
              <p>{{ $events->contact_title }}</p>
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