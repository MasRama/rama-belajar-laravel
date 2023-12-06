@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        
        <!-- /.row -->
        <!-- Main row -->
        
          <!-- Left col -->
          
           
           
            <!-- Main content -->
            <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3> {{ $totalProducts }} </h3>

                <p>Jumlah Semua Produk</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3> {{$totalCategories}} </h3>

                <p>Jumlah Kategori Produk</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3> Rp. {{ number_format($totalPrice, 0, ',', '.') }} </h3>

                <p>Jumlah Total Harga Semua Produk</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3> {{$totalStock}} </h3>

                <p>Jumlah Stok Semua Produk</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-6 connectedSortable">
            <div id="jumlah-per-kategori"></div>
            <br>
            <div id="harga-per-kategori"></div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-6 connectedSortable">

            <div id="stock-per-kategori"></div>

            
            <!-- solid sales graph -->
           
            <!-- /.card -->

           
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
              
           
          
         
          <section class="col-lg-5 connectedSortable">

            <!-- Main content -->
        
        
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


<script src="{{ asset('Highcharts-11.2.0/code/highcharts.src.js') }}"></script>

<script type="text/javascript">
    let categori = []
    let jumlahProdukPerKat = []
    let totalHargaPerKat = []
    let totalStockPerKat = []

    @foreach($allCategory as $category)
        categori.push("{{ $category->category_name }}")
        jumlahProdukPerKat.push(parseInt("{{ $category->count }}"))
        totalHargaPerKat.push(parseInt("{{ $category->total }}"))
        totalStockPerKat.push({name: "{{ $category->category_name }}", y: parseInt("{{ $category->totalStock }}")})
    @endforeach

    console.log(totalStockPerKat)

    Highcharts.chart("jumlah-per-kategori", {
        chart: {
            type: "column",
        },
        title: {
            text: "Jumlah Produk Per Kategori",
            align: "left",
        },
        xAxis: {
            categories: categori,
            crosshair: true,
            accessibility: {
                description: "Countries",
            },
        },
        yAxis: {
            min: 0,
            title: {
                text: "Fatqan Rama Databases",
            },
        },
        tooltip: {
            valueSuffix: " (PCS)",
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
            },
        },
        series: [
            {
                name: "Jumlah Produk",
                data: jumlahProdukPerKat,
            },
        ],
    });
    
    Highcharts.chart("harga-per-kategori", {
        chart: {
            type: "column",
        },
        title: {
            text: "Total Harga Produk Per Kategori",
            align: "left",
        },
        xAxis: {
            categories: categori,
            crosshair: true,
            accessibility: {
                description: "Countries",
            },
        },
        yAxis: {
            min: 0,
            title: {
                text: "Fatqan Rama Databases",
            },
        },
        tooltip: {
            valueSuffix: " (PCS)",
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0,
            },
        },
        series: [
            {
                name: "Total Harga Produk",
                data: totalHargaPerKat,
            },
        ],
    });

    Highcharts.chart('stock-per-kategori', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Total Stock Per Kategori'
        },
        tooltip: {
            valueSuffix: '%'
        },
        plotOptions: {
            series: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: [{
                    enabled: true,
                    distance: 20
                }, {
                    enabled: true,
                    distance: -40,
                    format: '{point.percentage:.1f}%',
                    style: {
                        fontSize: '1.2em',
                        textOutline: 'none',
                        opacity: 0.7
                    },
                    filter: {
                        operator: '>',
                        property: 'percentage',
                        value: 10
                    }
                }]
            }
        },
        series: [
            {
                name: 'Percentage',
                colorByPoint: true,
                data: totalStockPerKat
            }
        ]
    });
</script>  
@endsection