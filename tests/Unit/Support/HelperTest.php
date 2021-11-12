<?php

namespace Tests\Unit\Support;

use Tests\TestCase;
use App\Support\Helper;
use Illuminate\Foundation\Testing\WithFaker;

class HelperTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function must_return_link_tag_to_load_datatables_css()
    {
        $tag = Helper::dataTablesCSS();

        $this->assertEquals(
            '<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">',
            $tag
        );
    }

    /**
     * @test
     */
    public function must_return_script_tags_to_load_datatables_js()
    {
        $tags = Helper::dataTablesJS();

        $this->assertEquals(
            '<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
                <script src="//cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>',
            $tags
        );
    }

    /**
     * @test
     */
    public function must_return_a_js_code_with_sweetalert_confirm()
    {
        $selector     = $this->faker->domainName;
        $msg          = $this->faker->sentence;
        $formSelector = $this->faker->domainName;

        $swalConfirm = Helper::swalConfirm($selector, $msg, $formSelector);

        $this->assertEquals(
            "            <script>
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
                            form = \"$formSelector\"
                                ? $('$formSelector')
                                : $('#'+$(this).attr('form-target'));

                            if (this.name) {
                                form.append(`<input name='\${this.name}' value='\${this.value}'>`)
                            }

                            form.submit();
                        }
                    })
                });
            </script>",
            $swalConfirm
        );
    }

    /**
     * @test
     */
    public function must_return_a_js_code_for_init_datatables()
    {
        $selector = $this->faker->domainName;
        $options = "{key: value}";

        $datatables = Helper::dataTables($selector, $options);

        $this->assertEquals(
            "            <script>
                $(document).ready(function() {
                    $(\"$selector\").DataTable({
                        ...{
                            language: {
                                url: \"//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json\"
                            },
                        },
                        ...$options
                    });
                } );
            </script>",
            $datatables
        );
    }
}
