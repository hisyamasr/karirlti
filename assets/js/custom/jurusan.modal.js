(function($) {
    $(document).ready(function(e) {
        /*
            Modal Controller for Creating
         */
        $("#da-jurusan-create-form-div").dialog({
            autoOpen: false,
            title: "Tambah Jurusan",
            modal: true,
            width: "640",
            buttons: [{
                text: "Simpan",
                click: function() {
                    $(this).find('form#da-jurusan-create-form-val').submit();
                }},
                {
                text: "Keluar",
                click: function() {
                    $("#da-jurusan-create-form-div").dialog("option", {modal: true}).dialog("close");
                }}]
        }).find('form').validate({
            rules: {
                nama: {
                    required: true
                },
				kode_jurusan: {
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
                    $("#da-jurusan-create-validate-error").html(message).show();
                } else {
                    $("#da-jurusan-create-validate-error").hide();
                }
            }
        });

        $("#da-jurusan-create-dialog").bind("click", function(event) {
            event.preventDefault();
            $("#da-jurusan-create-form-div").dialog("option", {modal: true}).dialog("open");
            $("#jurusan-create-start-date").datepicker({showOtherMonths:true, dateFormat: 'dd-mm-yy'});

            $.get( "/jurusan/get_all_project_customer_names", function(data) {
                $( "#jurusan-create-customer" ).autocomplete({
                    source: data
                });
            }, "json" );
        });

        $("#da-jurusan-create-dialog").bind("click", function(event) {
            event.preventDefault();
            $("#da-jurusan-create-form-div").dialog("option", {modal: true}).dialog("open");
            $("#jurusan-create-start-date").datepicker({showOtherMonths:true, dateFormat: 'dd-mm-yy'});

            // $.get( "/jurusan/get_all_project_company_names", function(data) {
                // $( "#jurusan-create-company" ).autocomplete({
                    // source: data
                // });
            // }, "json" );
        });

        /*
            Modal Controller for Editing
         */
        $("#da-jurusan-edit-form-div").dialog({
            autoOpen: false,
            title: "Ubah jurusan",
            modal: true,
            width: "640",
            buttons: [{
                text: "Simpan",
                click: function() {
                    $(this).find('form#da-jurusan-edit-form-val').submit();
                }},
                {
                text: "Keluar",
                click: function() {
                    $("#da-jurusan-edit-form-div").dialog("option", {modal: true}).dialog("close");
                }}]
        }).find('form').validate({
            rules: {
                nama: {
                    required: true
                },
				kode_jurusan: {
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
                    $("#da-jurusan-edit-validate-error").html(message).show();
                } else {
                    $("#da-jurusan-edit-validate-error").hide();
                }
            }
        });

        $(".da-jurusan-edit-dialog").bind("click", function(event) {
            event.preventDefault();
            $("#da-jurusan-edit-form-div").dialog("option", {modal: true}).dialog("open");
            //$("#jurusan-edit-start-date").datepicker({showOtherMonths:true, dateFormat: 'dd-mm-yy'});

            var id = $(this).data("value");
            $.get( "/Setupjurusan/get_jurusan_by_id/" + id, function(data) {
                $("#jurusan-edit-id").val(id);
                $("#jurusan-edit-nama").val(data.nama);
                $("#jurusan-edit-status").val(data.status);
                $("#jurusan-edit-kodejurusan").val(data.kode_jurusan);
                
            }, "json" );
        });

    });
}) (jQuery);