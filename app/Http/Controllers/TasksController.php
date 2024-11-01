<?php

namespace App\Http\Controllers;

use App\Filters\SearchFilter;
use App\Filters\WhereFilter;
use App\Http\Requests\StoreTaskRequest;
use App\Services\TaskService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class TasksController
{
    public function __construct(protected TaskService $service) { }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $filters[] = new SearchFilter(request('query'), ['title', 'id']);
        $filters[] = new WhereFilter('completed', request('option'));
        $tasks     = $this->service->paginate($filters);

        return view('tasks.index', compact('tasks'));
    }

    /**
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('tasks.create');
    }

    /**
     * @param StoreTaskRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $this->service->create($request->validated());

        return to_route('tasks.index');
    }

    /**
     * @param string $id
     *
     * @return Factory|View|Application
     */
    public function edit(string $id): Factory|View|Application
    {
        $task = $this->service->getTask($id);

        return view('tasks.edit', compact('task'));
    }

    /**
     * @param StoreTaskRequest $request
     * @param string $id
     *
     * @return RedirectResponse
     */
    public function update(StoreTaskRequest $request, string $id): RedirectResponse
    {
        $this->service->update($id, $request->validated());

        return back();
    }

    /**
     * @param string $id
     *
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->service->destroy($id);

        return back();
    }

    /**
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function complete(int $id): RedirectResponse
    {
        $this->service->update($id, ['completed' => true]);

        return back();
    }
}
