<x-layout>
    <div class="bg">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-md-4">
                    <h1 class="text-center white topTitle">
                        {{ $announcement_to_check ? 'Ecco l\'annuncio da revisionare' : 'Non ci sono annunci da revisionare' }}
                    </h1>
                </div>
            </div>
        </div>
        <div class="container">
            @if (session('message'))
                <div class="d-flex justify-content-center alert alert-success text-center">
                    {{ session('message') }}
                </div>
            @elseif (session('status'))
                <div class="d-flex justify-content-center alert alert-danger text-center">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <br>
        @if ($announcement_to_check)
            <div class="container px-0">
                <div class="row justify-content-center mx-0">
                    <div class="col-10 col-md-12 d-flex justify-content-center responsive3">
                        @if (!$announcement_to_check->images()->get()->isEmpty())
                            <div id="carouselExampleAutoplaying" class="backCard2 col-12 col-md-3 carousel slide"
                                data-bs-ride="carousel">
                                <div class="carousel-inner banner-image">
                                    @foreach ($announcement_to_check->images as $image)
                                        <div class="carousel-item @if ($loop->first) active @endif ">
                                            <img src="{{ $image->getUrl(450, 500) }}" alt=""
                                                class="banner-image">
                                        </div>
                                    @endforeach
                                </div>
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
                            <div class="backCard2 col-12 col-md-2 d-flex flex-column align-items-center white">
                                <div>
                                    <h5 class="tc-accent">Tags</h5>
                                </div>
                                <div class="p-2 text-center">
                                    @if ($image->labels)
                                        @foreach ($image->labels as $label)
                                            <p class="d-inline">#{{ $label }}</p>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="backCard2 col-12 col-md-3 d-flex flex-column align-items-center white">
                                <h5 class="tc-accent">Revisione immagini</h5>
                                <p>Adulti: <span class="{{ $image->adult }}"><i class="bi bi-circle-fill"></i></span>
                                </p>
                                <p>Medical: <span class="{{ $image->medical }}"><i class="bi bi-circle-fill"></i></span>
                                </p>
                                <p>Satira: <span class="{{ $image->spoof }}"><i class="bi bi-circle-fill"></i></span>
                                </p>
                                <p>Violenza: <span class="{{ $image->violence }}"><i
                                            class="bi bi-circle-fill"></i></span></p>
                                <p>Contenuto ammiccante: <span class="{{ $image->racy }}"><i
                                            class="bi bi-circle-fill"></i></span></p>
                            </div>
                        @else
                            <div class="backCard2 mb-0">
                                <img class="NoImg" alt="">
                            </div>
                        @endif
                    </div>
                    <div class="col-12 col-md-6 backCard3 d-flex flex-column align-items-center justify-content-center white text-center mt-0">
                        <h3 class="cardTitle pt-3 pb-1">{{ $announcement_to_check->title }}</h3>
                        <p class="cardText fs-4">{{ $announcement_to_check->price }}€</p>
                        <p class="cardText">{{ $announcement_to_check->description }}</p>
                        <p class="cardText">{{ $announcement_to_check->category->name }}</p>
                        <div class="d-flex col-12 justify-content-around align-items-center py-2">
                            <form class="py-2"
                                action="{{ route('acceptAnnouncement', ['announcement' => $announcement_to_check]) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn1"><i class="bi bi-check-circle"></i></button>
                            </form>
                            <form class="py-2"
                                action="{{ route('rejectAnnouncement', ['announcement' => $announcement_to_check]) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn2 "><i class="bi bi-trash3"></i></button>
                            </form>
                        </div>
                        <div class="col-12 d-flex justify-content-around align-items-center pt-4">
                            <p class="cardText">Pubblicato il:
                                <br>{{ $announcement_to_check->created_at->format('d/m/Y') }}
                            </p>
                            <p class="cardText">Da:
                                <br>{{ $announcement_to_check->user->name ?? 'utente di default' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

</x-layout>