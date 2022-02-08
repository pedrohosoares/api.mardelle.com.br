<?php
namespace App\Http\Support;

class TotalMoneyDateCompleteSupport
{

    public static function completeStartAndEndDate(array $mounths): array
    {
        return collect($mounths)->map(function ($mounth) {
            $dateStart = date('Y-' . $mounth . '-01');
            $dateEnd = date('Y-m-d', strtotime('+1 month -1day', strtotime($dateStart)));
            return [$dateStart, $dateEnd];
        })->toArray();
    }

    public static function completeArrayDateStatusByFirstAtLast(array $datesData, string $dateStart, $dateEnd): array
    {
        $intervalDates = complementDateByIntervalInIndex($dateStart, $dateEnd);
        foreach ($datesData as $date => $values) {
            $newDate = date('Y-m', strtotime($date));
            foreach ($intervalDates as $indexDate => $dateInterval) {
                $dateInterval = date('Y-m', strtotime($indexDate));
                if ($newDate == $dateInterval) {
                    $intervalDates[$indexDate] = $values;
                }
            }
        }
        return $intervalDates;
    }

    public static function sumMoneyByDateAndStatus(object $orders): array
    {
        $newStatus = [];
        foreach ($orders as $status => $itens) {
            foreach ($itens as $iten) {
                $dateMonthYear = date('Y-m-01', strtotime($iten->date));
                if (!isset($newStatus[$dateMonthYear])) {
                    $newStatus[$dateMonthYear] = [];
                }
                if (!isset($newStatus[$dateMonthYear][$status])) {
                    $newStatus[$dateMonthYear][$status] = 0;
                }
                $newStatus[$dateMonthYear][$status] += $iten->total;
            }
        }
        return $newStatus;
    }

    public static function sumTotalByStatusAndDate(object $orders): array
    {
        $data = [];
        foreach ($orders->toArray() as $index => $values) {
            foreach ($values as $value) {
                if (!isset($data[$index])) {
                    $data[$index] = [];
                }
                if (!isset($data[$index][$value['date']])) {
                    $data[$index][$value['date']] = 0;
                }
                $data[$index][$value['date']] += $value['total'];
            }
        }
        return $data;
    }

}
