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
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <!-- Zero Configuration  Starts-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('events-listing.index') }}">Event & Exhibition</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Event & Exhibition Page Details</li>
                            </ol>
                        </nav>

                        <a href="{{ route('events-listing.create') }}" class="btn btn-primary px-5 radius-30">+ Add Event & Exhibition Page Details</a>
                    </div>


                    <div class="table-responsive custom-scrollbar">
                      <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Events Title</th>
                                <th>Events Image</th>
                                <th>Events Date</th>
                                <th>Events Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $key => $event)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $event->events_title }}</td>
                                    <td>
                                        @if($event->image)
                                            <img src="{{ asset('uploads/events/' . $event->image) }}" alt="Event Image" style="width: 80px; height: auto;">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d M, Y') }}</td>
                                    <td>{{ $event->event_loaction }}</td>
                                    <td>
                                        <a href="{{ route('events-listing.edit', $event->id) }}" class="btn btn-sm btn-primary">Edit</a><br><br>
                                        <form action="{{ route('events-listing.destroy', $event->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this event?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
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

</body>

</html>