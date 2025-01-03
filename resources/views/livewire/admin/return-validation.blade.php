<div>
    <div class="col-md-8 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <h4>Validasi Pengembalian</h4>
                </div>
                <div class="card-body">
                    @if (!$booking->isReturned())
                        <div class="alert alert-info">
                            <h4 class="alert-heading">Status Penyewaan</h4>
                            <p>Periode Sewa: {{ $startDate }} - {{ $endDate }}</p>
                            <hr>
                            <p class="mb-0">
                                @if (now() > $booking->end_date)
                                    Item belum dikembalikan (Terlambat)
                                @else
                                    Masa sewa masih berlangsung
                                @endif
                            </p>
                        </div>

                        <button class="btn btn-primary" wire:click="openReturnModal">
                            Konfirmasi Pengembalian
                        </button>
                    @else
                        <div class="alert alert-success">
                            <h4 class="alert-heading">Item Telah Dikembalikan</h4>
                            <p>Tanggal Pengembalian:
                                {{ $booking->actual_return_date instanceof \Carbon\Carbon
                                    ? $booking->actual_return_date->format('d M Y')
                                    : \Carbon\Carbon::parse($booking->actual_return_date)->format('d M Y') }}
                            </p>
                            <p>Kondisi: {{ ucfirst($booking->returnValidation->return_condition) }}</p>
                            @if ($booking->returnValidation->return_notes)
                                <hr>
                                <p class="mb-0">Catatan: {{ $booking->returnValidation->return_notes }}</p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Modal Konfirmasi Pengembalian -->
        <div class="modal @if ($showReturnModal) show @endif" tabindex="-1" role="dialog"
            style="display: @if ($showReturnModal) block @else none @endif;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Pengembalian Item</h5>
                        <button type="button" class="close" wire:click="closeReturnModal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="confirmReturn">
                            <div class="form-group">
                                <label>Tanggal Pengembalian</label>
                                <input type="date" class="form-control" wire:model="returnDate"
                                    min="{{ $booking->start_date instanceof \Carbon\Carbon
                                        ? $booking->start_date->format('Y-m-d')
                                        : \Carbon\Carbon::parse($booking->start_date)->format('Y-m-d') }}"
                                    max="{{ now()->format('Y-m-d') }}">
                                @error('returnDate')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Kondisi Item</label>
                                <select class="form-control" wire:model="returnCondition">
                                    <option value="">Pilih Kondisi</option>
                                    <option value="good">Baik</option>
                                    <option value="damaged">Rusak</option>
                                </select>
                                @error('returnCondition')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Catatan</label>
                                <textarea class="form-control" wire:model="returnNotes" placeholder="Tambahkan catatan jika diperlukan"></textarea>
                                @error('returnNotes')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeReturnModal">Tutup</button>
                        <button type="button" class="btn btn-primary" wire:click="confirmReturn">Konfirmasi
                            Pengembalian</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .modal {
            background-color: rgba(0, 0, 0, 0.5);
        }
    </style>
</div>
