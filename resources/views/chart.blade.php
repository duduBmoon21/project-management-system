
<div class="row">
    @if(in_array('projects',$modules) && in_array('status_wise_project',$activeWidgets))
        <div class="col-md-6">
            <div class="panel panel-inverse">
                <div class="panel-heading">@lang('modules.dashboard.statusWiseProject')
                    <a href="javascript:;" data-chart-id="statusWiseProject" class="text-dark pull-right download-chart">
                        <i class="fa fa-download"></i> @lang('app.download')
                    </a>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12">

                                @if(!empty(json_decode($statusWiseProject)))
                                    <div>
                                        <canvas id="statusWiseProject"></canvas>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <div class="empty-space" style="height: 200px;">
                                            <div class="empty-space-inner">
                                                <div class="icon" style="font-size:30px"><i class="icon-layers"></i></div>
                                                <div class="title m-b-15">@lang('messages.noProjectFound')</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    @endif
    @if(in_array('projects',$modules) && in_array('pending_milestone',$activeWidgets))
        <div class="col-md-6">
            <div class="panel panel-inverse">
                <div class="panel-heading">@lang('modules.dashboard.pendingMilestone')</div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>@lang('app.milestone')</th>
                                    <th>@lang('app.project')</th>
                                    <th>@lang('app.amount')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendingMilestone as $milestone)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.milestones.show', $milestone->project_id) }}" class="font-12">{{ ucwords($milestone->milestone_title) }}</a>                                        
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.projects.show', $milestone->project_id) }}" class="font-12">{{ ucwords($milestone->project_name) }}</a>
                                    </td>
                                    <td>{{ $milestone->currency_symbol . $milestone->cost }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3">
                                        @lang("messages.noRecordFound")
                                    </td>
                                    
                                </tr>
                               
                            @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    @endif
</div>



<script src="{{ asset('js/Chart.min.js') }}"></script>

<script>
    $(document).ready(function () {
        @if(!empty(json_decode($statusWiseProject)) && in_array('projects',$modules) && in_array('status_wise_project',$activeWidgets))
            function statusWiseProjectPieChart(statusWiseProject) {
                var ctx2 = document.getElementById("statusWiseProject");
                var data = new Array();
                var color = new Array();
                var labels = new Array();
                var total = 0;

                $.each(statusWiseProject, function(key,val){
                    labels.push(val.status.toUpperCase());
                    data.push(parseInt(val.totalProject));
                    total = total+parseInt(val.totalProject);
                    if (val.status == "in progress") {
                        color.push("#03a9f3");
                    } else if (val.status == "on hold") {
                        color.push("#fec107");
                    } else if (val.status == "not started") {
                        color.push("#fec107");
                    } else if (val.status == "canceled") {
                        color.push("#fb9678");
                    } else if (val.status == "finished") {
                        color.push("#00c292");
                    }
                });

                // labels.push('Total '+total);
                var chart = new Chart(ctx2,{
                    "type":"doughnut",
                    "data":{
                        "labels":labels,
                        "datasets":[{
                            "data":data,
                            "backgroundColor":color
                        }]
                    }
                });
                chart.canvas.parentNode.style.height = '470px';
            }
            statusWiseProjectPieChart(jQuery.parseJSON('{!! $statusWiseProject !!}'));

        @endif


        function getRandomColor() {
            var letters = '0123456789ABCDEF'.split('');
            var color = '#';
            for (var i = 0; i < 6; i++ ) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        $('.download-chart').click(function() {
            var id = $(this).data('chart-id');
            this.href = $('#'+id)[0].toDataURL();// Change here
            this.download = id+'.png';
        });

    });

    
    
</script>