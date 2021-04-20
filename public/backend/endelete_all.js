$(document).ready(function () {
    $('.deletee_all').on('click', function(e) {
        var allVals = [];
        $(".sub_chk:checked").each(function() {
            allVals.push($(this).attr('data-id'));
        });
        if(allVals.length <=0)
        {
            Swal.fire({
                icon: 'error',
                type: 'error',
                title: 'Please Select Row...',
                showConfirmButton: false,
                timer: 1500
            })
        }  else {
            var check = confirm("Are You sure ?!");
            if(check == true){
                var join_selected_values = allVals.join(",");
                $.ajax({
                    url: $(this).data('url'),
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: 'ids='+join_selected_values,
                    success: function (data) {
                        if (data['success']) {
                            $(".sub_chk:checked").each(function() {
                                $(this).parents("tr").remove();
                            });
                            Swal.fire({
                                icon: 'success',
                                type: 'success',
                                title: data['success'],
                                showConfirmButton: false,
                                timer: 2000
                            })
                        } else if (data['error']) {
                            Swal.fire({
                                icon: 'error',
                                type: 'error',
                                title: data['error'],
                                showConfirmButton: false,
                                timer: 2000
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                type: 'error',
                                title: data['error'],
                                showConfirmButton: false,
                                timer: 2000
                            })
                        }
                    },
                    error: function (data) {
                        Swal.fire({
                            icon: 'error',
                            type: 'error',
                            title: data['error'],
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                });
                $.each(allVals, function( index, value ) {
                    $('table tr').filter("[data-row-id='" + value + "']").remove();
                });
            }
        }
    });
});