@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('base.products') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('calculate') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-end">
                                    {{ __('base.quantity') }}
                                </label>

                                <div class="col-md-6">
                                    <input id="quantity"
                                           type="number"
                                           class="form-control"
                                           name="quantity"
                                           value="{{ old('quantity') }}"
                                           required autofocus>
                                </div>
                            </div>

                            @if (!empty($price))
                                <div class="alert alert-primary" role="alert">
                                    {{ __('base.price') }}: $ {{ $price }}
                                </div>
                            @endif

                            @if (!empty($error))
                                <div class="alert alert-danger" role="alert">
                                    {{ __('base.error') }}
                                </div>
                            @endif

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('base.check') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
