<?php

$homeController = new HomeController();
$sportsData = $homeController->getGroupBySport();
$modulesData = $homeController->getGroupByModule();
$homeCount = $homeController->getCountAllUsers();
$invoiceCount = $homeController->getCountAllInvoice();
$invoiceProfitsCount = $homeController->getCountAllInvoiceProfits();
$sportsDataForToday = $homeController->getGroupByDayAndSport();
$inscriptionsData = $homeController->getInscriptionsByModuleAndType();
$inscriptionsDataSM = $homeController->getInscriptionsBySportAndModuleAndTendence();

if (!empty($invoiceProfitsCount)) :
    foreach ($invoiceProfitsCount as $invoice) :
        if ($invoice['Mid'] == 6) {
            $idOneM = $invoice['Mid'];
            $countOneM = $invoice['InvoiceCount'];
            $amountOneM = $invoice['TotalAmount'];
        } else  if ($invoice['Mid'] == 7) {
            $idTwoM = $invoice['Mid'];
            $countTwoM = $invoice['InvoiceCount'];
            $amountTwoM = $invoice['TotalAmount'];
        } else  if ($invoice['Mid'] == 8) {
            $idThridM = $invoice['Mid'];
            $countThridM = $invoice['InvoiceCount'];
            $amountThridM = $invoice['TotalAmount'];
        }
    endforeach;
endif;

?>

<!-- Nav Header Component Start -->
<div class="iq-navbar-header" style="margin-top: 10%;">
    <!-- <div class="container-fluid iq-container">
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
    </div> -->
    <div class="iq-header-img">
        <img src="./../assets/image/dashboard/top-header-cdp.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">

    </div>
</div> <!-- Nav Header Component End -->
<!--Nav End-->
</div>
<div class="conatiner-fluid content-inner mt-n5 py-0">
    <div class="row">
        <!-- <div class="flex-wrap justify-content-between align-items-center">
            <div class="form-group">
                <h2 class="card-title text-white" style="box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);">Dashboard <?php echo $roleName; ?></h2>
            </div>
        </div> -->
        <div class="col-md-12 col-lg-12">

            <div class="row">

                <div class="col-md-12 col-lg-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card" data-aos="fade-up" data-aos-delay="50">

                                <div class="card-body">
                                    <div class="progress-widget">
                                        <img src="./../assets/image/icons/3D-Quota.png" width="75px" alt="">

                                        <div class="progress-detail">
                                            <p class="mb-1">Inscripciones Mod-1</p>

                                            <h4 class="counter"><?php echo $countOneM; ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card" data-aos="fade-up" data-aos-delay="50">

                                <div class="card-body">
                                    <div class="progress-widget">
                                        <img src="./../assets/image/icons/3D-Quota.webp" width="75px" alt="">

                                        <div class="progress-detail">
                                            <p class="mb-1">Ganancias Mod-1</p>
                                            <h4 class="counter"><?php echo $amountOneM; ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card" data-aos="fade-up" data-aos-delay="50">

                                <div class="card-body">
                                    <div class="progress-widget">
                                        <img src="./../assets/image/icons/3D-Quota.png" width="75px" alt="">

                                        <div class="progress-detail">
                                            <p class="mb-1">Inscripciones Mod-2</p>

                                            <h4 class="counter"><?php echo $countTwoM; ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card" data-aos="fade-up" data-aos-delay="50">

                                <div class="card-body">
                                    <div class="progress-widget">
                                        <img src="./../assets/image/icons/3D-Quota.webp" width="75px" alt="">
                                        <div class="progress-detail">
                                            <p class="mb-1">Ganancias Mod-2</p>
                                            <h4 class="counter"><?php echo $amountTwoM; ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- <div class="col-md-6">
                            <div class="card" data-aos="fade-up" data-aos-delay="50">
                                
                                    <div class="card-body">
                                        <div class="progress-widget">
                                            <img src="./../assets/image/icons/3D-Quota.png" width="75px" alt="">

                                            <div class="progress-detail">
                                                <p class="mb-1">Inscripciones Mod-3</p>

                                                <h4 class="counter"><?php echo $countThridM; ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card" data-aos="fade-up" data-aos-delay="50">
                                
                                    <div class="card-body">
                                        <div class="progress-widget">
                                            <img src="./../assets/image/icons/3D-Quota.webp" width="75px" alt="">
                                            <div class="progress-detail">
                                                <p class="mb-1">Ganancias Mod-3</p>
                                                <h4 class="counter"><?php echo $amountThridM; ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>
                        </div> -->
                    </div>
                </div>

                <div class="col-md-12 col-lg-4">

                    <div class="card" data-aos="fade-up" data-aos-delay="50">
                        <div class="">
                            <div class="card-header">
                                <h5 class="card-title">Inscripciones por Módulo</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="modulesChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Tendencia de inscripciones por Módulo y Deportes</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="inscriptionsChartTendence" width="400" height="200"></canvas>
                                </div>

                            </div>
                        </div>
                       
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Tipo de inscripción</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="inscriptionsChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Inscripciones por fecha actual (<?php echo date('d-m-Y') ?>)</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="sportsTodayChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Todas las inscripciones por Deporte</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="sportsChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    const inscriptionsDataModules = <?php echo json_encode($inscriptionsData); ?>;

                    const modulesForChart = [...new Set(inscriptionsDataModules.map(item => item.ModuleName))];
                    const typesForChart = [...new Set(inscriptionsDataModules.map(item => item.ITname))];

                    const colorsForChart = [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(199, 199, 199, 1)',
                        'rgba(83, 102, 255, 1)',
                        'rgba(50, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)'
                    ];

                    const datasetsForChart = typesForChart.map((type, index) => {
                        return {
                            label: type,
                            data: modulesForChart.map(module => {
                                const item = inscriptionsDataModules.find(d => d.ModuleName === module && d.ITname === type);
                                return item ? item.TotalInscriptions : 0;
                            }),
                            borderColor: colorsForChart[index % colorsForChart.length],
                            backgroundColor: colorsForChart[index % colorsForChart.length],
                            borderWidth: 2
                        };
                    });

                    const ctxForChart = document.getElementById('inscriptionsChart').getContext('2d');
                    const inscriptionsChart = new Chart(ctxForChart, {
                        type: 'bar',
                        data: {
                            labels: modulesForChart,
                            datasets: datasetsForChart
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            plugins: {
                                datalabels: {
                                    anchor: 'end',
                                    align: 'top',
                                    formatter: (value) => value,
                                    color: 'black',
                                    font: {
                                        weight: 'bold'
                                    }
                                }
                            }
                        }
                    });
                </script>

                <script>
                    const inscriptionsDataSM = <?php echo json_encode($inscriptionsDataSM); ?>;

                    const sports = [...new Set(inscriptionsDataSM.map(item => item.Sname))];
                    const modules = [...new Set(inscriptionsDataSM.map(item => item.ModuleName))];

                    const colors = [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(199, 199, 199, 1)',
                        'rgba(83, 102, 255, 1)',
                        'rgba(50, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)'
                    ];

                    const datasetsTendence = modules.map((module, index) => {
                        return {
                            label: module,
                            data: sports.map(sport => {
                                const item = inscriptionsDataSM.find(d => d.Sname === sport && d.ModuleName === module);
                                return item ? item.TotalInscriptions : 0;
                            }),
                            borderColor: colors[index % colors.length],
                            backgroundColor: colors[index % colors.length],
                            fill: false,
                            borderWidth: 2
                        };
                    });

                    const ctxTendence = document.getElementById('inscriptionsChartTendence').getContext('2d');
                    const inscriptionsChartTendence = new Chart(ctxTendence, {
                        type: 'line',
                        data: {
                            labels: sports,
                            datasets: datasetsTendence
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                },
                                x: {
                                    ticks: {
                                        autoSkip: false, // Para asegurar que se muestren todas las etiquetas
                                        maxRotation: 90,
                                        minRotation: 90
                                    }
                                }
                            },


                            plugins: {
                                datalabels: {
                                    anchor: 'end',
                                    align: 'top',
                                    formatter: (value) => value,
                                    color: 'black',
                                    font: {
                                        weight: 'bold'
                                    }
                                }
                            }
                        }
                    });
                </script>

                <script>
                    const sportsData = <?php echo json_encode($sportsData); ?>;
                    const modulesData = <?php echo json_encode($modulesData); ?>;

                    const sportsLabels = sportsData.map(data => data.SportName);
                    const sportsInscriptions = sportsData.map(data => data.TotalInscriptions);

                    const sportsColors = [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(199, 199, 199, 1)',
                        'rgba(83, 102, 255, 1)',
                        'rgba(50, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)'
                    ];

                    const sportsCtx = document.getElementById('sportsChart').getContext('2d');
                    const sportsChart = new Chart(sportsCtx, {
                        type: 'bar',
                        data: {
                            labels: sportsLabels,
                            datasets: [{
                                label: 'Total de Inscripciones por Deporte',
                                data: sportsInscriptions,
                                backgroundColor: sportsColors,
                                borderColor: sportsColors,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                },
                                x: {
                                    ticks: {
                                        autoSkip: false, // Para asegurar que se muestren todas las etiquetas
                                        maxRotation: 90,
                                        minRotation: 90
                                    }
                                }
                            }

                        }
                    });

                    const modulesLabels = modulesData.map(data => data.ModuleName);
                    const modulesInscriptions = modulesData.map(data => data.TotalInscriptions);

                    const modulesColors = [
                        'rgba(255, 159, 64, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(50, 159, 64, 1)',
                        'rgba(83, 102, 255, 1)',
                        'rgba(199, 199, 199, 1)',
                        'rgba(255, 159, 64, 1)'
                    ];

                    const modulesDataObject = {
                        labels: modulesLabels,
                        datasets: [{
                            label: 'Total de Inscripciones por Módulo',
                            data: modulesInscriptions,
                            backgroundColor: modulesColors,
                            hoverOffset: 4
                        }]
                    };

                    const modulesCtx = document.getElementById('modulesChart').getContext('2d');
                    const modulesChart = new Chart(modulesCtx, {
                        type: 'polarArea',
                        data: modulesDataObject,
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>



                <script>
                    const sportsDataForToday = <?php echo json_encode($sportsDataForToday); ?>;

                    // Organizar los datos para el gráfico de líneas
                    const sportLabels = sportsDataForToday.map(data => data.SportName);
                    const inscriptionsDataT = sportsDataForToday.map(data => data.TotalInscriptions);

                    const sportsTodayCtx = document.getElementById('sportsTodayChart').getContext('2d');
                    const sportsTodayChart = new Chart(sportsTodayCtx, {
                        type: 'bar',
                        data: {
                            labels: sportLabels,
                            datasets: [{
                                label: 'Inscripciones por Deporte',
                                data: inscriptionsDataT,
                                backgroundColor: getRandomColorPalette(sportLabels.length),
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                },
                                x: {
                                    ticks: {
                                        autoSkip: false, // Para asegurar que se muestren todas las etiquetas
                                        maxRotation: 90,
                                        minRotation: 90
                                    }
                                }
                            },
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(0); // Mostrar el valor entero
                                        }
                                    }
                                }
                            },

                        }
                    });

                    // Función auxiliar para generar colores sólidos para el gráfico
                    function getRandomColorPalette(length) {
                        const colors = [];
                        const baseColors = [
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(255, 159, 64, 0.6)',
                            'rgba(231, 233, 237, 0.6)',
                            'rgba(247, 70, 74, 0.6)',
                            'rgba(70, 191, 189, 0.6)',
                            'rgba(253, 180, 92, 0.6)'
                        ];

                        for (let i = 0; i < length; i++) {
                            colors.push(baseColors[i % baseColors.length]);
                        }
                        return colors;
                    }
                </script>
            </div>
        </div>
    </div>
</div>


<?php
