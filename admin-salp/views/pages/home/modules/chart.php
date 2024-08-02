<?php

error_reporting(0);

/*=============================================
total de ventas
=============================================*/

$url = "payorders?select=type_payorder,status_payorder";
$payorders = CurlController::request($url, $method, $fields);

if ($payorders->status == 200) {
    $payorders = $payorders->results;
} else {
    $payorders = array();
}

$paypal = 0;
$payu = 0;
$mercadoPago = 0;

foreach ($payorders as $key => $value) {

    switch ($value->type_payorder) {

        case "Infracciones de Tránsito":
            $transito++;
            break;

        case "Impuesto Predial":
            $predial++;
            break;

        case "Impuesto de Timbre Automotor":
            $timbre++;
            break;
    }
}

$total = $transito + $predial + $timbre;

$transito = round($transito * 100 / $total);
$predial = round($predial * 100 / $total);
$timbre = round($timbre * 100 / $total);
?>

<!--=====================================
Gráfico de ventas
======================================-->

<!-- PIE CHART -->
<div class="card card-danger">
    <div class="card-header">
        <h3 class="card-title">Mandamientos por Tipo</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div id="cantPqrs"></div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<script>
    Highcharts.chart('cantPqrs', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: ''
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [
                <?php
                echo "{name:'" . 'Tránsito' . "',y:" . $transito . "},";
                echo "{name:'" . 'Predial' . "',y:" . $predial . "},";
                echo "{name:'" . 'Timbre' . "',y:" . $timbre . "},";

                ?>
            ]
        }]
    });
</script>