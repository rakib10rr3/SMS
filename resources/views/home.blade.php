@extends('layouts.app')

@section('content')

    @if(isset($not_authorized))

        <div class="card box-shadow p-4">
            <blockquote class="blockquote text-center">
                <p class="mb-0">“Computers are good at following instructions, but not at reading your mind.”</p>
                <footer class="blockquote-footer">Donald Knuth</footer>
            </blockquote>
        </div>

    @else

        <div class="row clearfix progress-box">

            <!-- all student -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
                <div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">

                    <div class="project-info clearfix">
                        <div class="project-info-left">
                            <div class="icon box-shadow bg-blue text-white">
                                <i class="fa fa-graduation-cap"></i>
                            </div>
                        </div>
                        <div class="project-info-right">
                            <span class="no text-blue weight-500 font-24">{{$all_students}}</span>
                            <p class="weight-400 font-18">Students</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- all teachers -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
                <div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
                    <div class="project-info clearfix">
                        <div class="project-info-left">
                            <div class="icon box-shadow bg-light-green text-white">
                                <i class="fa fa-book"></i>
                            </div>
                        </div>
                        <div class="project-info-right">
                            <span class="no text-light-green weight-500 font-24">{{$all_teachers}}</span>
                            <p class="weight-400 font-18">Teachers</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- all staff -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
                <div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
                    <div class="project-info clearfix">
                        <div class="project-info-left">
                            <div class="icon box-shadow bg-light-orange text-white">
                                <i class="fa fa-briefcase"></i>
                            </div>
                        </div>
                        <div class="project-info-right">
                            <span class="no text-light-orange weight-500 font-24">{{$all_staffs}}</span>
                            <p class="weight-400 font-18">Staffs</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row clearfix">

            <div class="col-xl-8 col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="bg-white pd-20 box-shadow border-radius-5 mb-30">
                    <h4 class="mb-30">Last 7 Days Students Presents</h4>
                    <div id="areaspline-chart" style="min-width: 210px; height: 400px; margin: 0 auto"></div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="bg-white pd-20 box-shadow border-radius-5 height-100-p">
                    <h4 class="mb-20">Recent Notices</h4>

                    <div class="notification-list mx-h-450 customscroll">
                        <ul>

                            @foreach($notices as $notice)

                                <li>
                                    <a href="#">
                                        {{--<img src="vendors/images/img.jpg" alt="">--}}
                                        <h3 class="clearfix">{{$notice->title}}
                                            <span>{{ $notice->created_at->diffForHumans() }}</span></h3>
                                        <p>{{$notice->message}}</p>
                                        <p class="author">{{$notice->user->getUserDisplayName()}}</p>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>

    @endif


@endsection

@section('scripts')

    @if(!isset($not_authorized))

        <script src="/src/plugins/highcharts-6.0.7/code/highcharts.js"></script>
        <script src="/src/plugins/highcharts-6.0.7/code/highcharts-more.js"></script>

        <script type="text/javascript">
            Highcharts.chart('areaspline-chart', {
                chart: {
                    type: 'areaspline'
                },
                title: {
                    text: ''
                },
                legend: {
                    layout: 'vertical',
                    align: 'left',
                    verticalAlign: 'top',
                    x: 70,
                    y: 20,
                    floating: true,
                    borderWidth: 1,
                    backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
                },
                xAxis: {
                    categories: [@foreach($dates as $date) '{{$date['date']}}', @endforeach ],
                    plotBands: [{
                        from: 4.5,
                        to: 6.5,
                    }],
                    gridLineDashStyle: 'longdash',
                    gridLineWidth: 1,
                    crosshair: true
                },
                yAxis: {
                    title: {
                        text: ''
                    },
                    gridLineDashStyle: 'longdash',
                },
                tooltip: {
                    shared: true,
                    valueSuffix: ' Students'
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    areaspline: {
                        fillOpacity: 0.6
                    }
                },
                series: [

                        @foreach($presents as $key => $value)

                        @php
                            if ($color_count >= $color_total) {
                                $color_count = 0;
                            }
                        @endphp

                    {
                        name: '{{$key}}',
                        data: [ @foreach($value as $item) {{$item['present']}}, @endforeach ],
                        color: '{{$colors[$color_count++]}}',
                    },

                    @endforeach
                ]
            });


        </script>

    @endif

@endsection



