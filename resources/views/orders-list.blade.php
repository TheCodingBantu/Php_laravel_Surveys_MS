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
                            Orders
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">

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

                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th data-sortable="true"><a href="#">Order #</a></th>
                                <th data-sortable="true"><a href="#">Date</a></th>
                                <th data-sortable="true"><a href="#">Collection Branch</a></th>
                                <th data-sortable="true"><a href="#">Status</a></th>
                                <th data-sortable="true"><a href="#">Update Status</a></th>
                                <th data-sortable="true"><a href="#">Action</a></th>


                            </tr>
                        </thead>
                        <tbody>
                            @if (count($orders)>0)

                            @foreach ($orders as $order)

                            <tr >
                                <td>{{$order->user->name}}</td>
                                <td>{{$order->created_at}}</td>
                                <td>{{$order->branch->branch_name}}</td>
                                <td>
                                    @foreach ($steps as $key => $value)
                                    @if ($key==$order->status)
                                        {{$value}}
                                    @endif
                                    @endforeach
                                </td>

                                <td>
                                    <select id="{{'select_'.$order->id}}" @if ($order->status == count($steps)-1)
                                        disabled
                                    @endif name="" id="statusUpdater">
                                        @foreach ($steps as $key => $value)
                                        
                                   
                                            @if($order->status == $key)
                                            @if ($key < count($steps)-1)
                                                <option value="{{$key}}"> {{$value}}</option>
                                                <option value="{{$key+1}}"> {{$steps[$key+1]}}</option>
                                            @else
                                                 <option value="{{$key}}"> {{$value}}</option>
                                            @endif
                                            
                                            @endif
                                            
                                        @endforeach
                                       
                                    </select>
                                    
                                </td>
                                <td><button onclick="updateStatus({{$order->id}})" class="btn btn-success btn-sm">Update</button></td>
                            </tr>
                            @endforeach
                            @endif

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
                    <h5 class="modal-title" id="createGroupModalLabel">Start Visit</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('add-visit')}}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label class="mb-1 small text-muted" for="formGroupName">Customer Email</label>
                            <input name="email" class="form-control" id="formGroupName" type="email" required
                                placeholder="Enter Customer Email ..." />
                        </div>


                        <select name="branch" class="" id="single-select-field" data-placeholder="Choose one thing">
                            @foreach ($branches as $branch)
                                <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                            @endforeach
                        </select>

                        <div class="modal-footer" style="border:none">
                            <button class="btn btn-danger-soft text-danger" type="button"
                                data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary-soft text-primary" type="submit">Send</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</main>

@yield('footer')
<script>
    function updateStatus(id){
        let status = document.getElementById('select_'+id).value
        $.ajax({
            url: "{{ route('add-visit') }}",
            type: "POST",
            data: {
                id: id,
                status:status,
                _token: "{{ csrf_token() }}",
            },
            success: function(response) {
                
                if (response.redirect) {
                    window.location.href = response.redirect;
                } else if (response.error) {

                    toastr["error"](response.error);

                } else {
                    toastr["success"](response.success);
                }
            },

            error: function(response) {
                console.log(response.error);

            },
        });
    }
</script>
