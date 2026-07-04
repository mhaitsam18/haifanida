@extends('layouts.app')

@section('content')
    <x-page-banner :title="$title" />

    <section class="py-16">
        <div class="mx-auto max-w-4xl px-4">
            <div class="overflow-hidden rounded-2xl border border-cream-200 shadow-sm">
                <iframe
                    src="https://docs.google.com/forms/d/e/1FAIpQLSdhyNI6HqR7KCJZrfZ4pSDYisUMrnNJ7uj4cPlgghP00YR33A/viewform?embedded=true"
                    style="width: 100%; min-height: 800px; border: none;"
                    loading="lazy">Memuat&hellip;</iframe>
            </div>
        </div>
    </section>
@endsection
