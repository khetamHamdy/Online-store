<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Models\Subadmin;
use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller {

    public function index() {

        // dd( $monthsCount );
        $monthsTotal =$this->getChartDataMonthsTotal();
        $monthsCount= $this->getChartDataOrderCount();
        $users_count = User::where( 'is_deleted', '0' )->count();
        $sales_from_all_vendors_in_this_day = Order::whereDate( 'created_at', Carbon::today() )->where( 'status', '4' )->sum( 'total' );
        $orders_from_all_vendors_in_this_day = Order::whereDate( 'created_at', Carbon::today() )->count();
        $avg_from_all_vendors = round( Order::where( 'status', '!=', '5' )->average( 'total' ), 2 );
        $total_sales_from_all_vendors = Order::where( 'status', '!=', '5' )->sum( 'total' );
        $total_orders_from_all_vendors = Order::count();
        $confirmed_orders = Order::where( 'status', '1' )->count();
        $under_preparing_orders = Order::where( 'status', '2' )->count();
        $ready_to_pick_orders = Order::where( 'status', '3' )->count();
        $completed_orders = Order::where( 'status', '4' )->count();
        $canceled_orders = Order::where( 'status', '5' )->count();

        return view( 'admin.home.dashboard' )->with( compact( 'users_count',
        'sales_from_all_vendors_in_this_day', 'monthsTotal', 'monthsCount', 'orders_from_all_vendors_in_this_day'
        , 'avg_from_all_vendors', 'total_sales_from_all_vendors', 'total_orders_from_all_vendors'
        , 'confirmed_orders', 'under_preparing_orders', 'ready_to_pick_orders', 'completed_orders', 'canceled_orders' ) );
    }

    public function changeStatus( $model, Request $request ) {
        $role = '';
        if ( $model == 'admins' ) $role = 'App\Models\Admin';
        if ( $model == 'categories' ) $role = 'App\Models\Category';
        if ( $model == 'product' ) $role = 'App\Models\Product';
        if ( $model == 'product-trash' ) {
            $role = 'App\Models\Product';
        }

        if ( $model == 'sliders' ) $role = 'App\Models\Slider';
        if ( $model == 'orders' ) {
            $role = 'App\Models\Orders';
        }

        if ( $model == 'colors' ) $role = 'App\Models\Color';
        if ( $model == 'sizes' ) $role = 'App\Models\Sizes';
        if ( $model == 'cuisines' ) $role = 'App\Models\Cuisine';
        if ( $model == 'banners' ) $role = 'App\Models\Banner';
        if ( $model == 'contacts' ) $role = 'App\Models\Contact';
        if ( $model == 'providers' ) $role = 'App\Models\Subadmin';
        if ( $model == 'users' ) $role = 'App\Models\User';
        if ( $model == 'orders' ) $role = 'App\Models\Order';
        if ( $model == 'logs' ) $role = 'App\Models\Activity';
        if ( $model == 'roles' ) $role = 'App\Models\Role';
        if ( $model == 'country' ) $role = 'App\Models\Country';
        if ( $model == 'city' ) $role = 'App\Models\City';
        if ( $model == 'offers' ) $role = 'App\Models\Offer';
        if ( $model == 'brand' ) $role = 'App\Models\Brand';
        if ( $model == 'promoCodes' ) $role = 'App\Models\PromoCode';

        if ( $role != '' ) {
            if ( $request->action == 'delete' ) {
                $role::query()->whereIn( 'id', $request->IDsArray )->delete();
            } else {
                if ( $request->action ) {
                    $role::query()->whereIn( 'id', $request->IDsArray )->update( [ 'status' => $request->action ] );
                }
            }

            return $request->action;
        }
        return false;

    }

    public function getData( Request $request ) {

        $monthsTotal =$this->getChartDataMonthsTotal($request->year);
        $monthsCount= $this->getChartDataOrderCount($request->year);
        return response()->json([
            'monthsTotal'=>$monthsTotal,
            'monthsCount'=>$monthsCount
        ]);

    }

    public function getChartDataMonthsTotal( $year = '' ) {
        if ( $year ==  '' ) {
            $year = date( 'Y' );
        }
        $orderIncome = Order::select(
            DB::raw( 'SUM(total) as sum' ),
            DB::raw( 'MONTH(created_at) as month' ),
        )
        // ->where( DB::raw( 'YEAR(created_at)' ), date( 'Y' ) )
        ->whereYear( 'created_at', $year )
        ->groupBy( 'month' )
        ->get()
        ->toArray();

        $monthsTotal = [];

        foreach ( $orderIncome as $one ) {
            $monthsTotal[ $one[ 'month' ] ] = $one[ 'sum' ];
        }

        for ( $i = 1; $i <= 12; $i++ ) {
            if ( ! key_exists( $i, $monthsTotal ) ) {
                $monthsTotal[ $i ] = 0;
            }

        }
        ksort( $monthsTotal );
        $monthsTotal = array_values( $monthsTotal );

        return $monthsTotal;
    }

    public function getChartDataOrderCount( $year = '' ) {
        if ( $year ==  '' ) {
            $year = date( 'Y' );
        }

        $orderCount = Order::select(
            DB::raw( 'COUNT(*) as count' ),
            DB::raw( 'MONTH(created_at) as month' ),
        )
        ->whereYear( 'created_at', $year )
        ->groupBy( 'month' )
        ->get()
        ->toArray();

        $monthsCount = [];

        foreach ( $orderCount as $one ) {
            $monthsCount[ $one[ 'month' ] ] = $one[ 'count' ];
        }

        for ( $i = 1; $i <= 12; $i++ ) {

            if ( ! key_exists( $i, $monthsCount ) ) {
                $monthsCount[ $i ] = 0;
            }
        }
        ksort( $monthsCount );
        $monthsCount = array_values( $monthsCount );
        return $monthsCount;
    }
}
