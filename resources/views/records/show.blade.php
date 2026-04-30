<x-layouts.app :title="'Detail Data — ' . $entity->name">
    <div class="max-w-3xl mx-auto fade-in">
        <div class="page-header">
            <div>
                <h1 class="page-title">Detail Data</h1>
                <p class="page-subtitle">{{ $entity->name }} — Record #{{ $record->id }}</p>
            </div>
            <div class="flex items-center gap-2">
                @can('records.edit')
                <a href="{{ route('records.edit', [$entity, $record]) }}" class="btn-secondary">Edit</a>
                @endcan
                <a href="{{ route('entities.show', $entity) }}" class="btn-secondary">← Kembali</a>
            </div>
        </div>

        <div class="card p-6">
            {{-- Metadata --}}
            <div class="flex flex-wrap gap-4 mb-6 pb-6 border-b border-gray-100 text-sm">
                <div>
                    <span class="text-gray-400">Dibuat oleh:</span>
                    <span class="font-medium text-gray-700">{{ $record->creator->name ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-gray-400">Tanggal:</span>
                    <span class="font-medium text-gray-700">{{ $record->created_at->translatedFormat('d F Y, H:i') }}</span>
                </div>
                @if($record->programStudi)
                <div>
                    <span class="text-gray-400">Program Studi:</span>
                    <span class="badge-info">{{ $record->programStudi->name }}</span>
                </div>
                @endif
            </div>

            {{-- Field Values --}}
            <div class="space-y-4">
                @foreach($entity->fields as $field)
                @php $val = $record->getFieldValue($field->slug); @endphp
                <div class="grid grid-cols-3 gap-4 py-3 {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                    <div class="text-sm font-medium text-gray-500">{{ $field->name }}</div>
                    <div class="col-span-2">
                        @if($field->type === 'file')
                            @php $fileUpload = $record->fileUploads->where('field_id', $field->id)->first(); @endphp
                            @if($fileUpload)
                            <a href="{{ Storage::url($fileUpload->stored_path) }}" target="_blank"
                               class="inline-flex items-center gap-2 px-3 py-1.5 bg-primary-50 text-primary-700 rounded-lg text-sm hover:bg-primary-100 transition-colors">
                                📎 {{ $fileUpload->original_name }}
                                <span class="text-xs text-primary-400">({{ $fileUpload->formatted_size }})</span>
                            </a>
                            @else
                            <span class="text-gray-300 text-sm">Tidak ada file</span>
                            @endif
                        @elseif($val)
                            <span class="text-sm text-gray-900">{{ $val }}</span>
                        @else
                            <span class="text-gray-300 text-sm">—</span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.app>
