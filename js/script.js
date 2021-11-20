$(document).ready(function() {
    $('#txttelefone').mask('(00) 0000-00009');
});

$(document).ready(function(){
	$('a[data-confirm]').click(function(ev){
		var href = $(this).attr('href');
		if(!$('#confirm-delete').length){
			$('body').append('<div class="modal fade" id="confirm-delete" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Excluir</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"><p>Tem certeza de que deseja excluir?</p></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button><a class="btn btn-primary text-white" id="dataComfirmOK">Excluir</a></div></div></div></div>');
		}
		$('#dataComfirmOK').attr('href', href);
		$('#confirm-delete').modal({show: true});
		return false;
		
	});
});
