<x-layout>
    <div class="bg mt-0">
        <div class="container px-0">
            <div class="row justify-content-around">
                <h1 class="topTitle text-center white mb-5">Annuncio : "{{ $announcement->title }}"</h1>
                <div class="col-12 col-md-12 d-flex justify-content-center align-items-top">
                    <div class="backCardShow">
                        <div class="wrapper d-flex flex-column align-items-center">
                            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                                @if (!$announcement->images()->get()->isEmpty())
                                    <div class="carousel-inner banner-image">
                                        @foreach ($announcement->images as $image)
                                            <div
                                                class="carousel-item @if ($loop->first) active @endif banner-image">
                                                <img src="{{ $image->getUrl(450, 500) }}" alt="">
                                            </div>
                                        @endforeach
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                @else
                                    <div class="carousel-item active banner-image ">
                                        <img class="NoImg" src= "{{ asset('storage/img/Image_not_found.jpg') }}"
                                            alt="">
                                    </div>
                                @endif
                            </div>
                            <h3 class="cardTitle pt-3 pb-1">{{ $announcement->title }}</h3>
                            <p class="cardText fs-4">{{ $announcement->price }}€</p>
                            <p class="cardText">{{ $announcement->description }}</p>
                            <div class="d-flex flex-column align-items-center py-2">
                                <a href="{{ route('showCategory', ['category' => $announcement->category]) }}"
                                    class="btn outline fill">{{ $announcement->category->name }}</a>
                                    <button onclick="goBack()"  class="pt-3 fw-bold fill2">Torna indietro</button>
                                    <script>
                                        function goBack() {
                                            window.history.back();
                                        }
                                    </script>
                            </div>
                            <div class="col-12 d-flex justify-content-around align-items-center pt-4">
                                <p class="cardText">Pubblicato il:
                                    <br>{{ $announcement->created_at->format('d/m/Y') }}
                                </p>
                                <p class="cardText">Da: <br>{{ $announcement->user->name ?? 'utente non trovato' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
