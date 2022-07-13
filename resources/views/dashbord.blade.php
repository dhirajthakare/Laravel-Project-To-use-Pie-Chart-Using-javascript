<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashbord</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   
    {{-- Chart Script link --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js" ></script> --}}
    <script src="{!! URL::asset('dist/js/chart.js') !!}"></script>
    <script src="{!! URL::asset('dist/js/chartjs-plugin-datalabels.min.js') !!}"></script>

</head>
<body>
    <div>
        <div>
            <h4  class="text-center">Admin Dashbord</h4>
        </div>
        <div class="row mt-5">
              <div class="wrapper">
                <h5 class="text-center" style="color: #a4a1a1">App Type</h5>
                <canvas id="myAppointment" ></canvas>
              </div>
              <div class="wrapper">
                <h5 class="text-center" style="color: #a4a1a1">lead Type</h5>
                <canvas id="mylead" ></canvas>
              </div>
              <div class="wrapper">
                <h5 class="text-center" style="color: #a4a1a1">switcher / Virgin</h5>
                <canvas id="switcherVirgin"></canvas>
              </div>
              <div class="wrapper">
                <h5 class="text-center" style="color: #a4a1a1">heart / Cancel</h5>
                <canvas id="heartcancel" ></canvas>
              </div>
              <div class="wrapper">
                <h5 class="text-center" style="color: #a4a1a1">re-book</h5>
                <canvas id="rebook"></canvas>
              </div>

        </div>
        </div>

    </div>

<script>


    function getCurrentdataPercentage(value,datapointsValue){
      totalValue = datapointsValue.reduce(TotalSum,0);
      percentagevalue= ((value/totalValue) * 100).toFixed(1);
      return percentagevalue+"%";
    }

    function TotalSum(total,datapointsValue){
      return total+datapointsValue;
    }
    
    var config = (xValues,yValues,barColors)=> {
          var  data = {
          type: "pie",
          data: {
            labels: xValues,
            datasets: [{
              backgroundColor: barColors,
              data: yValues
            }]
          },
          options: {
            scales: {
            },
            plugins:  {
              tooltip: {
              enabled: false
              },
              legend: {
               display: true,  // <- the important part
               position:"bottom",
              //  labels: {
              //   usePointStyle: true,
              //  },
              },
              datalabels:{
                align:"center",
                formatter:(value,context)=>{
                  // console.log(value);
                  // console.log(context);
                  // console.log(context.chart.data.datasets[0].data);
                  var datapointsValue = context.chart.data.datasets[0].data;
                 
                  return getCurrentdataPercentage(value,datapointsValue);
                }
              }
            } 
          },
          plugins: [ChartDataLabels]
        }
        return data;
        };

    function initializePieChart(){
      
    // Appointment type pie
    var xValues = ["Tel", "Video", "F2F"];
    var yValues = [125, 50, 30];
    var barColors = [
      "#f41c5e",
      "#dac6ce",
      "#a6bcb0"
    ];
    new Chart("myAppointment",config(xValues,yValues,barColors));

    // lead type pie
    var xValues = ["SME", "2 to 3", "4 to 9", "10 to 49", "50+"];
    var yValues = [55, 40, 20,10,5];
    var barColors = [
      "#f41c5e",
      "#dac6ce",
      "#a6bcb0",
      '#7ca5ba',
      '#4f738a'
    ];
    
    new Chart("mylead", config(xValues,yValues,barColors));

    // switcher / Virgin
    var xValues = ["Virgin", "switcher"];
    var yValues = [125, 50];
    var barColors = [
      "#f41c5e",
      "#dac6ce"
    ];
    
    new Chart("switcherVirgin", config(xValues,yValues,barColors));

    // heart / Cancel
    var xValues = ["Yes", "No"];
    var yValues = [50, 25];
    var barColors = [
      "#f41c5e",
      "#dac6ce"
    ];
    
    new Chart("heartcancel", config(xValues,yValues,barColors));

    // re-book
    var xValues = ["Yes", "No"];
    var yValues = [125, 25];
    var barColors = [
      "#f41c5e",
      "#dac6ce"
    ];
    new Chart("rebook", config(xValues,yValues,barColors));
    }

    initializePieChart();

</script>

</body>
</html>