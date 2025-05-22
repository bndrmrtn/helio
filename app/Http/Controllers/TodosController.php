<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TodosController extends Controller {
    // index returns all the todos
    public function index(): \Inertia\Response {
        $todos = Todo::orderBy('created_at', 'desc')->paginate(2);

        $todos->getCollection()->transform(function ($todo) {
            $todo->due_human = \Carbon\Carbon::parse($todo->due_date)->shortAbsoluteDiffForHumans();
            if($todo->completed) {
                $todo->completed_in = $todo->created_at->diffForHumans($todo->updated_at, [
                    'parts' => 1,
                    'short' => true,
                    'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
                ]);
            }
            return $todo;
        });

        return Inertia::render('Home', [
            'todos' => $todos,
        ]);
    }

    // create renders the create page
    public function create(): \Inertia\Response {
        return Inertia::render('Create');
    }

    // store stores the TodoRequest as a new todo
    public function store(TodoRequest $request): RedirectResponse {
        $data = $request->validated();
        Todo::create($data);

        return Redirect::route('home');
    }

    // edit renders the edit page
    public function edit(int $id): \Inertia\Response {
        $todo = Todo::where('completed', false)->findOrFail($id);
        return Inertia::render('Edit', compact('todo'));
    }

    // update updates a todo
    public function update(int $id, TodoRequest $request): RedirectResponse {
        $todo = Todo::where('completed', false)->findOrFail($id);

        $data = $request->validated();

        $todo->description = $data['description'];
        $todo->due_date = $data['due_date'];
        $todo->save();

        return Redirect::route('home');
    }

    // finish marks a todo as completed
    public function finish(int $id): RedirectResponse {
        $todo = Todo::findOrFail($id);
        $todo->completed = true;
        $todo->save();
        return Redirect::route('home');
    }

    // destroy deletes a todo from the database
    public function destroy(int $id): RedirectResponse {
        Todo::where('id', $id)->delete();
        return Redirect::route('home');
    }
}
