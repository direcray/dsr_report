@extends('blank')

@section('content')
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">客戶清單</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-lg-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Bar Chart Example
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
                                                    <th>負責業務</th>
                                                    <th>公司名稱</th>
                                                    <th>電話</th>
                                                    <th>地址</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($customers as $customer)
                                                <tr>
                                                    <td>{{ $customer->AC }}</td>
                                                    <td>{{ $customer->employee() == null ? $customer->EMDN : $customer->employee->NAME }}</td>
                                                    <td><a href="{{action('CustomerController@view', $customer->ID)}}">{{ $customer->COMPANY }}</a></td>
                                                    <td>{{ $customer->TEL }}</td>
                                                    <td>{{ $customer->ADDRESS }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $customers->links() }}
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
                <!-- /.col-lg-8 -->

            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
@stop
