@extends('layouts.app')

@section('content')
<section class="py-20 bg-blue-50 text-center">
  <h2 class="text-4xl font-bold text-blue-700 mb-8">Catálogo de Productos</h2>
  <p class="text-gray-600 max-w-3xl mx-auto mb-12">
    Encuentra todos nuestros productos institucionales disponibles.
  </p>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 px-6 max-w-6xl mx-auto">
    <!-- Aquí luego podrás cargar productos desde la base de datos -->
    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow hover:shadow-xl transition">
      <img src="https://via.placeholder.com/250x180" alt="Producto" class="mx-auto mb-4">
      <h3 class="text-blue-800 font-semibold mb-2">Uniforme Institucional</h3>
      <p class="text-gray-600 text-sm mb-3">Uniforme personalizado de alta calidad para empresas e instituciones.</p>
      <button class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-full">Agregar al carrito</button>
    </div>
  </div>
</section>
@endsection
