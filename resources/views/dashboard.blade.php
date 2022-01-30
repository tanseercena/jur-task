<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="">Profile Information</h2>

                    @if ($message = Session::get('success'))
                        <div class="">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {!! implode('', $errors->all('<div>:message</div>')) !!}
                        </div>
                    @endif

                    <form class="mt-3" method="post" action="{{ route('user.profile.update',$user) }}">
                        @csrf
                        <div class="mb-6">
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">First Name</label>
                            <input type="text" value="{{ old('first_name', $user->first_name) }}" name="first_name" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="First Name" required>
                        </div>
                        <div class="mb-6">
                            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Last Name</label>
                            <input type="text" value="{{ old('last_name', $user->last_name) }}" name="last_name" id="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Last Name" required>
                        </div>
                        <div class="mb-6">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your email</label>
                            <input type="email" value="{{ old('email', $user->email) }}" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required>
                        </div>
                        <button type="submit" class="mt-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Save</button>
                    </form>

                    <h2 class="mt-3">Experiences</h2>
                    @if ($message = Session::get('success-exp'))
                        <div class="">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    <a href="{{ route('user.experience.create') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">Add Experience</a>

                    <div class="mt-3">
                        @forelse($experiences as $experience)
                            <div>
                                <p><strong>Company: </strong> {{ $experience->company }}</p>
                                <p><strong>Job Title: </strong> {{ $experience->title }}</p>
                                <p><strong>Start Date: </strong> {{ $experience->start_date }}</p>
                                <p><strong>End Date: </strong> {{ is_null($experience->end_date) ? 'Curently Working' : $experience->end_date }}</p>
                                <p><strong>Descriptions</strong></p>
                                <p>{{ $experience->description }}</p>
                            </div>
                            <a href="{{ route('user.experience.edit', $experience) }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">Edit Experience</a>
                            <a href="{{ route('user.experience.destroy', $experience) }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-red-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-red-700 transition duration-150 ease-in-out">Remove Experience</a>
                            <br><br>
                            <hr>
                        @empty
                            <p class="mt-3">No Experience Found!</p>
                        @endforelse
                    </div>

                    <h2 class="mt-3">Organization Associations</h2>
                    @if ($message = Session::get('success-org'))
                        <div class="">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    <a href="{{ route('user.org.association.create') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">Add Organization Association</a>

                    <div class="mt-3">
                        @forelse($org_associations as $org_association)
                            <div>
                                <p><strong>Name: </strong> {{ $org_association->name }}</p>
                                <p><strong>Associated As: </strong> {{ $org_association->associated_as }}</p>
                                <p><strong>Start Date: </strong> {{ $org_association->start_date }}</p>
                                <p><strong>End Date: </strong> {{ is_null($org_association->end_date) ? 'Currently Working' : $org_association->end_date }}</p>
                                <p><strong>Descriptions</strong></p>
                                <p>{{ $org_association->description }}</p>
                            </div>
                            <a href="{{ route('user.org.association.edit', $org_association) }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">Edit Experience</a>
                            <a href="{{ route('user.org.association.destroy', $org_association) }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-red-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-red-700 transition duration-150 ease-in-out">Remove Experience</a>
                            <br><br>
                            <hr>
                        @empty
                            <p class="mt-3">No Organization Association Found!</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
