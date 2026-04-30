<x-layouts.app :title="'Edit Data — ' . $entity->name">
    <div class="max-w-3xl mx-auto fade-in">
        <div class="page-header">
            <div>
                <h1 class="page-title">Edit Data</h1>
                <p class="page-subtitle">{{ $entity->name }} — Record #{{ $record->id }}</p>
            </div>
            <a href="{{ route('entities.show', $entity) }}" class="btn-secondary">← Kembali</a>
        </div>

        <form method="POST" action="{{ route('records.update', [$entity, $record]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card p-6 mb-6">
                {{-- Program Studi --}}
                <div class="mb-6 pb-6 border-b border-gray-100">
                    <label class="form-label" for="program_studi_id">Program Studi</label>
                    <select name="program_studi_id" id="program_studi_id" class="form-select">
                        <option value="">— Umum (Semua Prodi) —</option>
                        @foreach($programStudiList as $prodi)
                        <option value="{{ $prodi->id }}" {{ old('program_studi_id', $record->program_studi_id) == $prodi->id ? 'selected' : '' }}>
                            {{ $prodi->name }} ({{ $prodi->code }})
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Dynamic Fields with current values --}}
                <div class="space-y-5">
                    @foreach($entity->fields as $field)
                    @php $currentValue = $record->getFieldValue($field->slug); @endphp
                    <div>
                        <label class="form-label" for="field_{{ $field->slug }}">
                            {{ $field->name }}
                            @if($field->is_required) <span class="text-red-500">*</span> @endif
                        </label>

                        @switch($field->type)
                            @case('text')
                            @case('email')
                            @case('phone')
                            @case('url')
                                <input type="{{ $field->getInputType() }}"
                                       name="field_{{ $field->slug }}"
                                       id="field_{{ $field->slug }}"
                                       value="{{ old('field_' . $field->slug, $currentValue) }}"
                                       class="form-input"
                                       {{ $field->is_required ? 'required' : '' }}>
                                @break

                            @case('textarea')
                                <textarea name="field_{{ $field->slug }}"
                                          id="field_{{ $field->slug }}"
                                          rows="3" class="form-input"
                                          {{ $field->is_required ? 'required' : '' }}>{{ old('field_' . $field->slug, $currentValue) }}</textarea>
                                @break

                            @case('number')
                                <input type="number"
                                       name="field_{{ $field->slug }}"
                                       id="field_{{ $field->slug }}"
                                       value="{{ old('field_' . $field->slug, $currentValue) }}"
                                       class="form-input"
                                       @if(isset($field->options['min'])) min="{{ $field->options['min'] }}" @endif
                                       @if(isset($field->options['max'])) max="{{ $field->options['max'] }}" @endif
                                       {{ $field->is_required ? 'required' : '' }}>
                                @break

                            @case('date')
                                <input type="date"
                                       name="field_{{ $field->slug }}"
                                       id="field_{{ $field->slug }}"
                                       value="{{ old('field_' . $field->slug, $currentValue) }}"
                                       class="form-input"
                                       {{ $field->is_required ? 'required' : '' }}>
                                @break

                            @case('select')
                                <select name="field_{{ $field->slug }}" id="field_{{ $field->slug }}" class="form-select" {{ $field->is_required ? 'required' : '' }}>
                                    <option value="">— Pilih —</option>
                                    @foreach($field->options['choices'] ?? [] as $choice)
                                    <option value="{{ $choice }}" {{ old('field_' . $field->slug, $currentValue) == $choice ? 'selected' : '' }}>{{ $choice }}</option>
                                    @endforeach
                                </select>
                                @break

                            @case('file')
                                @php $existingFile = $record->fileUploads->where('field_id', $field->id)->first(); @endphp
                                @if($existingFile)
                                <div class="flex items-center gap-3 mb-2 bg-gray-50 rounded-lg px-3 py-2">
                                    <span class="text-sm text-gray-600">📎 {{ $existingFile->original_name }}</span>
                                    <span class="text-xs text-gray-400">({{ $existingFile->formatted_size }})</span>
                                </div>
                                @endif
                                <input type="file" name="field_{{ $field->slug }}" id="field_{{ $field->slug }}"
                                       class="form-input text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-primary-100 file:text-primary-700 file:font-medium hover:file:bg-primary-200">
                                <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengganti file</p>
                                @break
                        @endswitch

                        @error('field_' . $field->slug)
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('entities.show', $entity) }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</x-layouts.app>
