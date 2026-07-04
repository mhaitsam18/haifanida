@extends('layouts.app')

@section('content')
    <section class="py-16">
        <div class="mx-auto max-w-4xl px-4">
            <div class="overflow-hidden rounded-2xl border border-cream-200 bg-cream-50 shadow-sm">
                <div class="bg-maroon-800 px-6 py-6 text-center">
                    <h2 class="font-display text-xl font-semibold text-cream-50">
                        <i class="bx {{ $mode == 'edit' ? 'bx-edit' : 'bx-user' }} align-middle"></i>
                        {{ $mode == 'edit' ? 'Edit Profile' : 'Profile' }}
                    </h2>
                </div>

                <div class="p-6 md:p-8">
                    <div class="grid gap-8 md:grid-cols-3">
                        <div class="text-center">
                            <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('storage/user-photo/not-found.jpg') }}"
                                class="mx-auto h-40 w-40 rounded-full border border-cream-200 object-cover shadow-sm" alt="Profile Photo">

                            @if ($mode == 'edit')
                                <form action="{{ route('member.profile.update-photo') }}" method="POST" enctype="multipart/form-data" class="mt-5">
                                    @csrf
                                    <input type="file" name="photo" accept="image/*" id="photo-upload"
                                        class="block w-full text-xs text-stone-600 file:mr-3 file:rounded-lg file:border-0 file:bg-maroon-100 file:px-3 file:py-2 file:text-xs file:font-medium file:text-maroon-800 hover:file:bg-maroon-200">
                                    <x-button type="submit" class="mt-3 w-full justify-center">
                                        <i class="bx bx-camera"></i> Update Photo
                                    </x-button>
                                </form>
                            @endif
                        </div>

                        <div class="md:col-span-2">
                            @if ($mode == 'edit')
                                <form action="{{ route('member.profile.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <x-form-input label="Name" name="name" :value="$user->name" required />
                                    <x-form-input label="Email" name="email" type="email" :value="$user->email" />
                                    <x-form-input label="Username" name="username" :value="$user->username" />
                                    <x-form-input label="Phone Number" name="phone_number" type="number" :value="$user->phone_number" />
                                    @if (!$user->google_id)
                                        <x-form-input label="Password" name="password" type="password" />
                                    @endif
                                    <div class="mt-4 flex gap-3">
                                        <x-button type="submit"><i class="bx bx-save"></i> Save Changes</x-button>
                                        <x-button variant="secondary" :href="route('member.profile', ['mode' => 'show'])">
                                            <i class="bx bx-x"></i> Cancel
                                        </x-button>
                                    </div>
                                </form>
                            @else
                                <div class="space-y-4">
                                    <div>
                                        <label class="text-xs font-medium uppercase tracking-wide text-stone-500">Name</label>
                                        <div class="mt-1 rounded-lg bg-cream-100 p-3 text-sm text-stone-800">
                                            <i class="bx bx-user mr-2 text-maroon-700"></i>{{ $user->name }}
                                        </div>
                                    </div>
                                    <div>
                                        <label class="text-xs font-medium uppercase tracking-wide text-stone-500">Email</label>
                                        <div class="mt-1 rounded-lg bg-cream-100 p-3 text-sm text-stone-800">
                                            <i class="bx bx-envelope mr-2 text-maroon-700"></i>{{ $user->email }}
                                        </div>
                                    </div>
                                    <div>
                                        <label class="text-xs font-medium uppercase tracking-wide text-stone-500">Username</label>
                                        <div class="mt-1 rounded-lg bg-cream-100 p-3 text-sm text-stone-800">
                                            <i class="bx bx-at mr-2 text-maroon-700"></i>{{ $user->username }}
                                        </div>
                                    </div>
                                    <div>
                                        <label class="text-xs font-medium uppercase tracking-wide text-stone-500">Phone Number</label>
                                        <div class="mt-1 rounded-lg bg-cream-100 p-3 text-sm text-stone-800">
                                            <i class="bx bx-phone mr-2 text-maroon-700"></i>{{ $user->phone_number }}
                                        </div>
                                    </div>
                                    <div class="flex gap-3 pt-2">
                                        <x-button :href="route('member.profile', ['mode' => 'edit'])">
                                            <i class="bx bx-edit"></i> Edit Profile
                                        </x-button>
                                        <x-button variant="secondary" href="/member/identitas">
                                            <i class="bx bx-id-card"></i> Kelola Identitas dan Berkas
                                        </x-button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
