<?php


use App\Models\Setting;
use App\Models\Store;
use App\Models\StoreUsers;
use App\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;



function payment($amount,$order_id,$redirect_url , $SupplierCode ,$payment_method='KNET') {

    //Test
    $apiURL = 'https://apitest.myfatoorah.com';
    // $apiKey = 'rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL';
        $apiKey = 'P5koQx0UjoRk1jbFHXrz0NjHUCKpX8_GKpb_5TKhSvwl_DLWMdXh_4PScYheYyLcV5VS7UddNusysHMUqdNgjO68npKK0WroBhnMtgyUh1um30yOOcqKVkgX9ISi74VCMNHaoe96I1Ha4E2xBgw-HaGzLuEGGZtkh8YUlqFwE6JTxAPsn2e8HYBNfkrx1M7FU80u-5TJBilfWlAivzkkWXJ4-HmnuON8jps8ZiPd_vK26rQZMjYuT6-wPP3_plJDO7-g2ypc_-bcnj1GBLImTAwg4DmXyz66LC-4xAec1lc3SEP5bzEtQUMDb03hc6jAzBGt3ob0q3gMUjwW_QthXk1XiYLvSQ48GnhbzsfiQ4RZ7TAYNEAd8r3LuypbN2_HwzXEjBDo6PkNSGE3h4MSw1NyC22QxTCiTlKk61FuU1LLf_XPTuAOvD7bfzEwLfUypKjzPSmkvDVR1IY6RWYd9QXXdiy_I8Zo9JtrhvVuC4luf_NWqpJ3hmD1RrncCgGR-2XCrCA4YXIaX8c2JMBELS6hmoGQveexVqmefeXvC4L3sirG-YEn54RbehHEkjaBRXdILlk2qeujAvTe_7o6w3AjzUfwVkwXUQqaNkOAh-W4oeNiUZDuRM91CE6eqtV0D5TGUMMHb9BjIk-xFllgorU9TVbBqlnyT5LovKDLON4VxbI9cn0aTipFz7NPbGsurSO_yQ';
    //Live
    //$apiURL = 'https://api.myfatoorah.com';
    // $apiKey = 'VvZMc_Whl1MuKWB81zInjPuqSCZ9p4Mn_5iV9cwJyrkppmFT4QUeFWlAAWSsbSb4-lkL_hIvvxShtfbkpg2ofP-kh6wD3vZ891xAzh2FSoUKFosUjxY1qSE6A9MLnmzpF__1jFgN8namljyHphYg0atfpgWCByCVB6v3yjXU88TQaQ8M5OnqjTJGBAq9OS6lmFMZzLW2-H4yGQMdBYmrP7saGX9o_tP3GjRge7M-wBBmCl1AiSrwJAA9vdDk1oFiX7um9Riuwjj3qG-VbyRgJNjcSWpUuyy8QLq42Yvk4n3P8zMf8FinpQ9RMfRu5N5taTbRqhCMGQ1_Ol1-amIEKS3Y2Ir-p6aZhq57AflC-giwYkGXX18xiVoFrJBhyZl5mm31ueFLIVpdeo95HxnADuffh0k6rtoubzP8Y5BeVRrXzown9bp6xlrtATOv2NVJ5xMNUTmJQ4q8cR4YP1joC0mmQWCtzRCdjaSrJLFrSIRGg7B6RYvP1yVIMPvCN5ogpy9g7oMCS_AjmaNLftFyFRF_6QQLNXYvlgApOPBhpIY-711PPKWD7mnTSyFd7gLlhmPFAsM_LlbNO4GMvoZgDhd3Ybv7aHSbMKqhyb-OOLY92_CvRe8O1f-vidsGgmomBPai_jC6ZNlxkFO5YJ7s0N31Qd9Iwa6qjWwtnWFTNPDs357y2jwFhuok8gVEFitu5AFm7w';

    // $ipPostFields = ['InvoiceAmount' => $amount, 'CurrencyIso' => 'KWD'];
    // $json = callAPI("$apiURL/v2/InitiatePayment", $apiKey, $ipPostFields);



  $postFields = [
        'paymentMethodId' => $payment_method,
        'InvoiceValue'    => $amount,
        'Suppliers' => [
            (object) [
            'SupplierCode' => $SupplierCode,
            'ProposedShare' => null,
            'InvoiceShare' => $amount,
           ]
        ],
        'CallBackUrl'     => $redirect_url,
        'ErrorUrl'        => route('failPayment'), //or 'https://example.com/error.php'
        'Language'        => app()->getLocale(), //or 'ar'
        'CustomerReference'  => $order_id,
    ];
    //Call endpoint
    $json = callAPI("$apiURL/v2/ExecutePayment", $apiKey, $postFields);
    return $json;
}

function validatePayment($paymentId){
    /* ------------------------ Configurations ---------------------------------- */
    //Test
    $apiURL = 'https://apitest.myfatoorah.com';
    // $apiKey = 'rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL'; //Test token value to be placed here: https://myfatoorah.readme.io/docs/test-token
        $apiKey = 'P5koQx0UjoRk1jbFHXrz0NjHUCKpX8_GKpb_5TKhSvwl_DLWMdXh_4PScYheYyLcV5VS7UddNusysHMUqdNgjO68npKK0WroBhnMtgyUh1um30yOOcqKVkgX9ISi74VCMNHaoe96I1Ha4E2xBgw-HaGzLuEGGZtkh8YUlqFwE6JTxAPsn2e8HYBNfkrx1M7FU80u-5TJBilfWlAivzkkWXJ4-HmnuON8jps8ZiPd_vK26rQZMjYuT6-wPP3_plJDO7-g2ypc_-bcnj1GBLImTAwg4DmXyz66LC-4xAec1lc3SEP5bzEtQUMDb03hc6jAzBGt3ob0q3gMUjwW_QthXk1XiYLvSQ48GnhbzsfiQ4RZ7TAYNEAd8r3LuypbN2_HwzXEjBDo6PkNSGE3h4MSw1NyC22QxTCiTlKk61FuU1LLf_XPTuAOvD7bfzEwLfUypKjzPSmkvDVR1IY6RWYd9QXXdiy_I8Zo9JtrhvVuC4luf_NWqpJ3hmD1RrncCgGR-2XCrCA4YXIaX8c2JMBELS6hmoGQveexVqmefeXvC4L3sirG-YEn54RbehHEkjaBRXdILlk2qeujAvTe_7o6w3AjzUfwVkwXUQqaNkOAh-W4oeNiUZDuRM91CE6eqtV0D5TGUMMHb9BjIk-xFllgorU9TVbBqlnyT5LovKDLON4VxbI9cn0aTipFz7NPbGsurSO_yQ';

    //Live
    // $apiURL = 'https://api.myfatoorah.com';
    // $apiKey = 'VvZMc_Whl1MuKWB81zInjPuqSCZ9p4Mn_5iV9cwJyrkppmFT4QUeFWlAAWSsbSb4-lkL_hIvvxShtfbkpg2ofP-kh6wD3vZ891xAzh2FSoUKFosUjxY1qSE6A9MLnmzpF__1jFgN8namljyHphYg0atfpgWCByCVB6v3yjXU88TQaQ8M5OnqjTJGBAq9OS6lmFMZzLW2-H4yGQMdBYmrP7saGX9o_tP3GjRge7M-wBBmCl1AiSrwJAA9vdDk1oFiX7um9Riuwjj3qG-VbyRgJNjcSWpUuyy8QLq42Yvk4n3P8zMf8FinpQ9RMfRu5N5taTbRqhCMGQ1_Ol1-amIEKS3Y2Ir-p6aZhq57AflC-giwYkGXX18xiVoFrJBhyZl5mm31ueFLIVpdeo95HxnADuffh0k6rtoubzP8Y5BeVRrXzown9bp6xlrtATOv2NVJ5xMNUTmJQ4q8cR4YP1joC0mmQWCtzRCdjaSrJLFrSIRGg7B6RYvP1yVIMPvCN5ogpy9g7oMCS_AjmaNLftFyFRF_6QQLNXYvlgApOPBhpIY-711PPKWD7mnTSyFd7gLlhmPFAsM_LlbNO4GMvoZgDhd3Ybv7aHSbMKqhyb-OOLY92_CvRe8O1f-vidsGgmomBPai_jC6ZNlxkFO5YJ7s0N31Qd9Iwa6qjWwtnWFTNPDs357y2jwFhuok8gVEFitu5AFm7w';

    $postFields = [
        'Key'     => $paymentId,
        'KeyType' => 'paymentId'
    ];
    //Call endpoint
    $json       = callAPI("$apiURL/v2/getPaymentStatus", $apiKey, $postFields);
    return $json;
}

function callAPI($endpointURL, $apiKey, $postFields = [], $requestType = 'POST') {

    $curl = curl_init($endpointURL);
    curl_setopt_array($curl, array(
        CURLOPT_CUSTOMREQUEST  => $requestType,
        CURLOPT_POSTFIELDS     => json_encode($postFields),
        CURLOPT_HTTPHEADER     => array("Authorization: Bearer $apiKey", 'Content-Type: application/json'),
        CURLOPT_RETURNTRANSFER => true,
    ));

    $response = curl_exec($curl);
    $curlErr  = curl_error($curl);

    curl_close($curl);

    if ($curlErr) {
        return (object) ["status"=>false,"message"=>$curlErr];
    }

    $error = handleError($response);
    if ($error) {
        return (object) ["status"=>false,"message"=>$error];
    }
    $res = json_decode($response);

    return (object) ["status"=>true,"response"=>$res];
}

function handleError($response) {

    $json = json_decode($response);
    if (isset($json->IsSuccess) && $json->IsSuccess == true) {
        return null;
    }

    //Check for the errors
    if (isset($json->ValidationErrors) || isset($json->FieldsErrors)) {
        $errorsObj = isset($json->ValidationErrors) ? $json->ValidationErrors : $json->FieldsErrors;
        $blogDatas = array_column($errorsObj, 'Error', 'Name');

        $error = implode(', ', array_map(function ($k, $v) {return "$k: $v";
        }, array_keys($blogDatas), array_values($blogDatas)));
    } else if (isset($json->Data->ErrorMessage)) {
        $error = $json->Data->ErrorMessage;
    }

    if (empty($error)) {
        $error = (isset($json->Message)) ? $json->Message : (!empty($response) ? $response : 'API key or API URL is not correct');
    }

    return $error;
}

function refund($amount,$paymentId, $SupplierCode){
    /* ------------------------ Configurations ---------------------------------- */
    //Test
    $apiURL = 'https://apitest.myfatoorah.com';
    // $apiKey = 'rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL'; //Test token value to be placed here: https://myfatoorah.readme.io/docs/test-token
        $apiKey = 'P5koQx0UjoRk1jbFHXrz0NjHUCKpX8_GKpb_5TKhSvwl_DLWMdXh_4PScYheYyLcV5VS7UddNusysHMUqdNgjO68npKK0WroBhnMtgyUh1um30yOOcqKVkgX9ISi74VCMNHaoe96I1Ha4E2xBgw-HaGzLuEGGZtkh8YUlqFwE6JTxAPsn2e8HYBNfkrx1M7FU80u-5TJBilfWlAivzkkWXJ4-HmnuON8jps8ZiPd_vK26rQZMjYuT6-wPP3_plJDO7-g2ypc_-bcnj1GBLImTAwg4DmXyz66LC-4xAec1lc3SEP5bzEtQUMDb03hc6jAzBGt3ob0q3gMUjwW_QthXk1XiYLvSQ48GnhbzsfiQ4RZ7TAYNEAd8r3LuypbN2_HwzXEjBDo6PkNSGE3h4MSw1NyC22QxTCiTlKk61FuU1LLf_XPTuAOvD7bfzEwLfUypKjzPSmkvDVR1IY6RWYd9QXXdiy_I8Zo9JtrhvVuC4luf_NWqpJ3hmD1RrncCgGR-2XCrCA4YXIaX8c2JMBELS6hmoGQveexVqmefeXvC4L3sirG-YEn54RbehHEkjaBRXdILlk2qeujAvTe_7o6w3AjzUfwVkwXUQqaNkOAh-W4oeNiUZDuRM91CE6eqtV0D5TGUMMHb9BjIk-xFllgorU9TVbBqlnyT5LovKDLON4VxbI9cn0aTipFz7NPbGsurSO_yQ';

    //Live
    //$apiURL = 'https://api.myfatoorah.com';
    //$apiKey = 'fmY03mGqrdm_gMk4A_Jdgc8dNqXxAZAXbMrfIGC-BA1IsxWDTZpF0LG3NHBpNPiARp1fAyq9UuxL9TTPvhp4qskpm-VGW1i6n-HZ1BSMCGdJEwf9nOfZiT5gGLphOgK7y_odiBA_xb2sCGi1hUG-nM1bBY67WsBb5-Pph7uNIKABYyaIezBlcbZOm02wuX8WV2GiUo2CeO5PRHRh0P2leccyGCwjhY6t2DVVtrjTH1ogFX6uvfzGz1M_c_jAF7k5MiZ6g7k5WrFNUgbi48hmN5DkMvKO_jTqMrzzJ0100UV2X4yhdDSyXHfyOUcZUNBCau4_AUaJKGEYGmKbXR_FV_4rb_LZfFKnnTvvVNKWbm80NhWZyVPmBNiEYev1_uS7QxZ7yIM0bMk8ohWCiT0t_0hHkL7UGvI6ACRZioP_RQWptjaiZcBVNqt_rfFC3k4ki58rbuMJnc5NlRr881bQeKpv6jR5OF8ptZox6hM3u2BrhoBZjjSMWGbHxn9KFp2kpOmFkl2vhIlCydPWxdhXqCoVwfe1XnFvpJGsfx9e66M2ub0EQObgpnlMxZ5Z4Js8GTvCB623vMXo2uwDYddmm15g1KuGBoaKjgbt7-0wWlFahFCLveLvd1P5y9H3lKEd7SUUH-fMUZ7qZOmh7UTuYRi1eALUvetdrpBlNuHOSRCBs8Ok_EKH34HaY7AafZh_DYVTew'; //Live token value to be placed here: https://myfatoorah.readme.io/docs/live-token

    //------------- Post Fields -------------------------
    $postFields = [
        // Fill required Data
        'Key'     => $paymentId,
        'KeyType' => 'paymentid',
        'RefundChargeOnCustomer' => true,
        'ServiceChargeOnCustomer' => true,
         'VendorDeductAmount' => $amount,
        'Suppliers' => [
            (object) [
            'SupplierCode' => $SupplierCode,
            'SupplierDeductedAmount' => $amount,
           ]
        ],
        
        //Fill optional Data
        //"RefundChargeOnCustomer"  => false,
        //"ServiceChargeOnCustomer" => false,
        //"AmountDeductedFromSupplier"=> 0
    ];

    //------------- Call MakeRefund Endpoint ------------
    $json   = callAPI("$apiURL/v2/MakeSupplierRefund", $apiKey,$postFields);
    return $json;

}


function updateAdminOrdersFirebaseNotification($type,$target,$value=1){
    $database = app('firebase.database');
    $x = $database->getReference("adminOrdersNotifications/$target")->getSnapshot()->getValue();
    $newValue =0;
    if($type ==='increment') $newValue = $x+$value;
    if($type ==='decrement') $newValue = ($x-$value>0)? $x-$value : 0;
    if($type ==='reset') $newValue = 0;
    if($type ==='newValue') $newValue = $value;
    $database->getReference("adminOrdersNotifications")->update([
        $target => $newValue,
    ]);
}

function updateProviderOrdersFirebaseNotification($type,$target,$value=1){
    $database = app('firebase.database');
    $x = $database->getReference("providerOrdersNotifications/$target")->getSnapshot()->getValue();

    $newValue =0;
    if($type ==='increment') $newValue = $x+$value;
    if($type ==='decrement') $newValue = ($x-$value>0)? $x-$value : 0;
    if($type ==='reset') $newValue = 0;
    if($type ==='newValue') $newValue = $value;
    $database->getReference("providerOrdersNotifications")->update([
        $target => $newValue,
    ]);
}


function getUserPermissionOnStore($store_id){
    if(auth('api')->check() && auth('api')->user()->type == 2){
        $position = StoreUsers::where(['status'=>'active','store_id'=>$store_id,'user_id'=>auth('api')->user()->id])->first();
        if($position){
           return $position->position_id;
        }
    }
    return 0;
}

function can($permission){
    //  $user = auth()->user();

      $user='';
        if(auth()->guard('admin')->check()){
            $user=  auth()->guard('admin')->user();
         }else{
           return redirect('admin/login');
         }

    /*
        $users = User::where('status', 1)->get();
        $users->map(function ($item, $key) {
            return ucfirst($item->name);
        });
        dd($users);
    */

        if ($user->id == 1) {
            return true;
        }
//Cache::forget('permissions_' . $user->id);
     $values =[];
        $minutes = 5;
        $permissions = Cache::remember('permissions_' . $user->id, $minutes, function () use ($user,$values) {
             foreach($user->roles as $role){
                 foreach($role->role->permissions as $one_permission){
                     array_push($values, $one_permission->permission->slug);
                 }
            }
                 return  $values ;
    });

    $permissions = array_flatten($permissions);
     if(is_array($permission)){
         $result = array_intersect($permission, $permissions);
            if (count($result) > 0) {
                 return true ;
            }else{
                return false ;
            }
     }else{
         return in_array($permission, $permissions);
     }




    //@if(can('reservations.panel'))
}



     function image_extensions(){
        return array('jpg','png','jpeg','gif','bmp');
     }

     function audio_extensions(){
        return array('wav','ogg','mp3','wma','midi','aif','aifc','aiff','au','ea','3gp');
     }

     function video_extensions(){
        return array('mp4','mov','ogg','3gp','3gpp','x-flv','wmv','flv','avi');
     }

     function doc_extensions(){
        return array('pdf','doc','docx','ppt','pptx','xls','xlsx','txt');
     }


function admin_assets($dir){
    return url('/admin_assets/assets/' . $dir);
}

function choose(){
    return url('/uploads/images/choose.png');
}

function subadmin_assets($dir){
    return url('/subadmin/assets/' . $dir);
}

function getLocal(){
    return app()->getLocale();
}

function convertAr2En($string){
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $arabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
    $num = range(0, 9);
    $convertedPersianNums = str_replace($persian, $num, $string);
    $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);
    return $englishNumbersOnly;
}




function sendSMS($mobile,$message){
    try {
        $ch = curl_init();
        $data="AppSid=g9X11HAoeK16Pb3I0mqaHZsOK_LIaR&Recipient=$mobile&Body=$message";
        curl_setopt($ch, CURLOPT_URL, "https://api.unifonic.com/rest/Messages/Send");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          "Content-Type: application/x-www-form-urlencoded"
        ));

        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response,true);
    } catch (\Exception $ex) {
        return false;
    }
}

function random_number($digits){
    return str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);
}


function sendNotificationToUsers($tokens,$msgType="1", $target_id , $title='Yammk', $message ){
    try {
        $headers = [
            'Authorization: key='.env("FireBaseKey"),
            'Content-Type: application/json'
        ];

        if(!empty($tokens)) {
            $data= [
                "registration_ids" => $tokens,
                "data" => [
                    'body' => $message,
                    'type' => "notify",
                    'title' => $title,
                    'target_id' => $target_id, // order_id or user_id
                    'msgType' => $msgType,//1=>msg , 2=>order 
                    'badge' => 1,
                    "click_action" => 'FLUTTER_NOTIFICATION_CLICK',
                    'icon' => 'myicon',//Default Icon
                    'sound' => 'mySound'//Default sound
                ],
                "notification" => [
                    'body' => $message,
                    'type' => "notify",
                    'title' => 'Yammk',
                    'target_id' => $target_id, // order_id or user_id
                    'msgType' => $msgType,//1=>msg , 2=>order 
                    'badge' => 1,
                    "click_action" => 'FLUTTER_NOTIFICATION_CLICK',
                    'icon' => 'myicon',//Default Icon
                    'sound' => 'mySound'//Default sound
                ]
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            $result = curl_exec($ch);
            curl_close($ch);
            // $resultOfPushToIOS = "Done";
            //   return $result; // to check does the notification sent or not
        }

    } catch (\Exception $ex) {
        return $ex->getMessage();
    }





}



function slugURL($title){
    $WrongChar = array('@', '؟', '.', '!','?','&','%','$','#','{','}','(',')','"',':','>','<','/','|','{','^');

    $titleNoChr = str_replace($WrongChar, '', $title);
    $titleSEO = str_replace(' ', '-', $titleNoChr);
    return $titleSEO;
}

function pointInPolygon($point, $polygon) {
  //  pointOnVertex = true;

    // Transform string coordinates into arrays with x and y values
    $point = pointStringToCoordinates($point);
    $vertices = array();
    foreach ($polygon as $vertex) {
        $vertices[] = pointStringToCoordinates($vertex);
    }

    // Check if the point sits exactly on a vertex
    if (pointOnVertex($point, $vertices) == true) {
        return true;
    }

    // Check if the point is inside the polygon or on the boundary
    $intersections = 0;

    for ($i=1; $i < count($vertices); $i++) {
        $vertex1 = $vertices[$i-1];
        $vertex2 = $vertices[$i];
        if ($vertex1['y'] == $vertex2['y'] and $vertex1['y'] == $point['y'] and $point['x'] > min($vertex1['x'], $vertex2['x']) and $point['x'] < max($vertex1['x'], $vertex2['x'])) { // Check if point is on an horizontal polygon boundary
            return true;
        }
        if ($point['y'] > min($vertex1['y'], $vertex2['y']) and $point['y'] <= max($vertex1['y'], $vertex2['y']) and $point['x'] <= max($vertex1['x'], $vertex2['x']) and $vertex1['y'] != $vertex2['y']) {
            $xinters = ($point['y'] - $vertex1['y']) * ($vertex2['x'] - $vertex1['x']) / ($vertex2['y'] - $vertex1['y']) + $vertex1['x'];
            if ($xinters == $point['x']) { // Check if point is on the polygon boundary (other than horizontal)
                return true;
            }
            if ($vertex1['x'] == $vertex2['x'] || $point['x'] <= $xinters) {
                $intersections++;
            }
        }
    }
    // If the number of edges we passed through is odd, then it's in the polygon.
    if ($intersections % 2 != 0) {
        return true;
    } else {
        return false;
    }
}

function pointOnVertex($point, $vertices) {
    foreach($vertices as $vertex) {
        if ($point == $vertex) {
            return true;
        }
    }

}

function pointStringToCoordinates($pointString) {
    $coordinates = explode(" ", $pointString);
    return array("x" => $coordinates[0], "y" => $coordinates[1]);
}

function get_center($coords){
    $count_coords = count($coords);
    $xcos=0.0;
    $ycos=0.0;
    $zsin=0.0;

        foreach ($coords as $lnglat)
        {
            $lat = $lnglat['latitude'] * pi() / 180;
            $lon = $lnglat['longitude'] * pi() / 180;

            $acos = cos($lat) * cos($lon);
            $bcos = cos($lat) * sin($lon);
            $csin = sin($lat);
            $xcos += $acos;
            $ycos += $bcos;
            $zsin += $csin;
        }

    $xcos /= $count_coords;
    $ycos /= $count_coords;
    $zsin /= $count_coords;
    $lon = atan2($ycos, $xcos);
    $sqrt = sqrt($xcos * $xcos + $ycos * $ycos);
    $lat = atan2($zsin, $sqrt);

    return number_format($lat * 180 / pi(),6).','.number_format($lon * 180 / pi(),6);
}

