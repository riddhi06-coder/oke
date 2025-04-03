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
                  <h4>Edit Contact Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('contact-details.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Contact Details</li>
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
                        <h4>Contact Details Form</h4>
                        <p class="f-m-light mt-1">Fill up your true details and submit the form.</p>
                    </div>
                    <div class="card-body">
                        <div class="vertical-main-wizard">
                        <div class="row g-3">    
                            <!-- Removed empty col div -->
                            <div class="col-12">
                            <div class="tab-content" id="wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-contact" role="tabpanel" aria-labelledby="wizard-contact-tab">
                                    <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('contact-details.update', $contact->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Banner Title -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="banner_title">Banner Title <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_title" type="text" name="banner_title" placeholder="Enter Banner" value="{{ old('banner_title', $contact->banner_title) }}" required>
                                            <div class="invalid-feedback">Please enter a banner title.</div>
                                        </div>

                                        <!-- Banner Heading -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="banner_heading">Banner Heading <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_heading" type="text" name="banner_heading" placeholder="Enter Banner Heading" value="{{ old('banner_heading', $contact->banner_heading) }}" required>
                                            <div class="invalid-feedback">Please enter a Banner Heading.</div>
                                        </div>

                                        <!-- Banner Image Upload -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="banner_image">Upload Banner Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_image" type="file" name="banner_image" accept="image/*" onchange="previewImage(event)">
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small>
                                            <br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>
                                            <div class="mt-2">
                                                @if (!empty($contact->banner_image))
                                                    <img id="imagePreview" src="{{ asset('uploads/contact-details/' . $contact->banner_image) }}" alt="Banner Image" style="max-width: 100%; height: auto; border: 1px solid #ddd; padding: 5px;">
                                                @endif
                                            </div>
                                        </div>


                                         <!--Address -->
                                        <div class="col-xxl-4 col-sm-6">
                                            <label class="form-label" for="address">Address <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="address" type="text" name="address" placeholder="Enter Address" value="{{ old('address', $contact->address) }}" required>
                                            <div class="invalid-feedback">Please enter a Address.</div>
                                        </div>

                                        <!--Map url -->
                                        <div class="col-xxl-4 col-sm-6 mb-4">
                                            <label class="form-label" for="url">Map Url <span class="txt-danger">*</span> </label>
                                            <input class="form-control" id="url" type="text" name="url" placeholder="Enter Map Url" value="{{ old('url', $contact->url) }}" required>
                                            <div class="invalid-feedback">Please enter a Map Url.</div>
                                        </div>


                                        <!-- Business Phone Numbers -->
                                        <h5 class="mb-4 d-flex justify-content-between">
                                            <strong># Business Phone Numbers</strong>
                                            <button type="button" class="btn btn-success" onclick="addRow()">Add More</button>
                                        </h5>
                                        <table class="table table-bordered mb-4" id="cardTable">
                                            <thead>
                                                <tr>
                                                    <th>Business Name <span class="txt-danger">*</span></th>
                                                    <th>Contact No. <span class="txt-danger">*</span></th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="cardTableBody">
                                                @foreach ($contact->businessPhones ?? [] as $index => $phone)
                                                    <tr>
                                                        <td>
                                                            <input class="form-control" type="text" name="business_name[]" value="{{ old('business_name.' . $index, $phone) }}" placeholder="Enter Business Name" required>
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="text" name="contact_no[]" value="{{ old('contact_no.' . $index, $contact->contactNumbers[$index]) }}" placeholder="Enter Contact No." maxlength="10" required>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <!-- Business Emails -->
                                        <h5 class="mb-4 mt-3 d-flex justify-content-between">
                                            <strong># Business Emails</strong>
                                            <button type="button" class="btn btn-success" onclick="addServiceRow()">Add More</button>
                                        </h5>
                                        <table class="table table-bordered mb-4" id="serviceTable">
                                            <thead>
                                                <tr>
                                                    <th>Business Name <span class="txt-danger">*</span></th>
                                                    <th>Email ID <span class="txt-danger">*</span></th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="serviceTableBody">
                                                @foreach ($contact->businessEmails ?? [] as $index => $email)
                                                    <tr>
                                                        <td>
                                                            <input class="form-control" type="text" name="b_name[]" value="{{ old('b_name.' . $index, $email) }}" placeholder="Enter Business Name" required>
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="text" name="email_id[]" value="{{ old('email_id.' . $index, $contact->emailIds[$index]) }}" placeholder="Enter Email ID" required>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <!-- Contact Card Details -->
                                        <h5 class="mb-4 mt-3 d-flex justify-content-between">
                                            <strong># Contact Card Details</strong>
                                            <button type="button" class="btn btn-success" onclick="addContactRow()">Add More</button>
                                        </h5>
                                        <table class="table table-bordered" id="contactTable">
                                            <thead>
                                                <tr>
                                                    <th>Business Name <span class="txt-danger">*</span></th>
                                                    <th>Name <span class="txt-danger">*</span></th>
                                                    <th>Email <span class="txt-danger">*</span></th>
                                                    <th>Contact <span class="txt-danger">*</span></th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="contactTableBody">
                                                @foreach ($contact->contactCards ?? [] as $index => $card)
                                                    <tr>
                                                        <td>
                                                            <input class="form-control" type="text" name="business_n[]" value="{{ old('business_n.' . $index, $card) }}" placeholder="Enter Business Name" required>
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="text" name="name[]" value="{{ old('name.' . $index, $contact->contactNames[$index]) }}" placeholder="Enter Name" required>
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="text" name="email[]" value="{{ old('email.' . $index, $contact->contactEmails[$index]) }}" placeholder="Enter Email" required>
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="text" name="phone[]" value="{{ old('phone.' . $index, $contact->contactPhones[$index]) }}" placeholder="Enter Contact" maxlength="10" pattern="\d{10}" required>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="col-12 text-end">
                                            <a href="{{ route('contact-details.index') }}" class="btn btn-danger px-4">Cancel</a>
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
                <td><input class="form-control" type="text" name="business_name[]" placeholder="Enter Business Name"></td>
                <td><input class="form-control" type="text" name="contact_no[]" placeholder="Enter Contact No."></td>
                <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
            `;

            tableBody.appendChild(newRow);
        }

        function removeRow(button) {
            button.closest("tr").remove();
        }



        function addServiceRow() {
            let tableBody = document.getElementById("serviceTableBody");
            let newRow = document.createElement("tr");
            newRow.innerHTML = `
            
                <td><input class="form-control" type="text" name="b_name[]" placeholder="Enter Business Name" required></td>
                <td><input class="form-control" type="text" name="email_id[]" placeholder="Enter Email Id" required></td>
                <td><button type="button" class="btn btn-danger" onclick="removeServiceRow(this)">Remove</button></td>
            `;
            tableBody.appendChild(newRow);
        }

        function removeServiceRow(button) {
            button.closest("tr").remove();
        }


        
        function addContactRow() {
            let tableBody = document.getElementById("contactTableBody");
            let newRow = document.createElement("tr");
            newRow.innerHTML = `
            
               <td>
                    <input class="form-control" type="text" name="business_n[]" placeholder="Enter Business Name">
                </td>
                
                <td>
                    <input class="form-control" type="text" name="name[]" placeholder="Enter Name">
                </td>
                <td>
                    <input class="form-control" type="text" name="email[]" placeholder="Enter Email">
                </td>
                <td>
                    <input class="form-control" type="text" name="phone[]" placeholder="Enter Contact">
                </td>
                <td><button type="button" class="btn btn-danger" onclick="removeContactRow(this)">Remove</button></td>
            `;
            tableBody.appendChild(newRow);
        }

        function removeContactRow(button) {
            button.closest("tr").remove();
        }

    </script>


</body>

</html>