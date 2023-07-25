<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Exports\OrderExport;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Setting;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->settings = Setting::query()->first();
        view()->share([
            'settings' => $this->settings,
        ]);

        $route = Route::currentRouteAction();
        $route_name = substr($route, strpos($route, "@") + 1);
        $this->middleware(function ($request, $next) use ($route_name) {
            if (can('users')) {
                return $next($request);
            }
            if ($route_name == 'index') {
                if (can(['users-show', 'users-create', 'users-edit', 'users-delete'])) {
                    return $next($request);
                }
            } elseif ($route_name == 'edit' || $route_name == 'update') {
                if (can('users-edit')) {
                    return $next($request);
                }
            } elseif ($route_name == 'destroy' || $route_name == 'delete') {
                if (can('users-delete')) {
                    return $next($request);
                }
            } else {
                return $next($request);
            }
            return redirect()->back()->withErrors(__('cp.you_dont_have_permission'));
        });
    }

    public function index(Request $request)
    {
        $items = User::query()->filter()->orderBy('id', 'desc')->where(['is_deleted' => '0'])->paginate($this->settings->paginateTotal);
        return view('admin.users.home', [
            'items' => $items,
        ]);

    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function orders($id)
    {
        $item = User::query()->where('id', $id)->first();
        $items = Order::where('user_id', $id)->orderByDesc('id')->paginate(30);
        return view('admin.users.orders')->with(compact('items', 'item'));
    }

    public function editOrder($user_id, $order_id)
    {
        $item = User::query()->where('id', $user_id)->first();
        $order = Order::where('id', $order_id)->first();
        return view('admin.users.edit_order')->with(compact('order', 'item'));
    }

    public function update_order($order_id, Request $request)
    {
        $order = Order::where('id', $order_id)->first();
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('status', __('cp.update'));
    }

    public function store(Request $request)
    {
        $roles = [
            'user_name' => 'required',
            'email' => 'required|email|unique:users',
            'mobile' => 'digits:8|unique:users,mobile',
            'status' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password|min:6',
        ];
        $this->validate($request, $roles);

        $user = new User();

        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->status = $request->status;
        $user->password = bcrypt($request->password);
        if ($request->get('notifications') == 'on') {
            $user->notifications = '1';
        } else {
            $user->notifications = '0';
        }
        $user->save();
        activity()->causedBy(auth('admin')->user())->log('إضافة مستخدم جديد');
        return redirect()->back()->with('status', __('cp.create'));
    }

    public function edit($id)
    {
        $item = User::findOrFail($id);
        return view('admin.users.edit', [
            'item' => $item,
        ]);
    }

    public function update(Request $request, $id)
    {
        $roles = [
            'user_name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|digits:8|unique:users,mobile,' . $id,
            'status' => 'required',
        ];
        $this->validate($request, $roles);

        $user = User::findOrFail($id);
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->status = $request->status;

        if ($request->get('notifications') == 'on') {
            $user->notifications = '1';
        } else {
            $user->notifications = '0';
        }
        $user->save();

        if ($request->status == 'not_active') {
            $notify = new Notification();

            $notify->translateOrNew('en')->title = 'Attention';
            $notify->translateOrNew('ar')->title = 'تنبيه';
            $notify->translateOrNew('en')->message = 'You Are Logout';
            $notify->translateOrNew('ar')->message = 'لقد تم تسجيل الخروج';
            $notify->target_id = 0;
            $notify->user_id = $user->id;
            $notify->type = '3';
            $notify->save();
            $usersIDs = User::query()->where('id', $user->id)->pluck('id')->toArray();
            $tokens_en = Token::where('lang', 'en')->whereIn('user_id', $usersIDs)->pluck('fcm_token')->toArray();
            $tokens_ar = Token::where('lang', 'ar')->whereIn('user_id', $usersIDs)->pluck('fcm_token')->toArray();
            sendNotificationToUsers($tokens_en, '3', 0, 'Attention', 'You Are Logout');
            sendNotificationToUsers($tokens_ar, '3', 0, 'تنبيه', 'لقد تم تسجيل الخروج');

            Token::where('user_id', $user->id)->delete();

        }
        activity($user->user_name)
//            ->performedOn($user)
            ->causedBy(auth('admin')->user())
            ->log(' تعديل المستخدم  ');

        return redirect()->back()->with('status', __('cp.update'));
    }

    public function edit_password($id)
    {
        $item = User::findOrFail($id);
        return view('admin.users.edit_password', ['item' => $item]);
    }

    public function update_password(Request $request, $id)
    {
        $users_rules = array(
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password|min:6',
        );
        $users_validation = Validator::make($request->all(), $users_rules);

        if ($users_validation->fails()) {
            return redirect()->back()->withErrors($users_validation)->withInput();
        }
        $user = User::findOrFail($id);
        $user->password = bcrypt($request->password);
        $user->save();
        activity($user->user_name)
            ->causedBy(auth('admin')->user())
            ->log(' تعديل كلمة المرور للمستخدم  ');

        return redirect()->back()->with('status', __('cp.update'));
    }

    public function destroy($id)
    {
        $item = User::query()->findOrFail($id);
        if ($item) {
            User::query()->where('id', $id)->delete();
            return "success";
        }
        return "fail";
    }

    public function exportUsers(Request $request)
    {
        activity()->causedBy(auth('admin')->user())->log(' تصدير ملف إكسل لبيانات المستخدمين ');
        return Excel::download(new UsersExport($request), 'users.xlsx');
    }

    public function pdfUsers(Request $request)
    {
        activity()->causedBy(auth('admin')->user())->log(' تصدير ملف PDF لبيانات المستخدمين ');
        $items = User::orderByDesc('id')->get();
        $pdf = PDF::loadView('admin.users.export_pdf', ['items' => $items]);
        return $pdf->download('users.pdf');
    }

    public function changeOrderStatus($id, Request $request)
    {
        $order = Order::where('id', $id)->first();
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('status', __('cp.update'));
    }

    public function generateInvoicePDF()
    {
        $order_id = $_GET['order_id'];
        $user_id = $_GET['user_id'];

        $order = Order::where('id', $order_id)->with('products')->first();
        $user = User::query()->findOrFail($user_id);
        $pdf = PDF::loadView('admin.users.invoicePDF', compact('user', 'order'));

        $fileName = time() . '.' . 'pdf';
        $pdf->save(public_path() . '/' . $fileName);

        $pdf = public_path($fileName);
        return response()->download($pdf);
    }

    public function order_all()
    {
        $items = Order::orderBy('id', 'desc')->paginate($this->settings->paginateTotal);
        return view('admin.orders.home', compact('items'));
    }

    public function edit_orders($order_id)
    {
        $order = Order::where('id', $order_id)->first();
        return view('admin.orders.edit', compact('order'));
    }

    public function update_orders($order_id, Request $request)
    {
        $order = Order::where('id', $order_id)->first();
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('status', __('cp.update'));
    }

         public function exportExcel(Request $request)
    {
        activity()->causedBy(auth('admin')->user())->log(' تصدير ملف إكسل لبيانات الطلبات ');
        return Excel::download(new OrderExport($request), 'contacts.xlsx');
    }

}
