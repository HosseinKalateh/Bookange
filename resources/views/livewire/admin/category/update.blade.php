<div class="card">
    <div class="card-header p-0">
        <h3 class="card-title">{{ __('UpdateTitle', ['name' => __('Category') ]) }}</h3>
        <div class="px-2 mt-4">
            <ul class="breadcrumb mt-3 py-3 px-4 rounded" style="background-color: #e9ecef!important;">
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.categories.read')" class="text-decoration-none">{{ __(\Illuminate\Support\Str::plural('Category')) }}</a></li>
                <li class="breadcrumb-item active">{{ __('Update') }}</li>
            </ul>
        </div>
    </div>

    <form class="form-horizontal" wire:submit.prevent="update" enctype="multipart/form-data">

        <div class="card-body">

            
            <!-- Name Input -->
            <div class='form-group'>
                <label for='inputname' class='col-sm-2 control-label'> {{ __('Name') }}</label>
                <input type='text' wire:model.lazy='name' class="form-control @error('name') is-invalid @enderror" id='inputname'>
                @error('name') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            
            <!-- Sort_order Input -->
            <div class='form-group'>
                <label for='inputsort_order' class='col-sm-2 control-label'> {{ __('Sort_order') }}</label>
                <input type='number' wire:model.lazy='sort_order' class="form-control @error('sort_order') is-invalid @enderror" id='inputsort_order'>
                @error('sort_order') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            
            <!-- Is_active Input -->
            <div class='form-group'>
                <div class='form-check mt-4 mb-3'>
                    <input wire:model.lazy='is_active' class='form-check-input' type='checkbox' id='inputis_active'>
                    <label class='form-check-label' for='inputis_active'>{{ __('Is_active') }}</label>
                </div>
                @error('is_active') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info ml-4">{{ __('Update') }}</button>
            <a href="@route(getRouteName().'.categories.read')" class="btn btn-default float-left">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>
