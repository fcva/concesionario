<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const formulario=useForm({
    nombre: '',
    direccion: '',
    telefono: '',
});

const createProvider = () => {
  const url=route('provider.store');

    // Lógica para enviar el formulario
    formulario.post(url, {
        onSuccess: (response) => {
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
                    <form class="w-full max-w-sm mx-auto" @submit.prevent="createProvider">
                        <div class="mb-4">
                          <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">
                            Nombre
                          </label>
                          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nombre" type="text" placeholder="Nombre de proveedor" autocomplete="off" required v-model="formulario.nombre">
                        </div>
                        <div class="mb-4">
                          <label class="block text-gray-700 text-sm font-bold mb-2" for="direccion">
                            Direccion
                          </label>
                          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="direccion" type="text" placeholder="Direccion del proveedor" autocomplete="off" required v-model="formulario.direccion">
                        </div>
                        <div class="mb-4">
                          <label class="block text-gray-700 text-sm font-bold mb-2" for="telefono">
                            Telefono
                          </label>
                          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="telefono" type="tel" placeholder="Telefono del proveedor" autocomplete="off" required v-model="formulario.telefono">
                        </div>
                        <div class="flex items-center justify-between">
                          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Guardar Proveedor
                          </button>
                          <Link :href="route('provider.index' )" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Salir</Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
