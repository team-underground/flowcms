<div class="mb-5 overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">          
    <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
        <thead>
            <tr class="text-left">
                @foreach($headings as $heading)
                <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-gray-600 font-bold tracking-wider uppercase text-xs">
                    {{ $heading }}
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
                <tr 
                    x-data="{ 
                        showConfirm: false, 
                        deleteitem(url) {
                            return fetch(url, {
                                method: 'POST',
                                body: JSON.stringify({
                                    '_method': 'DELETE'
                                }),
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => response.json());
                        }
                    }" 
                    x-cloak
                    class="{{ $tableStriped && ($index % 2 != 0) ? 'bg-gray-100' : ''}}"
                >
                    @foreach($values as $value)
                        <td x-show="!showConfirm" class="border-t border-gray-200">

                            @php $valueItem = explode('.', $value['key']); @endphp

                            @if($value['type'] === 'data')
                                <span class="text-gray-700 px-6 py-3 block items-center truncate {{ $value['width'] ?? '' }}">
                                    @if(count($valueItem) == 1)
                                        @if(isset($value['theme']) && $value['theme']['type'] === 'badge')
                                            <span class="inline-flex font-bold uppercase text-sm tracking-wide px-2 rounded-full {{ $value['theme']['colors'][$item->{$valueItem[0]}] }}">
                                                {{ $item->{$valueItem[0]} }}
                                            </span>
                                        @else
                                            {{ $item->{$valueItem[0]} }}
                                        @endif
                                    @endif

                                    @if(count($valueItem) == 2)
                                        @if(isset($value['theme']) && $value['theme']['type'] === 'badge')
                                            <span class="inline-flex font-bold uppercase text-sm tracking-wide px-2 rounded-full {{ $value['theme']['colors'][$item->{$valueItem[0]}->{$valueItem[1]}] }}">
                                                {{ $item->{$valueItem[0]}->{$valueItem[1]} }}
                                            </span>
                                        @else
                                            {{ $item->{$valueItem[0]}->{$valueItem[1]} }}
                                        @endif     
                                    @endif

                                    @if(count($valueItem) == 3)
                                        {{ $item->{$valueItem[0]}->{$valueItem[1]}->{$valueItem[2]} }}  
                                    @endif
                                </span>
                            @endif

                            @if($value['type'] === 'date')
                                <span class="text-gray-700 px-6 py-3 flex items-center">
                                    @if(count($valueItem) == 1)
                                        @if(isset($value['format']))
                                            {{ $item->{$valueItem[0]}->format($value['format']) }}
                                        @else
                                            {{ $item->{$valueItem[0]}->format('j M, Y') }}
                                        @endif
                                    @endif

                                    @if(count($valueItem) == 2)
                                        @if(isset($value['format']))
                                            {{ $item->{$valueItem[0]}->{$valueItem[1]}->format($value['format']) }}
                                        @else
                                            {{ $item->{$valueItem[0]}->{$valueItem[1]}->format('j M, Y') }}    
                                        @endif 
                                    @endif

                                    @if(count($valueItem) == 3)
                                        @if(isset($value['format']))
                                            {{ $item->{$valueItem[0]}->{$valueItem[1]}->{$valueItem[2]}->format($value['format']) }}
                                        @else
                                            {{ $item->{$valueItem[0]}->{$valueItem[1]}->{$valueItem[2]}->format('j M, Y') }}
                                        @endif     
                                    @endif
                                </span>
                            @endif

                            @php $actions = collect($value['type']); @endphp

                            @if($actions->contains('edit') || $actions->contains('delete'))
                                <div class="text-gray-700 px-6 py-3 flex items-center justify-center">
                                    @if($actions->contains('edit'))
                                        @if (! empty($editRoute) && !empty($editId))
                                            <a class="transition duration-500 ease-in-out underline underline-indigo-200 text-indigo-500 mr-2" href="{{ route($editRoute, $item[$editId]) }}">Edit</a>
                                        @else
                                            <span class="text-xs">Edit route & id not provided</span>
                                        @endif
                                    @endif
                                    @if($actions->contains('delete'))
                                        @if (! empty($deleteRoute) && !empty($deleteId))
                                            <a class="transition duration-300 ease-in-out underline underline-red-200 text-red-500" href="#" x-on:click.prevent="showConfirm = true">Delete</a>
                                        @else
                                            <span class="text-xs">Delete route & id not provided</span>
                                        @endif     
                                    @endif
                                </div>
                            @endif
                        </td>
                    @endforeach

                    <td x-show="showConfirm" class="border-t border-gray-200" :colspan="showConfirm === true ? '{{ count($values) }}' : 1">

                        <div class="bg-gray-100 flex-1 px-6 py-2">
                            <div class="flex items-center justify-between">
                                <div class="ml-auto">
                                    <h3 class="font-semibold text-gray-700 pr-4">Are you sure?</h3>
                                </div>
                                <div class="flex items-center pt-1">
                                    <span class="shadow-xs mr-2 rounded-lg">
                                        <button type="button" x-on:click="showConfirm = false" class="px-2 py-1 rounded-lg bg-white text-gray-600">Cancel</button>
                                    </span>

                                    <button 
                                        x-ref="deleteButton"
                                        x-on:click="$refs.deleteButton.classList.add('base-spinner', 'cursor-not-allowed'); deleteitem('{{ route($deleteRoute, $item[$deleteId] ?? '') }}').then(() => $dispatch('reload')); $dispatch('notice', { type: 'success', text: 'item Deleted'})"
                                        type="button" 
                                        class="px-2 py-1 rounded-lg bg-red-500 text-white shadow-sm">Delete</button>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div>
    {{ $data->onEachSide(2)->links('flowcms::partials.tailwindPaginationAlpinejs') }}   
</div>