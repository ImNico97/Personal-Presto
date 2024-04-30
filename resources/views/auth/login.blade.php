<x-layout>
    <div class="container-fluid bg d-flex justify-content-center align-items-ceter">
        <div class="d-flex flex-column align-items-center topTitle">
            @if ($errors->any())
            <div class=" py-0 mt-3">
                <div class="d-flex  text-center align-items-center justify-content-center ">
                    <ul class="alert2">
                        @foreach ($errors->all() as $error)
                        <li class="fw-bold">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
            <div class="main">
                <input type="checkbox" id="chk" aria-hidden="true">
                <div class="signup">
                    <form class="auth" method="post" action="{{ route('register') }}">
                        @csrf
                        <label class="responsive2" for="chk" aria-hidden="true">REGISTRATI</label>
                        <input class="auth2" name="name" type="text" placeholder="User name" id="InputName"
                            aria-describedby="nameHelp">
                        <input class="auth2" name="email" type="email" placeholder="Email"
                            id="InputEmail"aria-describedby="emailHelp">
                        <input class="auth2" name="password" type="password" placeholder="Password"
                            id="InputPassword"aria-describedby="passwordHelp">
                        <input class="auth2" name="password_confirmation" type="password"
                            placeholder="Confirm password" id="InputPasswordconfirmation"
                            aria-describedby="passwordconfrimtionHelp">

                        <div class="d-flex justify-content-center">
                            <button href='{{ route('createAnnouncement') }}' type="submit"
                                class="button-30 ">REGISTRATI</button>
                        </div>
                    </form>
                </div>

                <div class="login ">
                    <form method="post" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <label class="auth" for="chk" aria-hidden="true">ACCEDI</label>
                        </div>
                        <input class="auth2" name="email" type="email" placeholder="Email" id="InputEmail"
                            aria-describedby="emailHelp">
                        <input class="auth2" name="password" type="password" placeholder="Password" id="InputPassword"
                            aria-describedby="passwordHelp">
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="button-30 d-flex">ACCEDI</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
