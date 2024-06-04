function confirmAction(event, message) {
    if (confirm(message)) {
    } else {
        event.preventDefault();
    }
}
