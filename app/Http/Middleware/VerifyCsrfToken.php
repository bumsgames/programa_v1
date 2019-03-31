<?php

namespace Bumsgames\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        "/ver_mas",
        "/agregaCarro",
        "/borrarElementoCarrito",
        "/filtrar_articulos",
        "/articulos_oferta",
        "/articulos/*",
        "/buscar_articulo_bums",
        "/categoria_general",
        "/articulos_web",
        "/articulos",
        "/lista_escrita"
    ];
}
