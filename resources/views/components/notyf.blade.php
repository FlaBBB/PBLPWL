<script>
    const notyf = new Notyf({
        duration: 5000,
        position: {
            x: 'right',
            y: 'top',
        },
        types: [
            {
                type: 'success',
                background: '#28a745',
                icon: {
                    className: 'notyf__icon--success',
                    tagName: 'i',
                    color: '#fff'
                }
            },
            {
                type: 'error',
                background: '#dc3545',
                icon: {
                    className: 'notyf__icon--error',
                    tagName: 'i',
                    color: '#fff'
                }
            },
            {
                type: 'info',
                background: '#17a2b8',
                icon: {
                    className: 'notyf__icon--info',
                    tagName: 'i',
                    color: '#fff'
                }
            },
            {
                type: 'warning',
                background: '#ffc107',
                icon: {
                    className: 'notyf__icon--warning',
                    tagName: 'i',
                    color: '#fff'
                }
            }
        ]
    });
    document.addEventListener('DOMContentLoaded', function() {
        @if(Session::has('notyf.notifications'))
            @php
                $notifications = Session::get('notyf.notifications');
            @endphp

            @foreach($notifications as $notification)
                const currentNotification = notyf.open({
                    type: '{{ $notification['type'] }}',
                    message: '{{ $notification['message'] }}',
                    @if(!empty($notification['options']))
                        ...@json($notification['options'])
                    @endif
                });
                currentNotification.on('click', ({ target, event }) => {
                    notyf.dismiss(currentNotification);
                });
            @endforeach
        @endif
    });
</script>