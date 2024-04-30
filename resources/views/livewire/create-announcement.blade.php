
<div class="container-fluid d-flex justify-content-center align-items-center">
    <div class="d-flex flex-column align-items-center col-lg-6 col-md-8 col-sm-10 col-12">
        <div class=" col-lg-6 col-md-8 col-sm-10 col-12 h-100 create">
            @if (session()->has('message'))
            <div class=" p-0 m-0">
                <div class="d-flex text-center align-items-center justify-content-center">
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                </div>
            </div>
                @endif
            @if ($errors->any())
                <div class=" p-0 m-0">
                    <div class="d-flex alert2 text-center align-items-center justify-content-center">
                        <ul class="my-0 px-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <form wire:submit = 'save'>
                <div class="d-flex flex-column align-items-center text-center ">
                    <h2 class="text-center fw-bold display-4 my-4 pt-5">{{__('ui.makeAnnouncements')}}</h2>

                    <label for="InputTitle" class="fw-semibold mt-4 col-12">{{__('ui.title')}}</label>
                    <input class="mt-2 mb-0" type="text" id="InputTitle" aria-describedby="titleHelp"
                        wire:model= 'title'>

                    <label for="InputPrice" class="form-label fw-semibold mt-4">{{__('ui.price')}}</label>
                    <input class="mt-2 mb-0" type="number" placeholder="€" id="InputPrice" wire:model= 'price'>

                    <label for="InputDescription" class="form-label fw-semibold mt-4">{{__('ui.description')}}</label>
                    <input class="mt-2 mb-0" type="text" id="InputDescription" wire:model= 'description'>

                    <label for="category" class="fw-semibold mt-4">{{__('ui.category')}}</label>
                    <select class="mt-2 mb-0" id="Category" wire:model="category">
                        <option class="dropdown-item" value="">
                            {{__('ui.category1')}}
                        </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">

                                {{ $category->name }}

                            </option>
                        @endforeach
                    </select>
                    <div class="mb-3 col-12 d-flex flex-column align-items-center">
                        <label for="foto" class="fw-semibold mt-4">{{__('ui.image')}}</label>
                        <input type="file" placeholder="Img" name="images" multiple
                            class="form-control @error('temporary_images.*') is-invalid @enderror" id="InputPrice"
                            wire:model="temporary_images">
                    </div>
                    @if (!empty($images))
                    <div class="row">
                        <div class="col-12">
                            <p class="text-center">Anteprima foto</p>
                            <div class="rounded shadow py-4 d-flex flex-wrap justify-content-center">
                                @foreach ($images as $key => $image)
                                    @php
                                        $colSize = count($images) === 1 ? 'col-12' : (count($images) === 2 ? 'col-12 col-md-6' : 'col-12 col-md-4');
                                    @endphp
                                    <div class="{{ $colSize }} m-1">
                                        <div class="img-preview mx-auto shadow rounded"
                                            style="background-image: url('{{ $image->temporaryUrl() }}');">
                                        </div>
                                        <button type="button"
                                            class="btn btn-danger shadow d-block text-center mt-2 mx-auto"
                                            wire:click="removeImage({{ $key }})"><i class="bi bi-trash3"></i></button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                    <div class="d-flex justify-content-center mt-5">
                        <button type="submit" class="button-30">{{__('ui.create')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
