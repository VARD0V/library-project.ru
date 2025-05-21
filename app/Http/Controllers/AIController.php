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
        $this->authorizeResource(ArtificialIntelligence::class, 'ai');
    }
    public function index()
    {
        $search = request('search');
        $transformationId = request('transformation');
        $taskId = request('task');
        $transformations = Transformation::all();
        $tasks = Task::all();
        $query = ArtificialIntelligence::with(['transformations', 'tasks']);
        if ($transformationId) {
            $query->whereHas('transformations', function ($q) use ($transformationId) {
                $q->where('transformations.id', $transformationId);
            });
        }
        if ($taskId) {
            $query->whereHas('tasks', function ($q) use ($taskId) {
                $q->where('tasks.id', $taskId);
            });
        }
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }
        $ais = $query->get();
        return view('ai.index', compact('ais', 'transformations', 'tasks'));
    }
    public function show(ArtificialIntelligence $ai)
    {
        return view('ai.show', compact('ai'));
    }
    public function create()
    {
        $tasks = Task::all();
        $transformations = Transformation::all();
        return view('ai.create', compact('tasks', 'transformations'));
    }
    public function store(AICreateRequest $request)
    {
        $ai = ArtificialIntelligence::create($request->except(['task_ids', 'transformation_ids']));
        if ($request->has('task_ids')) {
            $ai->tasks()->attach($request->task_ids);
        }
        if ($request->has('transformation_ids')) {
            $ai->transformations()->attach($request->transformation_ids);
        }
        return redirect()->route('ai.index')->with('success', 'ИИ успешно добавлен!');
    }
    public function edit(ArtificialIntelligence $ai)
    {
        $tasks = Task::all();
        return view('ai.edit', compact('ai', 'tasks'));
    }
    public function update(AIUpdateRequest $request, ArtificialIntelligence $ai)
    {
        $ai->update($request->validated());
        $ai->tasks()->sync($request->input('task_ids', []));
        $ai->transformations()->sync($request->input('transformation_ids', []));
        return redirect()->route('ai.index')->with('success', 'ИИ обновлён!');
    }
    public function destroy(ArtificialIntelligence $ai)
    {
        $ai->delete();
        return redirect()->route('ai.index')->with('success', 'ИИ удалён!');
    }
}
