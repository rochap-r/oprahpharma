<?php

namespace App\Http\Livewire\Apps;

use App\Models\Journal;
use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Report extends Component
{
    public $startDate;
    public $endDate;
    public $userId;

    public function mount()
    {
        $this->startDate = Carbon::now()->format('Y-m-d');
        $this->endDate = Carbon::now()->format('Y-m-d');
        $this->userId = null;
    }

    public function render()
    {
        $query = Journal::query();

        if ($this->startDate) {
            $query->whereDate('supply_date', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->whereDate('supply_date', '<=', $this->endDate);
        }

        if ($this->userId) {
            $query->whereHas('orderItem.order', function ($query) {
                $query->where('user_id', $this->userId);
            });
        }

        $journals = $query->get();

        $totalRevenue = $journals->sum(function ($journal) {
            return $journal->orderItem->line_price;
        });

        $totalOrders = $journals->count();


        $cmv = $journals->sum(function ($journal) {
            return $journal->unit_purchase_price * $journal->quantity;
        });


        $grossMarginValue = $totalRevenue - $cmv;
        $grossMarginPercentage = $totalRevenue > 0 ? (($grossMarginValue / $totalRevenue) * 100) : 0;

        return view('livewire.apps.report', [
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'cmv' => $cmv,
            'grossMarginValue' => $grossMarginValue,
            'grossMarginPercentage' => $grossMarginPercentage,
            'users' => User::all(),
        ]);
    }
}
