<?php

namespace App\Services;

use App\DataObjects\TaskData;
use App\Filters\EloquentFilterContract;
use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Author: nizomiddin
 * Date: 11/1/24 11:13 AM
 **/
class TaskService
{
    /**
     * @param iterable $filters
     * @param int $limit
     *
     * @return LengthAwarePaginator
     */
    public function paginate(iterable $filters = [], int $limit = 10): LengthAwarePaginator
    {
        $model = Task::query();

        foreach ($filters as $filter) {
            if ($filter instanceof EloquentFilterContract) {
                $model = $filter->applyEloquent($model);
            }
        }

        return $model->latest()->paginate($limit);
    }

    /**
     * @param array $data
     *
     * @return int
     */
    public function create(array $data): int
    {
        $task = Task::query()->create($data);

        return $task->id;
    }

    /**
     * @param int $id
     *
     * @return TaskData
     */
    public function getTask(int $id): TaskData
    {
        $task = Task::query()->findOrFail($id);

        return TaskData::createFromModel($task);
    }

    /**
     * @param int $id
     * @param array $data
     *
     * @return void
     */
    public function update(int $id, array $data): void
    {
        Task::query()->where('id', $id)->update($data);
    }

    /**
     * @param int $id
     *
     * @return void
     */
    public function destroy(int $id): void
    {
        Task::query()->where('id', $id)->delete();
    }
}
