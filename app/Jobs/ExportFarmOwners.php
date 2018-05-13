<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Models\FarmOwner;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Facades\Excel;

class ExportFarmOwners extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        $query = FarmOwner::query();
//
//        $query->chunk(100, function($data){
//            Excel::create('Filename', function($excel) use($data) {
//
//                $excel->sheet('Sheetname', function($sheet) use($data) {
//
//                    $sheet->fromModel($data);
//
//                });
//
//            })->store('xls');
//            return false;
//        });



    }
}
