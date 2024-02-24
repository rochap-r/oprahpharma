<?php

namespace App\Http\Livewire\Apps;

use App\Models\Order;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class OrderRegister extends Component
{
    use WithPagination;

    public $searchTotal = '';
    public $searchDateStart = '';
    public $searchDateEnd = '';

    public function mount()
    {
        $this->searchDateStart = Carbon::now()->startOfDay()->format('Y-m-d\TH:i');
        $this->searchDateEnd = Carbon::now()->endOfDay()->format('Y-m-d\TH:i');

        $this->userId = auth()->id();
    }

    public function render()
    {
        $orders = Order::query()
            ->where('user_id', auth()->id())
            ->when($this->searchTotal, function ($query) {
                $query->whereBetween('total_price', [$this->searchTotal - 1, $this->searchTotal + 1]);
            })
            ->when($this->searchDateStart && $this->searchDateEnd, function ($query) {
                $query->whereBetween('order_date', [
                    $this->searchDateStart,
                    $this->searchDateEnd
                ]);
            })
            ->orderByDesc('order_date')
            ->paginate(25);
        return view('livewire.apps.orders.order-register', ['orders' => $orders]);
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setCreator('Vous')
            ->setLastModifiedBy('Vous')
            ->setTitle('Historique des commandes')
            ->setSubject('Commandes')
            ->setDescription('Document contenant l\'historique des commandes.');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'Date')
            ->setCellValue('C1', 'Montant')
            ->setCellValue('D1', 'NB Prods');

        $orders = Order::query()
            ->where('user_id', auth()->id())
            ->when($this->searchTotal, function ($query) {
                $query->whereBetween('total_price', [$this->searchTotal - 1, $this->searchTotal + 1]);
            })
            ->when($this->searchDateStart && $this->searchDateEnd, function ($query) {
                $query->whereBetween('order_date', [
                    $this->searchDateStart,
                    $this->searchDateEnd
                ]);
            })
            ->orderByDesc('order_date')
            ->paginate(25);

        $row = 2;
        foreach ($orders as $order) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $row, $order->id)
                ->setCellValue('B' . $row, $order->order_date)
                ->setCellValue('C' . $row, $order->total_price)
                ->setCellValue('D' . $row, $order->orderItems->count());
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'historique_des_commandes_' . date('Y-m-d') . '.xlsx';
        $writer->save($fileName);

        return response()->download($fileName);

    }
}
