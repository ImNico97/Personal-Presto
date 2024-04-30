<x-layout>
    <div class="container-fluid bg">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-8 p-5">
                <div class="create">
                    <form method='post' action={{ route('becomeRevisor') }}>
                        @csrf
                        <h1 class="text-center fw-bold display-4 mb-4 pt-5">Lavora con noi</h1>
                        <div class="mb-3">
                            <label for="exampleInputmotivation" class="form-label fw-semibold mt-4">Motivazioni</label>
                            <input name='motivation' type="text" class="mt-2 mb-0" id="exampleInputmotivation"
                                aria-describedby="motivationHelp" required=''>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputexperience" class="form-label fw-semibold mt-4 ">Esperienze nel settore</label>
                            <textarea name='experience' type="text" class="form-control " id="exampleInputexperience" aria-describedby="expHelp"
                                required=''></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputTime" class="form-label fw-semibold mt-4">Quando sei disposto ad iniziare?</label>
                            <input name='time' type="text" class="mt-2 mb-0" id="exampleInputTime"
                                aria-describedby="timeHelp" required=''>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="button-30">DIVENTA REVISORE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
