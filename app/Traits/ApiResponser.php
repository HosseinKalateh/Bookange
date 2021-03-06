<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponser
{
  

	// Return Success Response
	private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

  // Return Error Response
  private function errorResponse($message, $code)
  {
  	return response()->json(['errors' => $message, 'code' => $code], $code);
  }

  // Show All 
  protected function showAll(Collection $collection, $code = 200)
  {
    // If Collection Empty
    if (!count($collection)) {
      $data = [];
      return $this->successResponse($data, $code);
    }

    // Get Model Transformer
    $transformer = $collection->first()->transformer;

    // Paginate
    $collection = $this->paginate($collection, $this->getModelPerpageNumber($collection->first()));
    
    // Transform
    $transformer = $collection->first()->transformer;

    $data = $this->transformData($collection, $transformer);

  	return $this->successResponse($data, $code);
  }

  // Show One 
  protected function showOne(Model $instance, $code = 200)
 	{
  	$transformer = $instance->transformer;

    $data = $this->transformData($instance, $transformer);
  	
 		return $this->successResponse($data, $code);
 	}

  // Get Model Pagination Per Page Number
  private function getModelPerpageNumber($model)
  {
    $fullClass = get_class($model);

    $modelName = '\\App\\Models\\' . substr($fullClass, 11);

    return $perPage = $modelName::Per_Page;
  }

  // Paginate Data
  private function paginate(Collection $collection, $perPage)
  {
    $page = LengthAwarePaginator::resolveCurrentPage();

    $results = $collection->slice(($page -1) * $perPage, $perPage)->values();

    $paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
        'path' => LengthAwarePaginator::resolveCurrentPath()
    ]);

    $paginated->appends(request()->all()); // For add other parameter(like sort_by, ...)
      
    return $paginated;
  }

  // Transform Data
  private function transformData($data, $transformer)
  {
    return fractal($data, new $transformer)->toArray();
  }

  // Show Success Message
  protected function showSuccessMessage($message, $code = 200)
  {
    return $this->successResponse(['data' => $message], $code);
  }

  // Show Error Message
  protected function showErrorMessage($message, $code = 404)
  {
    return $this->errorResponse(['data' => $message], $code);
  }

}