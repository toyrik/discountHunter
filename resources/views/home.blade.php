@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Вам предоставлена персональная скидка!!') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (isset($discount))
                        <div class="alert alert-success" role="alert">
                            <h3>Код вашей скидки на {{ $discount->value }}% :</h3>
                            {{ $discount->code }}
                        </div>
                    @else
                        <p class="text-center">Для получения скидки кликните по кнопке</p>
                        <div class="text-center">
                            <form method="post" action="{{ route('discount') }}">
                                @csrf
                                <button class="btn btn-primary" type="submit">Получить скидку</button>
                            </form>
                        </div>
                    @endif
                    <hr>
                    <p class="text-center">Срок действия скидки ограничен, проверьте имеющийся у вас код в поле ниже</p>
                    <div class="text-center">
                        <form method="post" action="{{ route('check-discount') }}">
                            @csrf
                            <input class="form-control mb-3" type="text" id="code" name="code" placeholder="Введите скидочный код...">
                            <button class="btn btn-secondary" type="submit">Проверить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
