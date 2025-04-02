    <header class="rsb-header">
      <!-- header start -->
      <section class="main_menu" id="myHeader">
        <div class="container-fluid">
          <div class="row v-center">
            <div class="header-item item-left">
              <div class="logo">
                <a href="{{ route('home.page') }}"><img src="{{ asset('frontend/assets/images/home/logo.png') }}"></a>
              </div>
            </div>
            <!-- menu start here -->
            <div class="header-item item-center">
              <div class="menu-overlay"></div>
              <nav class="menu">
                <div class="mobile-menu-head">
                  <div class="go-back"><i class="fa fa-angle-left"></i></div>
                  <div class="current-menu-title"></div>
                  <div class="mobile-menu-close">×</div>
                </div>
                <ul class="menu-main">
                  <li class="menu-item-has-children">
                    <a href="#">Business <i class="fa fa-angle-down"></i></a>
                    <div class="sub-menu single-column-menu">
                        <ul>
                            @php
                                $businesses = \App\Models\Business::whereNull('deleted_by')->get();
                            @endphp

                            @foreach($businesses as $business)
                                @php
                                    $exists = \App\Models\BusinessDetail::where('business_id', $business->id)->whereNull('deleted_by')->exists();
                                @endphp

                                @if ($exists)
                                    <li><a href="{{ route('display.detail', $business->slug) }}">{{ $business->business_name }}</a></li>
                                @else
                                    <li><a href="{{ route('comming-soon') }}">{{ $business->business_name }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                  </li>

                  <li><a href="{{ route('about.us') }}">About OKE</a></li>
                  <!-- <li><a href="coming-soon.html">Events & Exhibitions</a></li>
                  <li><a href="coming-soon.html">Blogs</a></li>
                  <li><a href="coming-soon.html">Careers</a></li> -->
                  <li><a href="contact.html">Contact Us</a></li>
                </ul>
              </nav>
            </div><!-- menu end here -->
            <div class="header-item header-right-item item-right">
              <!-- <ul>
                <li class="search-icon"><a data-toggle="modal" data-target="#search-popup"><i class="fa fa-search"></i> <span>Search</span></a></li>
              </ul> -->
              <!-- mobile menu trigger -->
              <div class="mobile-menu-trigger">
                <span></span>
              </div>
            </div>
          </div>
        </div>
      </section>
    </header>
