document.addEventListener('livewire:load', function () {
    window.addEventListener('toast', event => {
        toast.success(event.detail.message); // Use the message from the event
    });
});
