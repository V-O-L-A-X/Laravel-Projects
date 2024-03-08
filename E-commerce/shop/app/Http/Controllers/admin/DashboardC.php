<?php

namespace App\Http\Controllers\admin;

use App\Models\order;
use App\Models\product;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardC extends Controller
{
    public function index()
    {

        $totalOrders = order::where('status','!=','cancelled')->count();
        $totalProducts = product::count();
        $totalCustomers = User::where('role',1)->count();
        $totalRevenue = order::where('status','!=','cancelled')->sum('grand_total');

        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $currentDay = Carbon::now()->format('Y-m-d');

        $lastMonthStartDate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $lastMonthEndDate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
        $lastMonthName = Carbon::now()->subMonth()->endOfMonth()->format('M');

        $revenueThisMonth = order::where('status','!=','cancelled')
                        ->whereDate('created_at','>=',$startOfMonth)
                        ->whereDate('created_at','<=',$currentDay)
                        ->sum('grand_total');

        $revenueLastMonth = order::where('status','!=','cancelled')
                        ->whereDate('created_at','>=',$lastMonthStartDate)
                        ->whereDate('created_at','<=',$lastMonthEndDate)
                        ->sum('grand_total');


        $lastThirtyDayStartDate = Carbon::now()->subDay(30)->format('Y-m-d');

        $revenueLastThirtyDays = order::where('status','!=','cancelled')
                        ->whereDate('created_at','>=',$lastThirtyDayStartDate)
                        ->whereDate('created_at','<=',$currentDay)
                        ->sum('grand_total');



        return view('admin.dashboard', compact('totalOrders','totalProducts','totalCustomers','totalRevenue','revenueThisMonth','revenueLastMonth','revenueLastThirtyDays','lastMonthName'));
       
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
