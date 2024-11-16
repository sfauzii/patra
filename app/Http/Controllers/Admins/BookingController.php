<?php

namespace App\Http\Controllers\Admins;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::all()->map(function ($booking) {
            $start = Carbon::parse($booking->start_date);
            $end = Carbon::parse($booking->end_date);
            $booking->duration = $start->diffInDays($end);

            // Calculate overall document status
            $documentStatuses = $booking->documentValidations->pluck('status');

            if ($documentStatuses->contains('REJECTED')) {
                $booking->document_status = 'Rejected';
            } elseif ($documentStatuses->every(fn($status) => $status === 'APPROVED')) {
                $booking->document_status = 'Approved';
            } else {
                $booking->document_status = 'Pending';
            }

            return $booking;
        });

        return view('pages.admins.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = Booking::findOrFail($id);

        // Ensure document validation records are created for each document type
        $documentTypes = ['ktp_booking', 'identity_booking', 'selfie_booking'];

        foreach ($documentTypes as $documentType) {
            $booking->documentValidations()->firstOrCreate([
                'document_type' => $documentType,
            ], [
                'status' => 'PENDING',
            ]);
        }

        // Pass the booking to the view
        return view('pages.admins.bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        return view('pages.admins.bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $data = $request->all();

        $booking->update($data);

        toast('Your Booking has been updated!', 'success');


        return redirect()->route('bookings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        toast('Your Booking has been deleted!', 'success');


        return redirect()->route('bookings.index');
    }

    public function updateDocument(Request $request, Booking $booking)
    {
        $documentType = $request->input('document_type');
        $action = $request->input('action');

        // Validate the request
        $request->validate([
            'document_type' => 'required|in:ktp_booking,identity_booking,selfie_booking',
            'action' => 'required|in:approve,reject',
            'rejection_reason' => 'required_if:action,reject'
        ]);

        // Find the document validation
        $documentValidation = $booking->documentValidations()->where('document_type', $documentType)->first();

        if (!$documentValidation) {
            $documentValidation = $booking->documentValidations()->create([
                'document_type' => $documentType,
                'status' => 'PENDING'
            ]);
        }

        if ($action === 'approve') {
            $documentValidation->update([
                'status' => 'APPROVED',
                'rejection_reason' => null,
            ]);

            // Tambahkan ke history
            $documentValidation->addHistory('APPROVED');

            Alert::success('Success', 'Document has been approved');
        } elseif ($action === 'reject') {
            $documentValidation->update([
                'status' => 'REJECTED',
                'rejection_reason' => $request->input('rejection_reason'),
            ]);

            // Tambahkan ke history
            $documentValidation->addHistory('REJECTED', $request->input('rejection_reason'));

            Alert::warning('Rejected', 'Document has been rejected');
        }

        return redirect()->route('bookings.show', $booking->id);
    }

    public function rejectDocument(Request $request, Booking $booking)
    {
        $documentType = $request->input('document_type');
        $reason = $request->input('reason');

        // Find or create the document validation
        $documentValidation = $booking->documentValidations()->updateOrCreate(
            ['document_type' => $documentType],
            ['status' => 'REJECTED', 'rejection_reason' => $reason]
        );

        // Tambahkan ke history
        $documentValidation->addHistory('REJECTED', $reason);

        Alert::success('success', 'Status updated');

        return redirect()->route('bookings.show', $booking->id)->with('error', 'Document rejected');
    }
}
