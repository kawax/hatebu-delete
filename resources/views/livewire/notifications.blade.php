<flux:card>
    <flux:heading>
        通知
    </flux:heading>

    <ul class="list-none">
        @foreach($notifications as $notification)
            <li class="py-3 border-b border-gray-400">
                <time>{{ $notification->created_at }}</time>

                @switch(class_basename($notification->type))
                    @case('DeleteNotification')
                        <a href="{{ data_get($notification->data, 'url') }}" target="_blank"
                           class="font-bold text-indigo-500 hover:text-indigo-800 underline break-all">
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
</flux:card>
