<x-card>
    <x-slot:header>
        <flux:heading size="xl">
            通知
        </flux:heading>
    </x-slot:header>

    <ul class="list-none">
        @foreach($notifications as $notification)
            <li class="py-3 border-b border-zinc-200">
                <time>{{ $notification->created_at }}</time>

                @switch(class_basename($notification->type))
                    @case('DeleteNotification')
                        <a href="{{ data_get($notification->data, 'url') }}" target="_blank"
                           class="font-bold text-indigo-500 hover:text-indigo-700 hover:underline break-all">
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
</x-card>
