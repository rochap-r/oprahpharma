<?php

namespace App\Http\Livewire\Apps;

use App\Models\Journal;
use App\Models\Order;
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
        $this->startDate = Carbon::now()->startOfDay()->format('Y-m-d H:i:s');
        $this->endDate = Carbon::now()->endOfDay()->format('Y-m-d H:i:s');

        $this->userId = null;
    }

    public function render()
    {
        $query = Journal::query();


        if ($this->startDate && $this->endDate) {
            if ($this->startDate<=$this->endDate) {
                $query->whereBetween('supply_date', [$this->startDate, $this->endDate]);
            } else {
                // Gérer l'erreur ici, par exemple en définissant un message d'erreur
                $this->errorMessage = 'La date de début doit être inférieure à la date de fin.';
            }
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

        $orders = $journals->map(function ($journal) {
            return $journal->orderItem->order;
        })->unique();


        $totalOrders = count($orders);


        $cmv = $journals->sum(function ($journal) {
            return $journal->unit_purchase_price * $journal->quantity;
        });


        $grossMarginValue = $totalRevenue - $cmv;
        $grossMarginPercentage = $totalRevenue > 0 ? (($grossMarginValue / $cmv) * 100) : 0;

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
