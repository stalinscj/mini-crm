<?php

namespace App\Support;

class Helper
{
    /**
    * Returns a Link tag for import datatables.css
    *
    * @return string
    */
    public static function dataTablesCSS() {
        return '<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">';
    }

    /**
     * Returns a Script tag for import datatables.js
     *
     * @return string
     */
    public static function dataTablesJS() {
        return '<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
                <script src="//cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>';
    }
    
    /**
     * Returns a JS code for Sweet Alert Confirm
     *
     * @param  string  $selector
     * @param  string  $msg
     * @param  string  $formSelector
     * 
     * @return string
     */
    public static function swalConfirm($selector, $msg=null, $formSelector='') {

        $msg = $msg ?: 'Este registro será suspendido en caso de estar en uso y eliminado en caso contrario';

        return <<<HTML
            <script>
                $(document).on('click', '$selector', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: '$msg',
                        icon: 'warning',
                        confirmButtonText: 'Sí!',
                        cancelButtonText: 'Cancelar',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                    })
                    .then ((result) => {
                        if (result.value) {
                            form = "$formSelector"
                                ? $('$formSelector')
                                : $('#'+$(this).attr('form-target'));

                            if (this.name) {
                                form.append(`<input name='\${this.name}' value='\${this.value}'>`)
                            }

                            form.submit();
                        }
                    })
                });
            </script>
HTML;
    }

    /**
     * Returns a JS code for init DataTables
     *
     * @param  string  $selector
     * @param  JSON  $options
     * 
     * @return string
     */
    public static function dataTables($selector, $options='{}') {
        return <<<HTML
            <script>
                $(document).ready(function() {
                    $("$selector").DataTable({
                        ...{
                            language: {
                                url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                            },
                        },
                        ...$options
                    });
                } );
            </script>
HTML;
    }
}
