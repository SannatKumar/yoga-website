@props(['steps'])
@if(!empty($steps))
    <div class="pose-steps my-5">
        <h3 class="text-2xl font-bold mb-4">Steps</h3>
        <ol class="space-y-6">
            @foreach($steps as $index => $step)
                <li class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-start gap-4">
                        @if(!empty($step['image']))
                            <img src="{{ $step['image'] }}" alt="{{ $step['name'] }}" class="w-16 h-16 object-cover rounded-md border flex-shrink-0 mr-3 float-left">
                        @endif
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded">Step {{ $index + 1 }}</span>
                                <span class="font-semibold text-lg">{{ $step['name'] }}</span>
                            </div>
                            <div class="text-gray-700">{{ $step['desc'] }}</div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ol>
    </div>
@endif 