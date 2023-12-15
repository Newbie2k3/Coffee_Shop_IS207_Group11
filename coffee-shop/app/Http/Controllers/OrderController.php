<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\Status;
use App\Models\Category;
use App\Models\Paymentmethod;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function view()
    {
        $title = "Order";

        $user = auth()->user();
        $cart_items = Cart::with('product')->where('user_id', $user->id)->get();

        $product_ids = $cart_items->pluck('product_id');
        $products = Product::whereIn('id', $product_ids)->get();

        $cart_total = $this->calculateCartTotal();
        $liststatus = Paymentmethod::all();
        return view('pages.order.index', compact('cart_items', 'products', 'cart_total', 'liststatus'))->with('title', $title);
    }

    public function getOrder($orderId)
    {
        $order = Order::find($orderId);
        return response()->json($order);
    }
    public function insertOrder(Request $request)
    {
        $user = auth()->user();
        $cart_id = $request->input('cart_id');
        $paymentmethod_id = $request->input('payment_method_id');
        $status_id = 1;
        $time = now();
        $total = $this->calculateCartTotal();

        Order::create([
            'user_id' => $user->id,
            'cart_id' => $cart_id,
            'paymentmethod_id' => $paymentmethod_id,
            'status_id' => $status_id,
            'time' => $time,
            'total' => $total,
        ]);
        $cart = Cart::find($cart_id);
        $cart->update([
            'is_deleted' => 1,
        ]);
        return response()->json([]);
    }

    public function paymentVnpay(Request $request)
    {
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $user = auth()->user();
        $cart_id = $request->input('cart_id');
        $paymentmethod_id = $request->input('payment_method_id');
        $status_id = 2;
        $time = now();
        $total = $this->calculateCartTotal();

        $newOrder = Order::create([
            'user_id' => $user->id,
            'cart_id' => $cart_id,
            'paymentmethod_id' => $paymentmethod_id,
            'status_id' => $status_id,
            'time' => $time,
            'total' => $total,
        ]);
        $vnp_TmnCode = "N5NB4BEP"; //Mã định danh merchant kết nối (Terminal Id)
        $vnp_HashSecret = "XAZEKIGDWWWTXVRLSCZGEJBFGMLKCDUL"; //Secret key
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/payment-vnpay-return";
        $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
        //Config input format
        //Expire
        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));

        $vnp_TxnRef = $newOrder->id; //Mã giao dịch thanh toán tham chiếu của merchant
        $vnp_Amount =  $total; //$_POST['amount']; // Số tiền thanh toán
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => "vn",
            "vnp_OrderInfo" => "$vnp_TxnRef",
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $expire
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = "";
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        return response()->json(['url' => $vnp_Url]);
    }

    private function calculateCartTotal()
    {
        $user = auth()->user();
        $cart_items = Cart::with('product')->where('user_id', $user->id)->get();

        $total = 0;

        foreach ($cart_items as $cart_item) {
            $total += $cart_item->product->price * $cart_item->product_qty;
        }

        return $total;
    }
    public function paymentResult()
    {
        $vnp_TmnCode = "N5NB4BEP"; //Mã định danh merchant kết nối (Terminal Id)
        $vnp_HashSecret = "XAZEKIGDWWWTXVRLSCZGEJBFGMLKCDUL"; //Secret key
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/payment-vnpay-return";
        $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
        $inputData = array();
        $returnData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
        $vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
        $vnp_Amount = $inputData['vnp_Amount'] / 100; // Số tiền thanh toán VNPAY phản hồi
        $orderId = $inputData['vnp_TxnRef'];
        $order = Order::find($orderId);
        $debug = "Start";
        try {
            //Check Orderid    
            //Kiểm tra checksum của dữ liệu
            if ($secureHash == $vnp_SecureHash) {
                //Lấy thông tin đơn hàng lưu trong Database và kiểm tra trạng thái của đơn hàng, mã đơn hàng là: $orderId            
                //Việc kiểm tra trạng thái của đơn hàng giúp hệ thống không xử lý trùng lặp, xử lý nhiều lần một giao dịch
                //Giả sử: $order = mysqli_fetch_assoc($result);   
                $debug = "Checksum match";
                if ($order != NULL) {
                    $debug = "Order found";
                    if ($order->status_id != NULL && $order->status_id == 2) {
                        $debug = "Order already confirmed";
                        if ($inputData['vnp_ResponseCode'] == '00' && $inputData['vnp_TransactionStatus'] == '00') {
                            $debug = "Payment success";
                            $order->update([
                                'status_id' => 1,
                            ]);
                            $cart = Cart::find($order->cart_id);
                            $cart->update([
                                'is_deleted' => 1,
                            ]);
                        } else {
                            $debug = "Payment failed";
                            $order->update([
                                'status_id' => 2,
                            ]);
                        }
                        $returnData['RspCode'] = '00';
                        $returnData['Message'] = 'Confirm Success';
                    } else {
                        $returnData['RspCode'] = '02';
                        $returnData['Message'] = 'Order already confirmed';
                    }
                } else {
                    $returnData['RspCode'] = '01';
                    $returnData['Message'] = 'Order not found';
                }
            } else {
                $returnData['RspCode'] = '97';
                $returnData['Message'] = 'Invalid signature';
            }
        } catch (Exception $e) {
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Unknow error';
        }
        return view('pages.order.order_result', compact('inputData', 'order', 'debug'));
    }

    public function statistic()
    {
        $order_trong_ngay = Order::where('status_id', 1)
            ->whereDate('time', '>=', now())
            ->get();
        $tat_ca_danh_muc = Category::all();
        $tat_ca_san_pham = Product::all();
        $doanh_thu_trong_ngay = 0;

        foreach ($order_trong_ngay as $order) {
            $doanh_thu_trong_ngay += $order->total;
        }
        $so_luong_danh_muc = count($tat_ca_danh_muc);
        $so_luong_san_pham = count($tat_ca_san_pham);
        $don_hang_trong_ngay = count($order_trong_ngay);
        $don_hang_cod = count(Order::where('paymentmethod_id', 1)->get());
        $don_hang_online = count(Order::where('paymentmethod_id', 2)->get());
        return view('admin.dashboard', compact('doanh_thu_trong_ngay', 'so_luong_danh_muc', 'so_luong_san_pham', 'don_hang_trong_ngay'));
    }
    public function chartStatistic()
    {
        $don_hang_cod = count(Order::where('paymentmethod_id', 1)->get());
        $don_hang_online = count(Order::where('paymentmethod_id', 2)->get());
        return response()->json(['don_hang_cod' => $don_hang_cod, 'don_hang_online' => $don_hang_online]);
    }
}
