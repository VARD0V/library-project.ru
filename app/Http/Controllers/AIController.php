<?php
namespace App\Http\Controllers;
use App\Http\Requests\AIRequest;
use App\Models\ArtificialIntelligence;
use App\Models\Task;
class AIController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(ArtificialIntelligence::class, 'ai');
    }
    public function index()
    {
        // Получаем все AI с их задачами через связь tasks
        $ais = ArtificialIntelligence::with('tasks')->get();
        return view('ai.index', compact('ais'));
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
