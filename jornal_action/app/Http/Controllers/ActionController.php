<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActionRequest;
use App\Http\Resources\ActionResource;
use App\Models\Action;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ActionController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['index']]);
    }

    /**
     * Получить все записи "Action".
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $actions = Action::paginate(9);
        return ActionResource::collection($actions);
    }

    /**
     * Создать новую запись "Action".
     *
     * @param  StoreActionRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
   public function store(StoreActionRequest $request)
{
    $data = $request->all();
    $data['date'] = Carbon::createFromTimestamp($data['date'])->toDateTimeString();

    // Шифрование данных перед сохранением
    $encryptedData = Crypt::encrypt($data);

    // Получение значения userId из текущего аутентифицированного пользователя
    $userId = $request->user()->id;
    $action = Action::create([
        'userId' => $userId,
        'actionKey' => $data['actionKey'],
        'date' => $data['date'], // Установка значения для date
        'info' => $data['info'], // Установка значения для info
        'encrypted_data' => $encryptedData,
        // Другие поля модели Action
    ]);
    
    return new ActionResource($action);
}
    /**
     * Фильтрация записей "Action" по заданным параметрам.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filter(Request $request)
    {
        $data = $request->all();

        // Расшифровка данных, если требуется
        if (isset($data['encrypted_data'])) {
            $decryptedData = Crypt::decrypt($data['encrypted_data']);
            // Используйте расшифрованные данные для фильтрации
        }

        $query = Action::query();

        // Фильтрация по датам
        if (isset($data['dateFrom'])) {
            $query->where('date', '>=', Carbon::createFromTimestamp($data['dateFrom'])->toDateTimeString());
        }

        if (isset($data['dateTo'])) {
            $query->where('date', '<=', Carbon::createFromTimestamp($data['dateTo'])->toDateTimeString());
        }

        // Фильтрация по ключу действия
        if (isset($data['actionKey'])) {
            $query->where('actionKey', $data['actionKey']);
        }

        // Фильтрация по информации
        if (isset($data['info'])) {
            $info = $data['info'];
            foreach ($info as $key => $value) {
                $query->where('info->'.$key, $value);
            }
        }

        $perPage = 9; // Количество записей на странице
        $actions = $query->paginate($perPage);

        return response()->json($actions);
    }
}
