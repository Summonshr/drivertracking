<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteResource;
use App\Http\Requests\StoreResource;
use App\Http\Requests\UpdateResource;
use App\Http\Requests\ViewRequest;
use App\Interfaces\ResourceModel;

class ResourceController extends Controller
{
    public function view(ViewRequest $request, $resourceType, $resourceAction = 'index', ResourceModel $model = null)
    {
        $view = [$resourceType];

        if ($model) {
            array_push($view, 'single');
        } else {
            array_push($view, $resourceAction);
        }

        return view(implode('.', $view))->with($resourceType, $model);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResource $request, ResourceModel $model)
    {
        abort_if(! $model->fillable, 500, 'Add fillable property in model:'.$model->class_alias);

        $model->user_id = auth()->id();

        $model->fill($request->only($model->fillable));

        $model->save();

    }

    public function update(UpdateResource $request, ResourceModel $model)
    {
        $model->update($request->validated());
    }

    public function destroy(DeleteResource $request, ResourceModel $model)
    {
        $model->delete();
    }
}
