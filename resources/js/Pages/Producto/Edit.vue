<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const props=defineProps({
    producto:{
        type: Object,
        required: true,
    },
});

const formulario=useForm({
    codigo: props.producto.codigo,
    nombre: props.producto.nombre,
    marca: props.producto.marca,
    modelo: props.producto.modelo,
});

const submitProducto = () => {
    // Lógica para enviar el formulario
    formulario.put(route('producto.update', props.producto), {
        onSuccess: () => {
            console.log('Producto actualizado con éxito!');
        },
        onError: (errors) => {
            console.error('Errores de validación:', errors);
        }
    })
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Providers
            </h2>
            
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div>
                    <form class="w-full max-w-sm mx-auto" @submit.prevent="submitProducto">
                        <div class="mb-4">
                          <label class="block text-gray-700 text-sm font-bold mb-2" for="codigo">
                            Codigo
                          </label>
                          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="codigo" type="text" placeholder="Codigo del producto" required v-model="formulario.codigo">
                        </div>
                        <div class="mb-4">
                          <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">
                            Nombre
                          </label>
                          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombre" type="text" placeholder="Nombre del producto" required v-model="formulario.nombre">
                        </div>
                        <div class="mb-4">
                          <label class="block text-gray-700 text-sm font-bold mb-2" for="marca">
                            Marca
                          </label>
                          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="marca" type="text" placeholder="Marca" required v-model="formulario.marca">
                        </div>
                        <div class="mb-4">
                          <label class="block text-gray-700 text-sm font-bold mb-2" for="modelo">
                            Modelo
                          </label>
                          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="modelo" type="tel" placeholder="Modelo del producto" required v-model="formulario.modelo">
                        </div>
                        <div class="flex items-center justify-between">
                          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Guardar
                          </button>
                          <Link :href="route('producto.index' )" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Salir</Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
