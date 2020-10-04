<div class="card bg-primary">
    <div class="card-header text-white">
        通知
    </div>
    <ul class="list-group list-group-flush">
        @foreach($notifications as $notification)
            <li class="list-group-item">
                <time>{{ $notification->created_at }}</time>

                @switch(class_basename($notification->type))
                    @case('DeleteNotification')
                    <a href="{{ data_get($notification->data, 'url') }}" target="_blank"
                       rel="noreferrer noopener">
                        {{ data_get($notification->data, 'title') }}
                    </a>
                    を削除。
                    @break
                    @default
                    ...
                    @break
                @endswitch
            </li>
        @endforeach
    </ul>
</div>
