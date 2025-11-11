@extends('layouts.app')

@section('title', 'Por Qué Elegirnos')

@section('content')
<div class="max-w-6xl mx-auto px-6 text-center">
    <h1 class="text-3xl font-bold text-indigo-700 mb-10">¿Por Qué Elegirnos?</h1>

    <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-2 text-indigo-600">💼 Experiencia</h3>
            <p>Más de 10 años conectando empresas con los mejores proveedores institucionales.</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-2 text-indigo-600">⚙️ Tecnología</h3>
            <p>Usamos herramientas digitales modernas para optimizar los procesos de compra y entrega.</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
            <h3 class="text-xl font-semibold mb-2 text-indigo-600">🤝 Compromiso</h3>
            <p>Nos enfocamos en la satisfacción de nuestros clientes, garantizando cumplimiento y calidad.</p>
        </div>
    </div>
</div>
@endsection
