<!DOCTYPE html>
<html lang="en">
  <head>
    @include('components.frontend.head')
    <!-- CSS for Error Message Styling -->
    <style>
        .error-message {
            font-size: 14px;
            margin-top: 5px;
            display: block;
        }
        .text-white {
            color: white;
        }
    </style>

  </head>
  <body>

    @include('components.frontend.header')

        <section class="breadcrumb-wrap" style="background-image: url('{{ asset('uploads/contact-details/' . $contact_us->banner_image) }}');">
            <div class="container-fluid">
                <div class="row">
                <div class="col-md-offset-1 col-md-10">
                    <div class="breadcrumb-box">
                    <h1>{{ $contact_us->banner_title ?? '-' }}</h1>
                    <h3>{{ $contact_us->banner_heading ?? '-' }}</h3>
                    <ul>
                        <li><a href="{{ route('home.page') }}">Home</a></li>
                        <li>{{ $contact_us->banner_title ?? '-' }}</li>
                    </ul>
                    </div>
                </div>
                </div>
            </div>
        </section>
        
        <section class="contact-one-wrap">
            <div class="container">
                <div class="row">
                    <!-- Location Section -->
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="contact-one_content wow fadeInLeft animated" data-wow-delay="700ms" data-wow-duration="700ms">
                            <ul class="list-unstyled contact-one_info">
                                <li class="contact-one_info_item">
                                    <div class="contact-one_info_icon">
                                        <img src="{{ asset('frontend/assets/images/icons/location.png') }}">
                                    </div>
                                    <div class="contact-one_info_content">
                                        <p class="contact-one_info_text">Our Location</p>
                                        <p class="contact-one_info_title">
                                            {{ $contact_us->address ?? 'N/A' }}
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Phone Section -->
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="contact-one_content wow fadeInLeft animated" data-wow-delay="700ms" data-wow-duration="700ms">
                            <ul class="list-unstyled contact-one_info">
                                <li class="contact-one_info_item">
                                    <div class="contact-one_info_icon">
                                        <img src="{{ asset('frontend/assets/images/icons/phonee.png') }}">
                                    </div>
                                    <div class="contact-one_info_content">
                                        <p class="contact-one_info_text">Have any question?</p>

                                        @foreach($contact_us->contactNumbers as $index => $number)
                                            <p class="contact-one_info_title">
                                                <b>{{ $contact_us->businessPhones[$index] ?? 'Business' }}</b>
                                                <a href="tel:{{ $number }}">{{ $number }}</a>
                                            </p>
                                            @if(!$loop->last) <hr> @endif
                                        @endforeach

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Email Section -->
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="contact-one_content wow fadeInLeft animated" data-wow-delay="700ms" data-wow-duration="700ms">
                            <ul class="list-unstyled contact-one_info">
                                <li class="contact-one_info_item">
                                    <div class="contact-one_info_icon">
                                        <img src="{{ asset('frontend/assets/images/icons/mail.png') }}">
                                    </div>
                                    <div class="contact-one_info_content">
                                        <p class="contact-one_info_text">Send email</p>

                                        @foreach($contact_us->emailIds as $index => $email)
                                            <p class="contact-one_info_title">
                                                <b>{{ $contact_us->businessEmails[$index] ?? 'Business' }}</b>
                                                <a href="mailto:{{ $email }}">{{ $email }}</a>
                                            </p>
                                            @if(!$loop->last) <hr> @endif
                                        @endforeach

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="contact-form-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <form id="contactForm" method="POST" action="send_mail.php" enctype="multipart/form-data" onsubmit="return validateForm()">
                            <div class="heading white-heading">
                                <h2>Contact Form</h2>
                                <h3>Feel free to write us anytime</h3>
                            </div>
                            <div class="row">
                                <!-- Name Field -->
                                <div class="form-group col-md-6">
                                    <label>Name</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name">
                                    <small id="nameError" class="text-white error-message"></small>
                                </div>
                    
                                <!-- Email Field -->
                                <div class="form-group col-md-6">
                                    <label>Email ID</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email Id">
                                    <small id="emailError" class="text-white error-message"></small>
                                </div>
                    
                                <!-- Phone Number Field -->
                                <div class="form-group col-md-6">
                                    <label>Phone No</label>
                                    <input type="text" id="phone" name="phone" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Enter Mobile No">
                                    <small id="phoneError" class="text-white error-message"></small>
                                </div>
                    
                                <!-- Enquiry Dropdown -->
                                <div class="form-group col-md-6">
                                    <label>Enquiry</label>
                                    <select class="form-control" id="enquiry_id" name="enquiry_id">
                                        <option value="">Select Enquiry</option>
                                        <option value="1">Arvos</option>
                                        <option value="2">RSB</option>
                                        <option value="3">Catalyst</option>
                                        <option value="4g">Battery Manufacturing</option>
                                    </select>
                                    <small id="enquiryError" class="text-white error-message"></small>
                                </div>
                    
                                <!-- Message Field -->
                                <div class="form-group col-md-12">
                                    <label>Message</label>
                                    <textarea id="message" name="message" class="form-control message-box-sec" placeholder="Enter Message"></textarea>
                                    <small id="messageError" class="text-white error-message"></small>
                                </div>
                    
                                <!-- Submit Button -->
                                <div class="text-center col-md-12">
                                    <button type="submit" class="btn-primary btn-grey">
                                        <span>Submit</span>
                                        <span class="btn-primary-inner">
                                            <img src="{{ asset('frontend/assets/images/icons/btn.svg') }}" alt="Submit">
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="contact-map-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="google_map">
                            <h3>Our Location</h3>
                            <iframe src="{{ $contact_us->url ?? '#' }}" 
                                width="100%" 
                                height="350" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="box-two">
            <div class="container">
                <div class="row">
                    @foreach($contact_us->contactNames as $index => $name)
                        <div class="col-md-6">
                            <div class="info-text">
                                <ul class="contact-info-list">
                                    <h3>{{ $contact_us->contactCards[$index] ?? 'Contact' }}</h3>
                                    <li><i class="fa fa-user"></i> {{ $name }}</li>
                                    <li>
                                        <a href="mailto:{{ $contact_us->contactEmails[$index] }}">
                                            <i class="fa fa-envelope"></i> {{ $contact_us->contactEmails[$index] }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="tel:+91{{ $contact_us->contactPhones[$index] }}">
                                            <i class="fa fa-phone"></i> +91 {{ $contact_us->contactPhones[$index] }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>


    @include('components.frontend.footer')
    @include('components.frontend.main-js')



      <!-- JavaScript Validation -->
      <script>
        function validateForm() {
            // Clear previous errors
            document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
        
            // Get form values
            const name = document.getElementById("name").value.trim();
            const email = document.getElementById("email").value.trim();
            const phone = document.getElementById("phone").value.trim();
            const enquiry = document.getElementById("enquiry_id").value;
            const message = document.getElementById("message").value.trim();
        
            // Regular expressions
            const namePattern = /^[a-zA-Z\s]+$/;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const phonePattern = /^[0-9]{10}$/;
        
            let isValid = true;
        
            // Name validation
            if (!name.match(namePattern)) {
                document.getElementById("nameError").textContent = "Please enter a name.";
                isValid = false;
            }
        
            // Email validation
            if (!email.match(emailPattern)) {
                document.getElementById("emailError").textContent = "Please enter a email id.";
                isValid = false;
            }
        
            // Phone validation
            if (!phone.match(phonePattern)) {
                document.getElementById("phoneError").textContent = "Please enter a valid 10-digit phone number.";
                isValid = false;
            }
        
            // Enquiry validation
            if (enquiry === "") {
                document.getElementById("enquiryError").textContent = "Please select an enquiry type.";
                isValid = false;
            }
        
            // Message validation
            if (message.length < 10) {
                document.getElementById("messageError").textContent = "Message should be at least 10 characters long.";
                isValid = false;
            }
        
            return isValid;
        }
    </script>

</body>
</html>