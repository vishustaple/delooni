@extends('admin.layout.template')
@section('contents')
<!DOCTYPE html>
<html>
<head>
    <title>delooni.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="row">
        <form method="POST" id="get_info" class="dalooni-datepicker">
            @csrf
                <div class="row">
                <div class="col-md-5">
                <input  class="form-control datepicker" name="start_date" placeholder="YYYY/MM/DD" autocomplete="off">
                <div class="error" id="error_start_date"></div>
                </div>
                <div class="col-md-5">
                <input  class="form-control datepicker" name="end_date" placeholder="YYYY/MM/DD" autocomplete="off">
                <div class="error" id="error_end_date"></div>
                </div>
                <div class="col-md-2">
                <button class="btn yellow-bg bg-0 w-100" type="submit">Filter</button>
                </div>
                </div>
        </form>
    </div>
<!-- <h3 class="mb-4">Graphic Chart Of Users</h3> -->
<div id="graph_info_box">
<div class="row g-4 info">
<a href="{{route('customer')}}" class="dashboard-link">
    <div class="col-md-6">
      <div class="card bg-white">
          <div class="card-header yellow-bg row mx-0">
          <span class="info-box-text col-8 p-0">Total Customer</span>
                <span class="info-box-number col-4 p-0"> 
                {{ $total_customer }}</span> 
           </div>
        <div class="card-body bg-white">
         <div id="container"></div>
       </div>
      </div>
      </a>
      </div>

     
   
      <div class="col-md-6">
      <a href="{{route('viewserviceprovider')}}" class="dashboard-link">
      <div class="card bg-white">
      <div class="card-header yellow-bg row mx-0">
      <span class="info-box-text col-8 p-0">Total Individual Service Provider</span>
                <span class="info-box-number col-4 p-0"> 
                {{ $total_individual }}</span> 
      </div>
      <div class="card-body bg-white">
       <div id="container1"></div>
       </div>
      </div>                
      </a>
      </div>


      <div class="col-md-6">
      <a href="{{url('/company')}}" class="dashboard-link">
      <div class="card bg-white">
      <div class="card-header yellow-bg row mx-0">
      <span class="info-box-text col-8 p-0">Total Company Service Provider</span>
                <span class="info-box-number col-4 p-0"> 
                {{ $total_company }}</span> 
      </div>
      <div class="card-body bg-white">
         <div id="container2"></div>
       </div>
      </div>
      </a>
      </div>

      <div class="col-md-6">
      <a href="{{url('/admin/query')}}" class="dashboard-link">
      <div class="card bg-white">
      <div class="card-header yellow-bg row mx-0">
      <span class="info-box-text col-8 p-0">Total Query</span>
                <span class="info-box-number col-4 p-0"> 
                {{ $total_query }}</span> 
      </div>
      <div class="card-body bg-white">
         <div id="container3"></div>
       </div>
      </div>
      </a>
      </div>
</div>
</body>

<script type="text/javascript">
    var users =  <?php echo json_encode($customer) ?>;
   
    Highcharts.chart('container', {
       
        title: {
            text: 'Customer'
           },
        subtitle: {
            text: ''
        },
         xAxis: {
            categories: ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec','Jan', 'Feb', 'Mar','Apr'],
            
        },
        yAxis: {
            title: {
                text: 'Number of New Customer',
                height:"200px",
            },

        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
          
        },
        plotOptions: {
            series: {
                allowPointSelect: true,
                color:"#edc35d",
            }
        },
        series: [{
            name: 'New Customer',
            data: users
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 50
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        },

        chart: {
            height:200,
        }
});

var users =  <?php echo json_encode($individual_serviceprovider) ?>;
   
    Highcharts.chart('container1', {
        title: {
            text: 'Individual Service Provider'
        },
        subtitle: {
            text: ''
        },
         xAxis: {
            categories: ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec','Jan', 'Feb', 'Mar','Apr'],
            backgroundColor:'red',
            
        },
        yAxis: {
            title: {
                text: 'Number of New Service Provider'
            },

            backgroundColor:'red',
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
          
        },
        plotOptions: {
            series: {
                allowPointSelect: true,
                color:"#edc35d",
            }
        },
        series: [{
            name: 'New Service Provider',
            data: users
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 50
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        },

        chart: {
            height:200,
        }
});

var users =  <?php echo json_encode($company_serviceprovider) ?>;
   
    Highcharts.chart('container2', {
        title: {
            text: 'Service Provider with company'
        },
        subtitle: {
            text: ''
        },
         xAxis: {
            categories: ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec','Jan', 'Feb', 'Mar','Apr'],
            backgroundColor:'red',
            
        },
        yAxis: {
            title: {
                text: 'Number of New Service Provider'
            },

            backgroundColor:'red',
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
          
        },
        plotOptions: {
            series: {
                allowPointSelect: true,
                color:"#edc35d",
            }
        },
        series: [{
            name: 'New Service Provider',
            data: users
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 50
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        },

        chart: {
            height:200,
        }
});

var users =  <?php echo json_encode($query) ?>;
   
    Highcharts.chart('container3', {
        title: {
            text: 'Queries'
        },
        subtitle: {
            text: ''
        },
         xAxis: {
            categories: ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec','Jan', 'Feb', 'Mar','Apr'],
            backgroundColor:'red',
            
        },
        yAxis: {
            title: {
                text: 'Number of Query'
            },

            backgroundColor:'red',
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
          
        },
        plotOptions: {
            series: {
                allowPointSelect: true,
                color:"#edc35d",
            }
        },
        series: [{
            name: 'New Query',
            data: users
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 50
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        },

        chart: {
            height:200,
        }
});

//get data on date range

$(document).on("submit", "#get_info", function(e){

  e.preventDefault();
  var formData = new FormData(this);
   $.ajax({
   type:'post',
   url:"{{route('dashboarddaterange')}}",
   cache: false,
   contentType: false,
   processData: false,
   data :formData,
   headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   },
   success:function(data){
    $('.error').html(''); 

    // var successHtml = $($.parseHTML(data)).find("#graph_info_box").html();
    $('div#graph_info_box').html(data);
//    $('#graph_info_box').html(data);
    // $('#page-loader').hide();
   },
   error:function(data){ 
    $('.error').html(''); 
    $.each(data.responseJSON.errors, function(id,msg){
    $('#get_info #error_'+id).html(msg);
})
}
});
});
$( function() {
    $( ".datepicker" ).datepicker({
      format:'yy-mm-dd',
      todayHighlight: true,
      endDate: "today",
    });
  } );
</script>

</html>
@endsection