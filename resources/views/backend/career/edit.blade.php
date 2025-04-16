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
                  <h4>Edit Career Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('page-career.index') }}">Career</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Career Details</li>
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
                        <h4>Career Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                    <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('page-career.update', $career->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <h5 class="mb-4 d-flex justify-content-between"><strong># Banner Details</strong></h5>

                                        <!-- Banner Heading -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="banner_heading">Banner Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_heading" type="text" name="banner_heading" placeholder="Enter Banner Heading" value="{{ old('banner_heading', $career->banner_heading) }}" required>
                                            <div class="invalid-feedback">Please enter a Banner Heading.</div>
                                        </div>


                                        <!-- Banner Title -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="banner_title">Banner Title <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_title" type="text" name="banner_title" placeholder="Enter Banner" value="{{ old('banner_title', $career->banner_title) }}" required>
                                            <div class="invalid-feedback">Please enter a banner title.</div>
                                        </div>

                                    
                                     <!-- Banner Image Upload -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="banner_image">Upload Banner Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_image" type="file" name="banner_image" accept="image/*" onchange="previewImage(event)" {{ isset($career) ? '' : 'required' }}>
                                            
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            <!-- Banner Image Preview -->
                                            <div class="mt-2">
                                                @if(isset($career) && $career->banner_image)
                                                    <img id="imagePreview" src="{{ asset('uploads/career/' . $career->banner_image) }}" alt="Existing Banner Image" style="max-width: 100%; height: auto; border: 1px solid #ddd; padding: 5px;">
                                                @endif
                                            </div>
                                        </div>


                                        <hr>

                                        <h5 class="mb-4 d-flex justify-content-between"><strong># Section I Details</strong></h5>

                                        <!-- Page Heading -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="page_heading">Page Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="page_heading" type="text" name="page_heading" placeholder="Enter Page Heading" value="{{ old('page_heading', $career->page_heading) }}" required>
                                            <div class="invalid-feedback">Please enter a Page Heading.</div>
                                        </div>

                                        <!-- Page Title -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="page_title">Page Title <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="page_title" type="text" name="page_title" placeholder="Enter Page Title" value="{{ old('page_title', $career->page_title) }}" required>
                                            <div class="invalid-feedback">Please enter a Page Title.</div>
                                        </div>

                                        <!-- Image -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="image">Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="image" type="file" name="image" accept="image/*" onchange="previewPageImage(event)" {{ isset($career) ? '' : 'required' }}>
                                            
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            <!-- Image Preview -->
                                            <div class="mt-2">
                                                <img 
                                                    id="pageimagepreview" 
                                                    src="{{ isset($career) && $career->image ? asset('uploads/career/' . $career->image) : '#' }}" 
                                                    alt="Image Preview" 
                                                    style="max-width: 100%; height: auto; {{ isset($career) && $career->image ? '' : 'display: none;' }} border: 1px solid #ddd; padding: 5px;">
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <label class="form-label" for="description">Description <span class="txt-danger">*</span></label>
                                            <textarea id="summernote" name="description" class="form-control summernote" required>
                                                {{ old('description', $career->description ?? '') }}
                                            </textarea>
                                        </div>

                                        <hr class="mt-4">
                                        <h5 class="mt-4 mb-4 d-flex justify-content-between"><strong># Reviews Section Details</strong></h5>

                                         <!-- review Heading -->
                                         <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="review_heading">Review Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="review_heading" type="text" name="review_heading" placeholder="Enter Review Heading" value="{{ old('review_heading', $career->review_heading) }}" required>
                                            <div class="invalid-feedback">Please enter a Review Heading.</div>
                                        </div>


                                        <!-- review Title -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="review_title">Review Title <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="review_title" type="text" name="review_title" placeholder="Enter Review Title" value="{{ old('review_title', $career->review_title) }}" required>
                                            <div class="invalid-feedback">Please enter a Review title.</div>
                                        </div>

                                    
                                        
                                        <!-- Rating Heading -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="rating_heading">Rating Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="rating_heading" type="text" name="rating_heading" placeholder="Enter Rating Heading" value="{{ old('rating_heading', $career->rating_heading) }}" required>
                                            <div class="invalid-feedback">Please enter a Rating Heading.</div>
                                        </div>

                                        
                                        <!-- review Title -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="ratings">Ratings <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="ratings" type="text" name="ratings" placeholder="Enter Ratings" value="{{ old('ratings', $career->ratings) }}" required>
                                            <div class="invalid-feedback">Please enter a Ratings.</div>
                                        </div>

                                        
                                        <div class="col-12 mb-4">
                                            <label class="form-label" for="other_description">Review Description <span class="txt-danger">*</span></label>
                                            <textarea id="other_description" name="other_description" class="form-control summernote" required>{{ old('other_description', $career->other_description ?? '') }}</textarea>
                                        </div>

                                

                                        <h5 class="mb-4 mt-3 d-flex justify-content-between">
                                            <strong>Profile Images</strong>
                                            <button type="button" class="btn btn-success" onclick="addServiceRow()">Add More</button>
                                        </h5>


                                        <table class="table table-bordered" id="serviceTable">
                                            <thead>
                                                <tr>
                                                    <th>Image <span class="txt-danger">*</span></th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="serviceTableBody">
                                            @if(isset($career) && $career->profile_images)
                                                @foreach(json_decode($career->profile_images) as $image)
                                                    <tr>
                                                        <td>
                                                            <input class="form-control" type="file" name="profile_image[]" accept="image/*" onchange="previewLogoImage(event, this)">
                                                            <img src="{{ asset('uploads/career/' . $image) }}" alt="Profile Image Preview" class="img-preview" style="max-width: 30%; height: auto; border: 1px solid #ddd; padding: 5px;">
                                                            <input type="hidden" name="existing_profile_images[]" value="{{ $image }}">
                                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger" onclick="removeServiceRow(this)">Remove</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @else
                                                    <tr>
                                                        <td>
                                                            <input class="form-control" type="file" name="profile_image[]" accept="image/*" onchange="previewLogoImage(event, this)">
                                                            <img src="#" alt="Profile Image Preview" class="img-preview" style="max-width: 30%; height: auto; display: none; border: 1px solid #ddd; padding: 5px;">
                                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger" onclick="removeServiceRow(this)">Remove</button>
                                                        </td>
                                                    </tr>
                                            @endif
                                            </tbody>
                                        </table>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('page-career.index') }}" class="btn btn-danger px-4">Cancel</a>
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



    <!---- table preview scripts----->
    <script>
    
        function addServiceRow() {
            let tableBody = document.getElementById("serviceTableBody");
            let newRow = document.createElement("tr");
            newRow.innerHTML = `
                <td>
                    <input class="form-control" type="file" name="service_image[]" accept="image/*" onchange="previewLogoImage(event, this)" required>
                    <img src="#" alt="Service Image Preview" class="img-preview" style="max-width: 30%; height: auto; display: none; border: 1px solid #ddd; padding: 5px;">
                    <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                    <br>
                    <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                </td>
                <td><button type="button" class="btn btn-danger" onclick="removeServiceRow(this)">Remove</button></td>
            `;
            tableBody.appendChild(newRow);
        }

        function removeServiceRow(button) {
            button.closest("tr").remove();
        }

        function previewLogoImage(event, input) {
            let file = input.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let img = input.nextElementSibling;
                    img.src = e.target.result;
                    img.style.display = "block";
                };
                reader.readAsDataURL(file);
            }
        }

    </script>


</body>

</html>