<?php

namespace App\Http\Controllers\WEB\Admin;


use App\Exports\OrdersExportForAdmin;
use App\Exports\OrdersReportForAdmin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Setting;
use App\Models\Subadmin;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->locales = Language::all();
        $this->settings = Setting::query()->first();
        view()->share([
            'locales' => $this->locales,
            'settings' => $this->settings,

        ]);


        $route = Route::currentRouteAction();
        $route_name = substr($route, strpos($route, "@") + 1);
        $this->middleware(function ($request, $next) use ($route_name) {

            if ($route_name == 'index') {
                if (can(['orders-show', 'orders-create', 'orders-edit', 'orders-delete'])) {
                    return $next($request);
                }
            } elseif ($route_name == 'create' || $route_name == 'store') {
                if (can('orders-create')) {
                    return $next($request);
                }
            } elseif ($route_name == 'edit' || $route_name == 'update') {
                if (can('orders-edit')) {
                    return $next($request);
                }
            } elseif ($route_name == 'destroy' || $route_name == 'delete') {
                if (can('orders-delete')) {
                    return $next($request);
                }
            } else {
                return $next($request);
            }
            return redirect()->back()->withErrors(__('cp.you_dont_have_permission'));
        });


    }

    public function index()
    {

        $users = Subadmin::get();
        $items = Order::filter()->orderBy('id', 'desc')->paginate($this->settings->paginateTotal);
        return view('admin.orders.home', [
            'items' => $items,
            'users' => $users,
        ]);
    }

    public function report()
    {

        $users = Subadmin::get();
        $items = Order::filter()->where('status', '4')->orderBy('id', 'desc')->paginate($this->settings->paginateTotal);
        return view('admin.orders.report', [
            'items' => $items,
            'users' => $users,
        ]);
    }


    public function create()
    {
        $users = User::get();
        $providers = Subadmin::get();
        return view('admin.orders.create')->with(compact('users', 'providers'));
    }

    public function edit($id)
    {
        $item = Order::where('id', $id)->first();
        return view('admin.orders.show', [
            'item' => $item,
        ]);
    }

    public function update(Request $request, $id)
    {
        $roles = [

        ];
        $item = Order::query()->where('id', $id)->first();
        if ($item->status != '4' && $item->status != '5') {
            $roles = [
                'status' => 'required',
            ];
        }
        $this->validate($request, $roles);

        if ($item->status == '4' || $item->status == '5') {
            return redirect()->back()->with('status', __('cp.update'));
        }


        if ($request->status == '4') {
            $item->status = $request->status;
            $item->save();
            foreach ($item->meals as $one) {
                $one->meal->increment('count_selling');
                if (@$one->meal->price_offer > 0) {
                    $one->meal->increment('total_selling_amount', $one->meal->price_offer);
                } else {
                    $one->meal->increment('total_selling_amount', $one->meal->price);
                }
            }

        } else {
            $item->status = $request->status;
            $item->save();
        }
        if ($item->status == 1) {
            return redirect()->back()->with('status', __('cp.update'));
        } else {

            $message_en = '';
            $message_ar = '';
            if ($item->status == 2) {
                $message_en = 'You order is Being Prepared';
                $message_ar = 'طلبك قيد التحضير';
            } elseif ($item->status == 3) {
                $message_en = 'Your order is Ready for Pick Up';
                $message_ar = 'طلبك جاهز للاستلام';
            } elseif ($item->status == 4) {
                $message_en = 'Your order has been picked up';
                $message_ar = 'تم تسليم طلبك';
            } elseif ($item->status == 5) {
                $message_en = 'Sorry! Your order has been cancelled, please contact our customer service.';
                $message_ar = 'نأسف ! تم الغاء طلبك , يرجى التواصل مع خدمة العملاء';
            }
            $locales = Language::all()->pluck('lang');
            $usersIDs = User::query()->where('notifications', '1')->where('id', $item->user_id)->pluck('id')->toArray();
            $notify = new Notification();

            $notify->translateOrNew('en')->title = 'Order #' . $item->id;
            $notify->translateOrNew('ar')->title = $item->id . 'طلب #';
            $notify->translateOrNew('en')->message = $message_en;
            $notify->translateOrNew('ar')->message = $message_ar;
            $notify->target_id = $item->id;
            $notify->user_id = $item->user_id;
            $notify->fcm_token = $item->fcm_token;
            $notify->type = '2';
            $notify->save();

            $tokens_en = Token::where('lang', 'en')->where('fcm_token', $item->fcm_token)->pluck('fcm_token')->toArray();
            $tokens_ar = Token::where('lang', 'ar')->where('fcm_token', $item->fcm_token)->pluck('fcm_token')->toArray();
            sendNotificationToUsers($tokens_en, '2', $item->id, 'Order #' . $item->id, $message_en);
            sendNotificationToUsers($tokens_ar, '2', $item->id, $item->id . 'طلب #', $message_ar);
        }
        activity($item->id)->causedBy(auth('admin')->user())->log('تعديل في حالة الطلب ');


        return redirect()->back()->with('status', __('cp.update'));
    }

    public function changeStatus(Request $request , $id)
    {
        $roles = [
            'status' => 'required',
        ];
        $this->validate($request, $roles);

        $item = Order::where('id', $id)->first();
        if ($item->status != 4 && $item->status != 5) {
            $item->status = $request->status;
            $item->save();

            if ($item->status == 1) {
                return redirect()->back();
            } else {

                $message_en = '';
                $message_ar = '';
                if ($item->status == 2) {
                    $message_en = 'You order is Being Prepared';
                    $message_ar = 'طلبك قيد التحضير';
                } elseif ($item->status == 3) {
                    $message_en = 'Your order is Ready for Pick Up';
                    $message_ar = 'طلبك جاهز للاستلام';
                } elseif ($item->status == 4) {
                    $message_en = 'Your order has been picked up';
                    $message_ar = 'تم تسليم طلبك';
                } elseif ($item->status == 5) {
                    $message_en = 'Sorry! Your order has been cancelled, please contact our customer service.';
                    $message_ar = 'نأسف ! تم الغاء طلبك , يرجى التواصل مع خدمة العملاء';
                }
                $locales = Language::all()->pluck('lang');
                $usersIDs = User::query()->where('notifications', '1')->where('id', $item->user_id)->pluck('id')->toArray();
                $notify = new Notification();

                $notify->translateOrNew('en')->title = 'Order #' . $item->id;
                $notify->translateOrNew('ar')->title = $item->id . 'طلب #';
                $notify->translateOrNew('en')->message = $message_en;
                $notify->translateOrNew('ar')->message = $message_ar;
                $notify->target_id = $item->id;
                $notify->user_id = $item->user_id;
                $notify->fcm_token = $item->fcm_token;
                $notify->type = '2';
                $notify->save();

                $tokens_en = Token::where('lang', 'en')->where('fcm_token', $item->fcm_token)->pluck('fcm_token')->toArray();
                $tokens_ar = Token::where('lang', 'ar')->where('fcm_token', $item->fcm_token)->pluck('fcm_token')->toArray();
                sendNotificationToUsers($tokens_en, '2', $item->id, 'Order #' . $item->id, $message_en);
                sendNotificationToUsers($tokens_ar, '2', $item->id, $item->id . 'طلب #', $message_ar);

                activity($item->id)->causedBy(auth('admin')->user())->log('تعديل في حالة الطلب ');

            }
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        //
        $ad = Order::query()->findOrFail($id);
        if ($ad) {
            Order::query()->where('id', $id)->delete();

            return "success";
        }
        return "fail";
    }

    public function OrdersExportForAdmin(Request $request)
    {
        activity()->causedBy(auth('admin')->user())->log(' تصدير ملف إكسل لبيانات الطلبات ');
        return Excel::download(new OrdersExportForAdmin($request), 'orders.xlsx');
    }

    public function OrdersReportForAdmin(Request $request)
    {
        activity()->causedBy(auth('admin')->user())->log(' تصدير تقرير لبيانات الطلبات ');
        return Excel::download(new OrdersReportForAdmin($request), 'orders.xlsx');
    }

    public function pdfOrders(Request $request)
    {
        activity()->causedBy(auth('admin')->user())->log(' تصدير ملف PDF لبيانات الطلبات ');
        $items = Order::orderByDesc('id')->get();
        $pdf = PDF::loadView('admin.orders.export_pdf', ['items' => $items]);
        return $pdf->download('orders.pdf');
    }

    public function getNewOrdersCount()
    {
        if (Session::get('admin_total_notifications')) {
            return response()->json(Session::get('admin_total_notifications'));
        } else {
            return response()->json(0);
        }
    }

    public function changeOrdersCount(Request $request)
    {
        $value = $request->value;
        Session::put('admin_total_notifications', $value);
        response()->json('success');
    }

    public function refund($id)
    {
         
        $order = Order::where('id',$id)->first();
        if ($order){
            if ($order->status == '5'){
                $refund = refund( $order->total, $order->payment_id, @$order->provider->supplier_code);
                if ($refund->status && $refund->response && $refund->response->Data) {
                    if ($refund->response->IsSuccess && $refund->response->Data->Key == $order->payment_id) {
                        $order->payment_status = 2;
                        $order->refund_Key = @$refund->response->Data->Key;
                        $order->refund_id = @$refund->response->Data->RefundId;
                        $order->refund_reference = @$refund->response->Data->RefundReference;
                        $order->refund_amount = @$refund->response->Data->Amount;
                        $order->save();
                    }
                }
            }
        }
        return redirect()->back();
    }
//  number_format(@70, 3,'.',',')

    public function invoice($id){
        $item = Order::where('id',$id)->first();
        return view('admin.orders.invoice')->with(compact('item'));
    }


}
