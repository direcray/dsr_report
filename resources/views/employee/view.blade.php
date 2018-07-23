@extends('blank')

@section('content')
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12" style="height: 70px">
                    <h1 class="page-header" style="margin: 10px">{{ $employee->NAME }}</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-4">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            基本資訊
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row list-group" style="padding: 30px;">
                                <span class="list-group-item">員工代號：{{ $employee->EMDN }}</span>
                                <span class="list-group-item">到職日期：{{ $employee->DATEIN }}</span>
                                <span class="list-group-item">部門：{{ $employee->DEPT }}</span>
                                <span class="list-group-item">職稱：{{ $employee->JOB }}</span>
                                <span class="list-group-item">TGP：{{ number_format($srv->TGP) }}</span>
                                <span class="list-group-item">2017總毛利：{{ number_format($old_transaction->GP) }}</span>
                                <span class="list-group-item">2018總毛利：{{ number_format($transaction->GP) }}</span>
                                <span class="list-group-item">2017總銷量：{{ number_format($old_volume->TLT) }}</span>
                                <span class="list-group-item">2018總銷量：{{ number_format($volume->TLT) }}</span>
                                <span class="list-group-item">2017交易家數：{{ $old_customer_count }}</span>
                                <span class="list-group-item">2018交易家數：{{ $customer_count }}</span>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    
                </div>
                <!-- /.col-lg-4 -->

                <div class="col-lg-8">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            聯絡資訊
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                <ul>
                                    <li>電話：{{ $employee->TEL }}</li>
                                    <li>地址：{{ $employee->ZIP }} {{ $employee->ADDRESS }}</li>
                                </ul>
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    
                </div>
                <!-- /.col-lg-4 -->

                <div class="col-lg-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> 客戶資訊
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped" id="cus_table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>公司名稱</th>
                                                    <th>電話</th>
                                                    <th>地址</th>
                                                    <th>2017毛利</th>
                                                    <th>2018毛利</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($customers as $customer)
                                                <tr>
                                                    <td>{{ $i ++ }}</td>
                                                    <td>{{ $customer->COMPANY }}</td>
                                                    <td>{{ $customer->TEL }}</td>
                                                    <td>{{ $customer->ADDRESS }}</td>
                                                    <td class="number_field">{{-- number_format($customer->old_gp->GP) --}}</td>
                                                    <td class="number_field">{{-- //number_format($customer->gp->GP) --}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    
                </div>
                <!-- /.col-lg-4 -->





            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

@stop
