@extends('dashboard.layouts.master')
@section('css')

<link rel="stylesheet" href="{{ URL::asset('assets/dashboard/plugins/owl-carousel/owl.carousel.css') }}" />

<link href="{{URL::asset('assets/dashboard/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/dashboard/plugins/morris.js/morris.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/dashboard/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet">

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">
                {{ 'Wellcome' . " " . Auth::user()->name}} !</h2>
        </div>
    </div>

</div>
<!-- /breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="main-body">
<div class="row row-sm">
    <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-primary-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-24 text-white">Services</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\Service::count() }}</h4>
                            <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                        </div>

                    </div>
                </div>
            </div>
            <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-danger-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-24 text-white">Skills</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\Skill::count() }}</h4>
                            <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                        </div>

                    </div>
                </div>
            </div>
            <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-success-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-24 text-white">Contact Me</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">{{  App\Models\Contact::count() }}</h4>
                            <p class="mb-0 tx-12 text-white op-7">Compared to last week</p>
                        </div>

                    </div>
                </div>
            </div>
            <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
        </div>
    </div>
</div>
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        Flipchart
                    </div>
                    <p class="mg-b-20">A weekly chart of communication messages and services you provide</p>
                    <div id="echart2"  class="ht-300"></div>
                </div>
            </div>
        </div>
    </div>
<!-- Container closed -->
</div>
@endsection
@section('js')
    <script src="{{ URL::asset('assets/dashboard/js/modal.js') }}"></script>
    <!--Internal  Chart.bundle js -->
    <script src="{{URL::asset('assets/dashboard/plugins/chart.js/Chart.bundle.min.js')}}"></script>
    <!-- Moment js -->
    <script src="{{URL::asset('assets/dashboard/plugins/raphael/raphael.min.js')}}"></script>
    <!--Internal  Flot js-->
    <script src="{{URL::asset('assets/dashboard/js/apexcharts.js')}}"></script>
    <!-- Internal Map -->
    <script src="{{URL::asset('assets/dashboard/js/modal-popup.js')}}"></script>
    <!--Internal  index js -->
    <script src="{{URL::asset('assets/dashboard/js/index.js')}}"></script>
    <script src="{{URL::asset('assets/dashboard/plugins/echart/echart.js')}}"></script>

    <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var services_name = button.data('services_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #services_name').val(services_name);
        })

    </script>
    <script>

        $(function(e) {
            'use strict'
            var chartdata2 = [{
                name: 'Services',
                type: 'line',
                smooth: true,
                // data: [10, 15, 9, 18, 10, 15],
                data: @json($services),
                color: ['#285cf7']
            }, {
                name: 'Contact Me',
                type: 'line',
                smooth: true,
                size: 10,
                // data: [10, 14, 10, 15, 9, 25],
                data: @json($contacts),
                color: ['#f7557a']
            }];
            var chart2 = document.getElementById('echart2');
            var barChart2 = echarts.init(chart2);
            var option2 = {
                grid: {
                    top: '6',
                    right: '0',
                    bottom: '17',
                    left: '25',
                },
                xAxis: {
                    // data: ['2014', '2015', '2016', '2017', '2018', '2019'],
                    data: @json($date),
                    splitLine: {
                        lineStyle: {
                            color: 'rgba(171, 167, 167,0.2)'
                        }
                    },
                    axisLine: {
                        lineStyle: {
                            color: 'rgba(171, 167, 167,0.2)'
                        }
                    },
                    axisLabel: {
                        fontSize: 10,
                        color: '#5f6d7a'
                    }
                },
                tooltip: {
                    trigger: 'axis',
                    position: ['35%', '32%'],
                },
                yAxis: {
                    splitLine: {
                        lineStyle: {
                            color: 'rgba(171, 167, 167,0.2)'
                        }
                    },
                    axisLine: {
                        lineStyle: {
                            color: 'rgba(171, 167, 167,0.2)'
                        }
                    },
                    axisLabel: {
                        fontSize: 10,
                        color: '#5f6d7a'
                    }
                },
                series: chartdata2,
                color: ['#285cf7', '#f7557a' ]
            };
            barChart2.setOption(option2);
            /*----BarChartEchart----*/
            var echartBar = echarts.init(document.getElementById('index'), {
                color: ['#285cf7', '#f7557a'],
                categoryAxis: {
                    axisLine: {
                        lineStyle: {
                            color: '#888180'
                        }
                    },
                    splitLine: {
                        lineStyle: {
                            color: ['rgba(171, 167, 167,0.2)']
                        }
                    }
                },
                grid: {
                    x: 40,
                    y: 20,
                    x2: 40,
                    y2: 20
                },
                valueAxis: {
                    axisLine: {
                        lineStyle: {
                            color: '#888180'
                        }
                    },
                    splitArea: {
                        show: true,
                        areaStyle: {
                            color: ['rgba(255,255,255,0.1)']
                        }
                    },
                    splitLine: {
                        lineStyle: {
                            color: ['rgba(171, 167, 167,0.2)']
                        }
                    }
                },
            });
            echartBar.setOption({
                tooltip: {
                    trigger: 'axis',
                    position: ['35%', '32%'],
                },
                legend: {
                    data: ['New Account', 'Expansion Account']
                },
                toolbox: {
                    show: false
                },
                calculable: false,
                xAxis: [{
                    type: 'category',
                    data: ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    axisLine: {
                        lineStyle: {
                            color: 'rgba(171, 167, 167,0.2)'
                        }
                    },
                    axisLabel: {
                        fontSize: 10,
                        color: '#5f6d7a'
                    }
                }],
                yAxis: [{
                    type: 'value',
                    splitLine: {
                        lineStyle: {
                            color: 'rgba(171, 167, 167,0.2)'
                        }
                    },
                    axisLine: {
                        lineStyle: {
                            color: 'rgba(171, 167, 167,0.2)'
                        }
                    },
                    axisLabel: {
                        fontSize: 10,
                        color: '#5f6d7a'
                    }
                }],
                series: [{
                    name: 'View Price',
                    type: 'bar',
                    data:@json($date),
                    markPoint: {
                        data: [{
                            type: 'max',
                            name: ''
                        }, {
                            type: 'min',
                            name: ''
                        }]
                    },
                    markLine: {
                        data: [{
                            type: 'average',
                            name: ''
                        }]
                    }
                }, {
                    name: ' Purchased Price',
                    type: 'bar',
                    data:[2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3],
                    markPoint: {
                        data: [{
                            name: 'Purchased Price',
                            value: 182.2,
                            xAxis: 7,
                            // yAxis: 183,
                        }, {
                            name: 'Purchased Price',
                            value: 2.3,
                            xAxis: 11,
                            // yAxis: 3
                        }]
                    },
                    markLine: {
                        data: [{
                            type: 'average',
                            name: ''
                        }]
                    }
                }]
            });
        });

    </script>
    <script>
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var store = button.data('store')
            var payment_method = button.data('payment_method')
            var address = button.data('address')
            var Order_number = button.data('Order_number')
            var number_pieces = button.data('number_pieces')
            var date_application = button.data('date_application')
            var customer_number = button.data('customer_number')

            var name = button.data('name')
            var phone = button.data('phone')
            var total = button.data('total')
            var delivery_cost = button.data('delivery_cost')
            var delivery_time = button.data('delivery_time')
            var notes = button.data('notes')




            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #store').html(store);
            modal.find('.modal-body #payment_method').html(payment_method);
            modal.find('.modal-body #address').html(address);
            modal.find('.modal-body #Order_number').html(Order_number);
            modal.find('.modal-body #number_pieces').html(number_pieces);
            modal.find('.modal-body #date_application').html(date_application);
            modal.find('.modal-body #customer_number').html(customer_number);
            modal.find('.modal-body #name').html(name);
            modal.find('.modal-body #phone').html(phone);
            modal.find('.modal-body #total').html(total);
            modal.find('.modal-body #delivery_cost').html(delivery_cost);
            modal.find('.modal-body #delivery_time').html(delivery_time);
            modal.find('.modal-body #notes').html(notes);
        })
    </script>
@endsection
