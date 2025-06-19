<?php

namespace App\Imports;

use App\Models\Dissertation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportDissertation implements ToModel, WithStartRow
{
    /**
     * Start from the second row (index 1) for data import.
     *
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Dissertation([
            'year' => $row[0],
            'semester' => $row[1],
            'student_id' => $row[2],
            'class_id' => $row[3],
            'student_name' => $row[4],
            'gender' => $row[5],
            'yearOfBirth' => $row[6],
            'major' => $row[7],
            'titleInVietnamese' => $row[8],
            'titleInEnglish' => $row[9],
            'lecturer_name' => $row[10],
        ]);
    }
}
