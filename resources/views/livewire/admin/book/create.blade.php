<div class="card">
    <div class="card-header p-0">
        <h3 class="card-title">{{ __('CreateTitle', ['name' => __('Book') ]) }}</h3>
        <div class="px-2 mt-4">
            <ul class="breadcrumb mt-3 py-3 px-4 rounded" style="background-color: #e9ecef!important;">
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.books.read')" class="text-decoration-none">{{ __(\Illuminate\Support\Str::plural('Book')) }}</a></li>
                <li class="breadcrumb-item active">{{ __('Create') }}</li>
            </ul>
        </div>
    </div>

    <form class="form-horizontal" wire:submit.prevent="create" enctype="multipart/form-data">

        <div class="card-body">
            
            <!-- Name Input -->
            <div class='form-group'>
                <label for='inputname' class='col-sm-2 control-label'> {{ __('Name') }}</label>
                <input type='text' wire:model.lazy='name' class="form-control @error('name') is-invalid @enderror" id='inputname'>
                @error('name') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>

            <!-- Authors Input -->
            <div class='form-group'>
                <label for='inputauthors' class='col-sm-2 control-label'> {{ __('Authors') }}</label>
                <select wire:model='bookAuthors' class="form-control @error('bookAuthors') is-invalid @enderror" id='inputauthors' multiple="multiple">
                
                @foreach($authors as $author)
                    <option value='{{ $author->id }}'>{{ $author->getFullName() }}</option>
                @endforeach
            </select>
                @error('bookAuthors') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>

            <!-- Translators Input -->
            <div class='form-group'>
                <label for='inputtranslators' class='col-sm-2 control-label'> {{ __('Translators') }}</label>
                <select wire:model='bookTranslators' class="form-control @error('bookTranslators') is-invalid @enderror" id='inputtranslators' multiple="multiple">
                
                @foreach($translators as $translator)
                    <option value='{{ $translator->id }}'>{{ $translator->getFullName() }}</option>
                @endforeach
            </select>
                @error('bookTranslators') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>

            <!-- Category_id Input -->
            <div class='form-group'>
                <label for='inputcategory_id' class='col-sm-2 control-label'> {{ __('Category_id') }}</label>
                <select wire:model='category_id' class="form-control @error('category_id') is-invalid @enderror" id='inputcategory_id'>
                @foreach(getCrudConfig('book')->inputs()['category_id']['select'] as $key => $value)
                    <option value='{{ $key }}'>{{ $value }}</option>
                @endforeach
            </select>
                @error('category_id') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            
            <!-- Publisher_id Input -->
            <div class='form-group'>
                <label for='inputpublisher_id' class='col-sm-2 control-label'> {{ __('Publisher_id') }}</label>
                <select wire:model='publisher_id' class="form-control @error('publisher_id') is-invalid @enderror" id='inputpublisher_id'>
                @foreach(getCrudConfig('book')->inputs()['publisher_id']['select'] as $key => $value)
                    <option value='{{ $key }}'>{{ $value }}</option>
                @endforeach
            </select>
                @error('publisher_id') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            
            <!-- Price Input -->
            <div class='form-group'>
                <label for='inputprice' class='col-sm-2 control-label'> {{ __('Price') }}</label>
                <input type='text' wire:model.lazy='price' class="form-control @error('price') is-invalid @enderror" id='inputprice'>
                @error('price') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            
            <!-- ISBN Input -->
            <div class='form-group'>
                <label for='inputISBN' class='col-sm-2 control-label'> {{ __('ISBN') }}</label>
                <input type='text' wire:model.lazy='ISBN' class="form-control @error('ISBN') is-invalid @enderror" id='inputISBN'>
                @error('ISBN') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            
            <!-- Number_of_pages Input -->
            <div class='form-group'>
                <label for='inputnumber_of_pages' class='col-sm-2 control-label'> {{ __('Number_of_pages') }}</label>
                <input type='text' wire:model.lazy='number_of_pages' class="form-control @error('number_of_pages') is-invalid @enderror" id='inputnumber_of_pages'>
                @error('number_of_pages') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            
            <!-- Published_at Input -->
            <div class='form-group'>
                <label for='inputpublished_at' class='col-sm-2 control-label'> {{ __('Published_at') }}</label>
                <input type='text' wire:model.lazy='published_at' class="form-control @error('published_at') is-invalid @enderror" id='inputpublished_at'>
                @error('published_at') <div class='invalid-feedback'>{{ $message }}</div> @enderror
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
            
            <!-- Picture Input -->
            <div class='form-group'>
                <label for='inputpicture' class='col-sm-2 control-label'> {{ __('Picture') }}</label>
                <input type='file' wire:model='picture' class="form-control-file @error('picture') is-invalid @enderror" id='inputpicture'>
                @if($picture and !$errors->has('picture') and $picture instanceof \Livewire\TemporaryUploadedFile and (in_array( $picture->guessExtension(), ['png', 'jpg', 'gif', 'jpeg'])))
                    <a href="{{ $picture->temporaryUrl() }}"><img width="200" height="200" class="img-fluid shadow" src="{{ $picture->temporaryUrl() }}" alt=""></a>
                @endif
                @error('picture') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info ml-4">{{ __('Create') }}</button>
            <a href="@route(getRouteName().'.books.read')" class="btn btn-default float-left">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>
