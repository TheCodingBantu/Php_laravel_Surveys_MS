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
                            <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-users">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg></div>
                            Branches List
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">

                        <button class="btn btn-sm btn-light text-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#createGroupModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-plus me-1">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Create New Branch
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid px-4">
        <div class="card">
            <div class="card-body">
                <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">

                    <table id="datatablesSimple" class="">
                        <thead>
                            <tr>
                                <th data-sortable="true" style="width: 25.8610624635143%;"><a href="#"
                                        class="datatable-sorter">Branch Name</a></th>
                                <th data-sortable="true" style="width: 29.889083479276124%;"><a href="#"
                                        class="datatable-sorter">Branch Code</a></th>
                                <th data-sortable="true" style="width: 27.028604786923527%;"><a href="#"
                                        class="datatable-sorter">Created Date</a></th>
                                <th data-sortable="true" style="width: 17.221249270286048%;"><a href="#"
                                        class="datatable-sorter">Actions</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($branches as $branch)

                            <tr data-index="0">
                                <td>{{$branch->branch_name}}</td>
                                <td>{{$branch->branch_code}}</td>
                                <td>{{$branch->created_at}}</td>
                                <td>
                                    <button onclick="editBranch({{$branch->id}})" class="btn btn-datatable btn-icon btn-transparent-dark me-2" type="button"
                                        data-bs-toggle="modal" data-bs-target="#editGroupModal"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                            </path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                            </path>
                                        </svg></button>
                                        <input type="hidden" name="id" value="{{$branch->id}}">

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- Create group modal-->
    <div class="modal fade" id="createGroupModal" tabindex="-1" role="dialog"
        aria-labelledby="createGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createGroupModalLabel">Create New Branch</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('add-branch')}}" method="POST">
                        @csrf
                        <div class="mb-0">
                            <label class="mb-1 small text-muted" for="formGroupName">Branch Name</label>
                            <input name="name" class="form-control" id="formGroupName" type="text"
                                placeholder="Enter Branch name..." />

                        </div>
                        <div class="mb-0">
                            <label class="mb-1 small text-muted" for="formGroupName">Branch Code</label>
                            <input name="code" class="form-control" id="formGroupName" type="text"
                                placeholder="Enter Branch Code..." />

                        </div>
                        <div class="modal-footer" style="border:none">
                            <button class="btn btn-danger-soft text-danger" type="button"
                                data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary-soft text-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Edit group modal-->
    <div class="modal fade" id="editGroupModal" tabindex="-1" role="dialog" aria-labelledby="editGroupModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGroupModalLabel">Edit Branch</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('edit-branch')}}" method="POST">
                    @csrf
                <div class="modal-body">

                        <div class="mb-0">
                            <label class="mb-1 small text-muted" for="formGroupName">Branch Name</label>
                            <input id="branch-name" class="form-control" name="name" type="text"
                                placeholder="Enter Branch name..." value="" />
                                <input type="hidden" name="id" value="" id="branch-id">
                        </div>
                        <div class="mb-0">
                            <label class="mb-1 small text-muted" for="formGroupName">Branch Code</label>
                            <input id="branch-code" class="form-control" name="code" type="text"
                                placeholder="Enter Branch code..." value="" />

                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger-soft text-danger" type="button"
                        data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary-soft text-primary" type="submit">Save Changes</button>
                </div>
            </form>

            </div>
        </div>
    </div>
</main>

@yield('footer')
<script>
    function editBranch(id){
        // get value by id branch-id

        document.getElementById('branch-id').value = id;
        // ajax get
        $.ajax({
            url: '/getBranch'+id,
            type: 'GET',
            dataType: 'json',
            success: function(response){
                console.log(response);
                // branch-id value
                // set value to input
                $('#branch-name').val(response.branch_name);
                $('#branch-code').val(response.branch_code);

            }
        });

    }
</script>
