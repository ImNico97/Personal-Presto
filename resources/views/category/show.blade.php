<x-layout>
    <div class="bg">
        <div class="container titoloCustom">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <h1 class="text-center topTitle display-3 white fw-bold">{{__('ui.category')}} : {{__("ui.$category->name")}}</h1>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="col-12 col-md-12 d-flex justify-content-center align-items-center">
                <div class="row justify-content-around py-5">
                    @forelse ($announcements as $announcement)
                        <div class="col-12 col-md-4 backCard">
                            <div class="wrapper d-flex flex-column justify-content-center align-items-center">
                                @if (!$announcement->images()->get()->isEmpty())
                                    <div class="banner-image">
                                        <img class="d-block w-100 h-100" src="{{ $announcement->images()->first()->getUrl(450, 500) }}" alt="foto">
                                    </div>
                                @else
                                    <div class="banner-image">
                                        <img class="d-block w-100 h-100" class="NoImg" src= "{{ asset('storage/img/Image_not_found.jpg') }}" alt="foto">
                                    </div>
                                @endif
                                <h3 class="cardTitle pt-3 pb-1">{{ $announcement->title }}</h3>
                                <p class="cardText fs-4">{{ $announcement->price }}€</p>
                                <p class="cardText">{{implode(' ', array_slice(str_word_count($announcement->description, 1), 0, 10)) }}</p>
                                <div class="d-flex flex-column align-items-center py-2">
                                    <a href="{{ route('showCategory', ['category' => $announcement->category]) }}"
                                        class="btn outline fill white">{{ $announcement->category->name }}</a>
                                    <a href="{{ route('showAnnouncement', $announcement) }}"
                                        class=" pt-3 fw-bold fill"><i class="bi bi-info-circle pe-2"></i>Dettaglio</a>
                                </div>
                                <div class="col-12 d-flex justify-content-around align-items-center pt-3">
                                    <p class="cardText">Pubblicato il:
                                        <br>{{ $announcement->created_at->format('d/m/Y') }}
                                    </p>
                                    <p class="cardText">Da: <br>{{ $announcement->user->name ?? 'utente di default' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                </div>
                <div class="d-flex flex-column justify-content-center align-items-center vh-100">
                    <h2 class="white">Non ci sono prodotti</h2>
                    <a href="{{ route('createAnnouncement') }}"><button class="button-30">Aggiungi
                            Annuncio</button></a>
                </div>
                @endforelse
            </div>
        </div>
    </div>
    </div>
</x-layout>
