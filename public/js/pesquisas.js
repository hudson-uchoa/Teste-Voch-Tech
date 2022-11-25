function filtro() {
    $('.carregarSelect2').each((index, el) => {
        if ($(el).data('select2-id') !== undefined) {
            return;
        }
        var tema = 'classic';
        var width = '100%';
        if (!el.multiple) {
            tema = 'bootstrap4';
        }
        if (el.dataset.rota !== undefined) {
            $(el).select2({
                ajax: {
                    url: el.dataset.rota,
                    data: function (params) { 
                        page = params.page ?? 1;
                        pesquisa = params.term ?? '';                    
                        return $(el).parents('form').serialize() + '&page=' + page + '&pesquisa=' + pesquisa;
                    },
                },
                placeholder: $(el).data('placeholder') ?? '',
                allowClear: true,
                theme: tema,
                width: width,
            })
        } else {
            $(el).select2({
                minimumResultsForSearch: $(el).hasClass('semPesquisa') ? Infinity : 0,
                placeholder: $(el).data('placeholder') ?? '',
                allowClear: true,
                theme: tema,
                width: width,
            })
        }
    });
}

$(()=> {
    filtro();
})