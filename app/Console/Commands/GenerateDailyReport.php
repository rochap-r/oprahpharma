<?php

namespace App\Console\Commands;

use App\Mail\DailyReport;
use App\Models\Journal;
use App\Models\OrderJournal;
use App\Models\Product;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class GenerateDailyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-daily-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $startDate;
    private $endDate;


    public function __construct()
    {
        parent::__construct(); // Appelle le constructeur de la classe parente

        $this->startDate = Carbon::now()->startOfDay()->format('Y-m-d\TH:i');
        $this->endDate = Carbon::now()->endOfDay()->format('Y-m-d\TH:i');
    }



    /**
     * Execute the console command.
     */
    public function handle()
    {
        $query = Journal::query();
        $orderQuery = OrderJournal::query();


        if ($this->startDate && $this->endDate) {
            if ($this->startDate<=$this->endDate) {
                $query->whereBetween('supply_date', [$this->startDate, $this->endDate]);
                $orderQuery->whereBetween('order_date', [$this->startDate, $this->endDate]);
            }
        }


        $journals = $query->get();
        $orderJournals = $orderQuery->get();


        // Dans app/Console/Commands/GenerateDailyReport.php
        $salesRevenue = $orderJournals->sum(function ($journal) {
            return $journal->orderItem->line_price;
        });
        $salesByusers = User::select('users.id', 'users.name')
            ->addSelect(DB::raw('SUM(order_items.line_price) as total_sold'))
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->whereBetween('orders.order_date', [$this->startDate, $this->endDate])
            ->groupBy('users.id', 'users.name') 
            ->get();


        $orders = $orderJournals->map(function ($journal) {
            return $journal->orderItem->order;
        })->unique();
        $orderCount =count($orders);

        $cmv = $journals->sum(function ($journal) { return $journal->unit_purchase_price * $journal->quantity; });
        $grossMargin = $salesRevenue - $cmv;
        $grossMarginPercentage = $grossMargin? number_format(($grossMargin / $salesRevenue) * 100, 2, ',', ''): 0;

        $products = Product::all();
        $nb=0;
        foreach($products as $product){
            $lastSupply = $product->supplies()->latest()->first();

            if (!$lastSupply || $lastSupply->quantity_in_stock <= $product->unit->minimum_stock_level) {
                $nb++;
            }


        }
        $criticalStock=$nb;

        // date du rapport
        $today= Carbon::now('Africa/Lubumbashi')->format('d-m-Y');

        //les produits à 30 jours ou moins d'expiration
        $criticalExpirations=Product::getCriticalProducts()->count();




        // Générer le rapport ici
        $report = [
            'salesRevenue' => $salesRevenue,
            'orderCount' => $orderCount,
            'grossMargin' => $grossMargin,
            'grossMarginPercentage' => $grossMarginPercentage,
            'criticalStock' => $criticalStock,
            'today' => $today,
            'criticalExpirations' => $criticalExpirations,
            'salesByusers' => $salesByusers,
        ];


        Mail::to('philemonchey@gmail.com')
            ->cc('rodriguechot@gmail.com')
            ->send(new DailyReport(
                $salesRevenue,
                $orderCount,
                $grossMargin,
                $grossMarginPercentage,
                $criticalStock,
                $today,
                $criticalExpirations,
                $salesByusers
            ));




    }

}
