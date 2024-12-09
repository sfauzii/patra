<div>
    @if ($show)
        <div class="modal fade show" style="display: block;" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-0">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" wire:model.live.debounce.300ms="search"
                                class="form-control form-control-lg border-0 shadow-none" placeholder="Search items..."
                                autofocus>
                        </div>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>

                    <!-- Make the modal body scrollable -->
                    <div class="modal-body overflow-auto" style="max-height: 60vh;">
                        @if (strlen($search) < 3)
                            <div class="text-center text-muted py-4">
                                Please enter at least 3 characters to search
                            </div>
                        @else
                            <!-- Skeleton Loader -->
                            @if ($isLoading)
                                <div class="row g-4">
                                    @for ($i = 0; $i < 4; $i++)
                                        <div class="col-md-6">
                                            <div class="card h-100 border-0 shadow-sm">
                                                <div class="row g-0">
                                                    <div class="col-4">
                                                        <div class="skeleton-image rounded-start"></div>
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="card-body">
                                                            <div class="skeleton-title mb-2"></div>
                                                            <div class="skeleton-text mb-2"></div>
                                                            <div class="skeleton-text mb-2"></div>
                                                            <div class="skeleton-price"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            @else
                                @if ($items->isEmpty())
                                    <div class="text-center text-muted py-4">
                                        No items found for "{{ $search }}"
                                    </div>
                                @else
                                    <div class="row g-4 justify-content-center">
                                        @foreach ($items as $item)
                                            <div class="col-12 col-sm-8 col-md-6 d-flex justify-content-center">
                                                <div class="card"
                                                    style="box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;">
                                                    <img src="{{ asset('storage/' . json_decode($item->photos)[0]) }}"
                                                        alt="{{ $item->name }}">
                                                    <div class="card-content">
                                                        <h1 class="card-title cars">{{ ucwords($item->name) }} </h1>
                                                        <p class="card-description">Rp
                                                            {{ number_format($item->price, 0, '') }}/day</p>

                                                        <button class="view-details"
                                                            onclick="window.location.href='{{ route('item.details', $item->slug) }}';">View
                                                            Details</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>

    @endif
</div>
