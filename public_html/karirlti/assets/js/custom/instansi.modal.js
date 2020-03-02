(function($) {
    $(document).ready(function(e) {
        /*
            Modal Controller for Creating
         */
        $("#da-instansi-create-form-div").dialog({
            autoOpen: false,
            title: "Tambah Instansi Pendidikan",
            modal: true,
            width: "640",
            buttons: [{
                text: "Simpan",
                click: function() {
                    $(this).find('form#da-instansi-create-form-val').submit();
                }},
                {
                text: "Keluar",
                click: function() {
                    $("#da-instansi-create-form-div").dialog("option", {modal: true}).dialog("close");
                }}]
        }).find('form').validate({
            rules: {
                nama: {
                    required: true
                },
				singkatan: {
                    required: true
                }
            },
            invalidHandler: function(form, validator) {
                var errors = validator.numberOfInvalids();
                if (errors) {
                    var message = 'Atribut yang diberi tanda wajib diisi.';
                    $("#da-instansi-create-validate-error").html(message).show();
                } else {
                    $("#da-instansi-create-validate-error").hide();
                }
            }
        });

        $("#da-instansi-create-dialog").bind("click", function(event) {
            event.preventDefault();
            $("#da-instansi-create-form-div").dialog("option", {modal: true}).dialog("open");
            $("#instansi-create-start-date").datepicker({showOtherMonths:true, dateFormat: 'dd-mm-yy'});

            $.get( "/instansi/get_all_project_customer_names", function(data) {
                $( "#instansi-create-customer" ).autocomplete({
                    source: data
                });
            }, "json" );
        });

        $("#da-instansi-create-dialog").bind("click", function(event) {
            event.preventDefault();
            $("#da-instansi-create-form-div").dialog("option", {modal: true}).dialog("open");
            $("#instansi-create-start-date").datepicker({showOtherMonths:true, dateFormat: 'dd-mm-yy'});

            // $.get( "/instansi/get_all_project_company_names", function(data) {
                // $( "#instansi-create-company" ).autocomplete({
                    // source: data
                // });
            // }, "json" );
        });

        /*
            Modal Controller for Editing
         */
        $("#da-instansi-edit-form-div").dialog({
            autoOpen: false,
            title: "Ubah instansi",
            modal: true,
            width: "640",
            buttons: [{
                text: "Simpan",
                click: function() {
                    $(this).find('form#da-instansi-edit-form-val').submit();
                }},
                {
                text: "Keluar",
                click: function() {
                    $("#da-instansi-edit-form-div").dialog("option", {modal: true}).dialog("close");
                }}]
        }).find('form').validate({
            rules: {
                nama: {
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
                    $("#da-instansi-edit-validate-error").html(message).show();
                } else {
                    $("#da-instansi-edit-validate-error").hide();
                }
            }
        });

        $(".da-instansi-edit-dialog").bind("click", function(event) {
            event.preventDefault();
            $("#da-instansi-edit-form-div").dialog("option", {modal: true}).dialog("open");
            //$("#instansi-edit-start-date").datepicker({showOtherMonths:true, dateFormat: 'dd-mm-yy'});

            var id = $(this).data("value");
            $.get( "/SetupInstansi/get_instansi_by_id/" + id, function(data) {
                $("#instansi-edit-id").val(id);
                $("#instansi-edit-nama").val(data.nama);
                $("#instansi-edit-singkatan").val(data.singkatan);
                
            }, "json" );
        });

    });
}) (jQuery);