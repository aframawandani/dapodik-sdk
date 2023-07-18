# Dapodik SDK

Project ini fork dari dari repo dimasahmad/dapodik-sdk yang developmen-tnya tidak lagi dilanjutkan.

***Unofficial*** Dapodik SDK untuk mengakses API yang tersedia dalam aplikasi Dapodik.

Developer dapat mengakses secara langsung API Dapodik menggunakan client HTTP dan JSON jika mereka menginginkannya. Jika Anda ingin langsung mengakses data API Dapodik, SDK ini memberikan Anda beberapa kemudahan:

- *Less code*: Anda tidak perlu dipusingkan dengan *HTTP logic* untuk memulai
- SDK ini menyediakan kumpulan object yang dapat Anda gunakan untuk mengakses data tanpa perlu bekerja langsung dengan JSON, dan dengan penamaan yang lebih *predictable* serta konsisten
- Lapisan tambahan penanganan *error*, tipe data yang lebih ketat, dan *default values* cerdas untuk membatu *debugging* aplikasi Anda 

Semua model yang tersedia dibuat berdasarkan hasil analisis manual data Dapodik sebuah sekolah negeri. *(Semoga pengembang aplikasi Dapodik dapat menerbitkan dokumentasi atau bahkan spesifikasi OpenAPI atau standar metadata API lainnya agar akses API menjadi lebih mudah bagi developer serta semua model dapat digenerate secara otomatis.)*

Terdapat dua *endpoint* yang tersedia dalam SDK ini:
1. WebService http://localhost:5774/WebService/
2. REST http://localhost:5774/rest/ (baru tersedia otentikasinya saja, model belum dibuat)

***Library* ini masih dalam pengembangan ekstensif dan akan menghadirkan *breaking changes* pada versi-versi berikutnya.** 

## Requirement

PHP >=7.4
Composer

## Installation

```bash
composer require aframawandani/dapodik-sdk
```

## Memulai

### WebService Endpoint

Sebelum Anda dapat mengakses *endpoint* WebService, Anda harus mendaftarkan aplikasi Anda melalui halaman Pengaturan -> WebService di dalam aplikasi Dapodik sekolah Anda. Pastikan setting IP sesuai dengan komputer yang akan melakukan koneksi dengan server Dapodik.

```php
$dapodik = new \DimasAhmad\Dapodik\SDK\Auth\WebService();
$dapodik->setAccessToken("accessToken"); // Token yang didapatkan saat registrasi aplikasi
$dapodik->setNpsn("12345678"); // NPSN server Dapodik yang akan diakses

$sekolah = new \DimasAhmad\Dapodik\SDK\Model\WebService\Sekolah($dapodik);

echo $sekolah->getNama();
```

### Rest Endpoint

Gunakan akun operator sebagai parameter otentikasi.

```php
$dapodik = new \DimasAhmad\Dapodik\SDK\Auth\Rest();
$dapodik->setUsername("user@example.com");
$dapodik->setPassword("password");

$dapodik->login();
```

Implementasi model untuk *Rest Endpoint* masih dalam proses pengembangan (analisis manual memakan waktu dan usaha yang sangat besar 😩).

Anda dapat melakukan request menggunakan *method* yang tersedia melalui Rest->client->request($method, $uri), dan proses sendiri response JSON yang didapatkan.

```php
$response = $dapodik->client->request("GET", "/rest/Sekolah");
$sekolah = json_decode($response->getBody()->__toString())->rows[0];

echo $sekolah->nama;
```
## Lisensi

Copyright (c) 2020 Dimas Ahmad Eka Putra. All Rights Reserved.

Library ini menggunakan lisensi MIT. Lihat file [LICENCE](LICENSE) untuk detail lebih lanjut.
