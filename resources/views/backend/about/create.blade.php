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
                  <h4>Add About Page Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('about.index') }}">About</a>
                    </li>
                    <li class="breadcrumb-item active">Add About Page Details</li>
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
                        <h4>About Page Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                    <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('about.store') }}" method="POST" enctype="multipart/form-data">
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

                                        <h5 class="mb-4 d-flex justify-content-between"><strong># Page Details</strong></h5>

                                        <!-- Page Heading -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="page_heading">Page Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="page_heading" type="text" name="page_heading" placeholder="Enter Page Heading" value="{{ old('page_heading') }}" required>
                                            <div class="invalid-feedback">Please enter a Page Heading.</div>
                                        </div>

                                        <!-- Page Title -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="page_title">Page Title <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="page_title" type="text" name="page_title" placeholder="Enter Page Title" value="{{ old('page_title') }}" required>
                                            <div class="invalid-feedback">Please enter a Page Title.</div>
                                        </div>

                                        <!-- Image-->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="image">Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="image" type="file" name="image" accept="image/*" onchange="previewPageImage(event)" required>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            <!-- Image Preview -->
                                            <div class="mt-2">
                                                <img id="pageimagepreview" src="#" alt="Image Preview" style="max-width: 100%; height: auto; display: none; border: 1px solid #ddd; padding: 5px;">
                                            </div>
                                        </div>

                                        
                                        <!-- Card Title -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="card_title">Card Title <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="card_title" type="text" name="card_title" placeholder="Enter Card Title" value="{{ old('card_title') }}" required>
                                            <div class="invalid-feedback">Please enter a Card Title.</div>
                                        </div>

                                        <!-- Card Year -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="year">Year <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="year" type="text" name="year" placeholder="Enter Year" value="{{ old('year') }}" required>
                                            <div class="invalid-feedback">Please enter a Year.</div>
                                        </div>



                                        <div class="col-12">
                                            <label class="form-label" for="description">Description <span class="txt-danger">*</span></label>
                                            <textarea id="summernote" name="description" class="form-control summernote" required>
                                                {{ old('description', $homePage->description ?? '') }}
                                            </textarea>
                                        </div>


                                        <div class="col-12">
                                            <label class="form-label" for="other_description">Other Description <span class="txt-danger">*</span></label>
                                            <textarea id="other_description" name="other_description" class="form-control summernote" required>
                                                {{ old('other_description', $homePage->other_description ?? '') }}
                                            </textarea>
                                        </div>


                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('about.index') }}" class="btn btn-danger px-4">Cancel</a>
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