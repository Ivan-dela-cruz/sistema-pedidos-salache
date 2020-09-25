<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Order;
use App\Company;
use Barryvdh\DomPDF\Facade as PDF;

class ReportController extends Controller
{
    public function index(Request $request)
    {

        $request_month = $request->month;
        $request_year = $request->year;
        $company = $request->company;

        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month;
        $day = $now->day;

        $orders_month = Order::whereMonth('created_at', $month)->count();
        $orders_month_val = Order::whereMonth('created_at', $month)->sum("total");
        $orders_year = Order::whereYear('created_at', $year)->count();
        $orders_year_val = Order::whereYear('created_at', $year)->sum("total");

        $companies = Company::orderBy('company_name', 'ASC')->pluck('company_name', 'id');
        if ($request_month == 0) {
            $orders = Order::whereYear('created_at', $request_year)->where('id_company', $company)->get();
        } else {
            $orders = Order::whereMonth('created_at', $request_month)->whereYear('created_at', $request_year)->where('id_company', $company)->get();
        }

        return view('admin.reports.index', compact('orders_month', 'orders_year', 'orders', 'orders_month_val', 'orders_year_val', 'request_month', 'request_year', 'companies', 'company'));
    }

    public function getPdf(Request $request)
    {
        $request_month = $request->month;
        $request_year = $request->year;
        $company = $request->company;
        if ($request_month == 0) {
            $orders = Order::whereYear('created_at', $request_year)->where('id_company', $company)->get();
        } else {
            $orders = Order::whereMonth('created_at', $request_month)->whereYear('created_at', $request_year)->where('id_company', $company)->get();
        }
        $pdf = PDF::loadView('pdf.orders', compact('orders', 'request_month', 'request_year'));
        //$pdf->setPaper('A4', 'landscape');
        $nombrePdf = 'reporte de ordenes -' . time() . '.pdf';
        return $pdf->download($nombrePdf);
    }

    public function getPdfAllMonth()
    {
        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month;
        $day = $now->day;
        $orders = Order::whereMonth('created_at', $month)->get();
        $pdf = PDF::loadView('pdf.report_month', compact('orders'));
        //$pdf->setPaper('A4', 'landscape');
        $nombrePdf = 'reporte de ordenes -' . time() . '.pdf';
        return $pdf->download($nombrePdf);
    }

    public function getPdfYear()
    {
        $now = Carbon::now();
        $month = $now->month;
        $year = $now->year;
        $orders = Order::whereYear('created_at', $year)->get();
        $pdf = PDF::loadView('pdf.report_year', compact('orders'));
        //$pdf->setPaper('A4', 'landscape');
        $nombrePdf = 'reporte de ordenes -' . time() . '.pdf';
        return $pdf->download($nombrePdf);
    }

    public function allcompanies(Request $request)
    {

        $request_month = $request->month;
        $request_year = $request->year;
        $company = "";

        $now = Carbon::now();
        $year = $now->year;
        $month = $now->month;
        $day = $now->day;

        $orders_month = Order::whereMonth('created_at', $month)->count();
        $orders_month_val = Order::whereMonth('created_at', $month)->sum("total");
        $orders_year = Order::whereYear('created_at', $year)->count();
        $orders_year_val = Order::whereYear('created_at', $year)->sum("total");

        if ($request_month == 0) {
            $orders = Order::whereYear('created_at', $request_year)->get();
        } else {
            $orders = Order::whereMonth('created_at', $request_month)->whereYear('created_at', $request_year)->get();
        }

        return view('admin.reports.allcompanies', compact('orders_month', 'orders_year', 'orders', 'orders_month_val', 'orders_year_val', 'request_month', 'request_year', 'company'));
    }
    public function getPdfAll(Request $request)
    {
        $request_month = $request->month;
        $request_year = $request->year;
        $company = "";
        if ($request_month == 0) {
            $orders = Order::whereYear('created_at', $request_year)->get();
        } else {
            $orders = Order::whereMonth('created_at', $request_month)->whereYear('created_at', $request_year)->get();
        }
        $pdf = PDF::loadView('pdf.orders', compact('orders', 'request_month', 'request_year'));
        //$pdf->setPaper('A4', 'landscape');
        $nombrePdf = 'reporte de ordenes -' . time() . '.pdf';
        return $pdf->download($nombrePdf);
    }
}
