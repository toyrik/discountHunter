@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Вам предоставлена персональная скидка!!') }}</div>

                <div class="card-body">
                    <div class="alert alert-danger" role="alert">
                        <h3>Скидка недоступна</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
