@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="text-danger">
            {{ __('Whoops! Something went wrong.') }}
        </div>

        <ul class="mt-3 list-disc list-inside text-sm text-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
