<div class="grid grid-cols-3 gap-4 p-8 pt-32">
    @foreach ($info['rows']['previous']['cells'] as $position => $positionInformation)
        @if (empty($positionInformation['weather']))
            <div></div>
        @else
            <div class="grid grid-cols-{{ count($info['meta']['design'][0]) }} gap-1 @if ($position!='current') opacity-50 @else opacity-75 @endif">
                @foreach (end($info['meta']['design']) as $cellDesign)
                    @include('c2c-blanket::grid.cell', [
                                'cellDesign' => $cellDesign,
                                'positionInformation' => $positionInformation,
                                'colorInformation' => $info['meta']['colors'],
                            ])
                @endforeach
            </div>
        @endif
    @endforeach
            
    @foreach ($info['rows']['current']['cells'] as $position => $positionInformation)
        @if (empty($positionInformation['weather']))
            <div class="bg-stone-900 text-stone-600 p-4 flex flex-row min-h-96"><div class="grow self-center text-center"><i class="bi bi-slash-circle block text-3xl pb-2"></i>No data available for this date</div></div>
        @else
            <div class="grid grid-cols-{{ count($info['meta']['design'][0]) }} gap-1 @if ($position!='current') opacity-75 @else bg-stone-700 bg-opacity-50 outline outline-stone-700/50 outline-4 @endif">
                @foreach ($info['meta']['design'] as $rows)
                    @foreach ($rows as $cellDesign)
                        @include('c2c-blanket::grid.cell', [
                                    'cellDesign' => $cellDesign,
                                    'positionInformation' => $positionInformation,
                                    'colorInformation' => $info['meta']['colors'],
                                ])
                    @endforeach
                @endforeach
            </div>
        @endif
    @endforeach
            
    @include('c2c-blanket::grid.cell.metadata', [
                'meta' => $info['meta'],
                'date' => $info['rows']['current']['cells']['previous']['date'],
            ])
    @include('c2c-blanket::grid.cell.metadata', [
                'meta' => $info['meta'],
                'date' => $info['rows']['current']['cells']['current']['date'],
            ])
    @include('c2c-blanket::grid.cell.metadata', [
                'meta' => $info['meta'],
                'date' => $info['rows']['current']['cells']['next']['date'],
            ])
</div>

<script>
    document.onkeydown = checkKey;

    function checkKey(e) {
        e = e || window.event;
        if (e.keyCode == "38") {
            document.location.href="/?date={{ $info['rows']['previous']['date']->format('m/d/Y') }}";
        }
        else if (e.keyCode == "37") {
            document.location.href="/?date={{ $info['rows']['current']['cells']['previous']['date']->format('m/d/Y') }}";
        }
        @if ($info['rows']['current']['cells']['next']['show'])
            else if (e.keyCode == "39") {
                document.location.href="/?date={{ $info['rows']['current']['cells']['next']['date']->format('m/d/Y') }}";
            }
            else if (e.keyCode == "40") {
                document.location.href="/?date={{ $info['rows']['next']['date']->format('m/d/Y') }}";
            }
        @endif
    }
</script>