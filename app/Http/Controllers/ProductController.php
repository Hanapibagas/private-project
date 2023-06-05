<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductGallery;
use App\Models\Sale;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function category()
    {
        $kategory = ProductCategory::all();
        $product = Product::all();
        return view('components.pages.category', compact('kategory', 'product'));
    }

    public function details_products(Request $request, $id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        return view('components.pages.details', compact('product'));
    }

    public function isi_form_pemesanan($transactionCode)
    {
        if (is_null($transactionCode)) {
            abort(404);
        }

        $title = "Create Transaction";

        $sales = Sale::with(['product'])->where('transaction_code', $transactionCode);
        $items = $sales->get();
        $subTotal = $sales->sum('total_price');

        $user = User::all();

        return view('components.pages.cart', [
            'title' => $title,
            'transactionCode' => $transactionCode,
            'items' => $items,
            'user' => $user,
            'subTotal' => $subTotal
        ]);
    }

    public function add_cart(Request $request)
    {
        $input = $request->all();

        $transactionCode = $input['transaction_code'];
        $quantity = $input['quantity'];

        Transaction::firstOrCreate(
            ['transaction_code' => $transactionCode],
            ['valid' => FALSE],
        );

        $products = Product::where('product_code', $input['product_code'])->get();
        foreach ($products as $product) {
            $productId = $product->id;
            $productName = $product->name;
            $productPrice = $product->selling_price;
            $productStock = $product->stock;
        }

        if (!isset($productId)) {
            return redirect()->back()->withErrors('Produk tidak ditemukan.');
        }

        $saleProducts = Sale::where([
            ['transaction_code', '=', $transactionCode],
            ['product_id', '=', $productId]
        ])->get();

        $total = $quantity * $productPrice;
        $reducedStock = $productStock - $quantity;

        $reduceProductStock = [
            'stock' => $reducedStock
        ];

        $create = [
            'transaction_code' => $transactionCode,
            'product_id' => $productId,
            'product_price' => $productPrice,
            'quantity' => $quantity,
            'total_price' => $total
        ];

        // Cek stok produk
        if ($productStock == 0) {
            return redirect()->back()->withErrors('Stok ' . $productName . ' kosong!');
        } elseif ((int)$quantity <= $productStock) {
            // Cek jika produknya sama, maka update qty, harga totalnya, dan update stock barang.
            if (!$saleProducts->isEmpty()) {
                foreach ($saleProducts as $saleProduct) {
                    if ($saleProduct->product_id == $productId) {
                        $update = [
                            'quantity' => $saleProduct->quantity + $quantity,
                            'total_price' => $saleProduct->total_price + $total,
                        ];
                        Sale::findOrFail($saleProduct->id)->update($update);
                        Product::findOrFail($productId)->update($reduceProductStock);
                    } else {
                        Sale::create($create);
                        Product::findOrFail($productId)->update($reduceProductStock);
                    }
                }
            } else {
                Sale::create($create);
                Product::findOrFail($productId)->update($reduceProductStock);
            }
            return redirect()->route('isi_form_pemesanan', $transactionCode);
        } else {
            return redirect()->back()->withErrors('Jumlah stock produk tidak mencukupi! Stok produk tersisa ' . $productStock);
        }
    }

    public function delete_pesanan($id)
    {
        $saleProduct = Sale::findOrFail($id);
        $productSaleQuantity = $saleProduct->quantity;
        $productId = $saleProduct->product_id;

        $productStock = Product::findOrFail($productId)->stock;
        $originalProductStock = $productStock + $productSaleQuantity;

        Product::findOrFail($productId)->update([
            'stock' => $originalProductStock
        ]);

        Sale::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function update_pesanan(Request $request, $id)
    {
        $input = $request->all();

        $id = $id;

        $transactionCode = $input['transaction_code'];
        $quantity = $input['quantity'];

        $validator = Validator::make($input, [
            'transaction_code' => 'required',
            'quantity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->route('transaction.create', $transactionCode)
                ->withErrors($validator)
                ->withInput();
        }

        $saleProduct = Sale::find($id);
        $productSaleQuantity = $saleProduct->quantity;
        $productId = $saleProduct->product_id;

        $product = Product::findOrFail($productId);
        $productPrice = $product->selling_price;
        $productStock = $product->stock;

        $originalProductStock = $productStock + $productSaleQuantity;
        $reducedStock = $originalProductStock - $quantity;
        $total = $quantity * $productPrice;

        // Cek stok produk
        if ((int)$quantity < $originalProductStock) {
            Sale::findOrFail($id)->update([
                'quantity' => $quantity,
                'total_price' => $total
            ]);
            Product::findOrFail($productId)->update([
                'stock' => $reducedStock
            ]);
            return redirect()->route('isi_form_pemesanan', $transactionCode);
        } else {
            return redirect()->back()->withErrors('Jumlah stock produk tidak mencukupi! Stok produk tersisa ' . $productStock);
        }
    }

    public function getCoupon(Request $request)
    {
        $input = $request->all();
        $input['coupon_code'] = strtoupper(str_replace(' ', '', $input['coupon_code']));
        $couponCode = $input['coupon_code'];

        $validator = Validator::make($input, [
            'transaction_code' => 'required',
            'coupon_code' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $hasCoupon = false;
        $coupons = Coupon::where('coupon_code', $couponCode)->get();
        foreach ($coupons as $coupon) {
            if (Carbon::create($coupon->expired) < Carbon::now()) {
                return redirect()->back()
                    ->withErrors(['coupon_invalid' => 'Kupon sudah tidak berlaku.']);
            }

            if ($coupon->status == 0) {
                return redirect()->back()
                    ->withErrors(['coupon_invalid' => 'Kupon tidak aktif.']);
            }

            $hasCoupon = true;
            $discount = $coupon->discount;
        }

        if (!$hasCoupon) {
            return redirect()->back()
                ->withErrors(['coupon_invalid' => 'Kupon tidak ditemukan.']);
        }

        return redirect()->back()
            ->with([
                'coupon_code' => $couponCode,
                'discount' => $discount
            ]);
    }

    public function kirim_pesanan_product(TransactionRequest $request)
    {
        $request = $request->all();

        if ($request['coupon_code']) {
            $kupon = Coupon::where('coupon_code', $request['coupon_code'])->first();
            $data['coupon_id'] = $kupon->id;
        } else {
            $data['coupon_id'] = null;
        }

        $data['user_id'] = Auth::user()->id;
        // $data['customer_id'] = $request['customer_id'];
        $data['discount'] = $request['discount'];
        $data['sub_total'] = str_replace(',', '', $request['sub_total']);
        $data['discount_price'] = str_replace(',', '', $request['discount_price']);
        $data['grand_total'] = str_replace(',', '', $request['grand_total']);
        $data['paid'] = str_replace(',', '', $request['paid']);
        $data['change'] = str_replace(',', '', $request['change']);
        $data['valid'] = TRUE;

        $transactionCode = now()->format('dmyHis') . Transaction::all()->count() . Auth::user()->id;

        Transaction::where('transaction_code', $request['transaction_code'])
            ->update($data);
        return redirect()->route('success', $transactionCode)->with(['success' => 'Transaksi berhasil disimpan!', 'transactionCode' => $request['transaction_code']]);
    }

    public function success()
    {
        $user = Auth::id();
        return view('components.pages.succeess', compact('user'));
    }

    public function my_transaksi(Request $request, $id)
    {
        $transaksi = Transaction::where(['user_id'])->get();

        return view('components.pages.my-transaksi', compact('transaksi'));
    }
}
