

@if(session()->has('notify'))
    @foreach(session('notify') as $msg)
        <script>
            "use strict";
            iziToast.{{ $msg[0] }}({message:"{{ $msg[1] }}", position: "bottomRight"});
        </script>
    @endforeach
@endif

@if ($errors->any())
    <script>
        "use strict";
        @foreach ($errors->all() as $error)
        iziToast.error({
            message: $error,
            position: "bottomRight"
        });
        @endforeach
    </script>

@endif
<script>
    "use strict";
    function notify(status, message) {
        if(typeof message == 'string'){
            iziToast[status]({
                message: message,
                position: "bottomRight"
            });
        }else{
            $.each(message, function(i, val) {
                iziToast[status]({
                    message: val,
                    position: "bottomRight"
                });
            });
        }

    }

    function notifyOne(status, message) {
        iziToast[status]({
            message: message,
            position: "bottomRight"
        });
    }
</script>

