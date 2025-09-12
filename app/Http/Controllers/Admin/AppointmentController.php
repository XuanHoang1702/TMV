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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name'     => 'required|string|max:255',
            'customer_email'    => 'required|email|max:255',
            'customer_phone'    => 'required|string|max:20',
            'appointment_date'  => 'required|date|after_or_equal:today',
            'appointment_time'  => 'required|date_format:H:i',
            'notes'             => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        } else {
            $appointment = Appointment::create([
                'customer_name'    => $request->customer_name,
                'customer_email'   => $request->customer_email,
                'customer_phone'   => $request->customer_phone,
                'appointment_date' => $request->appointment_date,
                'appointment_time' => $request->appointment_time,
                'status'           => $request->status,
                'notes'            => $request->notes,
            ]);

            return response()->json([
                'message' => 'Lịch hẹn đã được tạo thành công!',
                'data'    => $appointment,
            ], 201);
        }
    }



}
