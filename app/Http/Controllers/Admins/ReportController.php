<?php

namespace App\Http\Controllers\Admins;

use Log;
use App\Models\Item;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class ReportController extends Controller
{
    public function showFormOrderBooking(Request $request)
    {

        $startDate = $request->input('start_date', '');
        $endDate = $request->input('end_date', '');


        $orders = collect();
        if ($startDate && $endDate) {
            $orders = Booking::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])->get();

            // Tambahkan alert jika tidak ada data
            if ($orders->isEmpty()) {
                Alert::info('No Data', 'No orders found for the selected date range.');
            }
        }

        return view('pages.admins.reports.order-booking.index', compact('startDate', 'endDate', 'orders'));
    }

    public function generateOrderPdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Debugging untuk memastikan data terisi

        $orders = Booking::with(['item', 'user'])
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->get();

        $successFullOrders = $orders->where('payment_status', 'success');
        $totalOrders = $successFullOrders->sum('total_price');
        $ordersCount = $successFullOrders->count();
        $averagePerOrder = $ordersCount > 0 ? $totalOrders / $ordersCount : 0;
        $highestOrder = $successFullOrders->max('total_price');
        $lowestOrder = $successFullOrders->min('total_price');

        $pdf = FacadePdf::loadView('pages.admins.reports.order-booking.pdf', compact(
            'orders',
            'startDate',
            'endDate',
            'totalOrders',
            'ordersCount',
            'averagePerOrder',
            'highestOrder',
            'lowestOrder'
        ))->setPaper('a4', 'portrait');

        // Add filename with date range
        $filename = 'order_report_' . $startDate . '_to_' . $endDate . '.pdf';

        // Return PDF for stream
        return $pdf->stream($filename);
    }

    public function showFormItem(Request $request)
    {

        $start_date = $request->input('start_date', '');
        $end_date = $request->input('end_date', '');

        $items = collect();
        if ($start_date && $end_date) {
            $items = Item::with(['type', 'brand'])
                ->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59'])
                ->get();

            // Tambahkan alert jika tidak ada data
            if ($items->isEmpty()) {
                Alert::info('No Data', 'No item cars found for the selected date range.');
            }
        }

        return view('pages.admins.reports.item-cars.index', compact('start_date', 'end_date', 'items'));
    }

    public function generateItemPdf(Request $request)
    {

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $items = Item::with(['type', 'brand'])
            ->withCount(['bookings as sales' => function ($query) {
                $query->where('payment_status', 'success');
            }])
            ->withSum(['bookings as total_sales_rupiah' => function ($query) {
                $query->where('payment_status', 'success');
            }], 'total_price')
            ->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59'])
            ->get();

        $pdf = FacadePdf::loadView('pages.admins.reports.item-cars.pdf', compact(
            'items',
            'start_date',
            'end_date'
        ))->setPaper('a4', 'portrait');

        return $pdf->stream('item_report_' . $start_date . '_to_' . $end_date . '.pdf');
    }
}
