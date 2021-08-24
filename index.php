
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
    <h1>Hamdee Naseng 62112073</h1>
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
              <div class="col-3">
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
      
    function loaddata(plot_data,url){
          var xlabel=[];
          var data1=[];
          var data2=[];

        $.getJSON(url,function( data) {
             let feeds = data.feeds;
              $("#lastTempearature").text(feeds[0].field2+" C");
              $("#lastHumadity").text(feeds[0].field1+" %");
              $("#lastUpdate").text(feeds[0].created_at);
              
        $.each(feeds, (k, v)=>{
              xlabel.push(k+1);
              data1.push(v.field1);
              data2.push(v.field2);
        });
        });  
      
        plot_data.xlabel = xlabel;
        plot_data.data = data1;
        plot_data.data1 = data2; 
        console.log(plot_data);
  }

  function showChart(plot_data,id,label){      
        var ctx = document.getElementById(id).getContext('2d');
        if(label == 'Humadity'){
         var data = plot_data.data;
        } else if(label == 'Tempearature'){
          var data = plot_data.data1;
        }  
        var xlabel =  plot_data.xlabel;    
        var myChart = new Chart (ctx, {
            type: 'line',
            data: {
                labels: xlabel,
                datasets: [{
                    label: label,
                    data: data

                }]
            }
    
        });
  }
     

$(
    ()=>{
       // alert("Thank God");
          var plot_data = Object();
         
          var id1 = 'myChart';  
          var id2 = 'myChart1';
          var label1 = 'Humadity';
          var label2 = 'Tempearature';
          let url = "https://api.thingspeak.com/channels/1458412/feeds.json?results=50";
       
      loaddata(plot_data,url);

      
      
      showChart(plot_data,id1,label1);
      showChart(plot_data,id2,label2); 
      })     
  </script>
</html>
