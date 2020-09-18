<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <form id='form' method="post" action="{{ route('randoms.laravel') }}">
                @csrf
                {{ "Name:" }} <input id='total' type="text" name="total" value="">
                <input id='lalala' type="submit" name="submit" value="Submit">
                <br><br><br>
                <label id="minutes">00</label> {{ " : " }} <label id="seconds">00</label>
            </form>
        </div>
    </body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        var getCount = 0;

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#form').submit(function(e) {
            var txt = document.getElementById('total').value;
            if(txt != null){
                var minutesLabel = document.getElementById("minutes");
                var secondsLabel = document.getElementById("seconds");
                var totalSeconds = 0;
                var myVar = setInterval(setTime, 1000);

                function setTime() {
                    ++totalSeconds;
                    secondsLabel.innerHTML = pad(totalSeconds % 60);
                    minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
                }

                function pad(val) {
                    var valString = val + "";
                    if (valString.length < 2) {
                        return "0" + valString;
                    } else {
                        return valString;
                    }
                }
                e.preventDefault();
                $.ajax({
                    url: "{{ route('randoms.laravel') }}",
                    type: 'POST',
                    data: {counts: txt},
                    success: function (status) {
                        console.log(status);
                        clearInterval(myVar);
                    },
                    error: function(jqXHR, exception){
                        console.log(exception);
                        console.log(txt);
                        alert('Please request again.');
                    }
                });
            }else{
                console.log("it kinda work?");
                e.preventDefault();
            }
        });
    });

</script>
