<head>
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js"></script>
</head>

<x-app-layout>
  <div id="body" class="hidden">
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
      @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
        <div class="mt-10 sm:mt-0">
            @livewire('profile.update-password-form')
        </div>
    
        <x-section-border />
      @endif
    
      @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
        <x-section-border />
    
        <div class="mt-10 sm:mt-0">
            @livewire('profile.delete-user-form')
        </div>
      @endif
    </div>
  </div>
</x-app-layout>