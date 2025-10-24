@props(['action', 'method' => 'POST', 'title' => '', 'description' => '', 'hasFiles' => false])

<div class="bg-primary-background min-h-screen flex items-center justify-center py-12 px-4">
    <div class="w-full max-w-2xl">
        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
            <!-- Card Header -->
            @if($title || $description)
                <div class="bg-accent p-6">
                    @if($title)
                        <h2 class="text-2xl font-bold text-primary mb-2">{{ $title }}</h2>
                    @endif
                    @if($description)
                        <p class="text-primary/70">{{ $description }}</p>
                    @endif
                </div>
            @endif

            <!-- Form Content -->
            <div class="p-8">
                {{-- novalidate --}}
                <form action="{{ $action }}" method="{{ $method === 'GET' ? 'GET' : 'POST' }}"
                      @if($hasFiles) enctype="multipart/form-data" @endif>
                    @csrf
                    @if(!in_array($method, ['GET', 'POST']))
                        @method($method)
                    @endif

                    {{ $slot }}
                </form>
            </div>
        </div>
    </div>
</div>
