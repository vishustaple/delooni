@extends('admin.layout.template')
@section('contents')
<!DOCTYPE html>
<html>
<head>
    <title>delooni.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<!-- <h3 class="mb-4">Graphic Chart Of Users</h3> -->
<div class="row g-4">
    <div class="col-md-6">
           <div class="mb-4">
           <span class="info-box-text">Total Customer</span>
                <span class="info-box-number"> 
                {{ $total_customer }}</span> 
           </div>
      <div class="card">
        <div class="card-body">
         <div id="container"></div>
       </div>
      </div>
      </div>
   
      <div class="col-md-6">
      <div class="mb-4">
      <span class="info-box-text">Total Individual Service Provider</span>
                <span class="info-box-number"> 
                {{ $total_individual }}</span> 
      </div>
      <div class="card">
        <div class="card-body">
         <div id="container1"></div>
       </div>
      </div>
      </div>
      <div class="col-md-6">
      <div class="mb-4">
      <span class="info-box-text">Total Company Service Provider</span>
                <span class="info-box-number"> 
                {{ $total_company }}</span> 
      </div>
      <div class="card">
        <div class="card-body">
         <div id="container2"></div>
       </div>
      </div>
      </div>
      <div class="col-md-6">
      <div class="mb-4">
      <span class="info-box-text">Total Query</span>
                <span class="info-box-number"> 
                {{ $total_query }}</span> 
      </div>
      <div class="card">
        <div class="card-body">
         <div id="container3"></div>
       </div>
      </div>
      </div>
</div>
</body>

<script src="https://code.highcharts.com/highcharts.js"></script>
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
            categories: ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec','Jan', 'Feb', 'Mar'],
            
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
        }
});

var users =  <?php echo json_encode($individual_serviceprovider) ?>;
   
    Highcharts.chart('container1', {
        width: 200,
        title: {
            text: 'Individual Service Provider'
        },
        subtitle: {
            text: ''
        },
         xAxis: {
            categories: ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec','Jan', 'Feb','Mar'],
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
        }
});

var users =  <?php echo json_encode($company_serviceprovider) ?>;
   
    Highcharts.chart('container2', {
        width: 200,
        title: {
            text: 'Service Provider with company'
        },
        subtitle: {
            text: ''
        },
         xAxis: {
            categories: ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec','Jan', 'Feb','Mar'],
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
        }
});

var users =  <?php echo json_encode($query) ?>;
   
    Highcharts.chart('container3', {
        width: 200,
        title: {
            text: 'Queries'
        },
        subtitle: {
            text: ''
        },
         xAxis: {
            categories: ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec','Jan', 'Feb','Mar'],
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
        }
});
</script>
</html>
@endsection