<?php
    include_once 'carbon/autoload.php';
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $imageURL	    = $this->_dirImg;

    if(isset($this->arrayParam['form']['select']))
        $this->arrayParam['form']['select'] = $this->arrayParam['form']['select'];
    else
        $this->arrayParam['form']['select'] = 'slb_day';
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    $select     = Helper::cmsSelectbox('form[select]', 'inputbox form-control' ,array('default' => 'Select Your Option', 'slb_day' => 'By Day', 'slb_month' => 'By Month', 'slb_quarter' => 'By Quarter'), $this->arrayParam['form']['select'], 'width: 230px; padding: 3px');

    if(isset($_POST['week']) || isset($_POST['month']) || isset($_POST['year'])){
            if(isset($_POST['week'])){
                $interval = new DateInterval('P7D'); // Cộng thêm 2 ngày
            }
            if(isset($_POST['month'])){
                $interval = new DateInterval('P30D'); // Cộng thêm 2 ngày
            }
            if(isset($_POST['year'])){
                $interval = new DateInterval('P365D'); // Cộng thêm 2 ngày
            }

            $now = date('Y-m-d', time());
            $date = new DateTime($now);

            $fromDate = date_format(date_sub($date, $interval), 'Y-m-d');
            $toDate = date('Y-m-d', time());

        } elseif($_POST['token'] > 0){
            $selected = 'Selected - ';
            $fromDate = $_POST['fromDate'];
            $toDate = $_POST['toDate'];
        } else {
            $fromDate = $now . ' 00:00:00';
            $toDate   = $now . ' 23:59:59';
        }

    $selected = 'Today - ';

    // Day
    foreach ($this->data as $key => $value){
        $dataDayRevenue[] = array(
            'date'      => $value['date'],
            'revenue'   => $value['totalPrice']
        );
    }

    $title      = '';
    $id         = '';
    $type       = '';
    switch ($this->arrayParam['form']['select']){
        case 'slb_day':
            $title = 'Statistic By Day';
            $id = 'day_revenue';
            break;
        case 'slb_month':
            $title = 'Statistic By Month';
            $id = 'month_revenue';
            $type = 'month';
            break;
        case 'slb_quarter':
            $title = 'Statistic By Quarter';
            $id = 'quarter_revenue';
            $type = 'quarter';
            break;
    }

    $dateCost   = array();
    $valueCost  = array();
    foreach ($this->cost as $key => $value){
        $dateCost[]     = $key;
        $valueCost[]    = $value;
    }

    foreach ($this->data as $key => $value){
            if(in_array($value["$type"], $dateCost, TRUE)){
                $dataRevenue[] = array(
                    "$type"      => $value["$type"],
                    'profit'     => $value['profit'] - $this->cost[$value["$type"]],
                    'revenue'    => $value['totalPrice']
                );
            }else {
                $dataRevenue[] = array(
                    "$type"         => $value["$type"],
                    'profit'        => $value['profit'],
                    'revenue'       => $value['totalPrice']
                );
            }
}
    // Category
    foreach ($this->dataCategoryRevenue as $key => $value)
        $dataCategoryRevenue[] = array(
            'name'      => $value['name'],
            'revenue'   => $value['revenue'],
            'sold'      => $value['sold']
        );

    // Collection
    foreach ($this->dataCollectionRevenue as $key => $value)
        $dataCollectionRevenue[] = array(
        'name'      => $value['name'],
        'revenue'   => $value['revenue'],
        'sold'      => $value['sold']
    );

    // Customer
    foreach ($this->dataCustomer as $key => $value)
        $dataCustomer[] = array(
            'name'      => $value['fullname'],
            'total'     => $value['total'],
        );

    // Stock & Sold
    foreach ($this->stock_sold as $key => $value)
        $dataStock[] = array(
        'name'      => $value['name'],
        'id'        => $value['id'],
        'stock'     => $value['stock'],
        'sold'      => $value['sold']
    );


?>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    $( function() {
        $( "#datepicker1" ).datepicker({dateFormat: "yy-mm-dd"});
        $( "#datepicker2" ).datepicker({dateFormat: "yy-mm-dd"});
    } );
</script>
<script type="text/javascript">
    $('btnFilter').click(function () {
        var fromDate = $('#datepicker1').val();
        var toDate = $('#datepicker2').val();
    })
</script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['bar', 'corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var expression = '<?php echo $this->arrayParam['form']['select'];?>';
        switch (expression){
            case 'slb_day':
                var data = google.visualization.arrayToDataTable([
                    ['Date', 'Revenue'],
                    <?php
                    foreach ($dataDayRevenue as $key) {
                        echo "['".$key['date']."', ".$key['revenue']."],";
                    }
                    ?>
                ]);
                var options = {
                    bars: 'vertical'
                };
                var chart = new google.charts.Bar(document.getElementById('day_revenue'));
                chart.draw(data, google.charts.Bar.convertOptions(options));
                break;

            case 'slb_month':
                var dataMonth = google.visualization.arrayToDataTable([
                    ['Month', 'Profit', 'Revenue'],
                    <?php
                    foreach ($dataRevenue as $key) {
                        echo "['".$key['month']."', ".$key['profit'].", ".$key['revenue']."],";
                    }
                    ?>
                ]);
                var optionsMonth = {
                    bars: 'vertical'
                };
                var chartMonth = new google.charts.Bar(document.getElementById('month_revenue'));
                chartMonth.draw(dataMonth, google.charts.Bar.convertOptions(optionsMonth));
                break;

            case 'slb_quarter':
                var dataQuarter = google.visualization.arrayToDataTable([
                    ['Quarter', 'Profit', 'Revenue'],
                    <?php
                    foreach ($dataRevenue as $key) {
                        echo "['".$key['quarter']."', ".$key['profit'].", ".$key['revenue']."],";
                    }
                    ?>
                ]);
                var optionsQuarter = {
                    bars: 'vertical'
                };
                var chartQuarter = new google.charts.Bar(document.getElementById('quarter_revenue'));
                chartQuarter.draw(dataQuarter, google.charts.Bar.convertOptions(optionsQuarter));
                break;
        }

        // Category - Bar Chart
        var dataCategory = google.visualization.arrayToDataTable([
            ['Category', 'Revenue'],
            <?php
            foreach ($dataCategoryRevenue as $key) {
                echo "
                    ['".$key['name']."', ".$key['revenue']."],
                    ";
            }
            ?>
        ]);
        var optionsCategory = {
            bars: 'horizontal'
        };
        var chartCategory = new google.charts.Bar(document.getElementById('category_revenue'));
        chartCategory.draw(dataCategory, optionsCategory);

        // Category - Pie Chart
        var dataCategoryPie = google.visualization.arrayToDataTable([
            ['Category', 'Sold'],
            <?php
            foreach ($dataCategoryRevenue as $key) {
                echo "
                    ['".$key['name']."', ".$key['sold']."],
                    ";
            }
            ?>
        ]);
        var optionsCategoryPie = {
            is3D: true
        };
        var chartCategoryPie = new google.visualization.PieChart(document.getElementById('category_pie_revenue'));
        chartCategoryPie.draw(dataCategoryPie, optionsCategoryPie);

        // Collection - Bar Chart
        var dataCollection = google.visualization.arrayToDataTable([
            ['Collection', 'Revenue'],
            <?php
            foreach ($dataCollectionRevenue as $key) {
                echo "
                    ['".$key['name']."', ".$key['revenue']."],
                    ";
            }
            ?>
        ]);
        var optionsCollection = {
            bars: 'horizontal'
        };
        var chartCollection = new google.charts.Bar(document.getElementById('collection_revenue'));
        chartCollection.draw(dataCollection, optionsCollection);

        // Collection - Pie Chart
        var dataCollectionPie = google.visualization.arrayToDataTable([
            ['Collection', 'Sold'],
            <?php
            foreach ($dataCollectionRevenue as $key) {
                echo "
                    ['".$key['name']."', ".$key['sold']."],
                    ";
            }
            ?>
        ]);
        var optionsCollectionPie = {
            is3D: true
        };
        var chartCollectionPie = new google.visualization.PieChart(document.getElementById('collection_pie_revenue'));
        chartCollectionPie.draw(dataCollectionPie, optionsCollection);

        // Customer
        var dataCustomer = google.visualization.arrayToDataTable([
            ['Name', 'Value Order'],
            <?php
            foreach ($dataCustomer as $key) {
                echo "
                    ['".$key['name']."', ".$key['total']."],
                    ";
            }
            ?>
        ]);
        var optionsCustomer = {
            bars: 'vertical'
        };
        var chartCustomer = new google.charts.Bar(document.getElementById('customer_revenue'));
        chartCustomer.draw(dataCustomer, optionsCustomer);


        // Stock & Sold
        var dataStock = google.visualization.arrayToDataTable([
            ['ID', 'Stock', 'Sold'],
            <?php
            foreach ($dataStock as $key) {
                echo "
                    ['".$key['id']."', ".$key['stock'].", ".$key['sold']."],
                    ";
            }
            ?>
        ]);
        var optionsStock = {
            bar: { groupWidth: '75%' },
            isStacked: 'percent',
            height: 700,
            legend: {position: 'bottom', maxLines: 3},
            hAxis: {
                minValue: 0,
                ticks: [0, .3, .6, .9, 1]
            }
        };
        var chartStock = new google.visualization.BarChart(document.getElementById('barchart_material_stock'));
        chartStock.draw(dataStock, optionsStock);

    }
</script>
<!-- Start wrapper-->

<div id="wrapper">
    <div class="clearfix"></div>

    <div class="content-wrapper">
        <div class="container-fluid">
            <!--Start Dashboard Content-->
            <div class="card mt-3">
                <div class="card-content">
                    <div class="row row-group m-0">
                        <div class="col-12 col-lg-6 col-xl-2 border-light">
                            <div class="card-body">
                                <h5 class="text-white mb-3"><?php echo $this->products?> <span class="float-right"><i class="fa fa-tag"></i></span></h5>
                                <p class="mb-0 text-white small-font">Total Products</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-2 border-light">
                            <div class="card-body">
                                <h5 class="text-white mb-3"><?php echo $this->orders?> <span class="float-right"><i class="fa fa-shopping-cart"></i></span></h5>
                                <p class="mb-0 text-white small-font">Total Orders</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-2 border-light">
                            <div class="card-body">
                                <h5 class="text-white mb-3"><?php echo $this->shipping?> <span class="float-right"><i class="fa fa-xmark"></i></span></h5>
                                <p class="mb-0 text-white small-font">Not Yet Completed</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-2 border-light">
                            <div class="card-body">
                                <h5 class="text-white mb-3"><?php echo $this->shipped?> <span class="float-right"><i class="fa fa-check"></i></span></h5>
                                <p class="mb-0 text-white small-font">Completed</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-2 border-light">
                            <div class="card-body">
                                <h5 class="text-white mb-3"><?php echo number_format($this->revenue)?> <span class="float-right"><i class="fa-solid fa-usd"></i></span></h5>
                                <p class="mb-0 text-white small-font">Total Revenue</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-2 border-light">
                            <div class="card-body">
                                <h5 class="text-white mb-3"><?php echo number_format($this->profit)?> <span class="float-right"><i class="fa fa-wallet"></i></span></h5>
                                <p class="mb-0 text-white small-font">Total Profit</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-content">
                    <div class="row row-group m-0">
                        <div class="col-12 col-lg-6 col-xl-2 border-light">
                            <div class="card-body">
                                <h5 class="text-white mb-3"><?php echo $this->monthProduct?> <span class="float-right"><i class="fa fa-tag"></i></span></h5>
                                <p class="mb-0 text-white small-font">New Products</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-2 border-light">
                            <div class="card-body">
                                <h5 class="text-white mb-3"><?php echo $this->monthOrder?> <span class="float-right"><i class="fa fa-shopping-cart"></i></span></h5>
                                <p class="mb-0 text-white small-font">New Orders</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-2 border-light">
                            <div class="card-body">
                                <h5 class="text-white mb-3"><?php echo $this->monthShipping?> <span class="float-right"><i class="fa fa-xmark"></i></span></h5>
                                <p class="mb-0 text-white small-font">Not Yet Completed</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-2 border-light">
                            <div class="card-body">
                                <h5 class="text-white mb-3"><?php echo $this->monthShipped?> <span class="float-right"><i class="fa fa-check"></i></span></h5>
                                <p class="mb-0 text-white small-font">Completed</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-2 border-light">
                            <div class="card-body">
                                <h5 class="text-white mb-3"><?php echo number_format($this->monthRevenue)?> <span class="float-right"><i class="fa-solid fa-usd"></i></span></h5>
                                <p class="mb-0 text-white small-font">Total Revenue</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-2 border-light">
                            <div class="card-body">
                                <h5 class="text-white mb-3"><?php echo number_format($this->monthProfit - array_sum($valueCost))?> <span class="float-right"><i class="fa fa-wallet"></i></span></h5>
                                <p class="mb-0 text-white small-font">Total Profit</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-content">
                    <div class="row row-group m-0">
                        <div class="col-12 col-lg-12 col-xl-12 border-light">
                            <div class="card-body">
                                <?php
                                    $linkSubmitForm = URL::createLink('admin', 'dashboard', 'index');
                                ?>
                                <form action="<?php echo $linkSubmitForm?>" method="post" name="adminForm" id="adminForm">
                                    <div class="d-flex container-fluid col-12 col-lg-12 col-xl-12 row ">
                                        <div class="col-12 col-lg-12 col-xl-12 row mb-4">
                                            <div class="d-flex" class="col-12 col-lg-12 col-xl-12 row">
                                                <div class="col-md-12 col-lg-6">
                                                    <p>From <input type="text" name="fromDate" id="datepicker1" class="form-control" value="<?php echo $fromDate?>"></p>
                                                    <input type="submit" id="btnFilter" class="btn btn-secondary btn-sm">
                                                </div>
                                                <div class="col-md-12 col-lg-6">
                                                    <p>To <input type="text" name="toDate" id="datepicker2" class="form-control" value="<?php echo $toDate?>"></p>
                                                </div>
                                                <div class="col-md-12 col-lg-6">
                                                    <p>Statistic By
                                                       <?php echo $select?>
                                                    </p>
                                                </div>
                                                <input type="hidden" name="token" value="<?php echo time();?>">
                                            </div>
                                        </div>
                                        </br>
                                        <div class="col-2 col-lg-2 col-xl-2">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="week" value="P7D">Last 7 days
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-2 col-lg-2 col-xl-2">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="month" value="P30D">Last 30 days
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-2 col-lg-2 col-xl-2">
                                            <div class="form-check disabled">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="year" value="P365D">Last 365 days
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<!--            Day & Month-->
            <div class="card mt-3">
                <div class="card-content" style="margin: 0 auto">
                    <div class="row row-group m-0">
                        <?php
                        echo '<div class="col-12 col-lg-12 col-xl-12">
                                    <h1 class="text-center" style="margin-top: 25px">'.$title.'</h1>
                                    <div class="card-body">
                                        <div id="'.$id.'" style="width: 1155px; height: 500px;"></div>
                                    </div>
                                </div>';
                        ?>
                    </div>
                </div>
            </div>


<!--            Category - Revenue & Profit-->
            <div class="card mt-3">
                <div class="card-content" style="margin: 0 auto; justify-content: space-between">
                    <div class="row row-group m-0">
                        <div class="col-6 col-lg-6 col-xl-6">
                            <h1 class="text-center" style="margin-top: 25px">Statistic Category <br> By Revenue</h1>
                            <div class="card-body">
                                <div id="category_revenue" style="width: 550px; height: 400px;"></div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-6 col-xl-6">
                            <h1 class="text-center" style="margin-top: 25px">Statistic Category <br>By Sold</h1>
                            <div class="card-body">
                                <div id="category_pie_revenue" style="width: 550px; height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<!--            Category - Revenue & Profit-->
            <div class="card mt-3">
                <div class="card-content" style="margin: 0 auto">
                    <div class="row row-group m-0">
                        <div class="col-6 col-lg-6 col-xl-6">
                            <h1 class="text-center" style="margin-top: 25px">Statistic Collection <br> By Revenue</h1>
                            <div class="card-body">
                                <div id="collection_revenue" style="width: 550px; height: 400px;"></div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-6 col-xl-6">
                            <h1 class="text-center" style="margin-top: 25px">Statistic Collection <br>By Sold</h1>
                            <div class="card-body">
                                <div id="collection_pie_revenue" style="width: 550px; height: 400px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<!--            Category - Sold & Customer-->
            <div class="card mt-3">
                <div class="card-content" style="margin: 0 auto">
                    <div class="row row-group m-0">
                        <div class="col-12 col-lg-12 col-xl-12">
                            <h1 class="text-center" style="margin-top: 25px">Top 10 Customers <br>By Order Value</h1>
                            <div class="card-body">
                                <div id="customer_revenue" style="width: 1155px; height: 500px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<!--            Stock & Sold-->
            <div class="card mt-3">
                <div class="card-content">
                    <div class="row row-group m-0">
                        <div class="col-12 col-lg-12 col-xl-12">
                            <h1 class="text-center" style="margin-top: 25px">Statistic Stock And Sold By ID</h1>
                            <?php
                            $xhtml = '';
                            $nameProduct = 'Product is not Exist';
                            if (($_POST['idProduct']) != null){
                                if($this->nameProduct[0]['name'] != null){
                                    $nameProduct            = $this->nameProduct[0]['name'];
                                    $soldProduct            = $this->nameProduct[0]['sold'];
                                    $stockProduct           = $this->nameProduct[0]['stock'];
                                    $pictureProduct         = $this->nameProduct[0]['picture1'];
                                    $designerProduct        = $this->nameProduct[0]['designerName'];
                                    $collectionProduct      = $this->nameProduct[0]['collectionName'];
                                    $xhtml = '<div class="row col-6">
                                                        <div class="col-md-12">
                                                            <p>Result <input type="text" readonly class="form-control" value="'.$nameProduct.'"></p>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <p>Sold <input type="text" readonly class="form-control" value="'.$soldProduct.'"></p>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <p>Stock <input type="text" readonly class="form-control" value="'.$stockProduct.'"></p>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <p>Designer <input type="text" readonly class="form-control" value="'.$designerProduct.'"></p>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <p>Collection <input type="text" readonly class="form-control" value="'.$collectionProduct.'"></p>
                                                        </div>
                                                        </div>
                                                        <div class="col-2">
                                                        <p>Image
                                                        <img width="240" height="270" src="'.UPLOAD_URL . 'product/' . $nameProduct . DS . $pictureProduct.'">
                                                    </p> 
                                                    </div>
                                                    ';
                                } else
                                    $xhtml = '<div class="col-md-6">
                                                        <p>Result <input type="text" readonly class="form-control" value="'.$nameProduct.'"></p>
                                                    </div>';

                            }

                            ?>
                            <div class="card-content">
                                <div class="row row-group m-0">
                                    <div class="col-12 col-lg-12 col-xl-12 border-light">
                                        <div class="card-body">

                                            <div class="col-md-12 row">
                                                <div class="col-md-4">
                                                    <p>ID <input type="number" name="idProduct" class="form-control" value="<?php echo $_POST['idProduct']?>"></p>
                                                    <input type="submit" id="btnFilter" class="btn btn-secondary btn-sm">
                                                </div>
                                                <?php echo $xhtml;?>

                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" id="chart_wrapper">
                                <div id="barchart_material_stock" style="width: 1155px; height: 700px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--End Dashboard Content-->

            <!--start overlay-->
            <div class="overlay toggle-menu"></div>
            <!--end overlay-->

        </div>
        <!-- End container-fluid-->

    </div><!--End content-wrapper-->
    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
</div><!--End wrapper-->

<style>
    #chart_wrapper {
        overflow-x: scroll;
        overflow-y: hidden;
    }
</style>