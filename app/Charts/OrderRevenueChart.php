<?php

namespace App\Charts;

use App\Models\Order;
use Carbon\Carbon;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class OrderRevenueChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function makeChart()
    {
        $revenueData = Order::where('is_confirmed', 1)
            ->whereYear('created_at', Carbon::now()->year)
            ->selectRaw('MONTH(created_at) as month, SUM(total_amount) as revenue')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Initialize array with all months
        $monthlyRevenue = array_fill(1, 12, 0);

        // Fill in actual revenue data
        foreach ($revenueData as $record) {
            $monthlyRevenue[$record->month] = $record->revenue;
        }

        // Create labels and data arrays for chart
        $labels = [];
        $data = [];
        for ($month = 1; $month <= 12; $month++) {
            $labels[] = Carbon::create()->month($month)->format('F');
            $data[] = $monthlyRevenue[$month];
        }

        // Set chart configuration
        $this->options([
            'responsive' => true,
            'scales' => [
                'yAxes' => [[
                    'ticks' => [
                        'beginAtZero' => true
                    ]
                ]]
            ]
        ]);

        $this->labels($labels);
        $this->dataset('Monthly Revenue', 'line', $data)
            ->color('#36A2EB')
            ->fill(false)
            ->linetension(0.3);


        return $this;
    }
}
