<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

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
    	return response()->json(['error' => $message, 'code' => $code], $code);
    }

    // Show All 
    protected function showAll(Collection $collection, $code = 200)
    {
    	$modelResource = $this->getModelResource($collection->first());
    	
    	$data = $modelResource::collection($collection);

    	return $this->successResponse($data, $code);
    }

    // Show One 
    protected function showOne(Model $instance, $code = 200)
   	{
    	$modelResource = $this->getModelResource($instance);
    	
    	$data = new $modelResource($instance);
    	
   		return $this->successResponse($data, $code);
   	}

   	// Get Model Resource From Model Name
   	private function getModelResource($model)
   	{
   		$fullClass = get_class($model);

    	$modelName = substr($fullClass, 11);

    	return $modelResource = '\\App\\Http\\Resources\\' . strtolower($modelName) . '\\' .$modelName . 'Resource';
   	}

}