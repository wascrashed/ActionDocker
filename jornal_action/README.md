Создать папку /database/pgdata/ и сделать её группой группу текущего пользовтаеля

docker-compose up -d - запускаем все контейнеры

Зайти в контейнер jornal_action и выполнить миграции

php artisan migrate

php artisan jwt:secret - генерация для JWT токена

php Generate_keys.php - генерация открытого и закрытого токена

php artisan tinker - запускаем тинкер

-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Пример регистрации  через Tinker :

$request = Request::create('/api/register', 'POST', [
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'password' => 'password123',
]);

app()->make('Illuminate\Contracts\Http\Kernel')->handle($request);

 Пример вывода ответа в Tinker :

 Illuminate\Http\JsonResponse {#7247
    +headers: Symfony\Component\HttpFoundation\ResponseHeaderBag {#7248},
    +original: [
      "message" => "User registered successfully",
    ],
    +exception: null,
  }
-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

Пример авторизации через Tinker :

$request = \Illuminate\Http\Request::create('/api/login', 'POST', [
    'email' => 'john@example.com',
   'password' => 'password123',
 ]);

  app()['Illuminate\Contracts\Http\Kernel']->handle($request);


 Пример вывода ответа в Tinker :

= Illuminate\Http\JsonResponse {#7299
    +headers: Symfony\Component\HttpFoundation\ResponseHeaderBag {#7298},
    +original: [
      "token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS9sb2dpbiIsImlhdCI6MTY4NzUzNzIzMSwiZXhwIjoxNjg3NTQwODMxLCJuYmYiOjE2ODc1MzcyMzEsImp0aSI6IkFsRWVUc25BaGpzQTcxZ0kiLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.Vp_6TflULbT-oNecoEwWBs91MPuVWwDGRxFDRVEbjJc",
    ],
    +exception: null,
  }

