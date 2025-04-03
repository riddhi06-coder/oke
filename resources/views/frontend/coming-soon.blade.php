
<!DOCTYPE html>
<html lang="en">
  <head>
    @include('components.frontend.head')
  </head>
  <body>

    @include('components.frontend.header')

        <section class="breadcrumb-wrap career-bg">
            <div class="container-fluid">
            <div class="row">
                <div class="col-md-offset-1 col-md-10">
                <div class="breadcrumb-box">
                    <h1>Coming Soon</h1>
                    <h3>Exciting things are on the horizon stay tuned for the next big chapter</h3>
                    <ul>
                    <li><a href="{{ route('home.page') }}">Home</a></li>
                    <li>Coming Soon</li>
                    </ul>
                </div>
                </div>
            </div>
            </div>
        </section>

        <section class="coming-soon-page-wrap">
            <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <div class="comin-soon-sec-img">
                    <img src="{{ asset('frontend/assets/images/home/coming-soon.png') }}" class="img-responsive">
                </div>
                <div class="comin-sec-btn">
                    <a href="index.html">
                    <button class="btn-primary btn-grey text-center-center margin-auto">
                        <span>Back to Home</span>
                        <span class="btn-primary-inner">
                        <img src="{{ asset('frontend/assets/images/icons/btn.svg') }}">
                        </span>
                    </button>
                    </a>
                </div>
                </div>
            </div>
            </div>
        </section>


    @include('components.frontend.footer')
    @include('components.frontend.main-js')

</body>
</html>