@extends('base')

@section('content')
    <header>
        <!-- Fixed navbar -->
        <nav class="navbar nav navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" data-toggle="tab" href="#basic">{{ $employee->NAME }}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#stats" data-toggle="tab">計畫 <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#great_5" data-toggle="tab">客戶掌握-前五大戶</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#customers" data-toggle="tab">時間管理-現有客戶</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#target_5" data-toggle="tab">客戶掌握-前5大潛戶</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#prev_target_5" data-toggle="tab">年中會客戶掌握-前5大潛戶</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pvdg" data-toggle="tab">時間管理-訪新成長目標</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kpi" data-toggle="tab">領先指標</a>
                    </li>
                </ul>
                <!--<form class="form-inline mt-2 mt-md-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>-->
            </div>
        </nav>
    </header>
    
    <main role="main" class="tab-content">
        <div class="tab-pane" id="basic">
            <div class="list-group">
                <span class="list-group-item">員工代號：{{ $employee->EMDN }}</span>
                <span class="list-group-item">到職日期：{{ $employee->DATEIN }}</span>
                <span class="list-group-item">部門：{{ $employee->DEPT }}</span>
                <span class="list-group-item">職稱：{{ $employee->JOB }}</span>
                <span class="list-group-item">TGP：{{ number_format($srv->TGP) }}</span>
                <span class="list-group-item">2017總毛利：{{ number_format($prev_transaction->GP) }}</span>
                <span class="list-group-item">2018總毛利：{{ number_format($transaction->GP) }}</span>
                <span class="list-group-item">2017總銷量：{{ number_format($prev_vol) }}</span>
                <span class="list-group-item">2018總銷量：{{ number_format($vol) }}</span>
                <span class="list-group-item">2017交易家數：{{ count($prev_gp) }}</span>
                <span class="list-group-item">2018交易家數：{{ count($gp) }}</span>
            </div>
        </div>
        <div class="tab-pane active" id="stats">
        <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="stats_table">
                    <thead>
                        <tr>
                            <th>指標</th>
                            <th>2017實際</th>
                            <th>2018目標</th>
                            <th>2018達成</th>
                            <th>達成率</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>交易家數</td>
                            <td class="number_field">{{ count($prev_gp) }}</td>
                            <td class="number_field">{{ $performance["customers"] }}</td>
                            <td class="number_field">{{ count($gp) }}</td>
                            <td class="number_field"></td>
                        </tr>
                        <tr>
                            <td>新交家數</td>
                            <td class="number_field">{{ $prev_new_cus_num }}</td>
                            <td class="number_field">{{ $performance["new_customers"] }}</td>
                            <td class="number_field">{{ $new_cus_num }}</td>
                            <td class="number_field"></td>
                        </tr>
                        <tr>
                            <td>毛利</td>
                            <td class="number_field">{{ number_format(array_sum($prev_gp) - array_sum($prev_disc)) }}</td>
                            <td class="number_field">{{ number_format($performance["GP"]) }}</td>
                            <td class="number_field">{{ number_format(array_sum($gp) - array_sum($disc)) }}</td>
                            <td class="number_field"></td>
                        </tr>
                        <tr>
                            <td>總銷量</td>
                            <td class="number_field">{{ number_format($prev_vol / 159, 1) }}</td>
                            <td class="number_field">{{ number_format($performance["PCI"], 1) }}</td>
                            <td class="number_field">{{ number_format($vol / 159, 1) }}</td>
                            <td class="number_field"></td>
                        </tr>
                        <tr>
                            <td>工業銷量</td>
                            <td class="number_field">{{ number_format(($prev_vol_vn[25] + $prev_vol_vn[26]) / 159, 1) }}</td>
                            <td class="number_field">{{ number_format($performance["IL"], 1) }}</td>
                            <td class="number_field">{{ number_format(($vol_vn[25] + $vol_vn[26]) / 159, 1) }}</td>
                            <td class="number_field"></td>
                        </tr>
                        <tr>
                            <td>重車銷量</td>
                            <td class="number_field">{{ number_format($prev_vol_vn[24] / 159, 1) }}</td>
                            <td class="number_field">{{ number_format($performance["CVL"], 1) }}</td>
                            <td class="number_field">{{ number_format($vol_vn[24] / 159, 1) }}</td>
                            <td class="number_field"></td>
                        </tr>
                        <tr>
                            <td>小車銷量</td>
                            <td class="number_field">{{ number_format($prev_vol_vn[22] / 159, 1) }}</td>
                            <td class="number_field">{{ number_format($performance["PVL"], 1) }}</td>
                            <td class="number_field">{{ number_format($vol_vn[22] / 159, 1) }}</td>
                            <td class="number_field"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="stats_table_month">
                    <thead>
                        <tr>
                            <th>指標</th>
                            <th>2017實際</th>
                            <th>2018目標</th>
                            <th>2018達成</th>
                            <th>達成率</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>交易家數</td>
                            <td class="number_field">{{ number_format(count($prev_gp) / 12, 1) }}</td>
                            <td class="number_field">{{ number_format($performance["customers"] / 12, 1) }}</td>
                            <td class="number_field">{{ number_format(count($gp) / 6, 1) }}</td>
                            <td class="number_field"></td>
                        </tr>
                        <tr>
                            <td>新交家數</td>
                            <td class="number_field">{{ number_format($prev_new_cus_num / 12, 1)}}</td>
                            <td class="number_field">{{ number_format($performance["new_customers"] / 12, 1) }}</td>
                            <td class="number_field">{{ number_format($new_cus_num / 6, 1) }}</td>
                            <td class="number_field"></td>
                        </tr>
                        <tr>
                            <td>毛利</td>
                            <td class="number_field">{{ number_format((array_sum($prev_gp) - array_sum($prev_disc)) / 12) }}</td>
                            <td class="number_field">{{ number_format($performance["GP"] / 12) }}</td>
                            <td class="number_field">{{ number_format((array_sum($gp) - array_sum($disc)) / 6) }}</td>
                            <td class="number_field"></td>
                        </tr>
                        <tr>
                            <td>總銷量</td>
                            <td class="number_field">{{ number_format($prev_vol / 159 / 12, 1) }}</td>
                            <td class="number_field">{{ number_format($performance["PCI"] / 12, 1) }}</td>
                            <td class="number_field">{{ number_format($vol / 159 / 6, 1) }}</td>
                            <td class="number_field"></td>
                        </tr>
                        <tr>
                            <td>工業銷量</td>
                            <td class="number_field">{{ number_format(($prev_vol_vn[25] + $prev_vol_vn[26]) / 159 / 12, 1) }}</td>
                            <td class="number_field">{{ number_format($performance["IL"] / 12, 1) }}</td>
                            <td class="number_field">{{ number_format(($vol_vn[25] + $vol_vn[26]) / 159 / 6, 1) }}</td>
                            <td class="number_field"></td>
                        </tr>
                        <tr>
                            <td>重車銷量</td>
                            <td class="number_field">{{ number_format($prev_vol_vn[24] / 159 / 12, 1) }}</td>
                            <td class="number_field">{{ number_format($performance["CVL"] / 12, 1) }}</td>
                            <td class="number_field">{{ number_format($vol_vn[24] / 159 / 6, 1) }}</td>
                            <td class="number_field"></td>
                        </tr>
                        <tr>
                            <td>小車銷量</td>
                            <td class="number_field">{{ number_format($prev_vol_vn[22] / 159 / 12, 1) }}</td>
                            <td class="number_field">{{ number_format($performance["PVL"] / 12, 1) }}</td>
                            <td class="number_field">{{ number_format($vol_vn[22] / 159 / 6, 1) }}</td>
                            <td class="number_field"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane" id="great_5">
            <h1>客戶掌握-前五大戶</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="great_5_table">
                    <thead>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 25%;">公司名稱</th>
                            <th style="width: 35%;">地址</th>
                            <th style="width: 15%;">2017毛利</th>
                            <th style="width: 15%;">2018毛利</th>
                            <th style="width: 10%;">說明</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($prev_sr as $i => $customer)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $cus[$customer->AC]->COMPANY }}</td>
                            <td>{{ $cus[$customer->AC]->ADDRESS }}</td>
                            <td class="number_field">{{ number_format($customer->GP) }}</td>
                            <td class="number_field">{{ number_format($gp[$customer->AC]) }}</td>
                            <td></td>
                        </tr>
                        @if ($i == 4)
                            @break
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <div class="tab-pane" id="customers">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="cus_table">
                    <thead>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 25%;">公司名稱</th>
                            <th style="width: 30%;">地址</th>
                            <th style="width: 15%;">2017毛利</th>
                            <th style="width: 15%;">2017折讓</th>
                            <th style="width: 15%;">2018毛利</th>
                            <th style="width: 15%;">2018折讓</th>
                            <th style="width: 10%;">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($customers as $i => $customer)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $customer->COMPANY }}</td>
                            <td>{{ $customer->ADDRESS }}</td>
                            <td class="number_field">{{ number_format($prev_gp[$customer->AC]) }}</td>
                            <td class="number_field">{{ number_format($prev_disc[$customer->AC]) }}</td>
                            <td class="number_field">{{ number_format($gp[$customer->AC]) }}</td>
                            <td class="number_field">{{ number_format($disc[$customer->AC]) }}</td>
                            <td><!--<a href="#" class="btn btn-primary">設定</a>--></td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>總計</th>
                            <th class="number_field">{{ number_format(array_sum($prev_gp)) }}</th>
                            <th class="number_field">{{ number_format(array_sum($prev_disc)) }}</th>
                            <th class="number_field">{{ number_format(array_sum($gp)) }}</th>
                            <th class="number_field">{{ number_format(array_sum($disc)) }}</th>
                            <th><!--<a href="#" class="btn btn-primary">設定</a>--></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel -->
        <div class="tab-pane" id="target_5">
            <h1>客戶掌握-前5大潛戶</h1>
        </div>
        <div class="tab-pane" id="prev_target_5">
            <h1>年中會客戶掌握-前5大潛戶</h1>
        </div>
        <div class="tab-pane" id="pvdg">
            <h1>時間管理-訪新成長目標</h1>
        </div>
        <div class="tab-pane" id="kpi">
            <h1>領先指標</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" id="kpi_table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>公司名稱</th>
                            <th>電話</th>
                            <th>地址</th>
                            <th>2017毛利</th>
                            <th>2018毛利</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($customers as $i => $customer)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $customer->COMPANY }}</td>
                            <td>{{ $customer->TEL }}</td>
                            <td>{{ $customer->ADDRESS }}</td>
                            <td class="number_field">{{-- number_format($customer->prev_gp->GP) --}}</td>
                            <td class="number_field">{{-- //number_format($customer->gp->GP) --}}</td>
                            <td><a href="#" class="btn btn-primary">設定</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
         </div>
    </main>              
@stop