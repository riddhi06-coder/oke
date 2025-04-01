<!DOCTYPE html>
<html lang="en">
   <head>
      @include('components.frontend.head')
      <link rel="stylesheet" href="{{ asset('frontend/assets/css/fullpage.css') }}">      
   </head>

   <body>
      <!-- ==================== Start Loading ==================== -->
      <div class="loader-wrap">
         <svg viewBox="0 0 1000 1000" preserveAspectRatio="none">
            <path id="svg" d="M0,1005S175,995,500,995s500,5,500,5V0H0Z"></path>
         </svg>
         <div class="loader-wrap-heading">
            <div class="load-text">
               <span>L</span>
               <span>o</span>
               <span>a</span>
               <span>d</span>
               <span>i</span>
               <span>n</span>
               <span>g</span>
            </div>
         </div>
      </div>
      <!-- ==================== End Loading ==================== -->



      @include('components.frontend.header')
      
      
        <div id="fullpage">
            <section class="section black-img-bg" id="banner">
                <div class="boxes-group-wrap">
                    <div class="wrap-circle-button">
                        <img src="{{ asset('frontend/assets/images/icons/arrow-down-big.png') }}">
                        <p>Scroll Down</p>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <div class="boxes-text">
                                    <h1>{{ $homeDetails->first()->banner_title}}</h1>
                                </div>
                                <div class="boxes-group">
                                    <div class="row">
                                        @foreach($homeDetails->first()->titles as $index => $title)
                                            <div class="col-md-3 col-sm-3 col-xs-6">
                                                <a href="#section{{ $index + 2 }}">
                                                    <div class="single-box">
                                                        <p>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }} - {{ $title }} </p>
                                                        <img src="{{ asset('uploads/home/' . ($homeDetails->first()->logos[$index] ?? 'default.png')) }}" class="img-responsive">
                                                        <h2>{{ $homeDetails->first()->companyNames[$index] ?? '' }}</h2><br>
                                                        <h6>{{ $homeDetails->first()->descriptions[$index] ?? '' }}</h6>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            @php
                $sectionIds = ['gasification', 'metal', 'catalyst', 'battery-manufacturing'];
            @endphp
            @foreach($homeDetails as $index => $home)
                @if($index > 0)
                <section class="section banner-wrap" id="{{ $sectionIds[$index - 1] }}" style="background-image: url('{{ asset('uploads/home/' . ($home->banner_image ?? 'default.jpg')) }}');">
                    <div class="banner-text">
                        <h6>{{ $home->banner_heading }}</h6>
                        @php
                            $words = explode(' ', $home->banner_title);
                            $firstThreeWords = implode(' ', array_slice($words, 0, 2));
                            $remainingWords = implode(' ', array_slice($words, 2));
                        @endphp

                        <h2>{{ $firstThreeWords }} <br> {{ $remainingWords }}</h2>

                        <div class="banner-pattern mb-16 flex flex-col items-center">
                            <div class="banner-line flex items-center justify-center">
                                <div class="fourline"></div>
                                <div class="thirdline"></div>
                            </div>
                            <div class="banner-line flex items-center justify-center">
                                <div class="secline"></div>
                                <div class="firstline"></div>
                            </div>
                        </div>
                        <div class="text-center-center">
                            <a href="#">
                                <button class="btn-primary">
                                    <span>Read More</span>
                                    <span class="btn-primary-inner">
                                        <img src="{{ asset('frontend/assets/images/icons/btn.svg') }}">
                                    </span>
                                </button>
                            </a>
                        </div>
                    </div>
                </section>

                @endif
            @endforeach

            @include('components.frontend.footer')
        </div>



      <div id="scroll-percentage"><span id="scroll-percentage-value"></span></div>
      @include('components.frontend.main-js')

      <!-- image moving with parallex -->
      <script src="http://themes.tvda.pw/demos/identiq/js/jquery.parallax-1.1.3.js"></script>
      <script src="{{ asset('frontend/assets/js/fullpage.js') }}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/4.0.27/fullpage.min.js"></script>

      <!-- for loader -->
      <script type="text/javascript">
         $(function () {
             const svg = document.getElementById("svg");
             const tl = gsap.timeline();
             const curve = "M0 502S175 272 500 272s500 230 500 230V0H0Z";
             const flat = "M0 2S175 1 500 1s500 1 500 1V0H0Z";
         
             tl.to(".loader-wrap-heading .load-text , .loader-wrap-heading .cont", {
                 delay: 1.5,
                 y: -100,
                 opacity: 0,
             });
             tl.to(svg, {
                 duration: 0.5,
                 attr: { d: curve },
                 ease: "power2.easeIn",
             }).to(svg, {
                 duration: 0.5,
                 attr: { d: flat },
                 ease: "power2.easeOut",
             });
             tl.to(".loader-wrap", {
                 y: -1500,
             });
             tl.to(".loader-wrap", {
                 zIndex: -1,
                 display: "none",
             });
             tl.from(
                 "header .container",
                 {
                     y: 100,
                     opacity: 0,
                     delay: 0.3,
                 },
                 "-=1.5"
             );
         
         });
      </script>

      <script>
         document.addEventListener('DOMContentLoaded', () => {
             const sandTimer = document.getElementById('sand-timer');
             const carouselDots = document.getElementById('carousel-dots');
         
             // Simulate transition after 3 seconds
             setTimeout(() => {
                 document.querySelector('.transition-container').classList.add('active');
             }, 3000); // Transition after 3 seconds
         });
      </script>

      <script type="text/javascript">
         $(document).ready(function() {
             new fullpage('#fullpage', {
                 autoScrolling: true,
                 scrollHorizontally: true,
                 navigation: true,
                 navigationPosition: 'right',
                 anchors: ['section1', 'section2', 'section3', 'section4', 'section5', 'section6'],
                 navigationTooltips: ['<img src="/frontend/assets/images/icons/header.png">','<img src="/frontend/assets/images/icons/gasification.png">','<img src="/frontend/assets/images/icons/metal.png">', '<img src="/frontend/assets/images/icons/rs.png">', '<img src="/frontend/assets/images/icons/battery.png">', '<img src="/frontend/assets/images/icons/footer.png">'],
                 showActiveTooltip: true,
                 slidesNavigation: true,
                 slidesNavPosition: 'bottom',
                 afterLoad: function(origin, destination, direction){
                 // Custom function if needed after section is loaded
                 }
             });
         });
      </script>
      
   </body>
</html>