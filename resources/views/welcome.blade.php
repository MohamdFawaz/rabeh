<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BootstrapDash Comingsoon Template</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/bd-coming-soon.css')}}">
</head>

<body class="min-vh-100 d-flex flex-column">
<main class="my-auto">
    <div class="container">
        <div class="row">
            <div class="col-md-6 section-left">
                <h1 class="page-title">Rabe7 is launching soon</h1>
                <div id="timer" class="bd-cd-timer">
                    <div class="time-card">
                        <span class="time-count" id="days"></span>
                        <span class="time-label">DAYS</span>
                    </div>
                    <div class="time-card">
                        <span class="time-count" id="hours"></span>
                        <span class="time-label">HOURS</span>
                    </div>
                    <div class="time-card">
                        <span class="time-count" id="minutes"></span>
                        <span class="time-label">MINUTES</span>
                    </div>
                    <div class="time-card">
                        <span class="time-count" id="seconds"></span>
                        <span class="time-label">SECONDS</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-none d-md-flex align-items-center">
                <img src="{{asset('assets/images/coming-soon.png')}}" alt="coming soon" class="img-fluid">
            </div>
        </div>
    </div>
</main>

<footer class="text-center"> 
</footer>

<script src="{{asset('assets/js/bd-timer.js')}}"></script>
</body>

</html>
