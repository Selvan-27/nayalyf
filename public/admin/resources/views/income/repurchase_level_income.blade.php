@extends('layout.admin') @section('content')
<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3> Repurchase Level Bonus List </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="/admin_home">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Income Report</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                   
                                    <form method="get" action="/reports">
    <select name="slot" class="form-select" onchange="this.form.submit()">
        <option value="">-- Select Cut-Off --</option>
        @foreach ($repurchase_cutoff_slots as $option)
            <option value="{{ $option->id }}" {{ request('slot') == $option->id ? 'selected' : '' }}>
                 {{  $option->name }}
            </option>
        @endforeach
    </select>
    
    <input type="hidden" name="type" value="repurchase_level_income">
</form>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                
                <div class="card-body vendor-table">
                    <div class="card-header">
                        <a href="#" class="btn btn-primary mt-md-0 mt-2">Download Report</a>
                    </div>
                    <h3 class="text-center">[cut-off] Re-Purchase Level Income List</h3>
                    <table class="table table-responsive" id="basic-1">
                        <thead>
                            <tr>
                                
                                <th>Member</th>
                                <th>Cut-Off</th>
                                <th>Level 1 (₹ 40)</th>
                                <th>Level 2 (₹ 40)</th>
                                <th>Level 3 (₹ 30)</th>
                                <th>Level 3 (₹ 30)</th>
                                <th>Level 3 (₹ 30)</th>
                                <th>Level 3 (₹ 20)</th>
                                <th>Level 2 (₹ 10)</th>
                                <th>Level 1 (₹ 8)</th>
                                <th>Level 9 (₹ 8)</th>
                                <th>Level 10 (₹ 8)</th>
                                <th>Level 11 (₹ 8)</th>
                                <th>Level 12 (₹ 8)</th>
                                <th>Level 13 (₹ 5)</th>
                                <th>Level 14 (₹ 5)</th>
                                <th>Total Bonus</th>
                                
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($data) > 0)
                                @foreach($data as $record)
                                <tr>
                                    <td>
                                        <div class="d-flex vendor-list">
                                            <img src="{{ $record['member']->profile_photo ? asset('storage/' . $record['member']->profile_photo) : 'assets/images/team/default.jpg' }}" alt=""
                                                class="img-fluid img-40 rounded-circle blur-up lazyloaded">
                                            <span>{{ $record['member']->name }} <br><small>{{ $record['member']->memberid }}</small></span>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $record['cutoff_slot']->name }}<br>
                                        From: {{ date('d/M/Y', strtotime($record['cutoff_slot']->from_date)) }}<br>
                                        To: {{ date('d/M/Y', strtotime($record['cutoff_slot']->to_date)) }}
                                    </td>
                                    
                                    <!-- Level 1 (₹ 40) -->
                                    <td>
                                       {{ number_format($record['level_incomes'][1]['amount'], 0) }}<br>
                                        <small>For {{ $record['level_incomes'][1]['count'] }} RP</small>
                                    </td>
                                    
                                    <!-- Level 2 (₹ 40) -->
                                    <td>
                                       {{ number_format($record['level_incomes'][2]['amount'], 0) }}<br>
                                        <small>For {{ $record['level_incomes'][2]['count'] }} RP</small>
                                    </td>
                                    
                                    <!-- Level 3 (₹ 30) -->
                                    <td>
                                       {{ number_format($record['level_incomes'][3]['amount'], 0) }}<br>
                                        <small>For {{ $record['level_incomes'][3]['count'] }} RP</small>
                                    </td>
                                    
                                    <!-- Level 4 (₹ 30) -->
                                    <td>
                                       {{ number_format($record['level_incomes'][4]['amount'], 0) }}<br>
                                        <small>For {{ $record['level_incomes'][4]['count'] }} RP</small>
                                    </td>
                                    
                                    <!-- Level 5 (₹ 30) -->
                                    <td>
                                       {{ number_format($record['level_incomes'][5]['amount'], 0) }}<br>
                                        <small>For {{ $record['level_incomes'][5]['count'] }} RP</small>
                                    </td>
                                    
                                    <!-- Level 6 (₹ 20) -->
                                    <td>
                                       {{ number_format($record['level_incomes'][6]['amount'], 0) }}<br>
                                        <small>For {{ $record['level_incomes'][6]['count'] }} RP</small>
                                    </td>
                                    
                                    <!-- Level 7 (₹ 10) -->
                                    <td>
                                       {{ number_format($record['level_incomes'][7]['amount'], 0) }}<br>
                                        <small>For {{ $record['level_incomes'][7]['count'] }} RP</small>
                                    </td>
                                    
                                    <!-- Level 8 (₹ 8) -->
                                    <td>
                                       {{ number_format($record['level_incomes'][8]['amount'], 0) }}<br>
                                        <small>For {{ $record['level_incomes'][8]['count'] }} RP</small>
                                    </td>
                                    
                                    <!-- Level 9 (₹ 8) -->
                                    <td>
                                       {{ number_format($record['level_incomes'][9]['amount'], 0) }}<br>
                                        <small>For {{ $record['level_incomes'][9]['count'] }} RP</small>
                                    </td>
                                    
                                    <!-- Level 10 (₹ 8) -->
                                    <td>
                                       {{ number_format($record['level_incomes'][10]['amount'], 0) }}<br>
                                        <small>For {{ $record['level_incomes'][10]['count'] }} RP</small>
                                    </td>
                                    
                                    <!-- Level 11 (₹ 8) -->
                                    <td>
                                       {{ number_format($record['level_incomes'][11]['amount'], 0) }}<br>
                                        <small>For {{ $record['level_incomes'][11]['count'] }} RP</small>
                                    </td>
                                    
                                    <!-- Level 12 (₹ 8) -->
                                    <td>
                                       {{ number_format($record['level_incomes'][12]['amount'], 0) }}<br>
                                        <small>For {{ $record['level_incomes'][12]['count'] }} RP</small>
                                    </td>
                                    
                                    <!-- Level 13 (₹ 5) -->
                                    <td>
                                       {{ number_format($record['level_incomes'][13]['amount'], 0) }}<br>
                                        <small>For {{ $record['level_incomes'][13]['count'] }} RP</small>
                                    </td>
                                    
                                    <!-- Level 14 (₹ 5) -->
                                    <td>
                                       {{ number_format($record['level_incomes'][14]['amount'], 0) }}<br>
                                        <small>For {{ $record['level_incomes'][14]['count'] }} RP</small>
                                    </td>
                                    
                                    <!-- Total Bonus -->
                                    <td>₹ {{ number_format($record['total_bonus'], 0) }}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="17" class="text-center">
                                        @if(request('slot'))
                                            No repurchase level income found for the selected cut-off period.
                                        @else
                                            Please select a cut-off period to view the report.
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




</div>
@stop