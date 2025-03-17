<?php

namespace App\Http\Controllers\User;

use App\Class\PhonePeHelper;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Refund;
use Exception;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{




  public function __construct(private PhonePeHelper $phonehelper) {}

  public function index()
  {

    return view('user.user-dashboard');
  }

  public function store() {}

  public function trackOrder($id)
  {

    $order = Order::with(['transaction', 'address', 'refund'])->find($id);


    if ($order->is_cancelled) {

      $refund = Refund::where('order_id', $id)->first();

      $reponse = $this->refundResponse($refund->refund_id);

      if ($reponse['state'] == 'COMPLETED') {

        $refund->update([
          'status' => $reponse['state'],
          'refund_completed_at' => now(),
        ]);
      
      }

      return view('user.track-rufund-order', compact('order'));
    }

    return view('user.track-order', compact('order'));
  }

  private function refundResponse($refund_id)
  {
    try {

      $accessToken = $this->phonehelper->validateToken();

      $response = $this->phonehelper->fetchRefundStatus($accessToken, $refund_id);

      return $response;
    } catch (Exception $e) {
      return $this->phonehelper->formatErrorResponse('Error processing refund');
    }
  }
}
