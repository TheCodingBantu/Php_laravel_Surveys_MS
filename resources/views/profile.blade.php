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
                            Employee Details
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="user-management-list.html">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-arrow-left me-1">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                            Back to Users List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <div class="row">

            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <form action="{{route('profile.update',$user->id)}}" method="POST">
                            <!-- Form Row-->
                            @csrf
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputFirstName">Name</label>
                                    <input value="{{$user->name}}" required name="name" class="form-control"
                                        id="inputFirstName" type="text" placeholder="Enter Employee name">
                                </div>


                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputLastName">Email</label>
                                    <input value="{{$user->email}}" name="email" required type="email"
                                        class="form-control" type="text" placeholder="Enter employee email">
                                </div>
                            </div>
                            <!-- Form Group (email address)-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="">Phone</label>
                                    <input value="{{$user->phone}}" required name="phone" type="number"
                                        class="form-control" id="inputFirstName" type="text"
                                        placeholder="Enter Employee Phone">
                                </div>
                                <!-- Form Group (last name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="">Address</label>
                                    <input value="{{ $user->address }}" name="address" required type="text"
                                        class="form-control" id="inputLastName" type="text"
                                        placeholder="Enter employee address">
                                </div>
                            </div>


                            <!-- Form Group (Roles)-->
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1">Department</label>

                                    <select name="department" class="form-select"
                                        aria-label="Default select example">
                                        @foreach ($departments as $department)
                                            <option
                                            {{-- if selected --}}
                                            @if ($user->department == $user->department_id)
                                                selected
                                            @endif
                                            value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">Role</label>

                                    <select name="role" class="form-select" aria-label="Default select example">
                                        <option  
                                        @if ($user->role == 0)
                                            selected
                                        @endif 
                                        value="0">Staff</option>
                                        <option
                                        @if ($user->role == 1)
                                            selected
                                        @endif
                                        value="1">Manager</option>
                                        <option
                                        @if ($user->role == 2)
                                            selected
                                        @endif
                                        value="2">Supervisor</option>

                                    </select>
                                </div>

                            </div>
                            <!-- Submit button-->
                            <button class="btn btn-primary" type="submit">Update Employee</button>
                        </form>
                    </div>
                </div>
                
            </div>
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4">
                    <div class="card-header">Update Password</div>
                    <div class="card-body">
                        <form action="{{route('profile.password',$user->id)}}" method="POST">
                            <!-- Form Row-->
                            @csrf
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="">
                                    <label class="small mb-1" for="inputFirstName">Current Password</label>
                                    <input required name="oldPassword" class="form-control"
                                        id="inputFirstName" type="password" placeholder="Enter old password">
                                </div>


                                <!-- Form Group (last name)-->
                                <div class="">
                                    <label class="small mb-1" for="inputLastName">New Password</label>
                                    <input name="newPassword" required type="password"
                                        class="form-control" type="text" placeholder="Enter new password">
                                </div>
                            </div>
                            

                            <!-- Submit button-->
                            <button class="btn btn-primary" type="submit">Update Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
{{-- if success --}}

@yield('footer')
