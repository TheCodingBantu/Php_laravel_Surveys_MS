@include('components.navbar')
@include('components.footer')

@yield('navbar')
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content">

                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg></div>
                            Customers
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">

                        <a class="btn  btn-primary text-white text-primary" href="{{route('addCustomer')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-user-plus me-1">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                            Add Customer
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid px-4">


        <div class="card mb-4">
            <div class="card-header">Preview</div>
            <div class="card-body p-0">
                <!-- Billing history table-->
                <div class="table-responsive ">
                    <table class="table mb-0">
                        <thead>
                            <tr>

                                <th class="border-gray-200" scope="col">Name</th>
                                <th class="border-gray-200" scope="col">Email</th>
                                <th class="border-gray-200" scope="col">Phone</th>
                                <th class="border-gray-200" scope="col">DOB</th>
                                <th class="border-gray-200" scope="col">Gender</th>
                                <th class="border-gray-200" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($customers)


                            @foreach ($customers as $customer)

                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-2"><img class="avatar-img img-fluid"
                                            src="{{asset('assets/img/illustrations/profiles/profile-1.png')}}" /></div>
                                   {{$customer->name}}
                                </div>
                            </td>
                            <td>
                                {{$customer->email}}

                            </td>
                            <td>
                                {{$customer->phone}}
                            </td>

                            <td>{{$customer->dob}}</td>
                            <td>{{$customer->gender}}</td>
                            <td>
                                <form style="" action="{{route('deleteCustomer')}}" method="POST">
                                    @csrf
                                    <a onclick="getCustomer({{$customer->id}})" class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="#"><i
                                            data-feather="edit"></i></a>
                                    <input type="hidden" name="id" value="{{$customer->id}}">



                                    <button type="submit" class="btn btn-datatable btn-icon btn-transparent-dark"
                                        href="#!"><i data-feather="trash-2"></i></button>


                                </form>

                            </td>

                        @endforeach
                        @endisset
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer">
                {!! $customers->links() !!}
            </div>
        </div>

    </div>
    {{-- edit modal --}}
    <div class="modal fade" id="editGroupModal" tabindex="-1" role="dialog" aria-labelledby="editGroupModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editGroupModalLabel">Edit Customer</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
            <form action="{{route('updateCustomer')}}" method="POST">
                @csrf
                <input type="text" hidden name="id" id="id">
                    <div class="mb-0">
                        <label class="mb-1 small text-muted" for="formGroupName">Customer Name</label>
                        <input required  name="name" id="customer-name" class="form-control" name="name" type="text" value="" />
                    </div>
                    <div class="mb-0">
                        <label class="mb-1 small text-muted" for="formGroupName">Customer Email</label>
                        <input required name="email"  id="customer-email" class="form-control"  type="text" value="" />
                    </div>
                    <div class="mb-0">
                        <label class="mb-1 small text-muted" for="formGroupName">Customer Phone</label>
                        <input required name="phone"  id="customer-phone" class="form-control"  type="text" value="" />
                    </div>
                    <div class="mb-0">
                        <label class="mb-1 small text-muted" for="formGroupName">Gender</label>
                        <input required name="gender"  id="gender" class="form-control"  type="text" value="" />
                    </div>
                    <div class="mb-0">
                        <label class="mb-1 small text-muted" for="formGroupName">Date of Birth</label>
                    </div>
                    <div class=" mb-2 input-group input-group-joined">
                        <span class="input-group-text">
                            <i data-feather="calendar"></i>
                        </span>
                        <input required autocomplete=off name="dob" class="form-control ps-0"
                            id="litepickerSingleDate" placeholder="Date of Birth" />
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info-soft" type="button"
                    data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary-soft text-primary" type="submit">Save Changes</button>
            </div>
        </form>

        </div>
    </div>
   </div>
</main>

@yield('footer')
<script>
       // edit preview
       function getCustomer(id){
        // get value by id branch-id
        // ajax get
        $.ajax({
            url: '/customer/'+id,
            type: 'GET',
            dataType: 'json',
            success: function(response){
                $('#customer-name').val(response.name);
                $('#id').val(id);
                $('#customer-email').val(response.email);
                $('#customer-phone').val(response.phone);
                $('#gender').val(response.gender);
                $('#litepickerSingleDate').val(response.dob);

                $('#editGroupModal').modal('show');

            }
        });

    }
</script>
