<div class="card">
    <div class="card-header p-0">
        <h3 class="card-title">{{ __('CreateTitle', ['name' => __('Author') ]) }}</h3>
        <div class="px-2 mt-4">
            <ul class="breadcrumb mt-3 py-3 px-4 rounded" style="background-color: #e9ecef!important;">
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.authors.read')" class="text-decoration-none">{{ __(\Illuminate\Support\Str::plural('Author')) }}</a></li>
                <li class="breadcrumb-item active">{{ __('Create') }}</li>
            </ul>
        </div>
    </div>

    <form class="form-horizontal" wire:submit.prevent="create" enctype="multipart/form-data">

        <div class="card-body">
            
            <!-- First_name Input -->
            <div class='form-group'>
                <label for='inputfirst_name' class='col-sm-2 control-label'> {{ __('First_name') }}</label>
                <input type='text' wire:model.lazy='first_name' class="form-control @error('first_name') is-invalid @enderror" id='inputfirst_name'>
                @error('first_name') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            
            <!-- Last_name Input -->
            <div class='form-group'>
                <label for='inputlast_name' class='col-sm-2 control-label'> {{ __('Last_name') }}</label>
                <input type='text' wire:model.lazy='last_name' class="form-control @error('last_name') is-invalid @enderror" id='inputlast_name'>
                @error('last_name') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            
            <!-- Description Input -->
            <div class='form-group'>
                <label for='inputdescription' class='col-sm-2 control-label'> {{ __('Description') }}</label>
                <div wire:ignore>
                    <textarea class='form-control ckeditor' id='editordescription' wire:model='description'></textarea>
                </div>
                <script>
                    ClassicEditor.create(document.querySelector('#editordescription'), {
                    @if(config('easy_panel.rtl_mode'))
                        language: 'fa'
                    @endif
                    }).then(editor => {
                        editor.setData('{!! $description !!}');
                        editor.model.document.on('change:data', () => {
                            @this.description = editor.getData()
                        });
                    });
                </script>
                @error('description') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info ml-4">{{ __('Create') }}</button>
            <a href="@route(getRouteName().'.authors.read')" class="btn btn-default float-left">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>
