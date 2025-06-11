@extends('layout.template')

@section('content')
<main class="flex-1 p-10">
    <div class="w-200 mx-auto p-6 border border-gray-200 rounded-lg">
        <h2 class="text-xl font-semibold border-b-2 border-gray-100 pb-2">User Profile</h2>

        <div class="flex items-center space-x-6 py-6">
            <img src="{{ $user->photo_profile ? asset($user->photo_profile) : asset('images/profile-default.jpg') }}"
                alt="Profile Photo" class="object-center w-28 h-28 rounded-full object-cover" />
            <div class="flex flex-col space-y-2">
                <div class="space-y-1">
                    <h3 class="text-sm font-semibold text-gray-800">
                        @if($user->role->value === 'MAHASISWA')
                            NIM
                        @elseif($user->role->value === 'DOSEN')
                            NIDN
                        @elseif($user->role->value === 'ADMIN')
                            NIP
                        @else
                            Username
                        @endif
                    </h3>
                    <p class="text-xs text-gray-400">
                        @if($user->role->value === 'MAHASISWA' && $user->mahasiswa)
                            {{ $user->mahasiswa->nim }}
                        @elseif($user->role->value === 'DOSEN' && $user->dosen)
                            {{ $user->dosen->nidn }}
                        @elseif($user->role->value === 'ADMIN' && $user->admin)
                            {{ $user->admin->nip }}
                        @else
                            {{ $user->username }}
                        @endif
                    </p>
                </div>
                <div class="space-y-1">
                    <h3 class="text-sm font-semibold text-gray-800">Email</h3>
                    <p class="text-xs text-gray-400">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        @if($user->role->value === 'MAHASISWA' && $user->mahasiswa)
            <div class="flex flex-col space-y-2 space-x-6 py-6">
                <h3 class="text-sm font-medium text-gray-400 border-b-2 border-gray-200 mb-4">Mahasiswa Details</h3>
                <div class="grid grid-cols-2 gap-6">
                    <div class="flex flex-col space-y-1">
                        <label class="block text-sm font-medium text-gray-500">NIM</label>
                        <p class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 bg-gray-50">{{ $user->mahasiswa->nim }}</p>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label class="block text-sm font-medium text-gray-500">Name</label>
                        <p class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 bg-gray-50">{{ $user->mahasiswa->name }}</p>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label class="block text-sm font-medium text-gray-500">Phone Number</label>
                        <p class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 bg-gray-50">{{ $user->mahasiswa->phone_number }}</p>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label class="block text-sm font-medium text-gray-500">Address</label>
                        <p class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 bg-gray-50">{{ $user->mahasiswa->address }}, {{ $user->mahasiswa->subdistrict }}, {{ $user->mahasiswa->district }}, {{ $user->mahasiswa->city }}</p>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label class="block text-sm font-medium text-gray-500">Prodi</label>
                        <p class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 bg-gray-50">{{ $user->mahasiswa->prodi }}</p>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label class="block text-sm font-medium text-gray-500">Grade</label>
                        <p class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 bg-gray-50">{{ $user->mahasiswa->grade }}</p>
                    </div>
                </div>
            </div>

            @if($user->mahasiswa->preferences->count() > 0)
                <div class="flex flex-col space-y-2 space-x-6 py-6 mb-4">
                    <h3 class="text-sm font-medium text-gray-400 border-b-2 border-gray-200 mb-4">Interests & Talents</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($user->mahasiswa->preferences as $preference)
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $preference->name }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

            @auth
                @if(Auth::user()->role->value === 'ADMIN' && $user->role->value === 'MAHASISWA')
                    <div class="flex flex-col space-y-2 space-x-6 py-6 mb-4" x-data="{ showRecommendationForm: false }">
                        <h3 class="text-sm font-medium text-gray-400 border-b-2 border-gray-200 mb-4">Send Recommendation</h3>
                        <button @click="showRecommendationForm = !showRecommendationForm"
                                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                            <span x-text="showRecommendationForm ? 'Cancel' : 'Send Recommendation'"></span>
                        </button>

                        <div x-show="showRecommendationForm" class="mt-4">
                            <form action="{{ route('admin.send-recommendation', ['id' => $user->id]) }}" method="POST">
                                @csrf
                                <textarea name="message" rows="4" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Compose your recommendation message..."></textarea>
                                <button type="submit" class="mt-2 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                                    Send Message
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            @endauth

        @elseif($user->role->value === 'DOSEN' && $user->dosen)
            <div class="flex flex-col space-y-2 space-x-6 py-6">
                <h3 class="text-sm font-medium text-gray-400 border-b-2 border-gray-200 mb-4">Dosen Details</h3>
                <div class="grid grid-cols-2 gap-6">
                    <div class="flex flex-col space-y-1">
                        <label class="block text-sm font-medium text-gray-500">NIDN</label>
                        <p class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 bg-gray-50">{{ $user->dosen->nidn }}</p>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label class="block text-sm font-medium text-gray-500">Name</label>
                        <p class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 bg-gray-50">{{ $user->dosen->name }}</p>
                    </div>
                </div>
            </div>

            @if($user->dosen->preferences->count() > 0)
                <div class="flex flex-col space-y-2 space-x-6 py-6 mb-4">
                    <h3 class="text-sm font-medium text-gray-400 border-b-2 border-gray-200 mb-4">Interests & Talents</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($user->dosen->preferences as $preference)
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $preference->name }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

        @elseif($user->role->value === 'ADMIN' && $user->admin)
            <div class="flex flex-col space-y-2 space-x-6 py-6">
                <h3 class="text-sm font-medium text-gray-400 border-b-2 border-gray-200 mb-4">Admin Details</h3>
                <div class="grid grid-cols-2 gap-6">
                    <div class="flex flex-col space-y-1">
                        <label class="block text-sm font-medium text-gray-500">NIP</label>
                        <p class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 bg-gray-50">{{ $user->admin->nip }}</p>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label class="block text-sm font-medium text-gray-500">Name</label>
                        <p class="text-sm block w-full border border-gray-300 rounded-lg px-2 py-2 bg-gray-50">{{ $user->admin->name }}</p>
                    </div>
                </div>
            </div>
        @else
            <p class="text-sm text-gray-600 mt-4">No specific profile details available for this user role.</p>
        @endif
    </div>
</main>
@endsection