<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CRequest;
use App\Repositories\CRequests\CRequestRepositoryInterface;

class ChartsController extends Controller
{
    protected $crequestRepo;
    public function __construct(CRequestRepositoryInterface $crequestRepo)
    {
        $this->crequestRepo = $crequestRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return view('admin.charts.index');
    }

    public function week($week) 
    {
        $requests = $this->crequestRepo->getByIsApprove(true);
        $requestsOfWeek = [];
        foreach ($requests as $request) {
            if (date("W", strtotime($request->created_at)) == $week)
            {
                $requestsOfWeek [] = $request;
            }
        }
        $numberRequestsWeek = [];
        for ( $i = 1; $i <= 7; $i++) {
            $numberRequestsWeek[] = 0;
        }

        foreach ($requestsOfWeek as $request) {
            $weekday = date("l", strtotime($request->created_at));
            switch($weekday) {
                case 'Monday':
                    $numberRequestsWeek[0]++;
                    break;
                case 'Tuesday':
                    $numberRequestsWeek[1]++;
                    break;
                case 'Wednesday':
                    $numberRequestsWeek[2]++;
                    break;
                case 'Thursday':
                    $numberRequestsWeek[3]++;
                    break;
                case 'Friday':
                    $numberRequestsWeek[4]++;
                    break;
                case 'Saturday':
                    $numberRequestsWeek[5]++;
                    break;
                case 'Sunday':
                    $numberRequestsWeek[6]++;
                    break;
            }
        }

        return $numberRequestsWeek;
    }

    public function month($month) 
    {
        $daysOfMonth = [];
        $numberOfDays = cal_days_in_month(CAL_GREGORIAN, $month, date('Y'));
        for ( $i = 1; $i <= $numberOfDays; $i++) {
            $daysOfMonth[] = $i;
        }

        $requests = $this->crequestRepo->getByIsApprove(true);
        $requestsOfMonth= [];
        foreach ($requests as $request) {
            if (date("m", strtotime($request->created_at)) == $month)
            {
                $requestsOfMonth[] = $request;
            }
        }

        $numberRequestsMonth = [];
        for ( $i = 1; $i <= $numberOfDays; $i++) {
            $numberRequestsMonth[] = 0;
        }

        foreach ($requestsOfMonth as $request) {
            $numberRequestsMonth[(int)date("d", strtotime($request->created_at))]++;    
        }

        return ['requestsOfMonth' => $numberRequestsMonth , 'daysOfMonth' => $daysOfMonth];
    }
}
