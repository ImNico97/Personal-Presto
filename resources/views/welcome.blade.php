<x-layout>
    <div class="alert3">
        @if (session('message'))
            <div class="alert alert-success text-center">
                {{ session('message') }}
            </div>
        @endif

        @if (session('access.denied'))
            <div class="alert alert-danger">
                {{ session('access.denied') }}
            </div>
        @endif
    </div>

    <header class="bg">
        <div class="container-fluid">
            <div class="bg2-container">
                <div class="bg2"></div>
            </div>
            <div class="row mx-5">
                <div class="responsive col-12 col-md-12 d-flex justify-content-between align-items-center px-4">
                    <div class=" col-12 col-md-3 d-flex flex-column align-items-center">
                        <p class="subtitle">{{ __('ui.title1') }}</p>
                        <a class="recent text-center fw-bold fs-3 " href="#recent"><i
                                class="bi bi-chevron-double-down"></i>{{ __('ui.title2') }}<i
                                class="bi bi-chevron-double-down"></i></a>
                    </div>
                    <div class="col-12 col-md-2 d-flex flex-column align-items-center">
                        <h2 class="subtitle my-0">{{ __('ui.title3') }}</h2>
                        <a class="white pt-3 {{ Route::currentRouteName() == 'createAnnouncement' ? 'active' : '' }}"
                            href="{{ route('createAnnouncement') }}"><button class="button-30 fs-1">+</button></a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <br id="recent">
    <section>
        <h2 class="text-center fw-bold display-3 mt-5 pt-5 white">ULTIME AGGIUNTE</h2>
        <div class="container-fluid">
            <div class="row justify-content-center">
                @forelse ($announcements as $announcement)
                    <div class="backCard">
                        <div class="wrapper d-flex flex-column justify-content-center align-items-center">
                            @if (!$announcement->images()->get()->isEmpty())
                                <div class="banner-image">
                                    <img src="{{ $announcement->images()->first()->getUrl(450,500) }}" class="d-block w-100 h-100" alt="">
                                </div>
                            @else
                                <div class="banner-image">
                                    <img class="NoImg" src= "{{ asset('storage/img/Image_not_found.jpg') }}"
                                        alt="">
                                </div>
                            @endif
                            <h3 class="cardTitle pt-3 pb-1">{{implode(' ', array_slice(str_word_count($announcement->title, 1), 0, 10)) }}<h3>
                            <p class="cardText fs-4">{{ $announcement->price }}€</p>
                            <p class="cardText">{{implode(' ', array_slice(str_word_count($announcement->description, 1), 0, 10)) }}</p>
                            <div class="d-flex flex-column align-items-center py-2">
                                <a href="{{ route('showCategory', ['category' => $announcement->category]) }}"
                                    class="btn outline fill white">{{ $announcement->category->name }}</a>
                                <a href="{{ route('showAnnouncement', $announcement) }}" class="pt-3 fw-bold fill"><i
                                        class="bi bi-info-circle pe-2"></i>Dettaglio</a>
                            </div>
                            <div class="col-12 d-flex justify-content-around align-items-center pt-3 ">
                                <p class="cardText me-5">Pubblicato il:
                                    <br>{{ $announcement->created_at->format('d/m/Y') }}
                                </p>
                                <p class="cardText ms-5">Da: <br>{{ $announcement->user->name ?? 'utente di default' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="container-fluid ">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-4 mt-3">
                                <h1 class="text-center">Non ci sono annunci</h1>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-layout>
{{-- <div class="col-12 col-md-4 ">
<div class="card mt-5 p-3">
    <img src="https://picsum.photos/200/203" class="d-block w-100" alt="img 3">
    <div class="card-body">
      <h5 class="card-title">{{$announcement->title}}</h5>
      <p class="card-text">{{$announcement->description}}</p>
      <p class="card-text">{{$announcement->price}}€</p>
      <a href="{{route('showCategory',['category'=>$announcement->category])}}" class="btn btn1">{{$announcement->category->name}}</a>
      <a href="{{route('showAnnouncement',$announcement)}}" class="btn btn2">Dettaglio</a>
      <p class="card-footer">Pubblicato il :{{$announcement->created_at->format('d/m/Y')}}</p>
      <p class="card-footer">Autore: {{$announcement->user->name}}</p>
    </div>
  </div>
</div> --}}
