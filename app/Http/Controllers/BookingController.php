<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Menampilkan form booking
     */
    public function create(Request $request): \Illuminate\View\View
    {
        $service = null;
        if ($request->has('service')) {
            $service = Service::findOrFail($request->service);
        }

        $services = Service::orderBy('service_name')->get();

        return view('booking', [
            'service' => $service,
            'services' => $services,
        ]);
    }

    /**
     * Menyimpan booking baru
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'required|string|max:50',
            'service_id' => 'nullable|exists:services,id',
            'event_date' => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) {
                    if ($value && strtotime($value) < strtotime('today')) {
                        $fail('Tanggal acara tidak boleh di masa lalu.');
                    }
                },
            ],
            'location' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Generate booking number
        $year = date('Y');
        $lastBooking = Booking::where('booking_number', 'like', "BK-{$year}-%")
            ->orderBy('booking_number', 'desc')
            ->first();

        if ($lastBooking) {
            // Extract number from last booking (e.g., BK-2024-0001 -> 1)
            $lastNumber = (int) substr($lastBooking->booking_number, -4);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $bookingNumber = 'BK-' . $year . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // Pastikan booking number unique (fallback)
        $counter = 0;
        while (Booking::where('booking_number', $bookingNumber)->exists() && $counter < 100) {
            $nextNumber++;
            $bookingNumber = 'BK-' . $year . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
            $counter++;
        }

        $booking = Booking::create([
            'booking_number' => $bookingNumber,
            'client_name' => $validated['client_name'],
            'client_email' => $validated['client_email'],
            'client_phone' => $validated['client_phone'],
            'service_id' => $validated['service_id'] ?? null,
            'event_date' => $validated['event_date'] ?? null,
            'location' => $validated['location'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'booking_status' => 'pending',
        ]);

        return redirect()
            ->route('index')
            ->with('booking_success', true)
            ->with('booking_number', $booking->booking_number)
            ->with('success', "Booking berhasil dibuat! Nomor booking Anda: <strong>{$booking->booking_number}</strong>");
    }
}
