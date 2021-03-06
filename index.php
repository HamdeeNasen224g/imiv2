<?php
date_default_timezone_set('Asia/Bangkok');
?>
<!doctype html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.0/dist/chart.min.js"></script>
    <title>Hamdee Naseng 62112073</title>
  </head>
  <body>
    <br>
    <h1 align=center>Hamdee Naseng 62112073</h1>
    <div class="container">
        <div class="row">
            <div class=" col-6">
              <canvas id="myChart" width="400" height="200"></canvas>
            </div>
            <div class="col-6">
              <canvas id="myChart1" width="400" height="200"></canvas>
            </div>
        </div>

        

        <div class="row">

        <div class="col-6">
              <canvas id="myChart2" width="400" height="200"></canvas>
          </div>

        <div class="col-6">
                <div class="row">
                  <div><h5>Last Data</h5></div>
                </div>
                <div class="row">
                    <div class="col-4">
                      <b>Tempearature</b>

                    </div>
                     <div class="col-8">
                        <b><span id="lastTempearature"></span></b>
                     </div> 
                </div>
                <div class="row">
                  <div class="col-4">
                    <b>Humadity</b>
                  </div>
                   <div class="col-8">
                      <b><span id="lastHumadity"></span></b>
                   </div> 
              </div>
              <div class="row">
                  <div class="col-4">
                    <b>Light</b>
                  </div>
                   <div class="col-8">
                      <b><span id="light"></span></b>
                   </div> 
              </div>
              <div class="row">
                <div class="col-4">
                  <b>LastUpdate</b>  
                </div>
                 <div class="col-8">
                <b><span id="lastUpdate"></span></b> 
                 </div> 
            </div>

            </div>


        </div>





    </div>

   
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script> 
  </body>
  <script>
     

      function showChart(data,xlabel,id,label){      
        var ctx = document.getElementById(id).getContext('2d');
      //  var xlabel = [1,2,3,4,5,6,7,];
      //  var data1 = [65, 59, 80, 56, 55, 40,32];
        var myChart = new Chart (ctx, {
            type: 'line',
            data: {
                labels: xlabel,
                datasets: [{
                    label: label,
                    data: data,
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1

                }]
            }
    
        });
      }
      function formatJSONDate(jsonDate) {
  var newDate = date(jsonDate, "mm/dd/yyyy");
  return newDate;
}

$(
    ()=>{
       // alert("Thank God");
       var xlabel=[];
          var data1=[];
          var data2=[];
          var data3=[];
       let url = "https://api.thingspeak.com/channels/1458412/feeds.json?results=240";
       $.getJSON(url,function( data) {
             let feeds = data.feeds;
             console.log(data);
              $("#lastTempearature").text(feeds[feeds.length-1].field2+" C");
              $("#lastHumadity").text(feeds[feeds.length-1].field1+" %");
              $("#light").text(feeds[feeds.length-1].field3);
              var date = new Date(parseInt(feeds[feeds.length-1].created_at));
              const str = new Date(parseInt(feeds[feeds.length-1].created_at)).toLocaleString('en-US', { timeZone: 'Asia/Bangkok' });
              $("#lastUpdate").text( str);
              
          for (let i=0; i < feeds.length; i++)  {
            xlabel[i] = new Date(parseInt(feeds[i].created_at)).toLocaleString('en-US', { timeZone: 'Asia/Bangkok' });
            data1[i] = feeds[i].field1;
            data2[i] = feeds[i].field2;  
            data3[i] = feeds[i].field3; 
          } 


      var id1 = 'myChart';  
     var id2 = 'myChart1';
     var id3 = 'myChart2';
     var label1 = 'Humadity';
     var label2 = 'Tempearature';
     var label3 = 'Light';
      showChart(data1,xlabel,id1,label1);
      showChart(data2,xlabel,id2,label2); 
      showChart(data3,xlabel,id3,label3); 
      });     
      console.log(xlabel);    
      console.log(data1);
      console.log(data2);
      })     
  </script>
</html>
