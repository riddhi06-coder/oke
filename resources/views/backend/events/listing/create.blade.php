<!doctype html>
<html lang="en">
    
<head>
    @include('components.backend.head')
</head>
	   
		@include('components.backend.header')

	    <!--start sidebar wrapper-->	
	    @include('components.backend.sidebar')
	   <!--end sidebar wrapper-->


        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Add Events & Exhibition Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('events-listing.index') }}">Events & Exhibition</a>
                    </li>
                    <li class="breadcrumb-item active">Add Events & Exhibition Details</li>
                </ol>

                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-header">
                        <h4>Events & Exhibition Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                    <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('events-listing.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <!-- Banner Heading -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="banner_heading">Banner Heading</label>
                                            <input class="form-control" id="banner_heading" type="text" name="banner_heading" placeholder="Enter Banner Heading" value="{{ old('banner_heading') }}">
                                            <div class="invalid-feedback">Please enter a Banner Heading.</div>
                                        </div>


                                        <!-- Banner Title -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="banner_title">Banner Title</label>
                                            <input class="form-control" id="banner_title" type="text" name="banner_title" placeholder="Enter Banner" value="{{ old('banner_title') }}">
                                            <div class="invalid-feedback">Please enter a banner title.</div>
                                        </div>

                                    
                                        <!-- Banner Image Upload -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="banner_image">Upload Banner Image</label>
                                            <input class="form-control" id="banner_image" type="file" name="banner_image" accept="image/*" onchange="previewImage(event)">
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            <!-- Banner Image Preview -->
                                            <div class="mt-2">
                                                <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 100%; height: auto; display: none; border: 1px solid #ddd; padding: 5px;">
                                            </div>
                                        </div>

                                        <hr>

                                        <h5 class="mb-4 d-flex justify-content-between"><strong># Events & Exhibition Details</strong></h5>

                                        <!-- Events Title -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="events_title">Events Title <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="events_title" type="text" name="events_title" placeholder="Enter Events Title" value="{{ old('events_title') }}" required>
                                            <div class="invalid-feedback">Please enter a Events Title.</div>
                                        </div>

                                        <!-- Image-->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="image">Events Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="image" type="file" name="image" accept="image/*" onchange="previewPageImage(event)" required>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            <!-- Image Preview -->
                                            <div class="mt-2">
                                                <img id="pageimagepreview" src="#" alt="Image Preview" style="max-width: 100%; height: auto; display: none; border: 1px solid #ddd; padding: 5px;">
                                            </div>
                                        </div>

                                        
                                        <!-- Event Location -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="event_loaction">Event Location <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="event_loaction" type="text" name="event_loaction" placeholder="Enter Event Location" value="{{ old('event_loaction') }}" required>
                                            <div class="invalid-feedback">Please enter a Event Location.</div>
                                        </div>

                                        <!-- Card Event Date -->
                                        <div class="col-xxl-4 col-sm-6 mt-2 mb-4">
                                            <label class="form-label" for="event_date">Event Date <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="event_date" type="date" name="event_date" value="{{ old('event_date') }}" required>
                                            <div class="invalid-feedback">Please select the Event Date.</div>
                                        </div>

                                        <hr class="mt-0">

                                        <h5 class="mb-4 d-flex justify-content-between"><strong># Contact Details</strong></h5>

                                        <!-- Contact Heading -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="contact_heading">Contact Heading</label>
                                            <input class="form-control" id="contact_heading" type="text" name="contact_heading" placeholder="Enter Contact Heading" value="{{ old('contact_heading') }}">
                                            <div class="invalid-feedback">Please enter a Contact Heading.</div>
                                        </div>


                                        <!-- Contact Title -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="contact_title">Contact Title</label>
                                            <input class="form-control" id="contact_title" type="text" name="contact_title" placeholder="Enter Banner" value="{{ old('contact_title') }}">
                                            <div class="invalid-feedback">Please enter a Contact Title.</div>
                                        </div>


                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('events-listing.index') }}" class="btn btn-danger px-4">Cancel</a>
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

          </div>
        </div>
        <!-- footer start-->
        @include('components.backend.footer')
        </div>
        </div>
   
       @include('components.backend.main-js')
       

    <!-- Preview Scripts -->
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById("imagePreview");

            if (file) {
                const validTypes = ["image/jpeg", "image/png", "image/jpg", "image/webp"];

                if (!validTypes.includes(file.type)) {
                    alert("Please upload a valid image file (.jpg, .jpeg, .png, .webp).");
                    return;
                }

                if (file.size > 2 * 1024 * 1024) { // 2MB limit
                    alert("The file size should be less than 2MB.");
                    return;
                }

                const reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = "block";
                };

                reader.readAsDataURL(file);
            } else {
                preview.style.display = "none";
            }
        }

        function previewPageImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById("pageimagepreview");

            if (file) {
                const validTypes = ["image/jpeg", "image/png", "image/jpg", "image/webp"];

                if (!validTypes.includes(file.type)) {
                    alert("Please upload a valid image file (.jpg, .jpeg, .png, .webp).");
                    return;
                }

                if (file.size > 2 * 1024 * 1024) { // 2MB limit
                    alert("The file size should be less than 2MB.");
                    return;
                }

                const reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = "block";
                };

                reader.readAsDataURL(file);
            } else {
                preview.style.display = "none";
            }
        }
    </script>


</body>

</html>