<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Customer;
use App\SRV;
use App\Transaction;
use App\OldTransaction;
use App\Payment;
use App\KPI;
use DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::where('DATEOUT', '=', '0000-00-00')->where('JOB', '=', '業務')->orderBy('EMDN', 'desc')->paginate(30);

        return view('employee.index',compact('employees'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $employee = Employee::where('EMDN', $id)->first();
        $srv = $employee->service_records()->where('MTH', '201806')->first();
        $customers = $employee->customers()->where('B', '=', '0000')->get();
        $i = 0;
        $ac_cond = " AND `AC` in (";
        foreach ($customers as $customer) {
            $i ++;
            if ($i == 1) {
                $ac_cond .= "'". $customer->AC. "'";
            } else {
                $ac_cond .= ",'". $customer->AC. "'";
            }
            /*
            $prev_gp = OldTransaction::selectRaw("SUM(`QTY`*(`UP`-`UC`)) AS `GP`")
                        ->whereRaw("`OPT` IN ('0', '1', '3') AND `AC`='". $customer->AC. "'")
                        ->first();

            $gp = Transaction::selectRaw("SUM(`QTY`*(`UP`-`UC`)) AS `GP`")
                        ->whereRaw("`OPT` IN ('0', '1', '3') AND `AC`='". $customer->AC. "' AND `DATE` >= '2018-01-01'")
                        ->first();
            */
            //$customer->prev_gp = $prev_gp;
            //$customer->gp = $gp;
        }
        $ac_cond .= ")";

        $prev_transaction = OldTransaction::selectRaw("SUM(`QTY`*(`UP`-`UC`)) AS `GP`")
        ->whereRaw("`OPT` IN ('0', '1', '3')" . $ac_cond)
        ->first();

        $transaction = Transaction::selectRaw("SUM(`QTY`*(`UP`-`UC`)) AS `GP`")
        ->whereRaw("`OPT` IN ('0', '1', '3') AND `DATE` >= '2018-01-01'" . $ac_cond)
        ->first();

        $prev_volume = Transaction::selectRaw("SUM(`QTY`*`LT`) AS `TLT`")
        ->whereRaw("`OPT` IN ('0', '1', '3') AND `DATE` >= '2017-01-01' AND `DATE` <= '2017-12-31'" . $ac_cond)
        ->first();

        $volume = Transaction::selectRaw("SUM(`QTY`*`LT`) AS `TLT`")
        ->whereRaw("`OPT` IN ('0', '1', '3') AND `DATE` >= '2018-01-01'" . $ac_cond)
        ->first();

        $prev_customer_count = OldTransaction::whereRaw("`OPT` IN ('0', '1', '3')" . $ac_cond)
        ->distinct('AC')->count('AC');

        $customer_count = Transaction::whereRaw("`OPT` IN ('0', '1', '3') AND `DATE` >= '2018-01-01' " . $ac_cond)
        ->distinct('AC')->count('AC');

        $i = 1;

        return view('employee.view', compact('employee', 'customers', 'srv', 'prev_transaction', 'transaction', 'prev_volume', 'volume', 'prev_customer_count', 'customer_count', 'i'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dsr_report($id)
    {
        // 取得業務在 EMD 的資料
        $employee = Employee::where('EMDN', $id)->first();
        // 取得業務在 SRV 的資料，這裡指定 201807 ，之後需要用別的方法來改。
        $srv = $employee->service_records()->where('MTH', '201807')->first();
        // 取得該業務所有的客戶的總公司 (B=0000)
        $customers = $employee->customers()->where('B', '=', '0000')->get();

        // 把所有客戶的 AC 串成字串
        $i = 0;
        $ac_cond = " AND `AC` in (";
        foreach ($customers as $customer) {
            $i ++;
            if ($i == 1) {
                $ac_cond .= "'". $customer->AC. "'";
            } else {
                $ac_cond .= ",'". $customer->AC. "'";
            }
        }
        $ac_cond .= ")";

        $new_cus_num = 0;
        $prev_new_cus_num = 0;
        foreach($customers as $customer) {
            $cus[$customer->AC] = $customer;
            $prev_disc[$customer->AC] = 0;
            $disc[$customer->AC] = 0;
            $prev_gp[$customer->AC] = 0;
            $gp[$customer->AC] = 0;
            if ($customer->DATE >= '2017-01-01' && $customer->DATE <= '2017-12-31') $prev_new_cus_num ++;
            if ($customer->DATE >= '2018-01-01' && $customer->DATE <= '2018-06-30') $new_cus_num ++;
        }

        // 取得業務在 KPI_Sales 的資料
        $kpis = KPI::where('EMDN', $id)->get();
        foreach($kpis as $kpi) {
            $performance[$kpi->KPI] = $kpi->TARGET;
        }
        if (!isset($performance['PVL'])) $performance['PVL'] = 0;
        if (!isset($performance['CVL'])) $performance['CVL'] = 0;
        if (!isset($performance['IL'])) $performance['IL'] = 0;
        if (!isset($performance['customers'])) $performance['customers'] = 0;
        if (!isset($performance['new_customers'])) $performance['new_customers'] = 0;
        if (!isset($performance['GP'])) $performance['GP'] = 0;
        $performance['PCI'] = $performance['PVL'] + $performance['CVL'] + $performance['IL'];

        $prev_transaction = OldTransaction::selectRaw("SUM(`QTY`*(`UP`-`UC`)) AS `GP`")
            ->whereRaw("`OPT` IN ('0', '1', '3')" . $ac_cond)
            ->first();

        $transaction = Transaction::selectRaw("SUM(`QTY`*(`UP`-`UC`)) AS `GP`")
            ->whereRaw("`OPT` IN ('0', '1', '3') AND `DATE` >= '2018-01-01' AND `DATE` <= '2018-06-30'" . $ac_cond)
            ->first();


        $prev_payments = DB::table('PAIN')
                        ->join('PAID', 'PAIN.PDNO', '=', 'PAID.PDNO')
                        ->selectRaw('`PAIN`.`AC`, SUM(`PAID`.`DEBIT`) AS `DISC`')
                        ->whereRaw("`PAID`.`DESCRIPT` LIKE '%折%' AND `PAIN`.`DATE` BETWEEN '2017-01-01' AND '2017-12-31'". $ac_cond)
                        ->groupBy('AC')
                        ->get();
        foreach ($prev_payments as $payment) {
            $prev_disc[$payment->AC] = $payment->DISC;
        }
        $payments = DB::table('PAIN')
                        ->join('PAID', 'PAIN.PDNO', '=', 'PAID.PDNO')
                        ->selectRaw('`PAIN`.`AC`, SUM(`PAID`.`DEBIT`) AS `DISC`')
                        ->whereRaw("`PAID`.`DESCRIPT` LIKE '%折%' AND `PAIN`.`DATE` BETWEEN '2018-01-01' AND '2018-06-30'". $ac_cond)
                        ->groupBy('AC')
                        ->get();
        foreach ($payments as $payment) {
            $disc[$payment->AC] = $payment->DISC;
        }

        $sr = Transaction::selectRaw("AC, SUM(`QTY`*(`UP`-`UC`)) AS `GP`")
            ->whereRaw("`OPT` IN ('0', '1', '3') AND `DATE` >= '2018-01-01' AND `DATE` <= '2018-06-30'" . $ac_cond)
            ->groupBy('AC')
            ->orderBy('GP', 'desc')
            ->get();
        foreach ($sr as $rec) {
            $gp[$rec->AC] = $rec->GP;
        }

        $prev_sr = OldTransaction::selectRaw("AC, SUM(`QTY`*(`UP`-`UC`)) AS `GP`")
            ->whereRaw("`OPT` IN ('0', '1', '3')" . $ac_cond)
            ->groupBy('AC')
            ->orderBy('GP', 'desc')
            ->get();
        foreach ($prev_sr as $rec) {
            $prev_gp[$rec->AC] = $rec->GP;
        }

        $sr = Transaction::selectRaw("AC, SUM(`QTY`*(`UP`-`UC`)) AS `GP`")
            ->whereRaw("`OPT` IN ('0', '1', '3') AND `DATE` >= '2018-01-01' AND `DATE` <= '2018-06-30'" . $ac_cond)
            ->groupBy('AC')
            ->orderBy('GP', 'desc')
            ->get();
        foreach ($sr as $rec) {
            $gp[$rec->AC] = $rec->GP;
        }


        $prev_vol_vn = array();
        $prev_vol_ac = array();
        $prev_tr = Transaction::selectRaw("`AC`, `VN`, SUM(`QTY`*`LT`) AS `TLT`")
            ->whereRaw("`OPT` IN ('0', '1', '3') AND `DATE` >= '2017-01-01' AND `DATE` <= '2017-12-31'" . $ac_cond)
            ->groupBy('AC', 'VN')
            ->get();
        foreach ($prev_tr as $rec) {
            if (!array_key_exists($rec->VN, $prev_vol_vn)) $prev_vol_vn[$rec->VN] = 0;
            if (!array_key_exists($rec->AC, $prev_vol_ac)) $prev_vol_ac[$rec->AC] = 0;
            if (!isset($prev_vol)) $prev_vol = 0;
            $prev_vol_vn[$rec->VN] += $rec->TLT;
            $prev_vol_ac[$rec->AC] += $rec->TLT;
            $prev_vol += $rec->TLT;
        }
        if (!array_key_exists(22, $prev_vol_vn)) $prev_vol_vn[22] = 0;
        if (!array_key_exists(24, $prev_vol_vn)) $prev_vol_vn[24] = 0;
        if (!array_key_exists(25, $prev_vol_vn)) $prev_vol_vn[25] = 0;
        if (!array_key_exists(26, $prev_vol_vn)) $prev_vol_vn[26] = 0;

        $vol_vn = array();
        $vol_ac = array();
        $tr = Transaction::selectRaw("`AC`, `VN`, SUM(`QTY`*`LT`) AS `TLT`")
        ->whereRaw("`OPT` IN ('0', '1', '3') AND `DATE` >= '2018-01-01' AND `DATE` <= '2018-06-30'" . $ac_cond)
        ->groupBy('AC', 'VN')
        ->get();
        foreach ($tr as $rec) {
            if (!array_key_exists($rec->VN, $vol_vn)) $vol_vn[$rec->VN] = 0;
            if (!array_key_exists($rec->AC, $vol_ac)) $vol_ac[$rec->AC] = 0;
            if (!isset($vol)) $vol = 0;
            $vol_vn[$rec->VN] += $rec->TLT;
            $vol_ac[$rec->AC] += $rec->TLT;
            $vol += $rec->TLT;
        }
        if (!array_key_exists(22, $vol_vn)) $vol_vn[22] = 0;
        if (!array_key_exists(24, $vol_vn)) $vol_vn[24] = 0;
        if (!array_key_exists(25, $vol_vn)) $vol_vn[25] = 0;
        if (!array_key_exists(26, $vol_vn)) $vol_vn[26] = 0;

        $vars[] = "employee";
        $vars[] = "customers";
        $vars[] = "cus";
        $vars[] = "srv";
        $vars[] = "prev_gp";
        $vars[] = "gp";
        $vars[] = "prev_transaction";
        $vars[] = "transaction";
        $vars[] = "prev_volume";
        $vars[] = "volume";
        $vars[] = "prev_sr";
        $vars[] = "prev_vol";
        $vars[] = "prev_vol_vn";
        $vars[] = "prev_vol_ac";
        $vars[] = "vol";
        $vars[] = "vol_vn";
        $vars[] = "vol_ac";
        $vars[] = "prev_new_cus_num";
        $vars[] = "new_cus_num";
        $vars[] = "performance";
        $vars[] = "prev_disc";
        $vars[] = "disc";
        return view('employee.dsr', compact($vars));
    }
}