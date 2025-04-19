<?php

namespace App\Http\Controllers;

use App\Http\Requests\AIRequest;
use App\Models\ArtificialIntelligence;
use App\Models\Task;
use Illuminate\Http\Request;

class AIController extends Controller
{
    public function index()
    {
        // Получаем все AI с их задачами через связь tasks
        $ais = ArtificialIntelligence::with('tasks')->get();
        return view('ai.index', compact('ais'));
    }
    public function create()
    {
        $tasks = Task::all(); // Получаем все категории статей
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
