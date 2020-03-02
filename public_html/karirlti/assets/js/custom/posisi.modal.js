(function($) {
    $(document).ready(function(e) {
        /*
            Modal Controller for Creating
         */
        $("#da-posisi-create-form-div").dialog({
            autoOpen: false,
            title: "Tambah Posisi",
            modal: true,
            width: "640",
            buttons: [{
                text: "Simpan",
                click: function() {
                    $(this).find('form#da-posisi-create-form-val').submit();
                }},
                {
                text: "Keluar",
                click: function() {
                    $("#da-posisi-create-form-div").dialog("option", {modal: true}).dialog("close");
                }}]
        }).find('form').validate({
            rules: {
                nama: {
                    required: true
                },
				kode_posisi: {
                    required: true
                },
				status: {
                    required: true
                }
            },
            invalidHandler: function(form, validator) {
                var errors = validator.numberOfInvalids();
                if (errors) {
                    var message = 'Atribut yang diberi tanda wajib diisi.';
                    $("#da-posisi-create-validate-error").html(message).show();
                } else {
                    $("#da-posisi-create-validate-error").hide();
                }
            }
        });

        $("#da-posisi-create-dialog").bind("click", function(event) {
            event.preventDefault();
            $("#da-posisi-create-form-div").dialog("option", {modal: true}).dialog("open");
            $("#posisi-create-start-date").datepicker({showOtherMonths:true, dateFormat: 'dd-mm-yy'});

            // $.get( "/posisi/get_all_project_company_names", function(data) {
                // $( "#posisi-create-company" ).autocomplete({
                    // source: data
                // });
            // }, "json" );
        });

        /*
            Modal Controller for Editing
         */
        $("#da-posisi-edit-form-div").dialog({
            autoOpen: false,
            title: "Ubah Posisi",
            modal: true,
            width: "640",
            buttons: [{
                text: "Simpan",
                click: function() {
                    $(this).find('form#da-posisi-edit-form-val').submit();
                }},
                {
                text: "Keluar",
                click: function() {
                    $("#da-posisi-edit-form-div").dialog("option", {modal: true}).dialog("close");
                }}]
        }).find('form').validate({
            rules: {
                nama: {
                    required: true
                },
				kode_posisi: {
                    required: true
                },
				status: {
                    required: true
                }
            },
            invalidHandler: function(form, validator) {
                var errors = validator.numberOfInvalids();
                if (errors) {
                    var message = 'Atribut yang diberi tanda wajib diisi.';
                    $("#da-posisi-edit-validate-error").html(message).show();
                } else {
                    $("#da-posisi-edit-validate-error").hide();
                }
            }
        });

        $(".da-posisi-edit-dialog").bind("click", function(event) {
            event.preventDefault();
            $("#da-posisi-edit-form-div").dialog("option", {modal: true}).dialog("open");
            //$("#posisi-edit-start-date").datepicker({showOtherMonths:true, dateFormat: 'dd-mm-yy'});

            var id = $(this).data("value");
            $.get( "/SetupPosisi/get_posisi_by_id/" + id, function(data) {
                $("#posisi-edit-id").val(id);
                $("#posisi-edit-nama").val(data.nama);
                $("#posisi-edit-status").val(data.isActive);
                $("#posisi-edit-kodeposisi").val(data.kode_posisi);
                
            }, "json" );
        });

    });
}) (jQuery);