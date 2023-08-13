@include('components.navbar')
@include('components.footer')

@yield('navbar')
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-user-plus">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="8.5" cy="7" r="4"></circle>
                                    <line x1="20" y1="8" x2="20" y2="14"></line>
                                    <line x1="23" y1="11" x2="17" y2="11"></line>
                                </svg></div>
                            Add Customer
                              
                                
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="{{route('customers')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-arrow-left me-1">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                            All Customers
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <div class="row">
            <div class="col-xl-1">
                <!-- Profile picture card-->

            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Customer Details</div>
                    <div class="card-body">
                        <form action="{{ route('storeCustomer') }}" method="POST">
                            <!-- Form Row-->
                            @csrf
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputFirstName">Name</label>
                                <input value="{{ old('name') }}"
                                    required name="name" class="form-control" id="inputFirstName" type="text"
                                    placeholder="Enter customer name">
                            </div>

                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Email</label>
                                <input value="{{ old('email') }}" name="email" required type="email" class="form-control" type="text"
                                    placeholder="Enter customer email">
                            </div>
                        </div>
                        <!-- Form Group (email address)-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="">Phone</label>
                                <input value="{{ old('phone') }}" required name="phone" type="number" class="form-control"
                                    id="inputFirstName" type="text" placeholder="Enter customer Phone">
                            </div>
                           
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="">Gender</label>
                                <select name="gender" class="form-control" id="">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="">Prefer not to say</option>
                                </select>
                            </div>
                        </div>
                        <div class="row gx-4 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="">Date of Birth</label>

                        <div class="input-group input-group-joined">
                            <span class="input-group-text">
                                <i data-feather="calendar"></i>
                            </span>
                            <input autocomplete=off name="date" class="form-control ps-0"
                                id="litepickerSingleDate" placeholder="Select date of birth..." />
                        </div>
                        </div>
                        </div>


                     
                        <!-- Submit button-->
                        <button class="btn btn-primary" type="submit">Save Customer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
{{-- if success --}}

@yield('footer')
