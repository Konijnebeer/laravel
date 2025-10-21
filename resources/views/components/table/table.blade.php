{{-- resources/views/components/table/table.blade.php --}}
@props(['columns', 'rows', 'actions' => []])

<div class="p-10">
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full">
                <div class="overflow-hidden border rounded-lg">
                    <table class="min-w-full divide-y divide-neutral-200">
                        <thead class="bg-neutral-50">
                        <tr class="text-neutral-500">
                            @foreach($columns as $label => $field)
                                <th class="px-5 py-3 text-xs font-medium text-left uppercase">{{ $label }}</th>
                            @endforeach
                            @if($actions)
                                <th class="px-5 py-3 text-xs font-medium text-right uppercase">Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-200">
                        @foreach($rows as $row)
                            <tr class="text-neutral-800">
                                @foreach($columns as $label => $field)
                                    <td class="px-5 py-4 text-sm whitespace-nowrap">
                                        {{ data_get($row, $field) }}
                                    </td>
                                @endforeach
                                @if($actions)
                                    <td class="px-5 py-4 text-sm font-medium text-right whitespace-nowrap">
                                        @foreach($actions as $action => $enabled)
                                            @if($enabled)
                                                <x-table.action-button :action="$action" :row="$row"/>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
