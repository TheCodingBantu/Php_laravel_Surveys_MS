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
                            Feedback List
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">

                        <a href="{{route('export-csv')}}" class="btn btn-sm btn-light text-primary" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-plus me-1">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Export as CSV
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid px-4">
        <div class="card">
            <div class="card-body">
                <div class="datatable-wrapper datatable-loading no-footer sortable searchable ">

                    <table id="datatablesSimple" class="">
                        <thead>
                            <tr>
                                <th data-sortable="true" ><a href="#"
                                        class="datatable-sorter">Customer Email</a></th>
                                <th data-sortable="true" ><a href="#"
                                        class="datatable-sorter">Branch Visited</a></th>
                                <th data-sortable="true" ><a href="#"
                                        class="datatable-sorter">Rating</a></th>
                                <th data-sortable="true" ><a href="#"
                                        class="datatable-sorter">Status</a></th>
                                <th data-sortable="true" ><a href="#"
                                        class="datatable-sorter">Date</a></th>
                                <th data-sortable="true" ><a href="#"
                                        class="datatable-sorter">Action</a></th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feedback as $record)

                            <tr data-index="0">
                                <td>{{$record->customer->email}}</td>
                                <td>{{$record->branch->branch_name}}</td>
                                <td>{{$record->rating}}</td>
                                <td>{{$record->status}}</td>
                                <td>{{$record->updated_at}}</td>
                                <td>
                                    {{-- <form style="" action="{{route('delete-department')}}" method="POST">
                                        @csrf --}}
                                    <button onclick="viewFeedback({{$record->id}})" class="btn btn-datatable btn-icon btn-transparent-dark me-2" type="button"
                                        data-bs-toggle="modal" data-bs-target=""><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                            </path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                            </path>
                                        </svg></button>

                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>

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
             <h5 class="modal-title" id="editGroupModalLabel">View Feedback</h5>
             <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>

         <div class="modal-body">

                 <div class="mb-0">
                     <label class="mb-1 small text-muted" for="formGroupName">Customer Name</label>
                     <input readonly id="customer-name" class="form-control" name="name" type="text" value="" />
                 </div>
                 <div class="mb-0">
                     <label class="mb-1 small text-muted" for="formGroupName">Customer Email</label>
                     <input readonly id="customer-email" class="form-control"  type="text" value="" />
                 </div>
                 <div class="mb-0">
                     <label class="mb-1 small text-muted" for="formGroupName">Branch Visited</label>
                     <input readonly id="branch-name" class="form-control"  type="text" value="" />
                 </div>
                 <div class="mb-0">
                     <label class="mb-1 small text-muted" for="formGroupName">Rating</label>
                     <input readonly id="rating" class="form-control"  type="text" value="" />
                 </div>
                 <div class="mb-0">
                     <label class="mb-1 small text-muted" for="formGroupName">How Likely to Recommend</label>
                     <input readonly id="recommendations" class="form-control"  type="text" value="" />
                 </div>
                 <div class="mb-0">
                     <label class="mb-1 small text-muted" for="formGroupName">Comments</label>
                     <textarea readonly name="" id="comments" class="form-control"  cols="10" rows="10"></textarea>
                 </div>
         </div>
         <div class="modal-footer">
             {{-- <button class="btn btn-info-soft" type="button"
                 data-bs-dismiss="modal">Close</button> --}}
             {{-- <button class="btn btn-primary-soft text-primary" type="submit">Save Changes</button> --}}
         </div>

     </div>
 </div>
</div>

</main>

@yield('footer')

<script>
    function viewFeedback(id){
        // get value by id branch-id

        // ajax get
        $.ajax({
            url: '/getFeedback'+id,
            type: 'GET',
            dataType: 'json',
            success: function(response){
                $('#customer-name').val(response[0].customer.name);
                $('#customer-email').val(response[0].customer.email);
                $('#branch-name').val(response[0].branch.branch_name);
                $('#rating').val(response[0].rating);
                $('#recommendations').val(response[0].recommendation);
                $('#comments').val(response[0].comments);
                $('#editGroupModal').modal('show');

            }
        });

    }
</script>
