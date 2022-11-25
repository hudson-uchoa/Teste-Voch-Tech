<div class="row">
    @isset ($dados['pesquisa'])
        <div class="col-2 divTipoPesquisa mt-2">
            <label class="labelsBuscas" for="">Pesquisas por</label>
            <select class="form-control selectBuscas" name="{{ $dados['nome'] }}Pesquisa">
                @foreach ($dados['pesquisa'] as $value => $pesquisa)
                    <option value="{{ $value }}" data-placeholder="{{ $pesquisa['placeholder'] }}" {{ $loop->first ? 'selected' : '' }}>
                        {{ $pesquisa['texto'] }}
                    </option>
                @endforeach
            </select>
        </div>
    @endisset
    <div class="col-8 mt-2">
        <label class="labelsBuscas" for="{{ $dados['nome'] }}Select">{{ $dados['titulo'] }}</label>
        <select class="selectDoisMultiplos carregarSelect2" name="{{ $dados['nome'] }}{{ isset($dados['multiplo']) && $dados['multiplo'] == true ? '[]' : '' }}" data-placeholder="{{ $dados['placeholder'] }}" data-rota="{{ $dados['rota'] }}"
            @if (isset($dados['multiplo']) && $dados['multiplo'] == true)
                multiple="multiple" 
            @endif
            >
        </select>
    </div>
    @isset ($dados['atividade'])
        <div class="col-2 divAtividade mt-2">
            <label class="labelsBuscas" for="{{ $dados['nome'] }}Atividade">Atividade</label>
            <select class="selectDoisMultiplos carregarSelect2" data-placeholder="Pesquise por ativo ou inativo" name="{{ $dados['nome'] }}Atividade[]" multiple="multiple">
                @foreach ($dados['atividade'] as $value => $atividade)
                    <option value="{{ $value }}" {{ $value == ($dados['atividadePadrao'] ?? 1) ? 'selected' : '' }}>{{ $atividade }}</option>
                @endforeach
            </select>
        </div>
    @endisset
    @isset ($dados['tipo'])
        <div class="col-xl-2 col-sm-3 col-12 divAtividade mt-2">
            <label class="labelsBuscas" for="{{ $dados['nome'] }}Tipo">Tipo</label>
            <select class="selectDoisMultiplos carregarSelect2" data-placeholder="Pesquise por tipo" name="{{ $dados['nome'] }}Tipo[]" multiple="multiple">
                @foreach ($dados['tipo'] as $value => $tipo)
                    <option value="{{ $value }}" {{ $value == ($dados['tipoPadrao'] ?? 1) ? 'selected' : '' }}>{{ $tipo }}</option>
                @endforeach
            </select>
        </div>
    @endisset
</div>