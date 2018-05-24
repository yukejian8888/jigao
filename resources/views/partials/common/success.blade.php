@if(Session::has('flash_message'))
    <script type="text/javascript">
        $.notify({
            'message'   :'{{ session('flash_message') }}',
            'status'  :'info',
            'timeout'  :'2200',
        });
    </script>
@endif