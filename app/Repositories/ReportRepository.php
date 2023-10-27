<?php


namespace App\Repositories;


use App\Models\Reports;

class ReportRepository extends Repository
{
    public function findByMonth(string $month)
    {
        return Reports::where('m&y', $month)->get();
    }

    public function getTotal()
    {
        return Reports::where('m&y', date('m.Y'))->get();

    }
}