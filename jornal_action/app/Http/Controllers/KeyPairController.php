<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

class KeyPairController extends Controller
{
    public function generateKeyPair()
    {
        // Генерация открытого и закрытого ключей
        $privateKey = openssl_pkey_new([
            'private_key_bits' => 2048,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ]);

        openssl_pkey_export($privateKey, $privateKeyString);

        $publicKey = openssl_pkey_get_details($privateKey)['key'];

        // Сохранение закрытого ключа в безопасное место
        $fileName = Str::random(16) . '.pem'; // Генерация уникального имени файла
        Storage::disk('private')->put($fileName, $privateKeyString);

        return response()->json([
            'public_key' => $publicKey,
        ]);
    }
}
