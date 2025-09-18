<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Information;
use App\Models\News;
use App\Models\Service;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_services' => Service::count(),
            'total_news' => News::count(),
            'pending_appointments' => Appointment::where('status', 'pending')->count(),
            'total_contacts' => Information::where('is_read', false)->count(),
            'monthly_appointments' => Appointment::whereMonth('created_at', now()->month)->count(),
            'yearly_revenue' => Appointment::whereYear('created_at', now()->year)
                ->where('status', 'completed')
                ->sum('estimated_price')
        ];

        $recentAppointments = Appointment::latest()->take(5)->get();
        $recentContacts = Information::where('is_read', false)->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentAppointments', 'recentContacts'));
    }

    public function getAppointmentChart()
    {
        $data = Appointment::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json($data);
    }
}
