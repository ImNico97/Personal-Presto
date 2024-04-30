<x-layout>
    <div class="bg">

        @if (session('message'))
            <div class="alert alert-success ">
                {{ session('message') }}
            </div>
        @endif

        <div class="container-fluid">
            <div class="row justify-content-center">
                <h1 class="text-center fw-bold white display-3 topTitle pb-5">{{__('ui.allAnnouncements')}}</h1>
                {{ $announcements->links() }}
                @forelse ($announcements as $announcement)
                    <div class="backCard">
                        <div class="wrapper d-flex flex-column justify-content-center align-items-center">
                            @if (!$announcement->images()->get()->isEmpty())
                                <div class="banner-image">
                                    <img src="{{ $announcement->images()->first()->getUrl(450, 500) }}"
                                        class="d-block w-100 h-100" alt="">
                                </div>
                            @else
                                <div class="banner-image">
                                    <img class="NoImg" src= "{{ asset('storage/img/Image_not_found.jpg') }}"
                                        alt="">
                                </div>
                            @endif
                            <h3 class="cardTitle pt-3 pb-1">{{implode(' ', array_slice(str_word_count($announcement->title, 1), 0, 10)) }}</h3>
                            <p class="cardText fs-4">{{ $announcement->price }}€</p>
                            <p class="cardText">{{implode(' ', array_slice(str_word_count($announcement->description, 1), 0, 10)) }}</p>
                            <div class="d-flex flex-column align-items-center py-2">
                                <a href="{{ route('showCategory', ['category' => $announcement->category]) }}"
                                    class="btn outline fill white">{{ $announcement->category->name }}</a>
                                <a href="{{ route('showAnnouncement', $announcement) }}" class="pt-3 fw-bold fill"><i
                                        class="bi bi-info-circle pe-2"></i>Dettaglio</a>
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
                    <div class="container-fluid ">
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-4 mt-3">
                                <h1 class="text-center text-white">Non ci sono annunci</h1>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        {{ $announcements->links() }}
    </div>
</x-layout>
