<!-- plugins:js -->
<script src={{ asset("vendors/js/vendor.bundle.base.js") }}></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src={{ asset("vendors/chart.js/Chart.min.js") }}></script>
<script src={{ asset("vendors/datatables.net/jquery.dataTables.js") }}></script>
<script src={{ asset("vendors/datatables.net-bs4/dataTables.bootstrap4.js") }}></script>
<script src={{ asset("js/dataTables.select.min.js") }}></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src={{ asset("js/off-canvas.js") }}></script>
<script src={{ asset("js/hoverable-collapse.js") }}></script>
<script src={{ asset("js/template.js") }}></script>
<script src={{ asset("js/settings.js") }}></script>
<script src={{ asset("js/todolist.js") }}></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src={{ asset("js/file-upload.js") }}></script>
<script src={{ asset("js/dashboard.js") }}></script>
<script src={{ asset("js/Chart.roundedBarCharts.js") }}></script>
{{-- Bootstrap js --}}
{{-- <script src={{ asset("js/bootstrap.min.js") }}></script> --}}
<!-- End custom js for this page-->
<script type="text/javascript">
    $(function () {
        $(".alert").delay(5000).slideUp(300);
    });
</script>
<script>
    $(document).ready(function(){
        setInterval('updateClock()', 1000);
        getTodayDate();
    });
  
    function getTodayDate(){
        const monthNames = ["Jan", "Feb", "March", "April", "May", "June",
            "July", "August", "Sept", "Oct", "Nov", "Dec"
        ];
        const d = new Date();
        const date = d.getDate() + " " +monthNames[d.getMonth()] + ', '+ d.getFullYear()+ ' ';
        $("#date").html(date);
    }
  
    function updateClock (){
        var currentTime = new Date ( );
        var currentHours = currentTime.getHours ( );
        var currentMinutes = currentTime.getMinutes ( );
        var currentSeconds = currentTime.getSeconds ( );
  
        // Pad the minutes and seconds with leading zeros, if required
        currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
        currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
  
        // Choose either "AM" or "PM" as appropriate
        var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";
  
        // Convert the hours component to 12-hour format if needed
        currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;
  
        // Convert an hours component of "0" to "12"
        currentHours = ( currentHours == 0 ) ? 12 : currentHours;
  
        // Compose the string for display
        var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
  
  
        $("#clock").html(currentTimeString);
    }
  </script>
@section('jscripts')
    @show