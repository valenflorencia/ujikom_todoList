<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Home',
            'lists' => TaskList::all(),
            'tasks' => Task::orderBy('created_at', 'desc')->get(),
            'priorities' => Task::PRIORITIES
        ];

        return view('pages.home', $data);
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'required|max:255',
            'priority' => 'required|in:low,medium,high',
            'list_id' => 'required|exists:task_lists,id'
        ]);

        $task->update([
            'name' => $request->name,
            'description' => $request->description,
            'priority' => $request->priority,
            'list_id' => $request->list_id
        ]);

        return redirect()->back()->with('success', 'Task berhasil diperbarui!');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'required|max:100',
            'priority' => 'required|in:low,medium,high',
            'list_id' => 'required'
        ]);

        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'priority' => $request->priority,
            'list_id' => $request->list_id
        ]);


        return redirect()->back();
    }

    public function complete($id)
    {
        Task::findOrFail($id)->update([
            'is_completed' => true
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        Task::findOrFail($id)->delete();

        return redirect()->route('home');
    }
    // untuk memanggil komen
    public function show($id)
    {
        // untuk menyuruh tampilkan kalo tidk ketemu akan gagal(fail)
        $task = Task::findOrFail($id);

        $data = [
            'title' => 'Details',
            'lists' => TaskList::all(),
            'task' => $task,
        ];
        // untuk memanggil view 
        return view('pages.details', $data);
    }

    public function updateList(Request $request, Task $task)
    {
        $request->validate([
            'list_id' => 'required|exists:task_lists,id' // Pastikan tabel sesuai
        ]);

        $task->update(['list_id' => $request->list_id]);

        return redirect()->back()->with('success', 'Task berhasil dipindahkan ke list baru!');
    }
}
