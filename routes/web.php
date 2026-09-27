<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\RepairController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\PhoneModelController;
use App\Http\Controllers\Admin\DamageController;


use App\Models\User;
use App\Models\RepairRequest;

// =========================
// LANDING
// =========================

Route::get('/', function () {
    return view('landing.index');
});


// =========================
// LOGIN
// =========================

Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/login', function (Illuminate\Http\Request $request) {

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

   session([
    'user' => [
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'phone' => $user->phone,
        'address' => $user->address,
    ],
]);

    return redirect('/customer/home');

})->name('login');


// =========================
// REGISTER
// =========================

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', function (Illuminate\Http\Request $request) {

    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'address' => 'required|string',
    ]);

    $user = User::create([
        'name' => $request->name,
        'phone' => $request->phone,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'address' => $request->address,
    ]);

    session([
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ],
    ]);

    return redirect('/customer/home');
});


// =========================
// CUSTOMER HOME
// =========================

Route::get('/customer/home', function () {
    return view('customer.home');
});


// =========================
// REPAIR FLOW
// =========================

Route::get('/select-brand', [RepairController::class, 'selectBrand']);

Route::post('/select-brand', [RepairController::class, 'selectBrandStore']);

Route::get('/select-model', [RepairController::class, 'selectModel']);

Route::get('/select-category', [RepairController::class, 'selectCategory']);

Route::get('/demage-list', [RepairController::class, 'damageList']);

Route::get('/damage-detail/{id}', [RepairController::class, 'damageDetail']);

Route::post('/repair-request', [RepairController::class, 'repairRequest']);

Route::get('/waiting-fixed-price', function () {
    return view('menunggu-harga-tetap');
});

Route::get('/notifications', [RepairController::class, 'notifications']);

Route::get('/fixed-price', [RepairController::class, 'fixedPrice']);


// =========================
// PAYMENT
// =========================

Route::get('/payment-method', function () {
    return view('metode-pembayaran');
});

Route::get('/bank-transfer', function () {
    return view('transfer-bank');
});

Route::post('/bank-transfer', [RepairController::class, 'bankTransfer']);

Route::get('/pay-on-site', function () {
    return view('bayar-di-tempat');
});


// =========================
// CUSTOMER
// =========================

Route::get('/repair-history', function () {
    return view('riwayat-perbaikan');
});

Route::get('/profile', function () {
    return view('customer.profile');
});


// =========================
// ADMIN
// =========================

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/admin/master', function () {
    return view('admin.master');
});

Route::resource('/admin/phone-models', PhoneModelController::class);

Route::resource('/admin/brands', BrandController::class);

Route::resource('/admin/damages', DamageController::class);

Route::get('/admin/requests', function () {

    $repairRequests = RepairRequest::latest()->get();

    return view('admin.requests', compact('repairRequests'));

});

Route::get('/admin/requests/{id}', function ($id) {

    $repairRequest = RepairRequest::findOrFail($id);

    return view('admin.request-detail', compact('repairRequest'));

});

Route::get('/admin/requests/{id}/price', function ($id) {

    $repairRequest = RepairRequest::findOrFail($id);

    return view('admin.set-price', compact('repairRequest'));

});

Route::post('/admin/requests/{id}/price', function (
    Illuminate\Http\Request $request,
    $id
) {

    $repairRequest = RepairRequest::findOrFail($id);

    $request->validate([
        'fixed_price' => 'required|numeric|min:0',
    ]);

    $repairRequest->update([
        'fixed_price' => $request->fixed_price,
        'status' => 'waiting_payment',
    ]);

    return redirect('/admin/requests')->with(
        'success',
        'Harga tetap berhasil disimpan.'
    );

});

Route::get('/admin/profile', function () {
    return view('admin.profile');
});

Route::get('/admin/payments', function () {
    return view('admin.payments');
});

Route::get('/admin/notifications', function () {
    return view('admin.notifications');
});

Route::get('/admin/history', function () {
    return view('admin.history');
});

Route::resource('/admin/brands', BrandController::class);


// =========================
// LANGUAGE
// =========================

Route::get('/language/{locale}', function ($locale) {

    if (!in_array($locale, ['id', 'eng'])) {
        abort(404);
    }

    session([
        'locale' => $locale
    ]);

    return redirect('/customer/home');

})->name('language');


