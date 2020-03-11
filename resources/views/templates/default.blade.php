<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>SocialWeb :)</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

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
