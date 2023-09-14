/**
* Creator: I. Kennedy Yinusa
* Email: iyinusa@yahoo.co.uk
* Website: http://iyinusa.kenafftech.com
* Module/App: Js Form
*/
//////////===== Dynamic Modal Pop-up ===/////////
$(".pops").click(function () {
	$(".modal").on('hidden.bs.modal', function () {
		$(this).data('bs.modal', null);
		$('.selects22').select2();
	});	
	$('#customSelect').select2();
	var pageTitle = $(this).attr('pageTitle');
	var pageName = $(this).attr('pageName');
	var pageSize = $(this).attr('pageSize');

	$(".modal-dialog").addClass(pageSize);
	$(".modal-center .modal-title").html(pageTitle);
	$(".modal-center .modal-body").html('<div class="col-sm-12 text-center"><i class="fa fa-spinner fa-spin" style="font-size:24px;"></i> Processing Request.. Please Wait..</div>');
	$(".modal-center .modal-body").load(pageName);
	$(".modal-center").modal("show");
});

$(".pop").click(function () {
	$(".modal").on('hidden.bs.modal', function () {
		$(this).data('bs.modal', null);
		$('.selects22').select2();
	});	
	$('#customSelect').select2();
	var pageTitle = $(this).attr('pageTitle');
	var pageName = $(this).attr('pageName');
	var pageSize = $(this).attr('pageSize');

	$(".modal-dialog").addClass(pageSize);
	$(".modal-center .modal-title").html(pageTitle);
	$(".modal-center .modal-body").html('<div class="col-sm-12 text-center"><i class="fa fa-spinner fa-spin" style="font-size:24px;"></i> Processing Request.. Please Wait..</div>');
	$(".modal-center .modal-body").load(pageName);
	$(".modal-center").modal("show");
});

$(".pop-right").click(function () {
	$(".modal").on('hidden.bs.modal', function () {
		$(this).data('bs.modal', null);
		$('.selects22').select2();
	});

	var pageTitle = $(this).attr('pageTitle');
	var pageName = $(this).attr('pageName');
	var pageSize = $(this).attr('pageSize');

	$(".modal-dialog").addClass(pageSize);
	$(".modal-right .modal-title").html(pageTitle);
	$(".modal-right .modal-body").html('<div class="col-sm-12 text-center"><i class="fa fa-spinner fa-spin" style="font-size:24px;"></i> Processing Request.. Please Wait..</div>');
	$(".modal-right .modal-body").load(pageName);
	$(".modal-right").modal("show");
});

$(".pop-left").click(function () {
	$(".modal").on('hidden.bs.modal', function () {
		$(this).data('bs.modal', null);
		 $('.selects22').select2();
	});

	var pageTitle = $(this).attr('pageTitle');
	var pageName = $(this).attr('pageName');
	var pageSize = $(this).attr('pageSize');

	$(".modal-dialog").addClass(pageSize);
	$(".modal-left .modal-title").html(pageTitle);
	$(".modal-left .modal-body").html('<div class="col-sm-12 text-center"><i class="fa fa-spinner fa-spin" style="font-size:24px;"></i> Processing Request.. Please Wait..</div>');
	$(".modal-left .modal-body").load(pageName);
	$(".modal-left").modal("show");
});