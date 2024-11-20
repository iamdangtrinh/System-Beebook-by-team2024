<div class="footer">
    <div class="pull-right">
        10GB of <strong>250GB</strong> Free.
    </div>
    <div>
        <strong>Copyright</strong> Example Company &copy; 2014-2017
    </div>
</div>

<!-- Mainly scripts -->
<script src="{{ asset('/') }}backend/js/jquery-3.1.1.min.js"></script>
<script src="{{ asset('/') }}backend/js/bootstrap.min.js"></script>
<script src="{{ asset('/') }}backend/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="{{ asset('/') }}backend/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Flot -->
<script src="{{ asset('/') }}backend/js/plugins/flot/jquery.flot.js"></script>
<script src="{{ asset('/') }}backend/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="{{ asset('/') }}backend/js/plugins/flot/jquery.flot.spline.js"></script>
<script src="{{ asset('/') }}backend/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="{{ asset('/') }}backend/js/plugins/flot/jquery.flot.pie.js"></script>
<script src="{{ asset('/') }}backend/js/plugins/flot/jquery.flot.symbol.js"></script>
<script src="{{ asset('/') }}backend/js/plugins/flot/curvedLines.js"></script>

<!-- Peity -->
<script src="{{ asset('/') }}backend/js/plugins/peity/jquery.peity.min.js"></script>
<script src="{{ asset('/') }}backend/js/demo/peity-demo.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('/') }}backend/js/inspinia.js"></script>
<script src="{{ asset('/') }}backend/js/plugins/pace/pace.min.js"></script>

<!-- jQuery UI -->
<script src="{{ asset('/') }}backend/js/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- Jvectormap -->
<script src="{{ asset('/') }}backend/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="{{ asset('/') }}backend/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<!-- Sparkline -->
<script src="{{ asset('/') }}backend/js/plugins/sparkline/jquery.sparkline.min.js"></script>

<!-- Sparkline demo data  -->
<script src="{{ asset('/') }}backend/js/demo/sparkline-demo.js"></script>

<!-- ChartJS-->
<script src="{{ asset('/') }}backend/js/plugins/chartJs/Chart.min.js"></script>

<script>
    $(document).ready(function() {

        var lineData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                    label: "Example dataset",
                    backgroundColor: "rgba(26,179,148,0.5)",
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data: [28, 48, 40, 19, 86, 27, 90]
                },
                {
                    label: "Example dataset",
                    backgroundColor: "rgba(220,220,220,0.5)",
                    borderColor: "rgba(220,220,220,1)",
                    pointBackgroundColor: "rgba(220,220,220,1)",
                    pointBorderColor: "#fff",
                    data: [65, 59, 80, 81, 56, 55, 40]
                }
            ]
        };

        var lineOptions = {
            responsive: true
        };


        var ctx = document.getElementById("lineChart").getContext("2d");
        new Chart(ctx, {
            type: 'line',
            data: lineData,
            options: lineOptions
        });

    });
</script>
</body>

</html>
