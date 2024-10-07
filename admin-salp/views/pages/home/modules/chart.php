<?php

error_reporting(0);

/* PQRs */

$url = "pqrs?select=id_pqr,status_pqr";
$pqrs = CurlController::request($url, $method, $fields);

//echo '<pre>'; print_r($pqrs); echo '</pre>';exit;
if ($pqrs->status == 200) {
    $pqrs = $pqrs->results;
} else {
    $pqrs = array();
}

$pending = 0;
$assign = 0;
$success = 0;
$cancell = 0;

foreach ($pqrs as $key => $value) {

    switch ($value->status_pqr) {
        case "Pending":
            $pending++;
            break;

        case "Assign":
            $assign++;
            break;

        case "Success":
            $success++;
            break;

        case "Cancell":
            $cancell++;
            break;
    }
}

$total = $pending + $assign + $success + $cancell;

$pending = round($pending * 100 / $total);
$assign = round($assign * 100 / $total);
$success = round($success * 100 / $total);
$cancell = round($cancell * 100 / $total);

// Luminarias por Tecnologia y Potencia

$select = "id_element,name_technology,name_power";
$url = "relations?rel=elements,classes,technologies,powers&type=element,class,technology,power&select=" . $select . "&linkTo=id_class_element&equalTo=" . 1;
//"relations?select=id_subject";
$elements = CurlController::request($url, $method, $fields);
$registers = $elements->total;
//echo '<pre>'; print_r($elements); echo '</pre>';

if ($elements->status == 200) {
    $elements = $elements->results;
} else {
    $elements = 0;
}

$groupelements = array();
$elemvalid = '';
$count = 1;


//echo '<pre>'; print_r($registers); echo '</pre>';
for ($i = 0; $i <= $registers - 1; $i++) {
    if ($elemvalid == '') {
        $groupelements[$count]['grupo'] = $elements[$i]->name_technology . ' ' . $elements[$i]->name_power;
        $groupelements[$count]['total'] = 1;
        $elemvalid = $elements[$i]->name_technology . ' ' . $elements[$i]->name_power;
    } else {
        if ($elemvalid == $elements[$i]->name_technology . ' ' . $elements[$i]->name_power) {
            $groupelements[$count]['total']++;
        } else {
            $count++;
            $groupelements[$count]['grupo'] = $elements[$i]->name_technology . ' ' . $elements[$i]->name_power;
            $groupelements[$count]['total'] = 1;
            $elemvalid = $elements[$i]->name_technology . ' ' . $elements[$i]->name_power;
        }
    }
}

//echo '<pre>'; print_r($groupelements); echo '</pre>';exit;
?>

<div class="row col-md-12">
    <!-- Gráfico de PQRs por Estado -->

    <!-- PIE CHART -->
    <div class="card card-danger col-md-5">
        <div class="card-header">
            <h3 class="card-title">PQRs por Estado</h3>

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

    <!-- Gráfico de Cargos Por Municipio -->
    <!-- PIE CHART -->
    <div class="card card-info col-md-5 ml-4">
        <div class="card-header">
            <h3 class="card-title">Luminarias por Tecnología y Potencia</h3>
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
            <div class="container-title">
<!--                 <div class="dflex text-right">
                    <input class="ventasAnio" name="ventasAnio" placeholder="Departamento" minlength="4" maxlength="4" onkeypress="return controlTag(event);" autocomplete="off">
                    <button type="button" class="btnVentasAnio btn btn-info btn-sm" onclick="fntSearchVAnio()"> <i class="fas fa-search"></i> </button>
                </div>
 -->            </div>
            <div id="cantElements"></div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<script>
    Highcharts.chart('cantPqrs', {
        lang: {
            downloadCSV: "Descarga CSV",
            viewFullscreen: "Ver en pantalla completa"
        },
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
                echo "{name:'" . 'Pendientes' . "',y:" . $pending . "},";
                echo "{name:'" . 'Asignadas' . "',y:" . $assign . "},";
                echo "{name:'" . 'Resueltas' . "',y:" . $success . "},";
                echo "{name:'" . 'Canceladas' . "',y:" . $cancell . "},";
                ?>
            ]
        }]
    });

    Highcharts.chart('cantElements', {
        lang: {
            downloadCSV: "Descarga CSV",
            viewFullscreen: "Ver en pantalla completa"
        },
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
                for ($c = 1; $c <= $count; $c++) {
                    echo "{name:'" . $groupelements[$c]['grupo'] . "',y:" . $groupelements[$c]['total'] . "},";
                }
                ?>
            ]
        }]
    });
</script>