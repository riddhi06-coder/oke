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
                  <h4>Edit Events & Exhibition Details Form</h4>
                </div>
                <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('events-details.index') }}">Events & Exhibition</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Events & Exhibition Details</li>
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
                                    <form class="row g-3 needs-validation custom-input" novalidate action="{{ route('events-details.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                         <!-- Event Name Dropdown -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="event_id">Select Event <span class="txt-danger">*</span></label>
                                            <select class="form-select" id="event_id" name="event_id" required>
                                                <option value="">-- Select Event --</option>
                                                @foreach($events_title as $id => $name)
                                                    <option value="{{ $id }}" {{ (old('event_id', $event->event_id) == $id) ? 'selected' : '' }}>
                                                        {{ $name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please select an event.</div>
                                        </div>


                                        <!-- Banner Title -->
                                        <div class="col-sm-6">
                                            <label class="form-label" for="banner_title">Event Title <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_title" type="text" name="banner_title" placeholder="Enter Banner" value="{{ old('banner_title', $event->banner_title) }}" required>
                                            <div class="invalid-feedback">Please enter a banner title.</div>
                                        </div><nbr><br>

                                    
                                        <!-- Banner Image Upload -->
                                        <div class="col-md-6">
                                            <label class="form-label" for="banner_image">Upload Banner Image <span class="txt-danger">*</span></label>
                                            <input class="form-control" id="banner_image" type="file" name="banner_image" accept="image/*" onchange="previewImage(event)">
                                            <small class="text-secondary"><b>Note: The file size should be less than 2MB.</b></small><br>
                                            <small class="text-secondary"><b>Note: Only files in .jpg, .jpeg, .png, .webp format can be uploaded.</b></small>

                                            <!-- Banner Image Preview -->
                                            <div class="mt-2">
                                                <img
                                                    id="imagePreview"
                                                    src="{{ !empty($event->banner_image) ? asset('uploads/events/' . $event->banner_image) : '#' }}"
                                                    alt="Image Preview"
                                                    style="max-width: 100%; height: auto; {{ empty($event->banner_image) ? 'display: none;' : '' }} border: 1px solid #ddd; padding: 5px;"
                                                >
                                            </div>
                                        </div>


                                   
                                        <div class="col-md-12 mt-2 mb-4">
                                            <label class="form-label" for="description">Event Description <span class="txt-danger">*</span></label>
                                            <textarea id="summernote" name="description" class="form-control summernote" required>
                                                {{ old('description', $event->description ?? '') }}
                                            </textarea>
                                        </div>

                                        <hr class="mt-0">

                                        <h5 class="mb-4 mt-7 d-flex justify-content-between">
                                            <strong>Event Images</strong>
                                            <button type="button" class="btn btn-success" onclick="addServiceRow()">Add More</button>
                                        </h5>


                                        <table class="table table-bordered mb-5" id="serviceTable">
                                            <thead>
                                                <tr>
                                                    <th>Image <span class="txt-danger">*</span></th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="serviceTableBody">

                                                {{-- Show existing images --}}
                                                @if (!empty($event->event_images))
                                                    @foreach (json_decode($event->event_images, true) as $image)
                                                        <tr>
                                                        <td>
                                                            {{-- File input for replacing the image --}}
                                                            <input class="form-control" type="file" name="service_image[]" accept="image/*" onchange="previewServiceImage(event, this)">
                                                            
                                                            {{-- Guidelines --}}
                                                            <small class="text-secondary d-block mt-1">
                                                                <b>Note:</b> The file size should be less than 2MB.
                                                            </small>
                                                            <small class="text-secondary d-block">
                                                                <b>Note:</b> Only files in .jpg, .jpeg, .png, .webp format can be uploaded.
                                                            </small>

                                                            {{-- Existing image preview --}}
                                                            <img src="{{ asset('uploads/events/' . $image) }}" alt="Service Image Preview" class="img-preview mt-2" style="max-width: 30%; height: auto; border: 1px solid #ddd; padding: 5px;">

                                                            {{-- Hidden input to retain the current image if no new one is uploaded --}}
                                                            <input type="hidden" name="existing_service_images[]" value="{{ $image }}">
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger" onclick="removeServiceRow(this)">Remove</button>
                                                        </td>

                                                        </tr>
                                                    @endforeach
                                                @endif

                                            </tbody>
                                        </table>


                                        <hr class="mt-3">

                                        <h5 class="mb-4 d-flex justify-content-between"><strong># Contact Details</strong></h5>

                                        <div class="row">
                                            <!-- Contact Heading -->
                                            <div class="col-md-6">
                                                <label class="form-label" for="contact_heading">Contact Heading</label>
                                                <input class="form-control" id="contact_heading" type="text" name="contact_heading" placeholder="Enter Contact Heading" value="{{ old('contact_heading', $event->contact_heading) }}">
                                                <div class="invalid-feedback">Please enter a Contact Heading.</div>
                                            </div>

                                            <!-- Contact Title -->
                                            <div class="col-md-6">
                                                <label class="form-label" for="contact_title">Contact Title</label>
                                                <input class="form-control" id="contact_title" type="text" name="contact_title" placeholder="Enter Banner" value="{{ old('contact_title', $event->contact_title) }}">
                                                <div class="invalid-feedback">Please enter a Contact Title.</div>
                                            </div>
                                        </div><br><br>

                                        <!-- Form Actions -->
                                        <div class="col-12 text-end">
                                            <a href="{{ route('events-details.index') }}" class="btn btn-danger px-4">Cancel</a>
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
    </script>

    <!-- Script for table management -->
    <script>

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