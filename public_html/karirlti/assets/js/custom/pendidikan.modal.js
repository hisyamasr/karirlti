(function($) {
    $(document).ready(function(e) {
        /*
            Modal Controller for Creating
         */
        $("#da-pendidikan-create-form-div").dialog({
            autoOpen: false,
            title: "Tambah pendidikan",
            modal: true,
            width: "640",
            buttons: [{
                text: "Simpan",
                click: function() {
                    $(this).find('form#da-pendidikan-create-form-val').submit();
                }},
                {
                text: "Keluar",
                click: function() {
                    $("#da-pendidikan-create-form-div").dialog("option", {modal: true}).dialog("close");
                }}]
        }).find('form').validate({
            rules: {
                nama: {
                    required: true
                },
				jenjang: {
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
                    $("#da-pendidikan-create-validate-error").html(message).show();
                } else {
                    $("#da-pendidikan-create-validate-error").hide();
                }
            }
        });

        $("#da-pendidikan-create-dialog").bind("click", function(event) {
            event.preventDefault();
            $("#da-pendidikan-create-form-div").dialog("option", {modal: true}).dialog("open");
            $("#pendidikan-create-start-date").datepicker({showOtherMonths:true, dateFormat: 'dd-mm-yy'});

            // $.get( "/pendidikan/get_all_project_company_names", function(data) {
                // $( "#pendidikan-create-company" ).autocomplete({
                    // source: data
                // });
            // }, "json" );
        });

        /*
            Modal Controller for Editing
         */
        $("#da-pendidikan-edit-form-div").dialog({
            autoOpen: false,
            title: "Ubah pendidikan",
            modal: true,
            width: "640",
            buttons: [{
                text: "Simpan",
                click: function() {
                    $(this).find('form#da-pendidikan-edit-form-val').submit();
                }},
                {
                text: "Keluar",
                click: function() {
                    $("#da-pendidikan-edit-form-div").dialog("option", {modal: true}).dialog("close");
                }}]
        }).find('form').validate({
            rules: {
                nama: {
                    required: true
                },
				jenjang: {
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
                    $("#da-pendidikan-edit-validate-error").html(message).show();
                } else {
                    $("#da-pendidikan-edit-validate-error").hide();
                }
            }
        });

        $(".da-pendidikan-edit-dialog").bind("click", function(event) {
            event.preventDefault();
            $("#da-pendidikan-edit-form-div").dialog("option", {modal: true}).dialog("open");
            //$("#pendidikan-edit-start-date").datepicker({showOtherMonths:true, dateFormat: 'dd-mm-yy'});

            var id = $(this).data("value");
            $.get( "/Setuppendidikan/get_pendidikan_by_id/" + id, function(data) {
                $("#pendidikan-edit-id").val(id);
                $("#pendidikan-edit-nama").val(data.nama);
                $("#pendidikan-edit-status").val(data.isActive);
                $("#pendidikan-edit-jenjang").val(data.jenjang);
                
            }, "json" );
        });

    });
}) (jQuery);