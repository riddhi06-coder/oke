
    <!-- footer start-->
    <footer class="section bg-dark footer-hei" id="footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="footer-text">
              <div class="footer-logo">
                <img src="{{ asset('frontend/assets/images/home/logo.png') }}" >
              </div>
              <ul class="footer-ul">
                <li><a class="footer-link" href="{{ route('home.page') }}">About OKE</a></li>
                <!-- <li><a class="footer-link" href="events-exhibitions.html">Events & Exhibitions</a></li>
                  <li><a class="footer-link" href="blog.html">Blogs</a></li>
                  <li><a class="footer-link" href="career.html">Careers</a></li> -->
                <li><a class="footer-link" href="{{ route('contact.us') }}">Contact Us</a></li>
              </ul>
              <div class="pattern-box"></div>

             @php
                use Illuminate\Support\Facades\DB;

                $footer = DB::table('contact_details')->first();
                $platforms = json_decode($footer->platform ?? '[]', true);
                $urls = json_decode($footer->media_url ?? '[]', true);

                $linkedinUrl = '#'; // Default fallback

                foreach ($platforms as $index => $platform) {
                    if (strtolower($platform) === 'linkedin' && !empty($urls[$index])) {
                        $linkedinUrl = $urls[$index];
                        break;
                    }
                }
            @endphp

            <div class="footer-social-items">
                <ul class="footer-social-list"> 
                    <li class="footer-social-list-item">
                        <a target="_blank" class="footer-social-list-link">Follow Us</a>
                    </li>

                    <li class="footer-social-list-item">
                        <a href="{{ $linkedinUrl }}" target="_blank" class="footer-social-list-link">
                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
            </div>



            

              
            </div>
          </div>
        </div>
      </div>
      <!-- Start Footer Bottom -->
      <div class="container-fluid zero-padding prt-container">
          <div class="bottom-footer">
            <div class="footer-author-block">
              <div class="footer-author-text"><div id="copyright">
                Copyright © {{ date('Y') }} OKE. All rights reserved. Designed By <a href="http://www.matrixbricks.com" target="_blank">Matrix Bricks</a></div>
              </div>
            </div>
          </div>
        </div>
      <!-- End Footer Bottom -->
    </footer>