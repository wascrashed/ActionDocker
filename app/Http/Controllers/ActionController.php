<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActionRequest;
use App\Http\Resources\ActionResource;
use App\Models\Action;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ActionController extends Controller
{
    public function index()
    {
        $actions = Action::all();
        return ActionResource::collection($actions);
    }

    public function store(StoreActionRequest $request)
    {
        $data = $request->all();
        $data['date'] = Carbon::createFromTimestamp($data['date'])->toDateTimeString();

        $action = Action::create($data);
        return new ActionResource($action);
    }

    public function filter(Request $request)
    {
        $data = $request->all();
    
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
    
        // Применение пагинации
        $perPage = 9; // Количество записей на странице
        $actions = $query->paginate($perPage);
    
        // Возвращение результата в формате JSON с пагинацией
        return response()->json($actions);
    }
    
    
}
