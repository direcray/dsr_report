@extends('blank')

@section('content')
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">{{ $customer->COMPANY }}</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-4">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            系統資訊
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
                                <ul>
                                    <li>客戶帳號：{{ $customer->AC }}-{{ $customer->B }}</li>
                                    <li>建檔日期：{{ $customer->DATE }}</li>
                                    <li>建檔人員：{{ $customer->NAME }}</li>
                                    <li>負責業務：{{ $customer->employee() == null ? $customer->EMDN : $customer->employee->NAME }}</li>
                                </ul>
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
                            客戶基本資訊
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
                                    <li>負責人：{{ $customer->BOSS }}</li>
                                    <li>聯絡人：{{ $customer->ATTN }}</li>
                                    <li>統編：{{ $customer->GN }}</li>
                                    <li>電話：{{ $customer->TEL }}</li>
                                    <li>傳真：{{ $customer->FAX }}</li>
                                    <li>地址：{{ $customer->ZIP }} {{ $customer->ADDRESS }}</li>
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
                            <i class="fa fa-bar-chart-o fa-fw"></i> 其他資訊
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
                                        <li>{{ $customer->NOTE }}</li>
                                        <li>{{ $customer->IV_NOTE }}</li>
                                        <li>{{ $customer->OTHER_NOTE }}</li>
                                    </ul>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>負責業務</th>
                                                    <th>公司名稱</th>
                                                    <th>電話</th>
                                                    <th>地址</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $customer->AC }}</td>
                                                    <td>{{ $customer->employee() == null ? $customer->EMDN : $customer->employee->NAME }}</td>
                                                    <td><a href="{{action('CustomerController@view', $customer->ID)}}">{{ $customer->COMPANY }}</a></td>
                                                    <td>{{ $customer->TEL }}</td>
                                                    <td>{{ $customer->ADDRESS }}</td>
                                                </tr>
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
