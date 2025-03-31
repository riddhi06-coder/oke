<!DOCTYPE html>
<html lang="en">
  <head>
    @include('components.frontend.head')
  </head>
  <body>

    @include('components.frontend.header')


        <section class="breadcrumb-wrap about-bg" style="background-image: url('{{ asset('uploads/about/' . $about->banner_image) }}');">
            <div class="container-fluid">
                <div class="row">
                <div class="col-md-offset-1 col-md-10">
                    <div class="breadcrumb-box">
                    <h1>{{ $about->banner_heading }}</h1>
                    <h3>{{ $about->banner_title }}</h3>
                    <ul>
                        <li><a href="{{ route('home.page') }}">Home</a></li>
                        <li>{{ $about->banner_heading }}</li>
                    </ul>
                    </div>
                </div>
                </div>
            </div>
        </section>

        <section class="about-detail-page-wrap">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="about-detail-text">
                            <div class="heading white-heading">
                                <h2>{{ $about->page_heading }}</h2>
                                <h3>{{ $about->page_title }}</h3>
                            </div>
                            <p>{!! $about->description !!}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="about-thumb2">
                            <div class="about-img-1">
                                <img src="{{ asset('uploads/about/' . $about->image) }}" alt="img" class="img-responsive">
                            </div>
                            <div class="about-counter-wrap style2 jump-reverse">
                                <p class="about-counter-text">{{ $about->card_title }}</p>
                                <h3 class="about-counter-number"><span class="counter-number"><span>{{ $about->year }}</span></span></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="about-detail-text about-detail-text-two">
                            <p>{!! $about->other_description !!}</p>              
                        </div>
                    </div>
                </div>
            </div>
        </section>


    @include('components.frontend.footer')
    @include('components.frontend.main-js')

</body>
</html>