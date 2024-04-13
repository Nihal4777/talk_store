<x-admin-layout>
    <div style="height: 100%;width: 100%;display: flex; justify-content: center; align-items: center;">
        <div style="font-size: 30px; font-weight: bold">
            Waiting for User...
        </div>
    </div>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('1c736033547afaeacd02', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('presence-waiting-chat-{{ $user->id }}');
        channel.bind('connected', function(data) {
            window.location.href = '';
        });
    </script>
</x-admin-layout>
