<!DOCTYPE html>
<html lang="en">
  <head>
    @include('components.frontend.head')
  </head>
  <body>

    @include('components.frontend.header')

    <section class="breadcrumb-wrap career-bg1" style="background-image: url('{{ asset('uploads/career/' . $career->banner_image) }}');">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-offset-1 col-md-10">
                <div class="breadcrumb-box">
                <h1>{{ $career->banner_heading }}</h1>
                <h3>{{ $career->banner_title ?? '' }}</h3>
                <ul>
                    <li><a href="{{ route('home.page') }}">Home</a></li>
                    <li>{{ $career->banner_heading }}</li>
                </ul>
                </div>
            </div>
            </div>
        </div>
    </section>

    <section class="career-page-wrap">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-6">
                <div class="career-text">
                <div class="heading white-heading">
                    <h2>{{ $career->page_heading ?? '' }}</h2>
                    <h3>{{ $career->page_title ?? '' }}</h3>
                </div>
                <p>{!! $career->description ?? '' !!}</p>
                <p>{{ $career->other_description ?? '' }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('uploads/career/' . $career->image) }}" class="img-responsive" alt="Section Image">
            </div>

            <div class="col-md-12">
                <div class="banner-one__content">
                    <div class="banner-one__content-left">
                    @php
                        $heading = $career->review_heading ?? '';
                        $words = explode(' ', $heading);
                        $lastTwo = implode(' ', array_slice($words, -2));
                        $firstPart = implode(' ', array_slice($words, 0, -2));
                    @endphp
                    <h2>
                        {{ $firstPart }} <span>{{ $lastTwo }}</span>
                    </h2>
                    <p>{{ $career->review_title ?? '' }}</p>
                </div>
                <div class="banner-one__content-right">
                    <div class="banner-one__content-right-text">
                    <p>{{ $career->other_description ?? '' }}</p>
                    </div>
                    <div class="banner-one__content-right-middle">
                    <ul class="clearfix">
                        @foreach (json_decode($career->profile_images, true) ?? [] as $profile)
                        <li>
                            <div class="img-box">
                            <img src="{{ asset('uploads/career/' . $profile) }}" alt="Profile Image">
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <div class="text-box">
                        <h2>{{ $career->rating_heading ?? '' }}</h2>
                        <p>{{ $career->ratings ?? '' }}</p>
                    </div>
                    </div>
                    <div class="banner-one__content-right-btn">
                    <a class="thm-btn" href="#">Check on glassdoor</a>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>

    <section class="vacancy-wrap">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-12">
                <div class="single-vacancy single-vacancy-wrap">
                    <h6>Job Posted</h6>
                    <h2>Job Position</h2>
                    <p>Location</p>
                    <p></p>
                </div>
            </div>
            @forelse ($jobs as $job)
                <div class="col-md-12">
                <div class="single-vacancy">
                    <h6>{{ \Carbon\Carbon::parse($job->inserted_at)->format('d M Y') }}</h6>
                    <h2>{{ $job->job_position }}</h2>
                    <p>{{ $job->job_location }}</p>
                    <p><a href="#">Read More</a></p>
                </div>
                </div>
            @empty
                <div class="col-md-12">
                <div class="single-vacancy">
                    <h6>No jobs available</h6>
                </div>
                </div>
            @endforelse
            </div>
        </div>
    </section>


    <div class="pattern-box-three">
      <div class="horizontal-line"></div>
    </div>

    <section class="vacancy-form-wrap">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <form action="{{ route('submit.resume') }}" method="POST" enctype="multipart/form-data" id="resumeForm" >
            @csrf
              <div class="heading white-heading text-center">
                <h2>Join Us</h2>
                <h3>Send your resume</h3>
              </div>

              <div class="form-group col-md-6">
                <label>First Name <span class="txt-danger">*</span></label>
                <input type="text" class="form-control" name="first_name">
                <div class="error-message"></div>
              </div>

              <div class="form-group col-md-6">
                <label>Last Name <span class="txt-danger">*</span></label>
                <input type="text" class="form-control" name="last_name">
                <div class="error-message"></div>
              </div>

              <div class="form-group col-md-6">
                <label>Email <span class="txt-danger">*</span></label>
                <input type="email" class="form-control" name="email">
                <div class="error-message"></div>
              </div>

              <div class="form-group col-md-6">
                <label>Mobile Phone Number <span class="txt-danger">*</span></label>
                <input type="text" class="form-control" name="mobile" pattern="\d{10}" maxlength="10" title="Please enter a 10-digit mobile number">
                <div class="error-message"></div>
              </div>

              <div class="form-group col-md-12">
                <label>Resume <span class="txt-danger">*</span></label>
                <input type="file" class="form-control" name="resume" accept=".pdf">
                <small class="text-secondary" style="color: white; font-size: 12px;">
                  <b>Note: The file size should be less than 1.5MB.</b>
                </small>
                <br>
                <small class="text-secondary" style="color: white; font-size: 12px;">
                  <b>Note: Only files in .pdf format can be uploaded.</b>
                </small>

                <div class="error-message"></div>
              </div>

              <div class="text-center">
                <button type="submit" class="btn-primary btn-grey text-center-center margin-auto">
                  <span>Submit</span>
                  <span class="btn-primary-inner">
                    <img src="{{ asset('frontend/assets/images/icons/btn.svg') }}">
                  </span>
                </button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </section>


    @include('components.frontend.footer')
    @include('components.frontend.main-js')


    <script>

      document.querySelector("#resumeForm").addEventListener("submit", function (e) {
        e.preventDefault();

        let isValid = true;
        const form = this;
        const inputs = form.querySelectorAll("input");
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const nameRegex = /^[A-Za-z\s]+$/;
        const phoneRegex = /^\d{10}$/;

        // Clear previous errors
        form.querySelectorAll(".error-message").forEach(div => div.innerText = "");

        inputs.forEach(input => {
          const errorDiv = input.nextElementSibling;
          const label = input.previousElementSibling ? input.previousElementSibling.innerText : '';
          errorDiv.style.color = "red";
          errorDiv.innerText = "";

          if (input.value.trim() === "") {
            isValid = false;
            errorDiv.innerText = `${label} is required.`;
          } else {
            if (input.name === "first_name" || input.name === "last_name") {
              if (!nameRegex.test(input.value.trim())) {
                isValid = false;
                errorDiv.innerText = `${label} should not contain numbers or special characters.`;
              }
            }

            if (input.name === "email") {
              if (!emailRegex.test(input.value.trim())) {
                isValid = false;
                errorDiv.innerText = "Please enter a valid email.";
              }
            }

            if (input.name === "phone") {
              if (!phoneRegex.test(input.value.trim())) {
                isValid = false;
                errorDiv.innerText = "Phone number must be exactly 10 digits.";
              }
            }

            if (input.name === "resume") {
              const file = input.files[0];
              if (!file) {
                isValid = false;
                errorDiv.innerText = "Please upload your resume.";
              } else {
                const allowedTypes = ['application/pdf'];
                if (!allowedTypes.includes(file.type)) {
                  isValid = false;
                  errorDiv.innerText = "Only PDF files are allowed.";
                } else if (file.size > 1.5 * 1024 * 1024) {
                  isValid = false;
                  errorDiv.innerText = "File size should not exceed 1.5 MB.";
                }
              }
            }
          }
        });

        if (isValid) {
          form.submit();
        }
      });

      // Prevent non-numeric input in phone field
      document.querySelector('input[name="mobile"]').addEventListener("input", function () {
        if (this.value < 0) this.value = 0;
        this.value = this.value.replace(/[^0-9]/g, ""); // optional: keep only digits
      });

    </script>



</body>
</html>