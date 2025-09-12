<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AppointmentsExport;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::with('service');

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

        if ($request->ajax()) {
            return view('admin.appointments._table', compact('appointments'));
        }

        return view('admin.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $services = \App\Models\Service::all();
        return view('admin.appointments.create', compact('services'));
    }

    public function edit(Appointment $appointment)
    {
        $services = \App\Models\Service::all();
        return view('admin.appointments.edit', compact('appointment', 'services'));
    }

    public function show(Appointment $appointment)
    {
        return view('admin.appointments.show', compact('appointment'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'notes' => 'nullable|string'
        ]);

        $appointment->update($validated);

        return redirect()->route('admin.appointments.index')->with('success', 'Lịch hẹn đã được cập nhật');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('admin.appointments.index')->with('success', 'Lịch hẹn đã được xóa');
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name'     => 'required|string|max:255',
            'customer_email'    => 'required|email|max:255',
            'customer_phone'    => 'required|string|max:20',
            'service_id'        => 'nullable|exists:services,id',
            'appointment_date'  => 'required|date|after_or_equal:today',
            'appointment_time'  => 'required|date_format:H:i',
            'status'            => 'required|in:pending,confirmed,completed,cancelled',
            'notes'             => 'nullable|string|max:1000',
        ]);

        Appointment::create($validated);

        return redirect()->route('admin.appointments.index')->with('success', 'Lịch hẹn đã được tạo thành công!');
    }

    public function storeFrontend(Request $request)
    {
        $validated = $request->validate([
            'customer_name'  => 'required|string|min:3|max:255',
            'customer_phone'    => 'required|digits:10',
            'service_id'        => 'required|exists:services,id',
            'appointment_time'  => 'required',
            'appointment_date'  => 'required|date',
            'notes'             => 'nullable|string|max:1000',
        ]);

        $validated['status'] = 'pending';

        $service = Service::find($validated['service_id']);
        $validated['estimated_price'] = $service ? $service->price_range : 0;
        
        Appointment::create($validated);

        return redirect()->back()->with('success', 'Đặt lịch hẹn thành công, Chúng tôi sẽ liên hệ với bạn sớm nhất!');
    }
}
