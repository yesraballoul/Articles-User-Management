@extends('adminlte::page')

@section('title', 'Edit Role')

@section('content_header')
    <h1></h1>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-row justify-content-between align-items-center">
                        <div>{{ __('Update Role') }}</div>
                        <div><a class="btn btn-primary" href="{{ route('roles.index') }}">back</a></div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('roles.update', ['role' => $role->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') ?? $role->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="permissions" class="col-md-12 col-form-label text-md-end">{{ __('Permissions') }}
                                @error('permissions')
                                    <span class="invalid-feedback  d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </label>

                        </div>
                        <div id="accordion" class="row">
                            @foreach ($permissionsByGroup as $groupName => $permissions)
                                <div class="card col-12">
                                    <div class="card-header bg-light" id="headingOne" data-toggle="collapse"
                                        data-target="#collapse{{ $groupName }}">
                                        <div
                                            class="d-flex flex-row justify-content-between align-items-center font-weight-bold">
                                            {{ Str::ucfirst($groupName) }}
                                            <i class="fas fa-angle-down"></i>
                                        </div>
                                    </div>

                                    <div id="collapse{{ $groupName }}"
                                        class="collapse @error('permissions')show @enderror" aria-labelledby="headingOne"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            @foreach ($permissions as $permission)
                                                <div class="form-check">
                                                    <input name="permissions[]" class="form-check-input" type="checkbox"
                                                        @checked($rolePermissionsIds->contains($permission->id)) value="{{ $permission->name }}"
                                                        id="{{ $permission->name }}Check">
                                                    <label class="form-check-label" for="{{ $permission->name }}Check">
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row mb-0 justify-content-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@stop
