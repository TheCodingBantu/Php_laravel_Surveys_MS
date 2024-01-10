@section('footer')

    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script>
    <!-- bootstrap 5 cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('js/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
    <script src="{{ asset('js/lite-bundle.js') }}"></script>
    <script src="{{ asset('js/litepicker.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script src="{{asset('js/charts/sentimentLineChart.js')}}"></script>
    </body>

    </html>

    @if (session('success'))
    <script>
        // toastr
        toastr.success("{{ session('success') }}");
    </script>
    @endif
    @if (session('error'))
    <script>
        // toastr
        toastr.error("{{ session('error') }}");
    </script>
    @endif
    <script>
        function markAsRead()
        {
            $.ajax({
                url: "{{route('markAsRead')}}",
                type: 'get',
                data: {
                    _token: "{{ csrf_token() }}",

                },
                success: function(response) {
                //    console.log(response);
                }
            });
        }
    </script>
@stop
