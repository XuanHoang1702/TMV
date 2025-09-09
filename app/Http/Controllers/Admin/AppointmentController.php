<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AppointmentsExport;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::query();

        // Filter by status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->date_from) {
            $query->whereDate('appointment_date', '>=', $request->date_from);
        }
        if ($request->date_to) {
            $query->whereDate('appointment_date', '<=', $request->date_to);
        }

        $appointments = $query->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->paginate(15);

        return view('admin.appointments.index', compact('appointments'));
    }

    public function show(Appointment $appointment)
    {
        return view('admin.appointments.show', compact('appointment'));
    }

    public function updateStatus(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'notes' => 'nullable|string'
        ]);

        $appointment->update($validated);

        // Send notification email to customer
        if ($request->notify_customer) {
            // Mail::to($appointment->customer_email)->send(new AppointmentStatusUpdate($appointment));
        }

        return back()->with('success', 'Trạng thái lịch hẹn đã được cập nhật');
    }

    public function calendar()
    {
        $appointments = Appointment::whereMonth('appointment_date', now()->month)
            ->whereYear('appointment_date', now()->year)
            ->get();

        return view('admin.appointments.calendar', compact('appointments'));
    }

    public function export(Request $request)
    {
        $query = Appointment::query();

        if ($request->date_from && $request->date_to) {
            $query->whereBetween('appointment_date', [$request->date_from, $request->date_to]);
        }

        $appointments = $query->orderBy('appointment_date')->get();

        return Excel::download(new AppointmentsExport($appointments), 'appointments.xlsx');
    }
}
