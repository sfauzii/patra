<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;

class SearchModal extends Component
{

    public $show = false;
    public $search = '';
    public $items = [];
    public $isLoading = false;

    protected $listeners = ['search-modal' => 'toggleModal'];

    public function mount()
    {
        $this->items = collect([]);
    }

    public function toggleModal()
    {
        $this->show = !$this->show;
        if (!$this->show) {
            $this->reset(['search', 'items', 'isLoading']);
        }
    }

    public function closeModal()
    {
        $this->show = false;
        $this->reset(['search', 'items', 'isLoading']);
    }

    public function updatedSearch()
    {
        if (strlen($this->search) >= 3) {
            // Start loading state when typing
            $this->isLoading = true;

            // Fetch search results
            $this->items = Item::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->orWhere('price', 'like', '%' . $this->search . '%')
                ->orWhereHas('brand', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                ->where('is_available', true)
                ->take(10)
                ->get();

            // Stop loading state after fetching data
            $this->isLoading = false;
        } else {
            // Reset items if search is too short
            $this->items = [];
            $this->isLoading = false;
        }
    }

    public function render()
    {
        return view('livewire.search-modal');
    }
}
