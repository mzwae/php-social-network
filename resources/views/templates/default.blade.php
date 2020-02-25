<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Social Website</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <style media="screen">
        #status {
            position: fixed;
            width: 100%;
            font: bold 1em sans-serif;
            color: #FFF;
            padding: 0.5em;
        }

        #log {
            padding: 2.5em 0.5em 0.5em;
            font: 1em sans-serif;
        }

        .online {
            background: green;
        }

        .offline {
            background: red;
        }
    </style>
</head>

<body>

    @include('templates.partials.navigation')
    <div id="status"></div>
    <div id="log"></div>
    <div class="container">
        @include('templates.partials.alerts')
        @yield('content')
    </div>
</body>
<script type="text/javascript">
    window.addEventListener('load', function() {
        var status = document.getElementById("status");
        var log = document.getElementById("log");

        function updateOnlineStatus(event) {
            var condition = navigator.onLine ? "alert alert-success" : "alert alert-danger";
            var alert = navigator.onLine ? "Back Online" : "Offline";

            status.className = condition;
            status.innerHTML = alert;

            // log.insertAdjacentHTML("beforeend", "Event: " + event.type + "; Status: " + condition);
        }

        window.addEventListener('online', updateOnlineStatus);
        window.addEventListener('offline', updateOnlineStatus);
    });
</script>

</html>
