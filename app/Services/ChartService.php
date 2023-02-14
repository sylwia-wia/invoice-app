<?php

namespace App\Services;

use App\Models\BusinessDocument;
use Carbon\Carbon;

class ChartService
{
    public function drawChart(): array
    {
        $record = BusinessDocument::select(\DB::raw("SUM(gross_value) as income"),
            \DB::raw("MONTHNAME(issue_date) as month_name"),
            \DB::raw("YEAR(issue_date) as year"),
            \DB::raw("issue_date"))
            ->whereDate('issue_date', '>', Carbon::now()->subYear()->format('Y-m-d'))
            ->groupBy('month_name', 'year')
            ->orderBy('issue_date')
            ->get();

        $data = [];

        foreach($record as $row) {
            $data['label'][] = $row->month_name . ' ' . $row->year;
            $data['data'][] = (int) $row->income;
        }

        $data['chart_data'] = json_encode($data);
        return $data;
    }
}
