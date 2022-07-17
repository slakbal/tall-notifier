<div class="{{ config('tall-notifier.positionClass') }} p-2 flex flex-col space-y-4">
    @foreach ($messages as $message)
        <livewire:notifier-message :message="$message" key="{{ $loop->index }}" />
    @endforeach
</div>
