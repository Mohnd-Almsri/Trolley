<?php

namespace App\Http\Controllers;

use App\Jobs\StatusOrder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Traits\SendMessageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class
 OrderController extends Controller
{
    use sendMessageTrait;
    public function CreateOrder(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $totalPrice = 0;

            $order = new Order();
            $order->user_id = auth()->user()->id;
            $order->total_price = 0;
            $order->save();
            StatusOrder::dispatch($order,1,auth()->user()->phoneNumber)->delay(now()->addMinutes(0.05));
            StatusOrder::dispatch($order,2,auth()->user()->phoneNumber)->delay(now()->addMinutes(.01));
            StatusOrder::dispatch($order,3,auth()->user()->phoneNumber)->delay(now()->addMinutes(.15));
            $productIds = collect($request->products)->pluck('product_id')->toArray();
            $productTable = Product::whereIn('id', $productIds)->get()->keyBy('id');

            foreach ($request->products as $product) {

                $currentProduct = $productTable->get($product['product_id']);

                if ($currentProduct) {
                    if ($currentProduct->quantity >= $product['quantity']) {
                        $currentProduct->decrement('quantity', $product['quantity']);

                        OrderItem::create([
                            'order_id' => $order->id,
                            'product_id' => $product['product_id'],
                            'quantity' => $product['quantity'],
                            'total_price' => $product['quantity'] * $currentProduct->price,
                        ]);

                        $totalPrice += $product['quantity'] * $currentProduct->price;


                    } else {
                        return response()->json([
                            'status' => 0,
                            'message' => 'the quantity of product ' . $product['product_id'] . ' is out of stock',
                        ]);
                    }
                } else {
                    return response()->json([
                        'status' => 0,
                        'message' => 'the product ' . $product['product_id'] . ' is\'t exist',
                    ]);
                }
            }
            $order->total_price = $totalPrice;
            $order->save();

$this->sendMessage(auth()->user()->phoneNumber, $this->formatOrderToText($order));


            DB::commit();

            return response()->json([
                'status' => 1,
                'message' => 'the order has been created',
                'data' => $order->load('orderItems'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 0,
                'message' => 'error : ' . $e->getMessage(),
            ]);
        }
    }
    public function UpdateOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            $order = Order::with('orderItems')->findOrFail($request->order_id);
        if($order->status=='pending'){
        foreach ($order->orderItems as $orderItem) {
        Product::where('id', $orderItem->product_id)->increment('quantity', $orderItem->quantity);
        }

    $order->orderItems()->delete();

    $productTable = Product::whereIn('id', collect($request->products)->pluck('product_id'))->get()->keyBy('id');

    $totalPrice = 0;

    foreach ($request->products as $product) {
        $productData = $productTable->get($product['product_id']);

        if ($productData->quantity >= $product['quantity']) {

            $productData->decrement('quantity', $product['quantity']);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity'],
                'total_price' => $product['quantity'] * $productData->price,
            ]);

            $totalPrice += $product['quantity'] * $productData->price;
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'the quantity of product ' . $product['product_id'] . ' is out of stock',]);
        }
    }
    $order->update([
        'total_price' => $totalPrice,

    ]);

    DB::commit();

    return response()->json([
        'status' => 1,
        'message' => 'the order has been updated',
        'data' => $order->load('orderItems'),
    ]);

}
else
    return response()->json([
        'status' => 0,
        'message' => 'you can\'t update this order because the order is already in progress',
    ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 0,
                'message' => 'error while updating order' . $e->getMessage(),
            ]);
        }
    }
    public function DeleteOrder(Request $request)
    {
        $request->validate(['order_id' => 'required|exists:orders,id']);

        $order = Order::where('user_id', auth()->user()->id)
            ->where('id', $request->order_id)
            ->with('orderItems')
            ->first();

        if (!$order) {
            return response()->json([
                'status' => 0,
                'message' => 'Order not found or does not belong to the user.'
            ]);
        }

        DB::beginTransaction();
        try {
      if ($order->status=='pending') {
          foreach ($order->orderItems as $orderItem) {
              Product::where('id', $orderItem->product_id)
                  ->increment('quantity', $orderItem->quantity);
          }

          $order->orderItems()->delete();
          $order->delete();

          DB::commit();

          return response()->json([
              'status' => 1,
              'message' => 'Order deleted successfully, and product quantities have been restored.'
          ]);

      }
      else return response()->json([
          'status' => 0,
          'message' => 'you can\'t update this order because the order is already in progress',
      ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 0,
                'message' => 'An error occurred while deleting the order.',
                'error' => $e->getMessage(),
            ]);
        }
    }
    public function UserOrders(){
    return response()->json([
    'status'=>1,
    'data'=>  auth()->user()->load('order.orderItems')
    ]);


    }
}
