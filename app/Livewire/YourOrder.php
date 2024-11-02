<?php

namespace App\Livewire;

use App\Models\BillModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class YourOrder extends Component
{
    use WithPagination, WithoutUrlPagination;
    public function render()
    {
        $orders = BillModel::where('id_user', '=', Auth::user()->id)->paginate('2');
        return view('livewire.your-order', compact(['orders']));
    }
}
