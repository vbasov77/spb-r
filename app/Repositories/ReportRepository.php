<?php


namespace App\Repositories;


use App\Models\Reports;

class ReportRepository extends Repository
{
    /**
     * @param string $month
     * @return object
     */
    public function findByMonth(string $month): object
    {
        return Reports::where('v_period', $month)->get();
    }

    /**
     * @return object
     */
    public function getTotal(): object
    {
        return Reports::where('v_period', date('m.Y'))->get();
    }

    /**
     * @return object
     */
    public function findAll(): object
    {
        return Reports::orderBy('v_period')->get();
    }

    public function findById(int $id)
    {
        return Reports::where('id', $id)->first();
    }

    /**
     * @param int $id
     * @param array $data
     */
    public function editExpenses(int $id, array $data): void
    {
        Reports::where('id', $id)->update($data);
    }

}