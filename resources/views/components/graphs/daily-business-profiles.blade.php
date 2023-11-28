


<div class="row">
   
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Daily Registered Business Profiles</h5>
                <div id="userchart" style="min-height: 365px;"></div>
            </div>
        </div>
    </div>
   
</div>



<script>
        document.addEventListener("DOMContentLoaded", function () {
            var options = {
                chart: {
                    type: 'line',
                    height: 300, 
                },
                series: [{
                    name: 'Daily Registered Users',
                    data: @json($counts),
                }],
                xaxis: {
                    categories: @json($dates),
                },
            };

            var chart = new ApexCharts(document.querySelector("#userchart"), options);
            chart.render();
        });
    </script>

