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
                  <h4>Add Business Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('details.index') }}">Business</a>
                    </li>
                    <li class="breadcrumb-item active">Add Business Details</li>
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
                        <h4>Business Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                    <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('details.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <!-- Business Type -->
                                        <div class="col-xxl-4 col-sm-6 mb-5">
                                            <label class="form-label" for="business_id">Business Type <span class="txt-danger">*</span></label>
                                            <select class="form-control" id="business_id" name="business_id" required>
                                                <option value="" disabled selected>Select Business Type</option>
                                                @foreach ($businesses as $id => $name)
                                                    <option value="{{ $id }}" {{ old('business_id') == $id ? 'selected' : '' }}>
                                                        {{ $name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please select a Business Type.</div>
                                        </div>
                                        <hr>
                                        <h4 class="mt-5"> Banner Details </h4>



                                        <!-- Banner Label -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="banner_label">Banner Label <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_label" type="text" name="banner_label" label="banner_label" placeholder="Enter Banner Label" value="{{ old('banner_label') }}" required>
                                            <div class="invalid-feedback">Please enter a Banner Label.</div>
                                        </div>

                                         
                                        <!-- Banner Image Upload -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="banner_image">Upload Banner Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_image" type="file" name="banner_image" accept="image/*" onchange="previewImage(event)" required>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            <!-- Banner Image Preview -->
                                            <div class="mt-2">
                                                <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 100%; height: auto; display: none; border: 1px solid #ddd; padding: 5px;">
                                            </div>
                                        </div>


                                        <!-- Logo-->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="logo">Banner Logo <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="logo" type="file" name="logo" accept="image/*" onchange="previewPageImage(event)" required>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            <!-- Image Preview -->
                                            <div class="mt-2">
                                                <img id="pageimagepreview" src="#" alt="Image Preview" style="max-width: 100%; height: auto; display: none; border: 1px solid #ddd; padding: 5px;">
                                            </div>
                                        </div>


                                        <!-- Banner Heading -->
                                        <div class="col-xxl-4 col-sm-6 mb-4"> 
                                            <label class="form-label" for="banner_heading">Banner Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_heading" type="text" name="banner_heading" placeholder="Enter Banner Heading" value="{{ old('banner_heading') }}" required>
                                            <div class="invalid-feedback">Please enter a Banner Heading.</div>
                                        </div>

                                        <!-- Adding margin to h4 -->
                                        <h4 class="mt-4">Banner Other Details</h4>

                                        <!-- Card Year -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="year">No. of Years</label>
                                            <input class="form-control" id="year" type="text" name="year" placeholder="Enter No. of Years" value="{{ old('year') }}">
                                            <div class="invalid-feedback">Please enter a Year.</div>
                                        </div>

                                             
                                        <!-- Projects Completed -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="project_completed">Projects Completed</label>
                                            <input class="form-control" id="project_completed" type="text" name="project_completed" placeholder="Enter Projects Completed" value="{{ old('project_completed') }}">
                                            <div class="invalid-feedback">Please enter a Projects Completed.</div>
                                        </div>

                                        <div class="col-12 mb-5"> <!-- Added mb-5 for larger gap -->
                                            <label class="form-label" for="banner_description">Banner Description</label>
                                            <textarea id="banner_description" name="banner_description" class="form-control summernote">
                                                {{ old('banner_description', $homePage->banner_description ?? '') }}
                                            </textarea>
                                        </div>

                                        <hr class="my-5"> <!-- Added my-5 for more vertical spacing -->

                                        <h4 class="mt-5">Industry Details</h4> <!-- Added mt-5 for extra space above -->


                                        <!-- Industry Label -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="industry_label">Industry Label <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="industry_label" type="text" name="industry_label" placeholder="Enter Industry Label" value="{{ old('industry_label') }}" required>
                                            <div class="invalid-feedback">Please enter a Industry Label.</div>
                                        </div>

                                        <!-- Industry Heading -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="industry_heading">Industry Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="industry_heading" type="text" name="industry_heading" placeholder="Enter Industry Heading" value="{{ old('industry_heading') }}" required>
                                            <div class="invalid-feedback">Please enter a Industry Heading.</div>
                                        </div>

                                        <!-- Industry Image -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="industry_image">Industry Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="industry_image" type="file" name="industry_image" accept="image/*" onchange="previewIndustryImage(event)" required>
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            <!-- Image Preview -->
                                            <div class="mt-2">
                                                <img id="IndustryImagepreview" src="#" alt="Image Preview" style="max-width: 100%; height: auto; display: none; border: 1px solid #ddd; padding: 5px;">
                                            </div>
                                        </div>


                                        <h5 class="mb-4 d-flex justify-content-between">
                                            <strong>Industry Served</strong>
                                            <button type="button" class="btn btn-success" onclick="addRow()">Add More</button>
                                        </h5>

                                        <table class="table table-bordered" id="cardTable">
                                            <thead>
                                                <tr>
                                                    <th>Image <span class="txt-danger">*</span></th>
                                                    <th>Description <span class="txt-danger">*</span></th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="cardTableBody">
                                                @php
                                                    $descriptions = old('description', []);
                                                @endphp

                                                @if (!empty($cardTitles))
                                                    @foreach ($cardTitles as $index => $title)
                                                        <tr>
                                                            <td>
                                                                <input class="form-control" type="file" name="image[]" accept="image/*" onchange="previewLogoImage(event, this)">
                                                                <img src="#" alt="Company Logo Preview" class="img-preview" style="max-width: 30%; height: auto; display: none; border: 1px solid #ddd; padding: 5px;" required>
                                                                <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                                <br>
                                                                <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                            </td>

                                                            <td>
                                                                <input class="form-control" type="text" name="description[]" value="{{ $descriptions[$index] ?? '' }}" placeholder="Enter Description *" required>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td>
                                                            <input class="form-control" type="file" name="image[]" accept="image/*" onchange="previewLogoImage(event, this)">
                                                            <img src="#" alt="Company Logo Preview" class="img-preview" style="max-width: 30%; height: auto; display: none; border: 1px solid #ddd; padding: 5px;" required>
                                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                            <br>
                                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="text" name="description[]" placeholder="Enter Description" required>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>

                                        <hr class="my-5"> <!-- Added large spacing between tables -->
                                        <h4 class="mt-5">Service Details</h4><br>   


                                        <!-- Service Heading -->
                                        <div class="col-xxl-4 col-sm-6 mb-4">
                                            <label class="form-label" for="service_heading">Service Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="service_heading" type="text" name="service_heading" placeholder="Enter Service Heading" value="{{ old('service_heading') }}" required>
                                            <div class="invalid-feedback">Please enter a Service Heading.</div>
                                        </div>

                                        <h5 class="mb-4 mt-3 d-flex justify-content-between">
                                            <strong>Service Details</strong>
                                            <button type="button" class="btn btn-success" onclick="addServiceRow()">Add More</button>
                                        </h5>


                                        <table class="table table-bordered" id="serviceTable">
                                            <thead>
                                                <tr>
                                                    <th>Image <span class="txt-danger">*</span></th>
                                                    <th>Description <span class="txt-danger">*</span></th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="serviceTableBody">
                                                <tr>
                                                    <td>
                                                        <input class="form-control" type="file" name="service_image[]" accept="image/*" onchange="previewLogoImage(event, this)">
                                                        <img src="#" alt="Service Image Preview" class="img-preview" style="max-width: 30%; height: auto; display: none; border: 1px solid #ddd; padding: 5px;" required>
                                                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                                        <br>
                                                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" name="service_description[]" placeholder="Enter Service Description" required>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>


                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('details.index') }}" class="btn btn-danger px-4">Cancel</a>
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

       <!-- Image Preview-->
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

            function previewIndustryImage(event) {
                const file = event.target.files[0];
                const preview = document.getElementById("IndustryImagepreview");

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

        <!-- Industry Served table js-->
        <script>
            function addRow() {
                let tableBody = document.getElementById("cardTableBody");
                let newRow = document.createElement("tr");

                newRow.innerHTML = `
                    <td>
                        <input class="form-control" type="file" name="image[]" accept="image/*" onchange="previewLogoImage(event, this)" required>
                        <img src="#" alt="Company Logo Preview" class="img-preview" style="max-width: 30%; height: auto; display: none; border: 1px solid #ddd; padding: 5px;">
                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                        <br>
                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                    </td>
                    <td><input class="form-control" type="text" name="description[]" placeholder="Enter Description" required></td>
                    <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
                `;

                tableBody.appendChild(newRow);
            }

            function removeRow(button) {
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



            function addServiceRow() {
                let tableBody = document.getElementById("serviceTableBody");
                let newRow = document.createElement("tr");
                newRow.innerHTML = `
                    <td>
                        <input class="form-control" type="file" name="service_image[]" accept="image/*" onchange="previewServiceImage(event, this)" required>
                        <img src="#" alt="Service Image Preview" class="img-preview" style="max-width: 30%; height: auto; display: none; border: 1px solid #ddd; padding: 5px;">
                        <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                        <br>
                        <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                    </td>
                    <td><input class="form-control" type="text" name="service_description[]" placeholder="Enter Service Description" required></td>
                    <td><button type="button" class="btn btn-danger" onclick="removeServiceRow(this)">Remove</button></td>
                `;
                tableBody.appendChild(newRow);
            }

            function removeServiceRow(button) {
                button.closest("tr").remove();
            }

            function previewServiceImage(event, input) {
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