<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\RepairRequest;
use App\Models\Damage;
use App\Models\Brand;
use App\Models\PhoneModel;

class RepairController extends Controller
{
    // =========================
    // SELECT BRAND
    // =========================

    public function selectBrand()
    {
        $brands = Brand::all();

        $brandDescs = [
            'Xiaomi' => 'Redmi, Poco, Mi series and more',
            'Samsung' => 'Galaxy A, M, S, and Note series',
            'OPPO' => 'A series, Reno, Find X series',
            'Vivo' => 'V series, Y series, X series',
            'Infinix' => 'Note, Hot, Zero series',
            'iPhone' => 'iPhone series',
        ];

        $brandColors = [
            'Xiaomi' => '#ff6900',
            'Samsung' => '#1428a0',
            'OPPO' => '#1d9b5f',
            'Vivo' => '#415fff',
            'Infinix' => '#00a8ff',
            'iPhone' => '#888888',
        ];

        $brandLogos = [
            'Xiaomi' => 'MI',
            'Samsung' => 'SA',
            'OPPO' => 'OP',
            'Vivo' => 'VI',
            'Infinix' => 'IN',
            'iPhone' => 'IP',
        ];

        return view('pilih-merek', compact(
            'brands',
            'brandDescs',
            'brandColors',
            'brandLogos'
        ));
    }

    // =========================
    // SAVE BRAND
    // =========================

    public function selectBrandStore(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:100',
        ]);

        session()->forget([
            'brand',
            'model',
            'modelId',
            'category',
            'damageId',
            'damageName',
            'estimatedPriceMin',
            'estimatedPriceMax',
        ]);

        session([
            'brand' => $request->brand
        ]);

        return redirect('/select-model?brand=' . urlencode($request->brand));
    }

    // =========================
    // SELECT MODEL
    // =========================

    public function selectModel()
    {
        $brand = request('brand', session('brand'));

        if (!$brand) {
            return redirect('/select-brand');
        }

        $brandData = Brand::where('name', $brand)->first();

        $brandModels = [];

        if ($brandData) {
            $brandModels = $brandData->phoneModels()
                ->get()
                ->map(function ($model) {
                    return [
                        'id' => $model->id,
                        'name' => $model->name,
                        'type' => 'Smartphone',
                        'description' => 'Perkiraan harga perbaikan berdasarkan model HP',
                    ];
                })
                ->toArray();
        }

        session([
            'brand' => $brand
        ]);

        return view('pilih-model', compact(
            'brand',
            'brandModels'
        ));
    }

    // =========================
    // SELECT CATEGORY
    // =========================

    public function selectCategory()
    {
        $brand = session('brand', 'Xiaomi');

        $model = request(
            'model',
            session('model', 'Redmi Note 13')
        );

        $category = request(
            'category',
            session('category', 'Light Damage')
        );

        session([
            'brand' => $brand,
            'model' => $model,
            'category' => $category,
        ]);

        $damageCategories = [
            [
                'name' => 'Light Damage',
                'description' => 'Kerusakan ringan seperti tombol, speaker, atau masalah kecil lainnya.',
                'bgColor' => 'rgba(34, 197, 94, 0.1)',
                'color' => '#22c55e',
            ],
            [
                'name' => 'Moderate Damage',
                'description' => 'Kerusakan sedang seperti baterai, charging port, atau komponen internal.',
                'bgColor' => 'rgba(234, 179, 8, 0.1)',
                'color' => '#eab308',
            ],
            [
                'name' => 'Severe Damage',
                'description' => 'Kerusakan berat seperti mati total atau kerusakan komponen utama.',
                'bgColor' => 'rgba(239, 68, 68, 0.1)',
                'color' => '#ef4444',
            ],
        ];

        $damageCount = [
            'Light Damage' => Damage::where('severity', 'light')->count(),
            'Moderate Damage' => Damage::where('severity', 'moderate')->count(),
            'Severe Damage' => Damage::where('severity', 'heavy')->count(),
        ];

        return view('pilih-kategori', compact(
            'brand',
            'model',
            'damageCategories',
            'damageCount'
        ));
    }

    // =========================
    // DAMAGE LIST
    // =========================

    public function damageList()
    {
        $brand = session('brand', 'Xiaomi');

        $model = session(
            'model',
            'Redmi Note 13'
        );

        $category = request(
            'category',
            session('category', 'Light Damage')
        );

        $severity = match ($category) {
            'Light Damage' => 'light',
            'Moderate Damage' => 'moderate',
            'Severe Damage' => 'heavy',
            default => 'light',
        };

        $damages = Damage::where('severity', $severity)
            ->get()
            ->map(function ($damage) {
                return [
                    'id' => $damage->id,
                    'name' => $damage->name,
                    'description' => 'Perbaikan atau penggantian komponen smartphone yang mengalami kerusakan.',
                    'price_min' => $damage->price_min,
                    'price_max' => $damage->price_max,
                    'days' => $damage->estimated_days,
                ];
            })
            ->toArray();

        session([
            'brand' => $brand,
            'model' => $model,
            'category' => $category,
        ]);

        return view('daftar-kerusakan', compact(
            'damages',
            'brand',
            'model',
            'category'
        ));
    }

    // =========================
    // DAMAGE DETAIL
    // =========================

    public function damageDetail($id)
    {
        $damage = Damage::findOrFail($id);

        $brand = session('brand', 'Xiaomi');

        $model = session(
            'model',
            'Redmi Note 13'
        );

        $category = request(
            'category',
            session('category', 'Light Damage')
        );

        $damage = [
            'id' => $damage->id,
            'name' => $damage->name,
            'description' => 'Perbaikan atau penggantian komponen smartphone yang mengalami kerusakan.',
            'price_min' => $damage->price_min,
            'price_max' => $damage->price_max,
            'days' => $damage->estimated_days,
        ];

        session([
            'brand' => $brand,
            'model' => $model,
            'category' => $category,
            'damageId' => $damage['id'],
            'damageName' => $damage['name'],
            'estimatedPriceMin' => $damage['price_min'],
            'estimatedPriceMax' => $damage['price_max'],
        ]);

        return view('detail-kerusakan', compact(
            'damage',
            'brand',
            'model',
            'category'
        ));
    }

    // =========================
    // REPAIR REQUEST
    // =========================

    public function repairRequest(Request $request)
    {
        $request->validate([
            'description' => 'nullable|string',
        ]);

        // Buat Request ID yang unik
        do {
            $requestId = 'REQ-' . date('YmdHis') . rand(10, 99);
        } while (RepairRequest::where('request_id', $requestId)->exists());

        $repairRequest = RepairRequest::create([
            'request_id' => $requestId,

            'user_id' => session('user.id'),

            'customer_name' => session('user.name', 'Customer'),

            'phone' => session('user.phone'),

            'brand' => session('brand', 'Xiaomi'),

            'model' => session('model', 'Redmi Note 13'),

            'category' => session('category', 'Light Damage'),

            'damage_name' => session('damageName', ''),

            'estimated_price_min' => session('estimatedPriceMin', 0),

            'estimated_price_max' => session('estimatedPriceMax', 0),

            'description' => $request->description,

            'status' => 'waiting_fixed_price',
        ]);

        session([
            'activeRequest' => $repairRequest->toArray()
        ]);

        return redirect('/waiting-fixed-price');
    }

    // =========================
    // FIXED PRICE
    // =========================

    public function fixedPrice()
    {
        $request = RepairRequest::latest()->first();

        if (!$request) {
            return redirect('/select-brand');
        }

        if ($request->fixed_price === null) {
            return redirect('/waiting-fixed-price');
        }

        return view('harga-tetap', compact('request'));
    }

    // =========================
    // NOTIFICATIONS
    // =========================

    public function notifications()
    {
        $request = RepairRequest::latest()->first();

        return view('notifikasi', compact('request'));
    }

    // =========================
    // BANK TRANSFER
    // =========================

    public function bankTransfer(Request $request)
    {
        $request->validate([
            'proof_file' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $repairRequest = RepairRequest::latest()->first();

        if (!$repairRequest) {
            return redirect('/select-brand');
        }

        $filePath = $request->file('proof_file')->store(
            'payment-proofs',
            'public'
        );

        $repairRequest->update([
            'payment_method' => 'bank_transfer',
            'proof_file' => $filePath,
            'transfer_amount' => $repairRequest->fixed_price,
            'status' => 'waiting_payment_verification',
        ]);

        session([
            'activeRequest' => $repairRequest->fresh()->toArray()
        ]);

        return redirect('/notifications');
    }
}