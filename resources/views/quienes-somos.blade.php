@extends('layouts.app')

@section('title', 'Quiénes Somos')

@section('content')
<div class="max-w-6xl mx-auto px-6">
    <h1 class="text-3xl font-bold text-indigo-700 mb-6 text-center">Quiénes Somos</h1>

    <div class="grid md:grid-cols-2 gap-8 items-center">
        <img src="https://cdn-icons-png.flaticon.com/512/3176/3176366.png" alt="Empresa" class="rounded-2xl shadow-lg">

        <div>
            <p class="text-lg leading-relaxed mb-4">
                Somos una empresa dedicada a ofrecer soluciones en compras institucionales, conectando proveedores confiables con organizaciones que buscan calidad, cumplimiento y eficiencia.
            </p>
            <p class="text-lg leading-relaxed">
                Nuestro objetivo es facilitar los procesos de adquisición con tecnología moderna y un servicio al cliente excepcional.
            </p>
        </div>
    </div>
</div>
@endsection
