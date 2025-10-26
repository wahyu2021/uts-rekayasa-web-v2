# Middleware Documentation

## AdminMiddleware

Middleware ini berfungsi untuk membatasi akses ke route-route tertentu yang hanya boleh diakses oleh pengguna dengan peran (role) 'admin'.

### Cara Kerja

1.  **Pengecekan Otentikasi**: Middleware akan memeriksa apakah pengguna sudah login (`Auth::check()`).
2.  **Pengecekan Peran (Role)**: Jika pengguna sudah login, middleware akan memeriksa apakah pengguna tersebut memiliki peran `'admin'` (`Auth::user()->role == 'admin'`).
3.  **Akses Diberikan**: Jika kedua kondisi di atas terpenuhi, maka permintaan (request) akan diteruskan ke controller atau response selanjutnya.
4.  **Akses Ditolak**: Jika salah satu kondisi tidak terpenuhi, pengguna akan dialihkan (redirect) ke halaman utama ('/') dengan pesan error 'You do not have admin access.'.

### Contoh Penggunaan

Di Laravel 11 dan versi lebih baru, alias middleware didaftarkan di dalam file `bootstrap/app.php`. Berdasarkan file proyek Anda, alias `'admin'` sudah didaftarkan.

```php
// bootstrap/app.php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ]);
})
```

Setelah alias terdaftar, Anda bisa langsung menggunakannya pada definisi route Anda.

**Route Tunggal:**

```php
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware('admin');
```

**Grup Route:**

```php
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/products', [AdminProductController::class, 'index']);
    Route::get('/categories', [AdminCategoryController::class, 'index']);
});
```