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
        // Get revenue data for last 12 months
        $today = Carbon::today();
        $lastYear = Carbon::today()->subYear();

        $revenueData = Order::where('is_confirmed', 1)
            ->whereBetween('created_at', [$lastYear, $today])
            ->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, SUM(total_amount) as revenue')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Prepare labels and data
        $labels = [];
        $data = [];

        foreach ($revenueData as $record) {
            $monthName = Carbon::create()->month($record->month)->format('F');
            $labels[] = $monthName . ' ' . $record->year;
            $data[] = $record->revenue;
        }

        // Set chart options
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

        // Set chart labels and data
        $this->labels($labels);
        $this->dataset('Monthly Revenue', 'line', $data)
            ->color('#36A2EB')
            ->fill(false)
            ->linetension(0.3);

        return $this;
    }
}
