<?php
namespace App\Http\Controllers;
use App\Http\Requests\AICreateRequest;
use App\Http\Requests\AIUpdateRequest;
use App\Models\ArtificialIntelligence;
use App\Models\Task;
use App\Models\Transformation;

class AIController extends Controller
{
    public function __construct()
    {
        // Автоматически применяет политику (AiPolicy) ко всем методам
        // Проверка прав происходит через методы view, create, update, delete в политике
        $this->authorizeResource(ArtificialIntelligence::class, 'ai');
    }
    //Список ИИ с фильтрацией по задачам и трансформациям
    public function index()
    {
        // Параметры фильтрации из GET-запроса
        $search = request('search');
        $transformationId = request('transformation');
        $taskId = request('task');
        // Все доступные трансформации и задачи для фильтров
        $transformations = Transformation::all();
        $tasks = Task::all();
        // Базовый запрос с жадной загрузкой связей
        $query = ArtificialIntelligence::with(['transformations', 'tasks']);
        // Фильтр по трансформациям (через отношение many-to-many)
        if ($transformationId) {
            $query->whereHas('transformations', function ($q) use ($transformationId) {
                $q->where('transformations.id', $transformationId);
            });
        }
        // Фильтр по задачам (через отношение many-to-many)
        if ($taskId) {
            $query->whereHas('tasks', function ($q) use ($taskId) {
                $q->where('tasks.id', $taskId);
            });
        }
        // Поиск по названию или описанию
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }
        $ais = $query->get();
        return view('ai.index', compact('ais', 'transformations', 'tasks'));
    }
    //Просмотр конкретного ИИ
    public function show(ArtificialIntelligence $ai)
    {
        // Автоматическая загрузка через Model Binding
        return view('ai.show', compact('ai'));
    }
    //Форма создания нового ИИ
    public function create()
    {
        // Все задачи и трансформации для выбора при создании
        $tasks = Task::all();
        $transformations = Transformation::all();
        return view('ai.create', compact('tasks', 'transformations'));
    }
    //Сохранение нового ИИ
    public function store(AICreateRequest $request)
    {
        // Создаем основную запись ИИ (исключаем поля связей)
        $ai = ArtificialIntelligence::create($request->except(['task_ids', 'transformation_ids']));
        // Привязываем выбранные задачи (many-to-many)
        if ($request->has('task_ids')) {
            $ai->tasks()->attach($request->task_ids);
        }
        // Привязываем выбранные трансформации (many-to-many)
        if ($request->has('transformation_ids')) {
            $ai->transformations()->attach($request->transformation_ids);
        }
        return redirect()->route('ai.index')->with('success', 'ИИ успешно добавлен!');
    }
    //Форма редактирования ИИ
    public function edit(ArtificialIntelligence $ai)
    {
        // Проверка прав через политику (автоматически через authorizeResource)
        $tasks = Task::all();
        $transformations = Transformation::all();
        return view('ai.edit', compact('ai', 'tasks', 'transformations'));
    }
    //Обновление данных ИИ
    public function update(AIUpdateRequest $request, ArtificialIntelligence $ai)
    {
        // Обновляем основную информацию
        $ai->update($request->validated());
        // Синхронизируем связанные задачи (many-to-many)
        // Если task_ids не передано - используем пустой массив (удаляем все связи)
        $ai->tasks()->sync($request->input('task_ids', []));
        // Синхронизируем связанные трансформации (many-to-many)
        $ai->transformations()->sync($request->input('transformation_ids', []));
        return redirect()->route('ai.index')->with('success', 'ИИ обновлён!');
    }

    //Удаление ИИ
    public function destroy(ArtificialIntelligence $ai)
    {
        // Удаление автоматически проверяется через политику (метод delete)
        $ai->delete();
        return redirect()->route('ai.index')->with('success', 'ИИ удалён!');
    }
}
