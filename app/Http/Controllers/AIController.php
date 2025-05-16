<?php
namespace App\Http\Controllers;
use App\Http\Requests\AIRequest;
use App\Models\ArtificialIntelligence;
use App\Models\Task;
use App\Models\Transformation;

class AIController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ArtificialIntelligence::class, 'ai');
    }
    public function index()
    {
        // Получаем параметры из GET-запроса
        $search = request('search');
        $transformationId = request('transformation');
        // Загружаем все возможные трансформации для фильтрации
        $transformations = Transformation::all();
        // Базовый запрос с eager loading
        $query = ArtificialIntelligence::with('transformations');
        // Фильтр по трансформации
        if ($transformationId) {
            $query->whereHas('transformations', function ($q) use ($transformationId) {
                $q->where('transformations.id', $transformationId);
            });
        }
        // Поиск по имени или описанию
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }
        // Получаем результат
        $ais = $query->get();
        return view('ai.index', compact('ais', 'transformations'));
    }
    public function show(ArtificialIntelligence $ai)
    {
        return view('ai.show', compact('ai'));
    }
    public function create()
    {
        $tasks = Task::all();
        return view('ai.create',compact( 'tasks'));
    }
    public function store(AIRequest $request)
    {
        $ai = ArtificialIntelligence::create($request->validated());
        // Привязываем выбранные задачи к ИИ (без массивов)
        foreach ($request->input('tasks') as $taskId) {
            $ai->tasks()->attach($taskId);
        }

        return redirect()->route('ai.index')->with('success', 'ИИ успешно создан!');
    }
    public function edit(ArtificialIntelligence $ai)
    {
        $tasks = Task::all();
        return view('ai.edit', compact('ai', 'tasks'));
    }
    public function update(AIRequest $request, ArtificialIntelligence $ai)
    {
        $ai->update($request->validated());
        $ai->tasks()->sync($request->input('tasks', []));
        return redirect()->route('ai.index')->with('success', 'ИИ обновлён!');
    }
    public function destroy(ArtificialIntelligence $ai)
    {
        $ai->delete();
        return redirect()->route('ai.index')->with('success', 'ИИ удалён!');
    }
}
