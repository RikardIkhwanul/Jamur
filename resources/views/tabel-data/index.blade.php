<!DOCTYPE html>
<html  >
<head>
  <!-- Site made with Mobirise Website Builder v4.12.4, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.12.4, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/logo2.png" type="image/x-icon">
  <meta name="description" content="Web Site Maker Description">
  
  
  <title>tabel</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/facebook-plugin/style.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/animatecss/animate.min.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  <!-- <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.css"> -->
  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">

  
  
</head>
<body>
  <section class="menu cid-sqfvbgIVf6" once="menu" id="menu1-6">

    

    <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center collapsed">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div class="menu-logo">
            <div class="navbar-brand">
                
                <span class="navbar-caption-wrap"><a class="navbar-caption text-white display-4" href="{{url('/')}}">Smart Garden</a></span>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true"><li class="nav-item">
                    <a class="nav-link link text-white display-4" href="{{url('/')}}">Informasi</a>
                </li><li class="nav-item"><a class="nav-link link text-white display-4" href="{{url('foto')}}">Foto</a></li>
                <li class="nav-item">
                    <a class="nav-link link text-white display-4" href="{{url('tabel-data')}}">Tabel Data</a>
                </li></ul>
            
        </div>
    </nav>
</section>

<section class="engine"><a href="https://mobirise.info/t">amp template</a></section><section class="progress-bars3 cid-sqfvBHbZRx" id="progress-bars3-1" style="padding-bottom: 0%;">

        <h2 class="mbr-section-title pb-3 align-center mbr-fonts-style display-2">Informasi kubung</h2>            
        
</section>

<section class="engine"><a href="https://mobirise.info/t">amp template</a></section><section class="display" id="table_idS">

    
    <div class="container">
    <table id="table_id" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Temperatur (&#176;C)</th>
                <th class="text-center">Kelembaban (%)</th>
                <th class="text-center">Updated</th>
            </tr>
        </thead>
    </table>
    </div>

</section>



    <script src="assets/web/assets/jquery/jquery.min.js"></script>
    <script src="assets/popper/popper.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5"></script>
    <script src="https://apis.google.com/js/plusone.js"></script>
    <script src="assets/facebook-plugin/facebook-script.js"></script>
    <script src="assets/tether/tether.min.js"></script>
    <script src="assets/smoothscroll/smooth-scroll.js"></script>
    <script src="assets/dropdown/js/nav-dropdown.js"></script>
    <script src="assets/dropdown/js/navbar-dropdown.js"></script>
    <script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
    <script src="assets/viewportchecker/jquery.viewportchecker.js"></script>
    <script src="assets/parallax/jarallax.min.js"></script>
    <script src="assets/theme/js/script.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.24/dataRender/datetime.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.12/sorting/datetime-moment.js"></script>
    <!-- <script src="assets/DataTables/datatables.js"></script> -->

  
    <script>
        $(document).ready( function () {
            

            $('#table_id').DataTable({
                ajax: {
                    url: "/statistik/"
                },
                columns : [
                    {data: 'id', class:'text-center'},
                    {data: 'temperatur', class:'text-center'},
                    {data: 'kelembaban', class:'text-center'},
                    {data: 'updated_at', class:'text-center'}
                ],
                
                stateSave: true,
                deferRender: true,
                pageLength: 10,
                aLengthMenu: [[10,20,50,100,-1], [10,20,50,100,"All"]]
            });
            
            $.fn.dataTable.moment('DD-MMM-Y HH:mm:ss');
        });
    </script>

    <input name="animation" type="hidden">
    </body>
</html>