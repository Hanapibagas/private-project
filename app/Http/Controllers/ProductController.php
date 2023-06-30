<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\DetailsTransaksi;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductGallery;
use App\Models\RiviewProduct;
use App\Models\Sale;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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
        $riview = RiviewProduct::where('product_id', $id)->paginate(5);
        $jumlah = RiviewProduct::where('product_id', $id)->count();
        return view('components.pages.details', compact('product', 'riview', 'jumlah'));
    }

    public function getCart()
    {
        $user = Auth::id();
        $kupon = Coupon::all();
        $data = Cart::where('user_id', $user)->get();
        $transaksi = Transaction::where('user_id', $user)->get();

        return view('components.pages.cart', compact('data', 'kupon', 'transaksi'));
    }

    public function storeCart($id)
    {
        $product = Product::find($id);
        $selling_price = $product->selling_price;

        $duplicate = Cart::where('product_id', $id)->first();

        if ($duplicate) {
            return redirect()->back()->with('warning', 'Barang yang anda pilih sudah dalam keranjang');
        }

        $previous_stock = $product->stock;

        $cart = Cart::create([
            'user_id' => Auth::user()->id,
            'product_id' => $id,
            'product_price' => $selling_price,
            'quantity' => '1',
            'total_price' => $selling_price
        ]);

        $new_stock = $previous_stock - $cart->quantity;
        $product->stock = $new_stock;
        $product->save();

        return redirect()->back()->with('status', 'Berhasil menambah item ke keranjang');
    }


    public function getUpdateCart(Request $request, $id)
    {
        $data = Cart::where('id', $id)->first();

        $previous_quantity = $data->quantity;
        $new_quantity = $request->input('quantity');
        $quantity_diff = $new_quantity - $previous_quantity;

        $product = Product::find($data->product_id);

        $product->stock -= $quantity_diff;
        $product->save();

        $data->update([
            'quantity' => $new_quantity,
            'total_price' => $data->total_price + ($data->product_price * $quantity_diff)
        ]);

        return redirect()->back()->with('status', 'Berhasil mengubah jumlah barang');
    }

    public function getDeleteCart($id)
    {
        $delete = Cart::find($id);

        if ($delete->banner && file_exists(storage_path('app/public/' . $delete->banner))) {
            Storage::delete('public/' . $delete->banner);
        }

        $product = Product::find($delete->product_id);
        $product->stock += $delete->quantity;
        $product->save();

        $delete->delete();

        return redirect()->back()->with('status', 'Berhasil menghapus barang dari cart');
    }

    public function getCheckOut(Request $request)
    {
        $user = Auth::id();

        $transaksi = Transaction::create([
            'user_id' => $user
        ]);

        $cartItems = Cart::where('user_id', $user)->get();

        foreach ($cartItems as $cartItem) {
            $detailTransaksi = new DetailsTransaksi();
            $detailTransaksi->transaksi_id = $transaksi->id;
            $detailTransaksi->product_id = $cartItem->product_id;
            $detailTransaksi->jumlah = $cartItem->total_price;
            $detailTransaksi->save();
            $cartItem->delete();
        }

        return redirect()->back()->with('status', 'Silahkan isi alamat lengkap dibawah ini');
    }

    public function getKupon(Request $request)
    {
        // return response()->json($data);
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
        $kupon = Coupon::where('user_id', Auth::user()->id)->get();

        return view('components.pages.cart', [
            'title' => $title,
            'transactionCode' => $transactionCode,
            'items' => $items,
            'user' => $user,
            'kupon' => $kupon,
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
        $photo = $request->file('foto');

        $request = $request->all();

        if ($request['coupon_code']) {
            $kupon = Coupon::where('coupon_code', $request['coupon_code'])->first();
            $data['coupon_id'] = $kupon->id;
        } else {
            $data['coupon_id'] = null;
        }

        if ($photo) {
            $data['foto'] = $photo->store(
                'assets/transaksi',
                'public'
            );
        } else {
            $data['foto'] = "";
        }

        $data['user_id'] = Auth::user()->id;
        $data['discount'] = $request['discount'];
        $data['nama_lengkap'] = $request['nama_lengkap'];
        $data['no_telpn'] = $request['no_telpn'];
        $data['alamat'] = $request['alamat'];
        $data['metode_pembayaran'] = $request['metode_pembayaran'];
        $data['sub_total'] = str_replace(',', '', $request['sub_total']);
        $data['discount_price'] = str_replace(',', '', $request['discount_price']);
        $data['grand_total'] = str_replace(',', '', $request['grand_total']);
        // $data['paid'] = str_replace(',', '', $request['paid']);
        $data['foto'] = $data['foto'];
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
