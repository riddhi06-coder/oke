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
                  <h4>Edit Home Page Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('home-page.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Home Page Details</li>
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
                        <h4>Home Page Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('home-page.update', $homePage->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <!-- Banner Title -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="banner_title">Banner Title <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="banner_title" type="text" name="banner_title" value="{{ old('banner_title', $homePage->banner_title) }}" required>
                                    </div>

                                    <!-- Banner Heading -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="banner_heading">Banner Heading</label>
                                        <input class="form-control" id="banner_heading" type="text" name="banner_heading" value="{{ old('banner_heading', $homePage->banner_heading) }}">
                                    </div>

                                    <!-- Banner Image Upload -->
                                    <div class="col-xxl-4 col-sm-6">
                                        <label class="form-label" for="banner_image">Upload Banner Image <span class="txt-danger">*</span></label>
                                        <input class="form-control" id="banner_image" type="file" name="banner_image" accept="image/*" onchange="previewImage(event)">
                                        <small class="text-secondary"><b>Max size: 2MB | Formats: JPG, JPEG, PNG, WEBP</b></small>

                                        @if($homePage->banner_image)
                                            <div class="mt-2">
                                                <img id="imagePreview" src="{{ asset('uploads/home/' . $homePage->banner_image) }}" alt="Banner Image" style="max-width: 100%; height: auto; border: 1px solid #ddd;">
                                            </div>
                                        @endif
                                    </div>

                                    <hr>

                                    <h5 class="mb-4 d-flex justify-content-between">
                                        <strong># Card Details (Optional)</strong>
                                        <button type="button" class="btn btn-success" onclick="addRow()">Add More</button>
                                    </h5>

                                    <table class="table table-bordered" id="cardTable">
                                        <thead>
                                            <tr>
                                                <th>Card Title</th>
                                                <th>Company Logo</th>
                                                <th>Company Name</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="cardTableBody">
                                            @forelse($cardTitles as $index => $title)
                                                <tr>
                                                    <td><input class="form-control" type="text" name="card_title[]" value="{{ $title }}" placeholder="Enter Card Title"></td>
                                                    <td>
                                                        <input class="form-control" type="file" name="company_logo[]" accept="image/*" onchange="previewLogoImage(event, this)">
                                                        @if(isset($companyLogos[$index]) && !empty($companyLogos[$index]))
                                                            <img src="{{ asset('uploads/home/' . $companyLogos[$index]) }}" alt="Company Logo" class="img-preview" style="max-width: 30%; height: auto; border: 1px solid #ddd;">
                                                        @endif
                                                    </td>
                                                    <td><input class="form-control" type="text" name="company_name[]" value="{{ $companyNames[$index] ?? '' }}" placeholder="Enter Company Name"></td>
                                                    <td><input class="form-control" type="text" name="description[]" value="{{ $descriptions[$index] ?? '' }}" placeholder="Enter Description"></td>
                                                    <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td><input class="form-control" type="text" name="card_title[]" placeholder="Enter Card Title"></td>
                                                    <td><input class="form-control" type="file" name="company_logo[]" accept="image/*"></td>
                                                    <td><input class="form-control" type="text" name="company_name[]" placeholder="Enter Company Name"></td>
                                                    <td><input class="form-control" type="text" name="description[]" placeholder="Enter Description"></td>
                                                    <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                    <div class="col-12 text-end">
                                        <a href="{{ route('home-page.index') }}" class="btn btn-danger px-4">Cancel</a>
                                        <button class="btn btn-primary" type="submit">Update</button>
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
    </script>


    <script>
        function addRow() {
            let tableBody = document.getElementById("cardTableBody");
            let newRow = document.createElement("tr");

            newRow.innerHTML = `
                <td><input class="form-control" type="text" name="card_title[]" placeholder="Enter Card Title"></td>
                <td>
                    <input class="form-control" type="file" name="company_logo[]" accept="image/*" onchange="previewLogoImage(event, this)">
                    <img src="#" alt="Company Logo Preview" class="img-preview" style="max-width: 30%; height: auto; display: none; border: 1px solid #ddd; padding: 5px;">
                </td>
                <td><input class="form-control" type="text" name="company_name[]" placeholder="Enter Company Name"></td>
                <td><input class="form-control" type="text" name="description[]" placeholder="Enter Description"></td>
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

    </script>


</body>

</html>